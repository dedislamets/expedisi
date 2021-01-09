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
		$(".moda").val($('#moda_tran option:selected').text());

		$('.list-moda').hover(
			function(){
				$(this).css('background-image','linear-gradient(to right,  #144322 , red, yellow)');
			},
			function(){
				$(this).css('background-image','none');
			}
		);

		$('#ViewTableSPK').DataTable({
			ajax: {		            
	            "url": "<?= base_url(); ?>listspk/dataTableSPK",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
			columnDefs:[
				{ "width": "100px", "targets": [4,3,2] },
				
			]

	    });

		if($("#mode").val() == 'edit') {
			pilih($("#id_spk").val());
			$("#p-moda").removeClass('hidden');
			$("#t_moda").text('<?= empty($data) ? "" : $data['moda_name'] ?>');
			$("#moda_tran").change();
		}
	})

    $(".list-moda").on('click', function (event) {
    	var tipe = $(this).data('moda');
    	var moda = $(this).data('moda') + ' - ' + $(this).data('kat') + ' - ' + $(this).data('sub');
    	$("#t_moda").text(moda);
    	$("#text-moda").val(moda);
    	$("#img-moda").attr('src',$(this).find('img').attr('src'));
    	$("#moda_tran").val($(this).attr('id'));
    	$("#jenis_moda").val(tipe);

    	$("#p-moda").removeClass('hidden');
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

    $('#btn-finish').on('click', function (event) {
    	event.preventDefault();
		var valid = false;
    	var sParam = $('#form-routing').serialize();
    	var validator = $('#form-routing').validate({
							rules: {
									nomor_rs: {
							  			required: true
									},
									nomor_spk: {
							  			required: true
									},
									moda_tran: {
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
	 		var link = '<?= base_url(); ?>Cargo/Header';
	 		$.post(link,sParam, function(data){
				if(data.error==false){	
					alertOK();
				}else{	
					alertError(data.message);				  	
				}
			},'json');
	 	}
        
    });

    $("#moda_tran").change(function(e, params){              
    	$.get('<?= base_url()?>Cargo/getInfoModa', { id: $(this).val() }, function(data){ 
    		var tipe = data['moda_name'];
	    	var moda = data['moda_name'] + ' - ' + data['moda_kategori'] + ' - ' + data['moda_subkategori'];
	    	$("#t_moda").text(moda);
	    	$("#text-moda").val(moda);

	    	$("#img-moda").attr('src','<?= base_url(); ?>assets/images/' + data['moda_subimage']);
	    	$("#jenis_moda").val(tipe);

	    	$("#p-moda").removeClass('hidden');
	    	$(".dp").addClass('hidden');
	    	if(tipe == 'Darat') {
	    		$("#dp-darat").removeClass('hidden');
	    	}else if(tipe == 'LAUT'){
	    		$("#dp-laut").removeClass('hidden');
	    	}else if(tipe == 'UDARA'){
	    		$("#dp-udara").removeClass('hidden');
	    	}
    	});
	});
	$("#tujuan").change(function(e, params){              
    	// getLayanan();
	});
	$("#moda_tran").change(function(e, params){              
		// getLayanan();
		if($("#moda_tran").val()=='CR'){
			$("#tableTransit").css("display","block");
		}else{
			$("#tableTransit").css("display","none");
		}
	});

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('Connote/delete', { id: $(val).data('id') }, function(data){ 
				datatable.ajax.reload();
			})
		}
	}

	function pilih(val){
		$.get('<?= base_url()?>spk/get', { id: val }, function(data){ 
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
	
</script>