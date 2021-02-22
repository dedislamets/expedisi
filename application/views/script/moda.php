<script type="text/javascript">

	$(document).ready(function(){  
		// $('#ViewTable').DataTable({
		// 	dom: 'Bfrtip',
  //       	buttons: ['excel', 'pdf', 'print'],
		// 	ajax: {		            
	 //            "url": "Moda/dataTable",
	 //            "type": "GET"
	 //        },
	 //        processing	: true,
		// 	serverSide	: true,			
		// 	"bPaginate": true,	
		// 	"autoWidth": true,
		// 	columnDefs:[
		// 		{ "width": "100px", "targets": [2] },
				
		// 	]

	 //    });

	})

	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	      this.loadMenuSelected();
	      
	    },
	    updated: function () {
	    	
	    },
	    data: {
	      menu_text: '',
	      menu_id:'',
	      group_id: '1',
	      group_text:'Darat',
	      menu_selected: [],
	   
	      myTable2: ''
	    },
	    methods: {
	    	loadMenuSelected: function () {
		        myTable = $('#ViewTable').DataTable({
					dom: 'frtip',
					ajax: {		            
			            "url": "moda/dataTable?id=" + this.group_id,
			            "type": "GET"
			        },
			        processing	: true,
					serverSide	: true,			
					"bPaginate": true,	
					"autoWidth": true,
					"destroy": true,
		            
			    });

			  //   this.myTable2 = $('#ModalTableUser').DataTable({
					// dom: 'frtip',
					// ajax: {		            
			  //           "url": "roleusers/dataTableModal?id=" + this.group_id,
			  //           "type": "GET"
			  //       },
			  //       processing	: true,
					// serverSide	: true,			
					// "bPaginate": true,	
					// "autoWidth": true,
					// "destroy": true,
		            
			  //   });
		    },
		    
	    }
	})

    $(".btnGroup").on('click', function (event) {
    	app.group_id = $(this).data('id');
    	app.group_text = $(this).text();
    	app.loadMenuSelected();
    }) 

	function editmodal(val){

		$.get('moda/edit', { id: $(val).data('id') }, function(data){ 
				$("#lbl-title").text("Edit");
         		$("#moda").val(data[0]['id_moda']);
				$("#jenis").change();
				
				$("#kategori").val(data[0]['moda_kategori']);
				$("#id").val(data[0]['id']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });

	}
	
	$('#btnAdd').on('click', function (event) {
		$("#lbl-title").text('Tambah');
		$("#kategori").val('');
		$("#id").val('');
		
		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnSubmit').on('click', function (e) {
		var valid = false;
    	var sParam = $('#Form').serialize();
    	var validator = $('#Form').validate({
							rules: {
									kategori: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'moda/Save';
	 		$.post(link,sParam, function(data){
				if(data.error==false){									
					window.location.reload();
				}else{	
					$("#lblMessage").remove();
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
        
    });

	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('moda/delete', { id: $(val).data('id') }, function(data){ 
				app.loadMenuSelected();
			})
		
		}
	}
</script>
