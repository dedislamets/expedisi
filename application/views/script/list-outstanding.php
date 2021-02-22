<script type="text/javascript">

	$(document).ready(function(){  
		myTable = $('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "listoutstanding/dataTable?status=" + $('#status').val(),
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
            "columnDefs": [ 
            {
			    "targets": 5,
			    "className": "text-right"
			},
			{
			    "targets": 6,
			    "data": "status_due",
			    "render": function ( data, type, row, meta ) {
			    	if( row[6] ==  'Hampir Jatuh Tempo'){
	                    return '<a href="#" class="btn btn-info btn-mini btn-skew" style="width:85%">' + row[6] +'</a>';
	                }else if( row[6] ==  'Melewati Jatuh Tempo'){
	                    return '<a href="#" class="btn btn-danger btn-mini btn-skew" style="width:85%">' + row[6] +'</a>';
	                }else if( row[6] ==  'Jatuh Tempo'){
	                    return '<a href="#" class="btn btn-warning btn-mini btn-skew" style="width:85%">' + row[6] +'</a>';
	                }else{
	                	return row[6];
	                }
			      
			    }
			}  
			]
	    });

	    myTable2 = $('#ViewTable2').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "listoutstanding/dataTableVendor?status=" + $('#status').val(),
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
            "columnDefs": [ 
            {
			    "targets": 5,
			    "className": "text-right"
			},
			{
			    "targets": 6,
			    "data": "status_due",
			    "render": function ( data, type, row, meta ) {
			    	if( row[6] ==  'Hampir Jatuh Tempo'){
	                    return '<a href="#" class="btn btn-info btn-mini btn-skew" style="width:85%">' + row[6] +'</a>';
	                }else if( row[6] ==  'Melewati Jatuh Tempo'){
	                    return '<a href="#" class="btn btn-danger btn-mini btn-skew" style="width:85%">' + row[6] +'</a>';
	                }else if( row[6] ==  'Jatuh Tempo'){
	                    return '<a href="#" class="btn btn-warning btn-mini btn-skew" style="width:85%">' + row[6] +'</a>';
	                }else{
	                	return row[6];
	                }
			      
			    }
			}  
			]
	    });

		$('#status').on('change', function() {
			myTable.ajax.url("listoutstanding/dataTable?status=" + $('#status').val() ).load();
		});
	})
</script>
