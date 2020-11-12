<script type="text/javascript">
	$(".js-example-basic-single").select2();

	$(document).ready(function(){  
		$('#ViewTableBrg').DataTable({
			
			// ajax: {		            
	  //           "url": "Barang/dataTable",
	  //           "type": "GET"
	  //       },
	  //       processing	: true,
			// serverSide	: true,			
			"bPaginate": false,
			"bFilter": false,	
			"autoWidth": true,
			"bInfo": false,
			// columnDefs:[
			// 	{ "width": "100px", "targets": [4,3,2] },
				
			// ]

	    });

	    $(".btn-next").on('click', function (event) {
	    	target = $('a[data-toggle="tab"].active').attr("href");
	    	if(target == "#pengirim"){
	    		$(".tujuan").val($('#tujuan').val());
	    		$(".asal").val($('#asal').val());
	    		$(".moda").val($('#moda_tran').val());
	    	}
	    });

	    $('#btnAdd').on('click', function (event) {
	    	event.preventDefault();
			// $("#lbl-title").text('Tambah');
			// $("#jenis").val('Gadget');
			// $("#satuan").val('Kg');
			// $("#nama_barang").val('');
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
	})
</script>