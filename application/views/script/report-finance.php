<script type="text/javascript">

	$(document).ready(function(){  
		var c_date = new Date();
		$('.chosen-select').chosen({
		      placeholder_text_multiple: "Semua",
		      no_results_text: "Oops, nothing found!"
		    });
		$("#from_tanggal").val(c_date.toLocaleDateString('en-CA'));
		$("#to_tanggal").val(c_date.toLocaleDateString('en-CA'));

		$('#btnCari').on('click', function() {
			// myTable.ajax.url("listpayment/dataTable?status=" + $('#status').val() ).load();
		});

		$('#btnExport').on('click', function()
		{
			var start = $("#from_tanggal").val();
	        var end = $("#to_tanggal").val();
	        var sa = window.open('reportfinance/export?from=' + start + '&to=' + end + '&c=' + $("#cust").val() + '&v=' + $("#vend").val() ,'_self');
			
		})
	})
</script>
