<script type="text/javascript">
	$(document).ready(function(){  

		var table = $('#ViewTable').DataTable({
			processing	: true,
			serverSide	: true,
			ajax: {		            
	            "url": "EmployeePerformanceJNE/dataTable",
	            "type": "GET"
	        },			
			"bPaginate": true,	
			"ordering": true,
			"order": [[ 1, "desc" ]],
			columnDefs:[
					{ orderable: false,  targets: 0 },
					{
						targets:[5,6], render:function(data){
			      			return moment(data).format('DD MMM YYYY'); 
			    		},
			    	},
			    	{
						targets:[3],
			    		orderData: [ 3 ]
			    	},

			    	
			],
			"createdRow": function( row, data, dataIndex){
                $(row).css('background-color',data[8]);

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
			table.ajax.url('EmployeePerformanceJNE/dataTable?startDate=' + start + '&endDate=' + end + '&op=' + $("#chkAdmin").prop('checked')).load();
			hideloader();
		})
	});

	
</script>