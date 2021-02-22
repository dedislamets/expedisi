<script type="text/javascript">
	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	      this.loadHistory();
	      
	    },
	    updated: function () {
	    	
	    },
	    data: {
	      history: [],
	      alamat:'',
	      totalrow: 1
	    },
	    methods: {
	    	loadHistory: function () {
		        var that = this;

		        jQuery.ajax({
		          type: "GET",
		          cache:false,
		          url: '<?= base_url() ?>customer/edit',
		          data: {id: $("#id").val()},
		          success: function(response) {          
		              	that.history = response['child'];
		              	that.totalrow = response['total'];
		              	that.alamat= response['parent'][0]['cust_address']
		          },
		        });
		    },

	    }
	})
	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "customer/dataTable",
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

	})

	function editmodal(val){

		$.get('customer/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
         		$("#attn").val(data['parent'][0]['attn']);
				$("#phone1").val(data['parent'][0]['phone1']);
				$("#phone2").val(data['parent'][0]['phone2']);
				$("#region").val(data['parent'][0]['region']);
				$("#cust_name").val(data['parent'][0]['cust_name']);
				$("#cust_address").val(data['parent'][0]['cust_address']);
				$("#id").val(data['parent'][0]['id']);
				$("#tbody-table").html('');
				app.loadHistory();
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}

	function gantiAlamat() {
		$(".main").text(app.alamat);
    }
	
	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#cust_name").val('');
		$("#cust_address").val('');
		$("#attn").val('');
		$("#phone1").val('');
		$("#region").val('');
		$("#phone2").val('');
		$("#id").val('');
		app.history = [];
		var baris = '<tr>';
		
		baris += '<td data-id=0><input type="text" name="tag_0" id="tag_0" class="form-control" value="Main" readonly/></td>';
		baris += '<td><textarea name="alamat_0" id="alamat_0" rows="4" class="form-control required main" placeholder="" style="height: 100px;" readonly> </textarea></td>';
		baris += '<td style="width:8%"><input type="text" id="id_detail_biaya_0" name="id_detail_biaya_0" class="form-control hidden" value=""></td>';
		
	
		baris += '</tr>';
		$(baris).appendTo("#tbody-table");

		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnAddAlamat').on('click', function (event) {
		event.preventDefault();
		var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').data('id');
		if( $.isNumeric( nomor ) ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}
		app.totalrow = nomor;
		$(".no-data").remove();
		var baris = '<tr>';
		
		baris += '<td data-id='+ nomor +'><input type="text" name="tag_'+ nomor +'" id="tag_'+ nomor +'" class="form-control"/></td>';
		baris += '<td><textarea name="alamat_'+ nomor +'" id="alamat_'+ nomor +'" rows="4" class="form-control required" placeholder="" style="height: 100px;"> </textarea></td>';
		baris += '<td style="width:8%"><input type="text" id="id_detail_biaya_'+ nomor +'" name="id_detail_biaya_'+ nomor +'" class="form-control hidden" value=""><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									region: {
							  			required: true
									},
									cust_address: {
							  			required: true
									},
									cust_name: {
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
					window.location.reload();
				}else{	
					$("#lblMessage").remove();
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
        
    });

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('customer/delete', { id: $(val).data('id') }, function(data){ 
				window.location.reload();
			})
		
		}
	}

	function cancel(val) {
		var id=$(val).prevAll()[0].value;
		if(id != ""){
			var r = confirm("Yakin dihapus?");
			if (r == true) {
				$.get('<?= base_url()?>customer/delete_address', { id: id }, function(data){ 
					$(val).parent().parent().remove();
				})
			}
		}else{
			$(val).parent().parent().remove();
		}
	}
	
</script>
