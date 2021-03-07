<script type="text/javascript">

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "listinvoice/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
			"columnDefs": [ 
            {
			    "targets": [6,7],
			    "className": "text-right"
			}],
			"order": [[ 1, "desc" ]],
			"createdRow": function( row, data, dataIndex){
                if( data[8] ==  'VOID'){
                    $(row).css('background-color','red');
                    $(row).css('color','white');
                }
            }
	    });

	})

	function deleteList(val) {
		Swal.fire({
			  title: 'Yakin divoid?',
			  text: "Pembayaran ini akan dilakukan void!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, yakin!'
			}).then((result) => {
				
			  	if(result.isConfirmed){
			  		$.get('listinvoice/delete', { id: $(val).data('id') }, function(data){ 
						if(data.error){
							alertError(data.msg);
						}else{
							alertOK(window.location.reload());	
						}
					})
			  	}
			})

	}
</script>
