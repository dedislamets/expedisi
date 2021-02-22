<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "listinvoice/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
			"columnDefs": [ 
            {
			    "targets": [6,7],
			    "className": "text-right"
			}]
	    });

	})

	function deleteList(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('listrs/delete', { id: $(val).data('id') }, function(data){ 
				alertOK(window.location.reload());
			})
		
		}
	}
</script>
