<script type="text/javascript">
	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	      this.loadHistory();
	      
	    },
	    updated: function () {
	    	
	    },
	    data: {
	      history: [],
	      alamat:'',
	      totalrow: 1
	    },
	    methods: {

	    }
	})

	var elemsingle = document.querySelector('.js-single');
	var switchery = new Switchery(elemsingle, { color: '#4680ff', jackColor: '#fff' });

	$(document).ready(function(){  
		$('#ViewTable').DataTable({
			dom: 'Bfrtip',
        	buttons: ['excel', 'pdf', 'print'],
			ajax: {		            
	            "url": "project/dataTable",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,
			order: [[0, 'desc']],
			columnDefs:[
				{ "width": "50px", "targets": [0] },
				{ "width": "70px", "targets": [3,4] },
			]

	    });

	})

	function editmodal(val){

		$.get('project/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
         		$("#prefix").val(data['parent'][0]['prefix']);
				$("#nama_project").val(data['parent'][0]['nama_project']);
				
				if(data['parent'][0]['is_active'] == 0){
					changeSwitchery($('#status'), false);
				}else{
					changeSwitchery($('#status'), true);
				}
				$("#id").val(data['parent'][0]['id']);

           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}

	
	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#nama_project").val('');
		$("#prefix").val('');
		$("#id").val('');

		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});
	

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									prefix: {
							  			required: true
									},
									nama_project: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'project/Save';
	 		$.post(link,sParam, function(data){
	
			},'json')
			.done(function(data) {
				if(data.error==false){									
					window.location.reload();
				}else{	
					$("#lblMessage").remove();
					$("<div id='lblMessage' class='w-100 alert alert-danger mt-3 p-2'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			})
			.fail(function(error) {
			    $("#lblMessage").remove();
				$("<div id='lblMessage' class='w-100 alert alert-danger mt-3 p-2'><strong><i class='ace-icon fa fa-times'></i> "+error.responseText+"!</strong></div>").appendTo(".modal-footer");
			})
			.always(function() {
			    // alert( "Berhasi" );
			});
	 	}
        
    });

	function hapus(val) {
		Swal.fire({
		  title: 'Yakin dihapus?',
		  text: "Project ini akan dilakukan dihapus!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, yakin!'
		}).then((result) => {
			
		  	if(result.isConfirmed){
		  		$.get('project/delete', { id: $(val).data('id') }, function(data){ 
					//window.location.reload();
				})
				.done(function(data) {
					if(data.error==false){									
						window.location.reload();
					}else{	
						alertError(error.responseText);
												  					  	
					}
				})
				.fail(function(error) {
				    alertError(error.responseText);
				})
		  	}
		})
	}

	function changeSwitchery(element, checked) {
	  if ( ( element.is(':checked') && checked == false ) || ( !element.is(':checked') && checked == true ) ) {
	    element.parent().find('.switchery').trigger('click');
	  }
	}
	
</script>
