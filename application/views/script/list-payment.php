<script type="text/javascript">

	$(document).ready(function(){  
		
	    myTable = $('#ViewTable').DataTable({
			dom: 'frtip',
        	// buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "listpayment/dataTable?status=" + $('#status').val(),
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
            "columnDefs": [ 
            {
			    "targets": [5,6],
			    "className": "text-right"
			},
			{
			    "targets": 0,
			    "data": "no_payment",
			    "render": function ( data, type, row, meta ) {
			    	return '<a href="payment/update/' + row[0] +'">' + row[0] +'</a>';
			    }
			}  
			]
	    });

		$('#btnCari').on('click', function() {
			myTable.ajax.url("listpayment/dataTable?status=" + $('#status').val() ).load();
		});
	})
</script>
