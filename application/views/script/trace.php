<script type="text/javascript">
	Dropzone.autoDiscover = false;
	$(document).ready(function(){  
		if($("#mode").val() == 'view') {
			app.mode = 'view';
			$("#id").change();
		}

		
	});
	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	      this.loadHistory();
	      
	    },
	    updated: function () {
	    	var that = this;
	    	// that.initialize();
	    	if(that.status_update == 'DITERIMA'){
      			app.dropzone();
	    		
	    	}
	    },
	    data: {
	      history: [],
	      maps: [],
	      overlay: false,
	      status_update:'',
	      id: '',
	      last_status:''
	    },
	    methods: {
	    	loadHistory: function () {
		        var that = this;

		        jQuery.ajax({
		          type: "GET",
		          cache:false,
		          url: '<?= base_url() ?>Trace/getHistory',
		          data: {id: $("#id").val()},
		          success: function(response) {          
		              	that.history = response;
		              	for (var i=0; i<response.length; i++){
		              		if(response[i]['latitude'] != null){		              			
			              		that.maps.push({
							      mapContainer: 'maps'+ response[i]['id'],
							      address: 'address'+ response[i]['id'],
							      lat: response[i]['latitude'],
							      lng: response[i]['longitude'],
							      status: response[i]['status'],
							    });
		              		}
		              		that.last_status = response[i]['status'];
		              	}
		              	that.initialize();      
		          },
		        });
		    },
		    initialize: function(){
		    	var that = this;
		    	var infoWindow = new google.maps.InfoWindow, marker,i;
		    	
		        for(var i = 0; i < that.maps.length; i++)
			    {
			       	var uluru = {
			       		lat: parseFloat(that.maps[i].lat), 
			       		lng: parseFloat(that.maps[i].lng)
			       	};

			       	var mapOptions = {
			            mapTypeId: google.maps.MapTypeId.ROADMAP
			        } 

			       	var peta = new google.maps.Map(
			         	document.getElementById(that.maps[i].mapContainer), {zoom: 16, center: uluru, gestureHandling: "greedy"}
			       	);

			       	var bounds = new google.maps.LatLngBounds();

			       	var lokasi = new google.maps.LatLng(that.maps[i].lat, that.maps[i].lng);
		            bounds.extend(lokasi);
		            marker = new google.maps.Marker({
		                map: peta,
		                position: lokasi,
		                content: that.maps[i].status
		            });       

		            // peta.fitBounds(bounds);
		            google.maps.event.addListener(marker, 'click', (function(marker, i) {
				        return function() {
				            infoWindow.setContent(marker['content']);
				            infoWindow.open(peta, marker);
				        }
				    })(marker, i));

		            that.getAddress({ location: uluru }, that.maps[i].address);

			    }
		    },
		    getAddress: function(location, address){
		    	const geocoder = new google.maps.Geocoder();
		    	geocoder.geocode(location, (results, status) => {
		          	if (status === "OK") {
			            if (results[0]) {
			            	$('#' + address).text(results[0].formatted_address);
			            } else {
			              window.alert("No results found");
			            }
		          	} else {
		            	// window.alert("Geocoder failed due to: " + status);
		          	}
		        });
		    },
		    dropzone: function(){
		    	var that = this;
		    	var foto_upload= new Dropzone("#dropzone",{
					url: "<?= base_url()?>trace/proses_upload",
					maxFilesize: 5,
					method:"post",
					acceptedFiles:"image/*",
					paramName:"userfile",
					dictInvalidFileType:"Type file ini tidak dizinkan",
					dictFileTooBig: 'Image is larger than 16MB',
					addRemoveLinks:true,	
					init: function() {  
		              	myDropzone = this;            
		              	$.get('<?= base_url()?>trace/getImage', { id: $("#id").val() }, function(data){ 
							$.each(data, function(key,value) {
					          var mockFile = { name: value.name, size: value.size,token: value.token };

					          myDropzone.emit("addedfile", mockFile);
					          myDropzone.emit("thumbnail", mockFile, value.path);
					          myDropzone.emit("complete", mockFile);
					          $('<a href="' + value.path +'" class="preview-dropzone" target="_blank">Preview File</a>').insertAfter(mockFile._removeLink);  
					        });
				           
				        });                                  
		          	}    		
				});

				foto_upload.on("sending",function(a,b,c){
					a.token=Math.random();
					c.append("token_foto",a.token); 
					c.append("id_rs", $("#id").val()); 
					c.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
				});

				//Event ketika foto dihapus
				foto_upload.on("removedfile",function(a){
					var token=a.token;
					var csrfName = $('#csrf_token').attr('name'); // Value specified in $config['csrf_token_name']
		          	var csrfHash = $('#csrf_token').val();
					$.ajax({
						type:"post",
						data:{token:token,[csrfName]: csrfHash},
						url:"<?= base_url()?>trace/remove_foto",
						cache:false,
						dataType: 'json',
						success: function(){
							console.log("Foto terhapus");
						},
						error: function(){
							console.log("Error");

						}
					});
				});
		    }
	    }
	})

	$( "#no" ).autocomplete({
      	source: function( request, response ) {
          $.ajax({
            url: "<?=base_url()?>trace/get_autocomplete",
            type: 'get',
            dataType: "json",
            data: {
              term: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          $('#no').val(ui.item.label);
          $('#id').val(ui.item.value).change(); 
          return false;
        }
    })

    $("#id").change(function(e, params){
    	app.id = $("#id").val();
		$.get('<?= base_url()?>trace/get', { id: $("#id").val() }, function(data){ 
				$("#nomor_spk").text(data['data']['spk_no']);
				$("#moda").text(data['moda']['moda_name'] + '-' + data['moda']['moda_kategori'] + '-' + data['moda']['moda_subkategori']);
				$("#project").text(data['data']['nama_project']);
				$("#tgl_routing").text(data['data']['CreatedDate']);

				$("#attn_pengirim").text(data['data']['attn_pengirim']);
				$("#nama_pengirim").text(data['data']['nama_pengirim']);
				$("#alamat_pengirim").text(data['data']['alamat_pengirim']);
				$("#kota_pengirim").text(data['data']['kota_pengirim']);
				$("#kec_pengirim").text(data['data']['kec_pengirim']);
				$("#zip_pengirim").text(data['data']['zip_pengirim']);
				$("#hp_pengirim").text(data['data']['hp_pengirim']);

				$("#attn_penerima").text(data['data']['attn_penerima']);
				$("#nama_penerima").text(data['data']['nama_penerima']);
				$("#alamat_penerima").text(data['data']['alamat_penerima']);
				$("#kota_penerima").text(data['data']['kota_penerima']);
				$("#kec_penerima").text(data['data']['kec_penerima']);
				$("#zip_penerima").text(data['data']['zip_penerima']);
				$("#hp_penerima").text(data['data']['hp_penerima']);

				app.loadHistory();
				app.dropzone();
				// addMarker(-6.269799187863608, 107.0918477788778, 'status');

		})
	})

	$("#status_update").change(function() {
      app.status_update = $(this).val();

    });


    function initialize(){
    	map = new google.maps.Map(document.getElementById("your-location"), {
		    center: { lat: -34.397, lng: 150.644 },
		    zoom: 16,
		  });
		infoWindow = new google.maps.InfoWindow();
	  	if (navigator.geolocation) {
	      	navigator.geolocation.getCurrentPosition(
		        (position) => {
		        	$("#lat").val(position.coords.latitude);
		        	$("#long").val(position.coords.longitude);
		         	const pos = {
		            	lat: position.coords.latitude,
		            	lng: position.coords.longitude,
		          	};
		          	infoWindow.setPosition(pos);
		          	infoWindow.setContent("Location found.");
		          	infoWindow.open(map);
		          	map.setCenter(pos);

		          	var lokasi = new google.maps.LatLng(pos);
		          	var marker = new google.maps.Marker({
		                map: map,
		                position: lokasi,
		            });   

		          	const geocoder = new google.maps.Geocoder();
			    	geocoder.geocode({ location: pos }, (results, status) => {
			          	if (status === "OK") {
				            if (results[0]) {
				            	$('#pickup_address').text(results[0].formatted_address);
				            } else {
				              window.alert("No results found");
				            }
			          	} else {
			            	window.alert("Geocoder failed due to: " + status);
			          	}
			        });
		        },
		        () => {
		          handleLocationError(true, infoWindow, map.getCenter());
		        }
	      	);
	    } else {
	      // Browser doesn't support Geolocation
	      handleLocationError(false, infoWindow, map.getCenter());
	    }
    }

    $('#btnSPickup').on('click', function (event) {
    	event.preventDefault();
		var valid = false;
    	var sParam = $('#formPickup').serialize();
    	var validator = $('#formPickup').validate({
							rules: {
									nomor_plat: {
							  			required: true
									},
									driver: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = '<?= base_url(); ?>trace/Pickup';
	 		if($(".jdl").text() == "UPDATE STATUS LOKASI"){
	 			link = '<?= base_url(); ?>trace/Update';
	 		}
	 		$.post(link,sParam, function(data){
				if(data.error==false){	
					alertOK(window.location.reload());
				}else{	
					alertError(data.message);				  	
				}
			},'json');
	 	}
        
    });
 
</script>