<script type="text/javascript">
	$(document).ready(function(){  

		$('#ViewTable').DataTable({
			ajax: {		            
	            "url": "EmployeePerformance/dataTable",
	            "type": "GET"
	        },			
			"bPaginate": true,	
			"ordering": false,
			columnDefs:[
					{
						targets:[4,5], render:function(data){
			      			return moment(data).format('DD MMM YYYY'); 
			    		}
			    	},
			]

	    });

	});
</script>