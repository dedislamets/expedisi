<script type="text/javascript">

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
         		$("#attn").val(data[0]['attn']);
				$("#phone1").val(data[0]['phone1']);
				$("#phone2").val(data[0]['phone2']);
				$("#region").val(data[0]['region']);
				$("#cust_name").val(data[0]['cust_name']);
				$("#cust_address").val(data[0]['cust_address']);
				$("#id").val(data[0]['id']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

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

		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									nama_barang: {
							  			required: true
									},
									berat_barang: {
							  			required: true
									},
									jenis: {
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

	
</script>
