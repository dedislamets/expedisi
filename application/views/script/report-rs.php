<script type="text/javascript">

	$(document).ready(function(){  
		var c_date = new Date();
		$(".js-example-basic-single").select2();
		$("#from_tanggal").val(c_date.toLocaleDateString('en-CA'));
		$("#to_tanggal").val(c_date.toLocaleDateString('en-CA'));

		$('#btnCari').on('click', function() {
			// myTable.ajax.url("listpayment/dataTable?status=" + $('#status').val() ).load();
		});

		$('#btnExport').on('click', function()
		{
			var start = $("#from_tanggal").val();
	        var end = $("#to_tanggal").val();
	        var sa = window.open('reportrs/export?from=' + start + '&to=' + end + '&c=' + $("#project").val()+ '&req=' + $("#requestor").val() ,'_self');
			
		})
	})
</script>
