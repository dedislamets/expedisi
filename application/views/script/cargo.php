<script type="text/javascript">
	Dropzone.autoDiscover = false;
	var app = new Vue({
        el: "#app",
        mounted: function () {
	      this.loadHistory();
	    },
	    updated: function () {
	    	var that = this;
	    	if(that.last_status == 'DALAM PERJALANAN'){
      			app.dropzone();
	    		
	    	}
	    },
        data: {
        	mode:'new',
        	id_spk: '',
        	moda_tran: '',
        	id_rs:'',
        	last_status:'<?= empty($data) ? "INPUT" : $data['status'] ?>',
        	moda_kat:'<?= empty($data) ? "" : $data['id_moda_kat'] ?>',
        	history: [],
        },
        methods: {
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
		              	$.get('<?= base_url()?>trace/getImage', { id: $("#id_rs").val() }, function(data){ 
							$.each(data, function(key,value) {
					          var mockFile = { name: value.name, size: value.size,token: value.token };

					          myDropzone.emit("addedfile", mockFile);
					          myDropzone.emit("thumbnail", mockFile, value.path);
					          myDropzone.emit("complete", mockFile);
					          $('<a href="' + value.path +'" class="preview-dropzone" target="_blank" >Preview File</a>').insertAfter(mockFile._removeLink);  
					        });
				           
				        });                                  
		          	}    		
				});

				foto_upload.on("sending",function(a,b,c){
					a.token=Math.random();
					c.append("token_foto",a.token); 
					c.append("id_rs", $("#id_rs").val()); 
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
		    },
		    updateHistory: function(){
		    	var that = this;
		    	var sParam = $('#form-routing').serialize();
		    	var link = '<?= base_url(); ?>Cargo/updatehistory';
		 		$.post(link,sParam, function(data){
					that.loadHistory();
				},'json');
		    },
		    loadHistory: function () {
		        var that = this;

		        jQuery.ajax({
		          type: "GET",
		          cache:false,
		          url: '<?= base_url() ?>Trace/getHistory',
		          data: {id: $("#id_rs").val()},
		          success: function(response) {          
		              that.history = response;
		          },
		        });
		    },
		    getCustPengirim: function(id){
		    	var that = this;
		    	$.get('customer/edit', { id: id }, function(data){ 
	         		$("#attn_pengirim").val(data['parent'][0]['attn']);
					$("#phone_pengirim").val(data['parent'][0]['phone1']);
					$("#region_pengirim").val(data['parent'][0]['region']);
					$("#nama_pengirim").val(data['parent'][0]['cust_name']);
					$("#alamat_pengirim").val(data['parent'][0]['cust_address']);
					$("#id_pengirim").val(data['parent'][0]['id']);
		
	           		$('#ModalCust').modal('hide');
	           
	        	});
		    },
		    getCustPenerima: function(id){
		    	var that = this;
		    	$.get('customer/edit', { id: id }, function(data){ 
	         		$("#attn_penerima").val(data['parent'][0]['attn']);
					$("#phone_penerima").val(data['parent'][0]['phone1']);
					$("#region_penerima").val(data['parent'][0]['region']);
					$("#nama_penerima").val(data['parent'][0]['cust_name']);
					$("#alamat_penerima").val(data['parent'][0]['cust_address']);
					$("#id_penerima").val(data['parent'][0]['id']);
		
	           		$('#ModalCust').modal('hide');
	           
	        	});
		    },
		    clearCust: function(){
		    	var that = this;
		    	$("#cust_name").val('');
				$("#cust_address").val('');
				$("#region").val('');
				$("#attn").val('');
				$("#phone1").val('');
				$("#phone2").val('');
				$("#tipe").val('');
		    }
        }
    });


	$(document).ready(function(){  
		$(".js-example-basic-single").select2();
		$(".moda").val($('#moda_tran option:selected').text());


		$('.list-moda').hover(
			function(){
				$(this).css('background-image','linear-gradient(to right,  #144322 , red, yellow)');
			},
			function(){
				$(this).css('background-image','none');
			}
		);

		// $('#ViewTableSPK').DataTable({
		// 	ajax: {		            
	 //            "url": "<?= base_url(); ?>listspk/dataTableSPK",
	 //            "type": "GET"
	 //        },
	 //        processing	: true,
		// 	serverSide	: true,			
		// 	"bPaginate": true,	
		// 	"autoWidth": true,
		// 	columnDefs:[
		// 		{ "width": "100px", "targets": [4,3,2] },
				
		// 	]

	 //    });

		if($("#mode").val() == 'edit') {
			app.mode = 'edit';
			$("#t_moda").text('<?= empty($data) ? "" : $data['moda_name'] ?>');
			$("#moda_tran").change();
			$("#id_pengirim").change();
			$("#id_penerima").change();

		}
	})


	$('#ModalTableBrg').DataTable({
		ajax: {		            
	            "url": "<?= base_url(); ?>spk/dataTableBrg",
	            "type": "GET"
	        },
        processing	: true,
		serverSide	: true,			
		"bPaginate": true,	
		"autoWidth": true,
    });

    $('#ViewTable').DataTable({
		ajax: {		            
            "url": "<?= base_url(); ?>spk/dataTable",
            "type": "GET"
        },
        processing	: true,
		serverSide	: true,			
		"bPaginate": true,	
		// "ordering": false,
		"autoWidth": true,
		// "order": [[ 4, "desc" ]],
		columnDefs:[
			{ "width": "100px", "targets": [4,3,2] },
			
		]

    });

	$(".btnAddPengirim").on('click', function (event) {
		app.clearCust();
		$("#tipe").val('pengirim');
    	$('#ModalCust').modal({backdrop: 'static', keyboard: false}) ;
    });
    $(".btnAddPenerima").on('click', function (event) {
    	app.clearCust();
    	$("#tipe").val('penerima');
    	$('#ModalCust').modal({backdrop: 'static', keyboard: false}) ;
    });

    $(".btnCariPengirim").on('click', function (event) {
    	$("#lbl-title-cust").text('Pengirim');
    	$('#modalCust2').modal({backdrop: 'static', keyboard: false}) ;
    });
    $(".btnCariPenerima").on('click', function (event) {
    	$("#lbl-title-cust").text('Penerima');
    	$('#modalCust2').modal({backdrop: 'static', keyboard: false}) ;
    });
    $("#btnCariBarang").on('click', function (event) {
    	$('#modalBarang').modal({backdrop: 'static', keyboard: false}) ;
    });

    $("#region_pengirim").change(function(e, params){              
    	getKecamatan($('#region_pengirim').val(),'kecamatan_pengirim','zip_pengirim','region_pengirim');
	});
	$("#kecamatan_pengirim").change(function(e, params){   
		getZipCode($('#kecamatan_pengirim option:selected').text(),'zip_pengirim',$('#region_pengirim option:selected').text());
	});
	$("#region_penerima").change(function(e, params){              
    	getKecamatan($('#region_penerima').val(),'kecamatan_penerima','zip_penerima','region_penerima');
	});
	$("#kecamatan_penerima").change(function(e, params){   
		getZipCode($('#kecamatan_penerima option:selected').text(),'zip_penerima',$('#region_penerima option:selected').text());
	});

	$("#id_pengirim").change(function(e, params){   
		$.get('<?= base_url() ?>defaults/getbyid/master_customer/id', { id	: $(this).val() }, function(data){ 
			$("#nama_pengirim").val(data['cust_name']);			
	    });
	});
	$("#id_penerima").change(function(e, params){   
		$.get('<?= base_url() ?>defaults/getbyid/master_customer/id', { id	: $(this).val() }, function(data){ 
			$("#nama_penerima").val(data['cust_name']);			
	    });
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									cust_name: {
							  			required: true
									},
									cust_address: {
							  			required: true
									},
									region: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'customer/Save';
	 		$.post(link,sParam, function(data){
				if(data.error==false){	
					if($("#tipe").val() == "penerima"){
						app.getCustPenerima(data.id);
					}else{
						app.getCustPengirim(data.id);
					}								
				}else{	
					$("#lblMessage").remove();
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
        
    });

	$('#btnAdd').on('click', function (event) {
		event.preventDefault();
		var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
		if( $.isNumeric( nomor ) ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		$('#total-row').val(nomor);
		$(".no-data").remove();
		var baris = '<tr>';
		baris += '<td style="width:1%">'+ nomor+'</td>';
		baris += '<td style="width:8%"><input type="text" id="kode'+ nomor +'" name="kode'+ nomor +'" placeholder="Kode Item" class="form-control hidden"><input type="text" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control hidden" value=""><a href="javascript:void(0)" class="btn hor-grd btn-grd-success" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
		baris += '<td style="width:29%">Nama Item</td>';
		baris += '<td style="width:10%"><input type="text" name="qty'+ nomor +'" id="qty'+ nomor +'" class="form-control" value="0"/></td>';
		baris += '<td style="width:25%"><input type="text" name="satuan'+ nomor +'" id="satuan'+ nomor +'" class="form-control"/></td>';
		baris += '<td style="width:25%"><input type="number" id="kg'+ nomor +'" name="kg'+ nomor +'" placeholder="" class="form-control" style="width:100%" value="0"></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}
		
		//$('#tbody-table tr:nth-last-child(2) td:first-child').html(nomor);
		// $('html, body').scrollTop( $(document).height() );
	});

	$('#btnAddModa').on('click', function (event) {
		event.preventDefault();
		var nomor = $('#tbody-table-multi tr:nth-last-child(1) td:first-child').html();
		if( $.isNumeric( nomor ) ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		$('#total-row-multi').val(nomor);
		$(".no-data").remove();
		var baris = '<tr>';
		baris += '<td style="width:1%">'+ nomor+'</td>';
		baris += '<td style="width:8%"><input type="text" id="id_detail_multi_'+ nomor +'" name="id_detail_multi_'+ nomor +'" class="form-control hidden" value=""><input type="hidden" id="deleted_'+ nomor +'" name="deleted_'+ nomor +'" value="0"> <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancelMulti(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
		
		baris += '<td><input type="text" name="aktifitas_'+ nomor +'" id="aktifitas_'+ nomor +'" class="form-control"/></td>';
	
		baris += '</tr>';
		
		var last = $('#tbody-table-multi tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table-multi");
		}else{
			$('#tbody-table-multi tr:last').after(baris);
		}
	});

    $(".list-moda").on('click', function (event) {
    	var tipe = $(this).data('moda');
    	var moda = $(this).data('moda') + ' - ' + $(this).data('kat') + ' - ' + $(this).data('sub');
    	$("#t_moda").text(moda);
    	$("#text-moda").val(moda);
    	$("#img-moda").attr('src',$(this).find('img').attr('src'));
    	$("#moda_tran").val($(this).attr('id'));
    	app.moda = $("#moda_tran").val();
    	$("#jenis_moda").val(tipe);

    	$(".dp").addClass('hidden');
    	if(tipe == 'Darat') {
    		$("#dp-darat").removeClass('hidden');
    	}else if(tipe == 'LAUT'){
    		$("#dp-laut").removeClass('hidden');
    	}else if(tipe == 'UDARA'){
    		$("#dp-udara").removeClass('hidden');
    	}
    	$('#modalModa').modal('hide');
    });

    $('#btnModa').on('click', function (event) {
    	$('#modalModa').modal({backdrop: 'static', keyboard: false}) ;
    });
    $('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });

    function cari_dealer(val) {
		event.preventDefault();
		$("#id-row").val($(val).prev().prev().attr('id'));
		$("#modalBarang").modal({backdrop: 'static', keyboard: false}) ;  	   
	}
   	
   	function cancelMulti(val) {
		var id=$(val).prevAll()[1].value;
		if(id != ""){
			// debugger;
			$(val).prevAll()[0].value = 1;
			$(val).parent().parent().addClass('hidden');

		}else{
			$(val).parent().parent().remove();
		}
	}

	$( "#nama_barang" ).autocomplete({
      // source: "<?php echo site_url('Connote/get_autocomplete/?');?>"
      	source: function( request, response ) {
          $.ajax({
            url: "<?=base_url()?>Connote/get_autocomplete",
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
          $('#nama_barang').val(ui.item.label); // display the selected text
          $('#kode_barang').val(ui.item.value); 
          $('#berat_barang').val(ui.item.berat_barang);
          $('#satuan').val(ui.item.satuan);
          return false;
        }
    })

    $('#btn-finish').on('click', function (event) {
    	event.preventDefault();
		var valid = false;
    	var sParam = $('#form-routing').serialize();
    	var validator = $('#form-routing').validate({
							rules: {
									nomor_rs: {
							  			required: true
									},
									project: {
							  			required: true
									},
									moda_tran: {
							  			required: true
									},
									moda_kat: {
							  			required: true
									},
									agent: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		if(validateBarang()){
		 		var link = '<?= base_url(); ?>Cargo/Header';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alertOK();
						window.location.href = '<?= base_url(); ?>Cargo/edit/' + data.id;
					}else{	
						alertError(data.message);				  	
					}
				},'json');
		 	}
	 	}
        
    });

    $("#moda_tran").change(function(e, params){              
    	// $.get('<?= base_url()?>Cargo/getInfoModa', { id: $(this).val() }, function(data){ 
    		// var tipe = data['moda_name'];
	    // 	var moda = data['moda_name'] + ' - ' + data['moda_kategori'] ;
	    // 	$("#t_moda").text(moda);
	    // 	$("#img-moda").attr('src','<?= base_url(); ?>assets/images/' + data['moda_subimage']);
	    // 	$("#jenis_moda").val(tipe);

	    	$(".dp").addClass('hidden');
    		var tipe = $(this).val();

	    	if(tipe == 1) {
	    		$("#dp-darat").removeClass('hidden');
	    	}else if(tipe == 2){
	    		$("#dp-laut").removeClass('hidden');
	    	}else if(tipe == 3){
	    		$("#dp-udara").removeClass('hidden');
	    	}
    	// });

    	$.get('<?= base_url()?>Cargo/getModaKategori', { id: $(this).val()   }, function(data){ 

			$('#moda_kat').empty();
    		$.each(data,function(i,value){
            	$('#moda_kat').append('<option value='+value.id+'>'+value.moda_kategori+'</option>');
            	
        	})
    		$("#moda_kat").val(app.moda_kat);
    		 var moda = $('#moda_tran option:selected').text();
	    	$("#text-moda").val(moda + " - " + $('#moda_kat option:selected').text());
	    });
	    var moda = $('#moda_tran option:selected').text();
	    $("#text-moda").val(moda + " - " + $('#moda_kat option:selected').text());
	});
	$("#moda_kat").change(function(e, params){   
		app.moda_kat=$(this).val();           
    	var moda = $('#moda_tran option:selected').text();
	    $("#text-moda").val(moda + " - " + $('#moda_kat option:selected').text());

	});

	$("#btnShowLink").on('click', function (event) {
		if($("#link").val() == ""){
			alertError('Link tidak tersedia..!');
			return false;
		}
		window.open(
		  $("#link").val() ,
		  '_blank'
		);
	});

	function validateBarang(){
    	var flag = true;
    	if($("#tbody-table").html().trim() == ""){
    		alertError('Anda belum memasukkan daftar item..');
    		flag = false;
    	}else{
    		$("#tbody-table").find('tr').each(function (i, el) {
		        var $tds = $(this).find('td');
		        if($tds.eq(1).children().val() != undefined){
			        var productId = $tds.eq(1).children().val().trim();
			        if(productId==""){
			        	alertError('Item belum dipilih..');
			        	flag= false;
			        }
			    }
		    });
    	}
    	return flag;
    }

	function editmodal(val){
		var row = $(val).parent().prevAll();
		$.get('<?= base_url()?>spk/getCustomer', { id: $(val).data('id') }, function(data){ 
			if($("#lbl-title-cust").text() == 'Pengirim'){
				$("#attn_pengirim").val(data[0]['attn']);
				$("#phone_pengirim").val(data[0]['phone1']);
				$("#region_pengirim").val(data[0]['region']);
				$("#nama_pengirim").val(data[0]['cust_name']);
				$("#alamat_pengirim").val(data[0]['cust_address']);
				$("#id_pengirim").val(data[0]['id']);
				$('#modalCust2').modal('hide');
			}else{
				$("#attn_penerima").val(data[0]['attn']);
				$("#phone_penerima").val(data[0]['phone1']);
				$("#region_penerima").val(data[0]['region']);
				$("#nama_penerima").val(data[0]['cust_name']);
				$("#alamat_penerima").val(data[0]['cust_address']);
				$("#id_penerima").val(data[0]['id']);
				$('#modalCust2').modal('hide');
			}
			
		})
	}

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('Connote/delete', { id: $(val).data('id') }, function(data){ 
				datatable.ajax.reload();
			})
		}
	}

	function pilih(val){
		$.get('<?= base_url()?>Cargo/get', { id: val }, function(data){ 
			// if($("#lbl-title-cust").text() == 'Pengirim'){
				$("#nomor_spk").val(data['data']['spk_no']);
				$("#id_spk").val(data['data']['id']);
				$("#project").val(data['data']['nama_project']);
				$("#tgl_do").val(data['data']['tgl_spk']);

				$("#attn_pengirim").text(data['data']['attn_pengirim']);
				$("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				$("#alamat_pengirim").text(data['data']['alamat_pengirim']);
				$("#kota_pengirim").text(data['data']['kota_pengirim']);
				$("#kec_pengirim").text(data['data']['kec_pengirim']);
				$("#zip_pengirim").text(data['data']['zip_pengirim']);
				$("#hp_pengirim").text(data['data']['hp_pengirim']);

				$("#attn_penerima").text(data['data']['attn_penerima']);
				$("#nama_penerima").text(data['data']['penerima']['cust_name']);
				$("#alamat_penerima").text(data['data']['alamat_penerima']);
				$("#kota_penerima").text(data['data']['kota_penerima']);
				$("#kec_penerima").text(data['data']['kec_penerima']);
				$("#zip_penerima").text(data['data']['zip_penerima']);
				$("#hp_penerima").text(data['data']['hp_penerima']);

				$("#ViewTableBrg tbody").empty();
				const tbody = $("#ViewTableBrg tbody");
				$.each(data['data_detail'], function(_, obj) {
				    tr = $("<tr />");
				    $.each(obj, function(_, text) {
				      tr.append("<td>" + text + "</td>")
				    });
				    tr.appendTo(tbody);
				});

				$('#modalBrowse').modal('hide');
			// }
			
		})
	}

	function pilih_item(val){
		var el = $("#id-row").val();
		var itemno= $(val).data('id');
		var x= true;

		$("#tbody-table").find('tr').each(function (i, el) {
	        var $tds = $(this).find('td');
	        if($tds.eq(1).children().val() != undefined){
		        var productId = $tds.eq(1).children().val().trim();
		        if(productId==itemno){
		        	alert('Item No sudah ada, silahkan masukan item lain..');
		        	x=false;
		        }
		    }
	    });
	    if(x){
			$("#"+el).val(itemno);
			var tks = $(val).parent().prev().prev().prev().prev().text();
			$("#"+el).parent().next().html(tks.replace("\n", "<br>"));
			$("#"+el).parent().next().next().children().val($(val).parent().prev().prev().text());
			$("#"+el).parent().next().next().next().children().val($(val).parent().prev().text());
			$("#"+el).parent().next().next().next().next().children().val(1);
			$("#"+el).parent().next().next().next().next().children().focus();
			$("#modalBarang").modal('hide');
		}
	}

	function cancel(val) {
		var id=$(val).prevAll()[1].value;
		if(id != ""){
			var r = confirm("Yakin dihapus?");
			if (r == true) {
				$.get('<?= base_url()?>spk/delete', { id: id }, function(data){ 
					$(val).parent().parent().remove();
				})
			}
		}else{
			$(val).parent().parent().remove();
		}
	}

	function getKecamatan(val,name, zip, kota){
		$.get('<?= base_url()?>spk/getKecamatan', { kota: val  }, function(data){ 

			$('#' + name).empty();
    		$.each(data,function(i,value){
            	$('#' + name).append('<option value="'+value.kecamatan+'">'+value.kecamatan+'</option>');
            	
        	})
	    	getZipCode($('#' + name + ' option:selected').text(),zip, $('#' + kota + ' option:selected').text());
	    });
	}
	function getZipCode(val,name,kota){

		$.get('<?= base_url()?>spk/getZipCode', { kota: kota, kecamatan	: val }, function(data){ 

			$('#'+ name).empty();
    		$.each(data,function(i,value){
            	$('#'+name).append('<option value='+value.kodepos+'>'+value.kodepos+'</option>');
        	})
	    				
	    });
	}
	
</script>