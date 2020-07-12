<script type="text/javascript">
	$(document).ready(function(){ 
		$('#attach_file').ace_file_input({
			// style: 'well',
			no_file:'No File ...',
			btn_choose:'Choose',
			btn_change:'Change',
			droppable:true,
			onchange:null,
			thumbnail:'small', //| true | large
			whitelist:'pdf|docx|jpg|doc'
			//blacklist:'exe|php'
			//onchange:''
			//
		});

		

		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		$('.number').priceFormat({
	        prefix: '',
	        centsSeparator: '',
	        centsLimit: 0,
	        thousandsSeparator: ''
	    });

		$(".number").focus(function(){
            $(this).setCursorPosition(0);
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

		// $('#ViewTable').DataTable({
		// 	ajax: {		            
	 //            "url": "ListPerformanceKPM",
	 //            "type": "GET",
	 //            "data":{'id': $("#txtID").val()},
	 //        },			
		// 	"bPaginate": true,	
		// 	"ordering": false,
		// 	"destroy": true,
	 //    });
	  //   $('#ViewTable-Competency').DataTable({
			// ajax: {		            
	  //           "url": "ListCompetency",
	  //           "type": "GET",
	  //           "data":{'id': $("#txtID").val()},
	  //       },			
			// "bPaginate": true,	
			// "ordering": false,
			// "destroy": true,
	  //   });
	    

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

		$('#IsActual').on('change', function (event) {
			if( parseInt($(this).val()) > 0){
				$("#f-alasan-score").addClass('hidden');
				$("#alasan-score").val('0');
			}else{
				$("#f-alasan-score").removeClass('hidden');
				if($("#lbl-title").text() == 'Add'){
					$("#alasan-score").val('1');
				}
			}
		});

		$('#WeightPercentage').on('change', function (event) {
			if($("#lbl-title").text() == 'Add'){
				if( parseInt($("#total_bobot").val())+ parseInt($(this).val()) > 100){
					$("#msg_kpm").text('Total bobot anda saat ini melebihi 100. Anda tidak diperkenankan untuk submit !!');
					$("#btnSubmit").attr('disabled','disabled');
					$("#msg_kpm").css('display','block');
				}else{
					$("#btnSubmit").removeAttr('disabled');
					$("#msg_kpm").css('display','none');
				}
			}else{
				var new_total = parseInt($("#total_bobot").val()) - ( parseInt($('#WeightPercentage_old').val()) - parseInt($(this).val()) )
				if(  new_total > 100){
					$("#msg_kpm").text('Total bobot anda saat ini melebihi 100. Anda tidak diperkenankan untuk submit !!');
					$("#btnSubmit").attr('disabled','disabled');
					$("#msg_kpm").css('display','block');
				}else{
					$("#btnSubmit").removeAttr('disabled');
					$("#msg_kpm").css('display','none');
				}
			}
		});
		$('#btnAdd').on('click', function (event) {
			$("#lbl-title").text('Add');
			$("#calc").val('1');
			$("#IsDesc").val('');
			$("#txtRecnum").val('');
			$("#WeightPercentage").val('0');
			$("#WeightPercentage_old").val('0');
			$("#IsTarget").val('0');
			$("#IsActual").val('0').change();
			$("#DataSource").val('');
			$("#remark_kpm").val('');
			$("#submit_remove").remove();
			$("#btnSubmit").css("display","block");
			$("#warning-del").remove();
			$('#Form').find(':input:disabled').removeAttr('disabled');
			
			$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
		});

		$('#btnAddTask').on('click', function (event) {
			$("#lbl-title-task").text('Add');
			$("#priority").val('1');
			$("#txtRecnumTask").val('');
			$("#start_date").val('');
			$("#end_date").val('');
			$("#com_date").val('');
			$("#report_type").val('');
			$("#sub_method").val('');
			$("#task_status").val('1');
			$("#task").val('');
			$("#submit_remove_task").remove();
			$("#warning-del-task").remove();
			$("#btnSubmitTask").css("display","block");
			$('#FormTask').find(':input:disabled').removeAttr('disabled');
			$('#ModalTaskScheduler').modal({backdrop: 'static', keyboard: false}) ;
		});

		$('#btnAddDoc').on('click', function (event) {
			$("#lbl-title-task").text('Add');
			$("#status_performance").change();
			$("#txtRecnumDoc").val('');
			$("#rencana_pengembangan").val('');
			$("#alasan_status").val('');
			$("#btnSubmitDoc").css("display","block");
			$('#FormDoc').find(':input:disabled').removeAttr('disabled');

			if($("#total_bobot").val() < 100){
				$("#msg_doc").text('Total bobot anda saat ini belum mencapai 100. Anda tidak diperkenankan untuk update status dokumen !!');
				$("#btnSubmitDoc").attr('disabled','disabled');
			}
			
			$("#submit_remove_doc").remove();
			$("#warning-del-doc").remove();
			
			
			$('#ModalDoc').modal({backdrop: 'static', keyboard: false}) ;
		});

		$('#status_performance').on('change', function (event) {
			$("#f-rencana").css('display','none');
			$("#f-alasan").css('display','none');
			if($(this).val() < $("#RecnumPerformanceStatus").val()){
				$("#f-alasan").css('display','block');
			}else if ($(this).val() == 7) {
				$("#f-rencana").css('display','block');
			}
		})

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
						Swal.fire({ title: "Berhasil disimpan..!",
                           text: "",
                           timer: 2000,
                           showConfirmButton: false,
                           onClose: () => {
                            window.location.reload();
                          }
                        });
					}else{	
						$("#lblMessage").remove();
						$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
												  					  	
					}
				},'json');
		 	}
		});

		$('#btnSubmitCompetency').on('click', function () {
	    	var valid = false;
	    	
	    	var validator = $('#Form1').validate({
								rules: {
										bukti_perilaku: {
								  			required: true
										} ,
										nilai: {
								  			required: true
										}   
									}
								});
		 	validator.valid();
		 	$status = validator.form();
		 	if($status) {
		 		$('#Form1').find(':input:disabled').removeAttr('disabled');
		 		var sParam = $('#Form1').serialize();
		 		var link = 'SaveCompetency';
		 		$.get(link,sParam, function(data){
					if(data.error==false){		
						Swal.fire({ title: "Berhasil disimpan..!",
                           text: "",
                           timer: 2000,
                           showConfirmButton: false,
                           onClose: () => {
                            window.location.reload();
                          }
                        });
					}else{	
						$("#lblMessage").remove();
						$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
												  					  	
					}
				},'json');
		 	}
		});

		$('#btnSubmitCoaching').on('click', function () {
	    	var valid = false;
	    	var sParam = $('#FormCoaching').serialize();
	    	var validator = $('#FormCoaching').validate({
								rules: {
										TopikPembahasan: {
								  			required: true
										},
										FaktorDipertahankan: {
								  			required: true
										},
										FaktorDikembangkan: {
								  			required: true
										},
										PenyebabUtama: {
								  			required: true
										},
										RencanaAksiEvaluasi: {
								  			required: true
										}  
									}
								});
		 	validator.valid();
		 	$status = validator.form();
		 	if($status) {
		 		var link = 'SaveCoaching';
		 		$.get(link,sParam, function(data){
					if(data.error==false){									
						Swal.fire({ title: "Berhasil disimpan..!",
                           text: "",
                           timer: 2000,
                           showConfirmButton: false,
                           onClose: () => {
                            window.location.reload();
                          }
                        });
					}else{	
						$("#lblMessage").remove();
						$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
												  					  	
					}
				},'json');
		 	}
		});

		$('#FormTask').on('submit', function (e) {
            e.preventDefault(); 
	    	var valid = false;
	    	var sParam = $('#FormTask').serialize() + "&id="+ $("#txtID").val();
	    	var validator = $('#FormTask').validate({
								rules: {
										task: {
								  			required: true
										},
										start_date: {
								  			required: true
										},
										priority: {
								  			required: true
										},
										report_type: {
								  			required: true
										},
										sub_method: {
								  			required: true
										},
										task_status: {
								  			required: true
										} ,
										com_date: {
								  			required: true
										}
									}
								});
		 	validator.valid();
		 	$status = validator.form();
		 	if($status) {
		 		$.ajax({
                     url:'SaveTask', //URL submit
                     type:"post", //method Submit
                     data:new FormData(this), //penggunaan FormData
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                    beforeSend: function () {
	                    showloader();
	                },
	                error: function () {
	                    hideloader();	
	                },
                    success: function(data){
                    	hideloader();	
                      	if(data.error==false){
							Swal.fire({ title: "Berhasil disimpan..!",
	                           text: "",
	                           timer: 2000,
	                           showConfirmButton: false,
	                           onClose: () => {
	                            window.location.reload();
	                          }
	                        });
						}else{	
							$("#lblMessage").remove();
							$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
													  					  	
						}
                   }
                 });
		 	}
		});

		$('#btnSubmitDoc').on('click', function (e) {
            e.preventDefault(); 
	    	var valid = false;
	    	var sParam = $('#FormDoc').serialize() + "&id="+ $("#txtID").val();
	    	var validator = $('#FormDoc').validate({
								rules: {
										// rencana_pengembangan: {
								  // 			required: true
										// },
										// alasan_status: {
								  // 			required: true
										// },
									}
								});
		 	validator.valid();
		 	$status = validator.form();
		 	if($status) {
		 		var link = 'SaveDoc';
		 		$.get(link,sParam, function(data){
					if(data.error==false){									
						Swal.fire({ title: "Berhasil disimpan..!",
                           text: "",
                           timer: 2000,
                           showConfirmButton: false,
                           onClose: () => {
                            window.location.reload();
                          }
                        });
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

         		// $('#Form').find(':input:disabled').removeAttr('disabled');
         		$("#calc").val(data[0]['RecnumCalculationMethod']);
         		$("#area_kinerja").val(data[0]['RecnumAreaPerformance']);
				$("#IsDesc").val(data[0]['IsDesc']);
				$("#txtRecnum").val(data[0]['Recnum']);
				$("#WeightPercentage").val(parseFloat(data[0]['WeightPercentage']));
				$("#WeightPercentage_old").val(parseFloat(data[0]['WeightPercentage']));
				$("#IsTarget").val(parseFloat(data[0]['IsTarget']));
				$("#IsActual").val(parseFloat(data[0]['IsActual']));
				$("#IsActual").change();
				$("#alasan_score").val(data[0]['RecnumPerformanceScore0']);
           		$("#DataSource").val(data[0]['DataSource']);
           		$("#remark_kpm").val(data[0]['Remark']);
           		$("#submit_remove").remove();
           		$("#warning-del").remove();
           		$("#btnSubmit").css("display","block");
           		$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;
           
        });
		
		hideloader();
	}

	function editmodal_2(val){
		showloader('body');
		$.get('editCompetency', { id: $(val).data('id'), com: $(val).data('com') }, function(data){ 
         		$("#lbl-title-competency").text('Edit');
         		// $("#evaluator").val(data[0]['RecnumEvaluator']);
         		$("#IsDescCompetency").val($(val).parent().parent().children()[1].textContent);
				$("#txtEmpPerformance").val(data[0]['RecnumEmpPerformance']);
				$("#txtRecnumCompetency").val(data[0]['RecnumCompetency']);
				$("#RecnumCompetency").val(data[0]['RecnumCompetency']);
				$("#nilai").val(data[0]['IsActual']);
           		$("#bukti_perilaku").text(data[0]['Remark']);
           		$('#ModalCompetency').modal({backdrop: 'static', keyboard: false}) ;
           
        });
		
		hideloader();
	}

	function editmodalconseling(val){
		showloader('body');
		$.get('editConseling', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title-coaching").text('Edit');
       			$("#RecnumPeriod").val(data[0]['RecnumPeriod'])
				$("#IsPeriod").val($(val).parent().parent().children()[2].textContent);
				$("#DateOfCoaching").val(moment().format('DD-MM-YYYY'));
				$("#TopikPembahasan").text(data[0]['TopikPembahasan']);
				$("#FaktorDipertahankan").text(data[0]['FaktorDipertahankan']);
           		$("#FaktorDikembangkan").text(data[0]['FaktorDikembangkan']);
           		$("#PenyebabUtama").text(data[0]['PenyebabUtama']);
           		$("#RencanaAksiEvaluasi").text(data[0]['RencanaAksiEvaluasi']);
           		$("#txtRecnumCoaching").val(data[0]['Recnum']);
           		$('#ModalCoaching').modal({backdrop: 'static', keyboard: false}) ;
           
        });
		
		hideloader();
	}
	function editmodaltask(val){
		showloader('body');
		$("#submit_remove_task").remove();
       	$("#warning-del-task").remove();
		$.get('editTask', { id: $(val).data('id') }, function(data){ 
			$('#FormTask').find(':input:disabled').removeAttr('disabled');
         	$("#lbl-title-task").text('Edit');
			$("#priority").val(data[0]['RecnumPriority']);
			$("#txtRecnumTask").val(data[0]['Recnum']);
			if(data[0]['EndDate'] != null){
                $("#end_date").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['StartDate'] != null){
                $("#start_date").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['CompletationDate'] != null){
                $("#com_date").val(moment(data[0]['CompletationDate']).format('DD-MM-YYYY'));
            }

			$("#report_type").val(data[0]['ReportType']);
			$("#sub_method").val(data[0]['SubmissionMethod']);
			$("#task_status").val(data[0]['RecnumTaskStatus']);
			$("#task").val(data[0]['Task']);
			if(data[0]['AttachFile'] != undefined){
				$('#attach_file').ace_file_input('show_file_list', [
					// {type: 'image', name: data[0]['AttachFile'], path: 'http://hrsmartpro.com/assets/attach'},
					{type: 'file', name: data[0]['AttachFile']}
				]);
			}
			

			
       		$("#btnSubmitTask").css("display","block");
       		$('#ModalTaskScheduler').modal({backdrop: 'static', keyboard: false}) ;

           
        });
		
		hideloader();
	}

	function removeList(val){	
    	$("#lbl-title").text('Remove Form ' + $("#judul").text());
    	showloader('body');
    	$.get("edit",{ id: val }, function(data){ 
    		
    		// $("#lbl-title").text('Hapus Data');
     		$("#calc").val(data[0]['RecnumCalculationMethod']);
     		$("#area_kinerja").val(data[0]['RecnumAreaPerformance']);
			$("#IsDesc").val(data[0]['IsDesc']);
			$("#txtRecnum").val(data[0]['Recnum']);
			$("#WeightPercentage").val(data[0]['WeightPercentage']);
			$("#IsTarget").val(data[0]['IsTarget']);
			$("#IsActual").val(data[0]['IsActual']);
       		$("#DataSource").text(data[0]['DataSource']);
			$("#msg_kpm").css('display','none');
       		

    		$.each($('#Form').serializeArray(), function(index, value){
			    $('[name="' + value.name + '"]').attr('disabled', 'disabled');
			});
			$('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;

			$("#btnSubmit").css("display","none");
			$("#btnSubmit").before(' <button type="button" id="submit_remove" onclick="deleteData()" class="btn btn-danger btn-block">Ya</button>');

			
			$(".modal-body").before('<h3 id="warning-del" style="text-align:center;color: red">Yakin untuk menghapus data ini?</h3>');
    		
    		hideloader();
    	});
		$('#ModalGenerate').modal({backdrop: 'static', keyboard: false});
		
	}
	function removeListTask(val){	
    	$("#lbl-title").text('Remove Form ' + $("#judul").text());
    	showloader('body');
    	$.get('editTask', { id: val }, function(data){ 
         	$("#lbl-title-task").text('Edit');
			$("#priority").val(data[0]['RecnumPriority']);
			$("#txtRecnumTask").val(data[0]['Recnum']);
			if(data[0]['EndDate'] != null){
                $("#end_date").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['StartDate'] != null){
                $("#start_date").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['CompletationDate'] != null){
                $("#com_date").val(moment(data[0]['CompletationDate']).format('DD-MM-YYYY'));
            }

			$("#report_type").val(data[0]['ReportType']);
			$("#sub_method").val(data[0]['SubmissionMethod']);
			$("#task_status").val(data[0]['RecnumTaskStatus']);
			$("#task").val(data[0]['Task']);

       		$.each($('#FormTask').serializeArray(), function(index, value){
			    $('[name="' + value.name + '"]').attr('disabled', 'disabled');
			});

			$("#btnSubmitTask").css("display","none");
			$("#btnSubmitTask").before(' <button type="button" id="submit_remove_task" onclick="deleteDataTask()" class="btn btn-danger btn-block">Ya</button>');

			
			$("#modal-body-task").before('<h3 id="warning-del-task" style="text-align:center;color: red">Yakin untuk menghapus data ini?</h3>');
           hideloader();
        });
    	
		$('#ModalTaskScheduler').modal({backdrop: 'static', keyboard: false});
		
	}

	function deleteData() {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$("input, select, button, textarea").prop("disabled", false);
			var form = $("#Form");
			var formData = new FormData($("#Form")[0]);

			$.ajax({
	            type: "POST",
	            url: 'delete',
	            data: formData,
	            contentType: false,
	            processData: false, 
	           	beforeSend: function(){
					$("input, select, button, textarea").prop("disabled", true);
				},
				done: function(data){					
					
				},
			    success: function (data) {
			    	if(!data['error']){
			    		Swal.fire({ title: "Berhasil dihapus..!",
                           text: "",
                           timer: 2000,
                           showConfirmButton: false,
                           onClose: () => {
                            window.location.reload();
                          }
                        });
			    	}
		            
		        },
	        });
		}
	}
	function deleteDataTask() {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$("input, select, button, textarea").prop("disabled", false);
			var form = $("#FormTask");
			var formData = new FormData($("#FormTask")[0]);

			$.ajax({
	            type: "POST",
	            url: 'deleteTask',
	            data: formData,
	            contentType: false,
	            processData: false, 
	           	beforeSend: function(){
					$("input, select, button, textarea").prop("disabled", true);
				},
				done: function(data){					
					
				},
			    success: function (data) {
			    	if(!data['error']){
			    		alert('Sukses terhapus..');
			    		window.location.reload();
			    	}
		            
		        },
	        });
		}
	}

	$(function() { 
	    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
	    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	        // save the latest tab; use cookies if you like 'em better:
	        localStorage.setItem('lastTab', $(this).attr('href'));
	    });

	    // go to the latest tab, if it exists:
	    var lastTab = localStorage.getItem('lastTab');
	    if (lastTab) {
	        $('[href="' + lastTab + '"]').tab('show');
	    }
	});

</script>