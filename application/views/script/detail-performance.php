<script type="text/javascript">
	$(document).ready(function(){ 
		$('.number').priceFormat({
	        prefix: '',
	        centsSeparator: '',
	        centsLimit: 0,
	        thousandsSeparator: ''
	    });

	    $('.dec').priceFormat({
	        prefix: '',
	        centsSeparator: '.',
	        centsLimit: 2,
	        thousandsSeparator: ','
	    });

		$('#myCarousel').find('.item').first().addClass('active');
		$('#myCarousel').carousel({
		  interval: 4000
		})

		$('.carousel .item').each(function(){
		  var next = $(this).next();
		  if (!next.length) {
		    next = $(this).siblings(':first');
		  }
		  next.children(':first-child').clone().appendTo($(this));
		  
		  for (var i=0;i<2;i++) {
		    next=next.next();
		    if (!next.length) {
		    	next = $(this).siblings(':first');
		  	}
		    
		    next.children(':first-child').clone().appendTo($(this));
		  }
		});    

		$('#ViewTable').DataTable({
			ajax: {		            
	            "url": "ListPerformanceKPM",
	            "type": "GET",
	            "data":{'id': $("#txtID").val()},
	        },			
			"bPaginate": true,	
			"ordering": false,
			"destroy": true,
	    });
	    $('#ViewTable-Competency').DataTable({
			ajax: {		            
	            "url": "ListCompetency",
	            "type": "GET",
	            "data":{'id': $("#txtID").val()},
	        },			
			"bPaginate": true,	
			"ordering": false,
			"destroy": true,
	    });

	    $('#btnRefresh').on('click', function (event) {
	    	showloader('body');
			$('#ViewTable').DataTable({
				ajax: {		            
		            "url": "ListPerformanceKPM",
		            "type": "GET",
		            "data":{'id': $("#txtID").val()},
		        },			
				"bPaginate": true,	
				"ordering": false,
				"destroy": true,
				"initComplete": function(settings, json) {
                    hideloader();
                },
		    });
		});

		$('#btnRefresh_2').on('click', function (event) {
	    	showloader('body');
			$('#ViewTable-Competency').DataTable({
				ajax: {		            
		            "url": "ListCompetency",
		            "type": "GET",
		            "data":{'id': $("#txtID").val()},
		        },			
				"bPaginate": true,	
				"ordering": false,
				"destroy": true,
				"initComplete": function(settings, json) {
                    hideloader();
                },
		    });
		});

		$('#btnAdd').on('click', function (event) {
			$("#lbl-title").text('Add');
			$("#calc").val('0');
			$("#IsDesc").val('');
			$("#txtRecnum").val('');
			$("#WeightPercentage").val('0');
			$("#IsTarget").val('0');
			$("#IsActual").val('0');
			$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
		});

		$('#btnSubmit').on('click', function () {
	    	var valid = false;
	    	var sParam = $('#Form').serialize()+ "&id="+ $("#txtID").val();
	    	var validator = $('#Form').validate({
								rules: {
										IsDesc: {
								  			required: true
										},
										WeightPercentage: {
								  			required: true
										},
										IsTarget: {
								  			required: true
										},
										IsActual: {
								  			required: true
										}   
									}
								});
		 	validator.valid();
		 	$status = validator.form();
		 	if($status) {
		 		var link = 'SaveKPR';
		 		$.get(link,sParam, function(data){
					if(data.error==false){									
						alert('Berhasil disimpan..');
						window.location.reload();
					}else{	
						$("#lblMessage").remove();
						$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
												  					  	
					}
				},'json');
		 	}
		});

	});

	function editmodal(val){
		showloader('body');
		$.get('edit', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title").text('Edit');
         		$("#calc").val(data[0]['RecnumCalculationMethod']);
				$("#IsDesc").val(data[0]['IsDesc']);
				$("#txtRecnum").val(data[0]['Recnum']);
				$("#WeightPercentage").val(data[0]['WeightPercentage']);
				$("#IsTarget").val(data[0]['IsTarget']);
				$("#IsActual").val(data[0]['IsActual']);
           		$("#remark").text(data[0]['Remark']);
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });
		
		hideloader();
	}

	function editmodal_2(val){
		showloader('body');
		$.get('edit', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title").text('Edit');
         		$("#calc").val(data[0]['RecnumCalculationMethod']);
				$("#IsDesc").val(data[0]['IsDesc']);
				$("#txtRecnum").val(data[0]['Recnum']);
				$("#WeightPercentage").val(data[0]['WeightPercentage']);
				$("#IsTarget").val(data[0]['IsTarget']);
				$("#IsActual").val(data[0]['IsActual']);
           		$("#remark").text(data[0]['Remark']);
           		$('#ModalCompetency').modal({backdrop: 'static', keyboard: false}) ;
           
        });
		
		hideloader();
	}

</script>