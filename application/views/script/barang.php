<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "Barang/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			// "ordering": false,
			"autoWidth": true,
			// "order": [[ 4, "desc" ]],
			columnDefs:[
				{ "width": "100px", "targets": [2,3] },
				
			]

	    });

	})

	function gridview(val){

		$.ajax({
            url: 'Leave/ListEmp?id='+val,
            dataType: 'json',
            success: function(msg) { 
             	
				$("#grid-table").jqGrid('clearGridData');
				bindingdata("List Emp Leave", val);
				$("#grid-table").jqGrid('setGridParam',{
					datatype:'json',
					editurl: 'clientArray',
					url: 'Leave/ListEmp?id='+ val }
				).trigger('reloadGrid');
            }
        });
	}
	
	function EditPost(params) {				
		$.post('GenerateTable/crud',params, function(data){
			if(data.error==false){		
				$("#cData").trigger('click');
				$("#grid-table").trigger('reloadGrid');		
			}else{
				alert(data.msg);
			}					
		},'json');	
	}
	function AddPost(params) {				
		$.post('GenerateTable/crud',params, function(data){
			if(data.error==false){		
				$("#cData").trigger('click');
				$("#grid-table").trigger('reloadGrid');		
			}else{
				alert(data.msg);
			}					
		},'json');	
	}

	function addRow() {
		var nomor = $('.baris').length;
		if( nomor>0 ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		var html = $(".cl").clone();
		renameCloneIdsAndNames(html, nomor,'add');
		$('.baris').last().after(html);
	}
	function delRow(val) {
		$(val).parent().parent().parent().remove();
	}

	$('#submit_button').on('click', function (e) {

        var valid = false;
        var sParam = $('#form1').serialize() + "&count=" + $('.baris').length;
        $.post('GenerateTable/alter',sParam, function(data){
          
        }).done(function() {
		    alert("Create Table Success" );
		    window.location.reload();
		})
		.fail(function(error) {
			$("#lblMessage").remove();
		    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+error.responseText+"!</strong></div>").appendTo(".modal-footer");
		});
		return false;
    });


</script>
