<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "listinvoicevendor/dataTable",
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
			}],
			"order": [[ 0, "desc" ]]
	    });

	})

	function deleteList(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('listinvoicevendor/delete', { id: $(val).data('id') }, function(data){ 
				alertOK(window.location.reload());
			})
		
		}
	}
</script>
