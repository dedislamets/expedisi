<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "listrs/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
	    });

	})

	function editmodal(val){

		$.get('barang/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
         		$("#jenis").val(data[0]['jenis_barang']);
				$("#jenis").change();
				$("#satuan").val(data[0]['satuan']);
				$("#satuan").change();
				$("#nama_barang").val(data[0]['nama_barang']);
				$("#berat_barang").val(data[0]['berat_barang']);
				$("#id_barang").val(data[0]['id_barang']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}

	function deleteList(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('listrs/delete', { id: $(val).data('id') }, function(data){ 
				alertOK(window.location.reload());
			})
		
		}
	}
</script>
