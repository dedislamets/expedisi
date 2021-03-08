<script type="text/javascript">

	var app = new Vue({
        el: "#app",
        mounted: function () {
	   
	    },
	    updated: function () {
	    	var that = this;

	    },
        data: {
        	mode:'new',
        	id_routing: '',
        	id_invoice:'',
        },
        methods: {

        }
    });


	$(document).ready(function(){  
		var c_date = new Date();
		$("#tgl_invoice").val(c_date.toLocaleDateString('en-CA'));
		$(".js-example-basic-single").select2();

		myTable = $('#ViewTableSPK').DataTable({
			ajax: {		            
	            "url": "<?= base_url(); ?>payment/dataTable?tipe=" + $('#type_payment').val(),
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,

	    });

		if($("#mode").val() == 'edit') {
			app.mode = 'edit';
			pilih_edit($("#no_invoice").val());

		}

		$('#type_payment').on('change', function() {
			var link = "getNumberVendor";
			if($(this).val() == "Customer"){
				link = "getNumber";
			}
			$.get('<?= base_url() ?>payment/'+ link, { }, function(data){ 
				$("#no_payment").val(data);		
		    });
			myTable.ajax.url("payment/dataTable?tipe=" + $('#type_payment').val() ).load();
		});
	})


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


    $('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });
    

    $('#btn-finish').on('click', function (event) {
    	event.preventDefault();
    	$.validator.addMethod('minStrict', function (value, el, param) {
		    return value > param;
		});
		var valid = false;
    	var sParam = $('#form-invoice').serialize();
    	var validator = $('#form-invoice').validate({
							rules: {
									no_payment: {
							  			required: true
									},
									no_invoice: {
							  			required: true
									},
									tgl_payment: {
							  			required: true
									},
									dibayar: {
									    required: true,
									    minStrict: 0,
									    number: true
									},
								},
							messages: {
							   dibayar: { minStrict: "Nominal Harus lebih besar dari Nol!" },
							  } 
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		validate(sParam);
	 	}
        
    });

    function validate(sParam){
    	var flag = false;
    	var totalAmount = parseFloat($('#subtotal').val());
		var dibayar = parseFloat($('#dibayar').val());
		if(dibayar < totalAmount){
			Swal.fire({
			  title: 'Yakin lanjutkan?',
			  text: "Nominal dibayar kurang dari tagihan!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, yakin!'
			}).then((result) => {
				
			  	if (result.isConfirmed) {
			  		var link = '<?= base_url(); ?>payment/Header';
			 		$.post(link,sParam, function(data){
						if(data.error==false){	
							alertOK(window.location.reload());
						}else{	
							alertError(data.message);				  	
						}
					},'json');
			  	}else{
			  		alertError('Transaksi tidak dilanjutkan karena pembayaran kurang!');	
			    	
			  	}
			})
			
		}else{
			var link = '<?= base_url(); ?>payment/Header';
	 		$.post(link,sParam, function(data){
				if(data.error==false){	
					alertOK(window.location.reload());
				}else{	
					alertError(data.message);				  	
				}
			},'json');
		}
    	
    	
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
		$.get('<?= base_url()?>payment/get', { id: val,tipe: $("#type_payment").val() }, function(data){ 
				
				$("#no_invoice").val(data['data']['no_invoice']);
				// $("#id_pengirim").val(data['data_routing']['id_pengirim']);
				// $("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				// $("#origin").text(data['data_routing']['kec_pengirim'] + ' - ' + data['data_routing']['kota_pengirim']);
				// $("#nama_penerima").text(data['data']['penerima']['cust_name']);
				// $("#destination").text(data['data_routing']['kec_penerima'] + ' - ' + data['data_routing']['kota_penerima']);
				var sisa = parseFloat(data['data']['total'])-parseFloat(data['data']['sudah_dibayar']);
				$("#label_subtotal").val(sisa.toLocaleString('id-ID'));
				$("#subtotal").val(sisa);
				// $("#vendor").text(data['data_routing']['agent']);
				$('#modalBrowse').modal('hide');
			
		})
	}

	function pilih_edit(val){
		$.get('<?= base_url()?>payment/get_edit', { id: val }, function(data){ 
				$("#id_pengirim").val(data['data_routing']['id_pengirim']);
				$("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				$("#origin").text(data['data_routing']['kec_pengirim'] + ' - ' + data['data_routing']['kota_pengirim']);
				$("#nama_penerima").text(data['data']['penerima']['cust_name']);
				$("#destination").text(data['data_routing']['kec_penerima'] + ' - ' + data['data_routing']['kota_penerima']);
				var sisa = parseFloat(data['data']['total'])-parseFloat(data['data']['sudah_dibayar']);
				$("#label_subtotal").val(sisa.toLocaleString('id-ID'));
				$("#subtotal").val(sisa);
				if(sisa	== 0 ){
					$("#btn-finish").remove();
					$("#dibayar").attr('disabled','disabled');
					$("#note").attr('disabled','disabled');
					$("#metode_payment").attr('disabled','disabled');
					$("#tgl_payment	").attr('disabled','disabled');
				}
				$('#modalBrowse').modal('hide');
			
		})
	}

	$(document).on('blur', "[id^=dibayar]", function(){
		calculateTotal();
	});	
		

	function calculateTotal(){
		var totalAmount = parseFloat($('#subtotal').val());
		var dibayar = parseFloat($('#dibayar').val());
		if(dibayar > totalAmount){
			alertError('Nominal dibayar melebihi tagihan.');	
		}
	}

	
</script>