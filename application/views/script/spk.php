<script type="text/javascript">
	var app = new Vue({
        el: "#app",
        data: {
        	asal:'',
        	tujuan:'',
        	moda:'',
        	nama_pengirim: '',
        	alamat_pengirim:'',
        	hp_pengirim:'',
        	nama_penerima: '',
        	alamat_penerima:'',
        	hp_penerima:'',
        }
    });


	$(document).ready(function(){  

		$(".js-example-basic-single").select2();
		$(".tujuan").val($('#tujuan').val());
		$(".asal").val($('#asal').val());
		$(".moda").val($('#moda_tran option:selected').text());
		// $("#rute").text($('#asal').val().trim() + '-' + $('#tujuan').val().trim() );
		// getLayanan();

		$('.list-moda').hover(
			function(){
				$(this).css('background-image','linear-gradient(to right,  #144322 , red, yellow)');
			},
			function(){
				$(this).css('background-image','none');
			}
		);
	})
	var datatable = $('#ViewTableBrg').DataTable({
		
		ajax: {		            
            "url": "Connote/dataTableDetail",
            "type": "GET",
            "data":{'resi': $("#resi").val()}
        },
  //       processing	: true,
		// serverSide	: true,			
		"bPaginate": false,
		"bFilter": false,	
		"autoWidth": true,
		"bInfo": false,
		columnDefs:[
			{ "width": "60px", "targets": [4] },
			
		]

    });

    $('#ViewTable').DataTable({
		ajax: {		            
            "url": "spk/dataTable",
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
    	$('#ModalCust').modal({backdrop: 'static', keyboard: false}) ;
    });
    $(".btnAddPenerima").on('click', function (event) {
    	$('#ModalCust').modal({backdrop: 'static', keyboard: false}) ;
    });

    $(".btnCariPengirim").on('click', function (event) {
    	$('#modalCust2').modal({backdrop: 'static', keyboard: false}) ;
    });
    $(".btnCariPenerima").on('click', function (event) {
    	$('#modalCust2').modal({backdrop: 'static', keyboard: false}) ;
    });

    $("#region_pengirim").change(function(e, params){              
    	getKecamatan($('#region_pengirim').val(),'kecamatan_pengirim','zip_pengirim');
	});
	$("#kecamatan_pengirim").change(function(e, params){   
		getZipCode($('#kecamatan_pengirim option:selected').text(),'zip_pengirim');
	});
	$("#region_penerima").change(function(e, params){              
    	getKecamatan($('#region_penerima').val(),'kecamatan_penerima','zip_penerima');
	});
	$("#kecamatan_penerima").change(function(e, params){   
		getZipCode($('#kecamatan_penerima option:selected').text(),'zip_penerima');
	});


    $('#btnAdd').on('click', function (event) {
    	event.preventDefault();
		$("#lbl-title").text('Tambah');
		// $("#jenis").val('Gadget');
		// $("#satuan").val('Kg');
		$("#nama_barang").val('');
		// $("#berat_barang").val(0);
		// $("#id_barang").val('');
		// $('#Form').find(':input:disabled').removeAttr('disabled');
		
		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

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

    $('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize() + "&resi=" + $("#resi").val();
    	var validator = $('#Form').validate({
							rules: {
									nama_barang: {
							  			required: true
									},
									qty: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'Connote/Save';
	 		$.post(link,sParam, function(data){
				if(data.error==false){	
					$('#ModalAdd').modal('hide');
					datatable.ajax.reload();								
					// window.location.reload();
				}else{	
					$("#lblMessage").remove();
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
        
    });

	$("#btn-finish").on('click', function (event) {
		event.preventDefault();
    	var sParam = $('#form-wizard').serialize();
    	var link = 'Cargo/Header';
 		$.post(link,sParam, function(data){
			if(data.error==false){	
				window.location.href="packinglist";
			}else{	
				alert('gagal menyimpan....');  					  	
			}
		},'json');
    })

	function getKecamatan(val,name, zip){
		$.get('spk/getKecamatan', { kota: val  }, function(data){ 

			$('#' + name).empty();
    		$.each(data,function(i,value){
            	$('#' + name).append('<option value='+value.kecamatan+'>'+value.kecamatan+'</option>');
            	
        	})
	    	getZipCode($('#' + name + ' option:selected').text(),zip);
	    });
	}
	function getZipCode(val,name){

		$.get('spk/getZipCode', { kecamatan	: val }, function(data){ 

			$('#'+ name).empty();
    		$.each(data,function(i,value){
            	$('#'+name).append('<option value='+value.kodepos+'>'+value.kodepos+'</option>');
        	})
	    				
	    });
	}
	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('Connote/delete', { id: $(val).data('id') }, function(data){ 
				datatable.ajax.reload();
			})
		}
	}

	function editmodal(val){
		var row = $(val).parent().prevAll();
		$.get('spk/getCustomer', { id: $(val).data('id') }, function(data){ 
			$("#attn_pengirim").val(data[0]['attn']);
			$("#phone_pengirim").val(data[0]['phone1']);
			$("#region").val(data[0]['region']);
			$("#nama_pengirim").val(data[0]['cust_name']);
			$("#alamat_pengirim").val(data[0]['cust_address']);
			$("#id_pengirim").val(data[0]['id']);
			$('#modalCust2').modal('hide');
		})
	}
	
</script>