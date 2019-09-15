<script type="text/javascript">

	$(document).ready(function(){ 
		var d = new Date();

        
	    showloader('body');
	    myTable = $('#tabel-request').DataTable({    
	                "bPaginate": true,  
	                dataSrc: "original.data",
	                "destroy": true,                  
	                "initComplete": function(settings, json) {
	                    hideloader();
	                }   
	            });
	    $('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		$("#periode_start").datepicker("setDate", d);
        $("#periode_end").datepicker("setDate", d);
    });

	$('#btnFind').on('click', function()
	{
		showloader('body');
		var start = $("#periode_start").val();
        var end = $("#periode_end").val();
		$.post("<?php echo base_url(); ?>Approval/find",{start: start,end: end,type: $("#workflow").val(), status: $("#status").val() }, function(data){ 

			$("#isi-tabel").html('');
			$("#isi-tabel").html(data);
			$('#tabel-request').DataTable({    
                "bPaginate": true,  
                dataSrc: "original.data",
                "destroy": true,                  
                "initComplete": function(settings, json) {
                    hideloader();
                }   
            });
		});

	})
	$('#btnApprove').on('click', function()
	{
		var checked_courses = $('#tabel-request').find('input[name="selected_courses[]"]:checked').length;
        if (checked_courses != 0) {
            CheckedTrue(3);
        } else {
            alert("Silahkan pilih terlebih dahulu");
        }

	})
	$('#btnReject').on('click', function()
	{
		var checked_courses = $('#tabel-request').find('input[name="selected_courses[]"]:checked').length;
        if (checked_courses != 0) {
            CheckedTrue(4);
        } else {
            alert("Silahkan pilih terlebih dahulu");
        }

	})
    $('#selected_all').on('change', function()
	{
	    $('#tabel-request').DataTable()
	        .column(0)
	        .nodes()
	        .to$()
	        .find('input[type=checkbox]')
	        .prop('checked', this.checked);
	});
	
	function CheckedTrue(mode) {
        var b = $("#txtSelected");
        b.val('');
        var str = "";        
        var rowcollection = myTable.$(':checkbox', { "page": "all" });
        rowcollection.each(function () {
            if (this.checked) {
                str += this.value + ";";
            }
        });
        b.val(str); 

        var konfirm = "Are You Sure to Approve All?";                       
        if(mode==4){
        	konfirm = "Are You Sure to Reject All?";
        }
        var r = confirm(konfirm);
		if (r == true) {

	        $.ajax({
	            type: "POST",
	            url: 'Approval/approval',
	            data: {str: str, mode: mode},
	            dataType: "json",
	            traditional: true,	            
	           	beforeSend: function(){
					
				},
				done: function(data){					
					window.location.reload();
				},
			    success: function (data) {
			    	
		            
		        },
	        });
	 	}       
    }
	
</script>