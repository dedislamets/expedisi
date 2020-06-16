<script type="text/javascript">
	$(document).ready(function(){  

		var table = $('#ViewTable').DataTable({
			ajax: {		            
	            "url": "EmployeePerformanceJNE/dataTable",
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
			],
			"createdRow": function( row, data, dataIndex){
                $(row).css('background-color',data[7]);

            }

	    });
	    var d = new Date();
	    var foYear = new Date(new Date().getFullYear(), 0, 1);
		var eoYear = new Date(d.getFullYear(),12,0)
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		$("#periode_start").datepicker("setDate", foYear);
        $("#periode_end").datepicker("setDate", eoYear);

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