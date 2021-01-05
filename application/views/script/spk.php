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

		if($("#mode").val() == 'edit') {
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
    	$('#ModalCust').modal({backdrop: 'static', keyboard: false}) ;
    });
    $(".btnAddPenerima").on('click', function (event) {
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
		baris += '<td style="width:8%"><input type="text" id="kode'+ nomor +'" name="kode'+ nomor +'" placeholder="Kode Item" class="form-control hidden"><input type="text" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control hidden" value=""><a href="#" class="btn hor-grd btn-grd-success" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="#" class="btn hor-grd btn-grd-danger" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
		baris += '<td style="width:39%">Nama Item</td>';
		baris += '<td>Berat</td>';
		baris += '<td style="width:25%"><input type="text" name="satuan'+ nomor +'" id="satuan'+ nomor +'" class="form-control"/></td>';
		baris += '<td style="width:25%"><input type="number" id="qty'+ nomor +'" name="qty'+ nomor +'" placeholder="Qty" class="form-control" style="width:100%"></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}
		
		//$('#tbody-table tr:nth-last-child(2) td:first-child').html(nomor);
		$('html, body').scrollTop( $(document).height() );
	});

	$( "#cari_barang" ).autocomplete({
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


	$("#btn-finish").on('click', function (event) {
		event.preventDefault();
		var valid = false;
    	var sParam = $('#form-wizard').serialize();
    	var validator = $('#form-wizard').validate({
							rules: {
									project: {
							  			required: true
									},
									nomor_spk: {
							  			required: true
									},
									tgl_do: {
							  			required: true
									},
									nama_pengirim: {
							  			required: true
									},
									nama_penerima: {
							  			required: true
									},
									  
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		if(validateBarang()){
 			  	var link = '<?= base_url()?>spk/Header';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alertOK(window.location.reload());
					}else{	
						alertError('Terjadi kendala saat menyimpan');					  	
					}
				},'json');
	 			
	 		}
	 		
	 	}else{
	 		alertError();
	 	}

    })

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

	function getKecamatan(val,name, zip, kota){
		$.get('<?= base_url()?>spk/getKecamatan', { kota: val  }, function(data){ 

			$('#' + name).empty();
    		$.each(data,function(i,value){
            	$('#' + name).append('<option value='+value.kecamatan+'>'+value.kecamatan+'</option>');
            	
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
	
	function cari_dealer(val) {
		event.preventDefault();
		$("#id-row").val($(val).prev().prev().attr('id'));
		$("#modalBarang").modal({backdrop: 'static', keyboard: false}) ;  	   
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
			$("#"+el).parent().next().next().text($(val).parent().prev().prev().text());
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
</script>