<script type="text/javascript">

	$(document).ready(function(){  
		$(".js-example-basic-single").select2();
		$(".tujuan").val($('#tujuan').val());
		$(".asal").val($('#asal').val());
		$(".moda").val($('#moda_tran option:selected').text());
		$("#rute").text($('#asal').val().trim() + '-' + $('#tujuan').val().trim() );
		getLayanan();
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

    $(".btn-next").on('click', function (event) {
    	target = $('a[data-toggle="tab"].active').attr("href");
    	if(target == "#pengirim" || target == "#moda"){
    		$(".tujuan").val($('#tujuan').val());
    		$(".asal").val($('#asal').val());
    		$(".moda").val($('#moda_tran').val());
    	}
    });
    $(".btn-finish").on('click', function (event) {
    	var sParam = $('#form-wizard').serialize();
    	var link = 'Connote/Header';
 		$.post(link,sParam, function(data){
			if(data.error==false){	
				alert('sukses');
			}else{	
				alert('gagal menyimpan....');  					  	
			}
		},'json');
    })

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

    $("#asal").change(function(e, params){              
    	getLayanan();
	});
	$("#tujuan").change(function(e, params){              
    	getLayanan();
	});
	$("#moda_tran").change(function(e, params){              
		getLayanan();
		if($("#moda_tran").val()=='CR'){
			$("#tableTransit").css("display","block");
		}else{
			$("#tableTransit").css("display","none");
		}
	});

	function getLayanan(){
		$(".tujuan").val($('#tujuan').val());
		$(".asal").val($('#asal').val());
		$(".moda").val($('#moda_tran option:selected').text());
		$.get('Connote/getServices', { asal: $('#asal').val(), tujuan: $('#tujuan').val(), moda: $('#moda_tran').val() }, function(data){ 
    			if(data.length>0){
	    			$('#paket').empty();
		    		$.each(data,function(i,value){
	                	$('#paket').append('<option value='+value.id_services+'>'+value.nama_services+'</option>');
	            	})
	            	$("#estimasi").val(data[0]['estimasi_day']);
	            	$("#biaya").val(data[0]['tarif']);
	    		}else{
	    			alert('layanan tidak ditemukan');
	    			$('#paket').empty();
	    			$("#estimasi").val('');
	            	$("#biaya").val(0);
	    		}			
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
	
</script>