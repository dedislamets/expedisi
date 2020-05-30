<script type="text/javascript">
	$(document).ready(function(){  

		var table = $('#ViewTable').DataTable({
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
	    var d = new Date();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		$("#periode_start").datepicker("setDate", d);
        $("#periode_end").datepicker("setDate", d);

        $('#btnFind').on('click', function()
		{
			showloader('body');
			var start = $("#periode_start").val();
	        var end = $("#periode_end").val();
			table.ajax.url('EmployeePerformanceJNE/dataTable?start=' + start + '&end=' + end).load();
			hideloader();
		})
	});

	
</script>