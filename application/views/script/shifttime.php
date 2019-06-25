<script type="text/javascript">
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	});
	$('#mandat').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#mandat').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('#mandat1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#mandat1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('#in').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#in').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('#out').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#out').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$("#panel-working").toggle();
	myTable = $('#tabel-shift-name').DataTable({
				ajax: {		            
		            "url": "datatabel_shift",
		            "type": "GET",
		            "data":{'eventid': 0},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"searching": false,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"destroy": true,
				"initComplete": function(settings, json) {
					$("#tabel-shift-name_wrapper").children().first().remove();
				}
		    });
	myTable2 = $('#tabel-standart-working').DataTable({
				ajax: {		            
		            "url": "datatabel_standard_working",
		            "type": "GET",
		            "data":{'shift': 0},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"searching": false,
				"destroy": true,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"columnDefs": [
		            {
		                "targets": [ 8 ],
		                "visible": false
		            }
		        ],
				"initComplete": function(settings, json) {
					$("#tabel-standart-working_wrapper").children().first().remove();
				}
		    });

	$('.btn-shift').on('click', function (event) {
		myTable = $('#tabel-shift-name').DataTable({
				ajax: {		            
		            "url": "datatabel_shift",
		            "type": "GET",
		            "data":{'eventid': $(this).data("id")},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"searching": false,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"destroy": true,
				"initComplete": function(settings, json) {
					$("#tabel-shift-name_wrapper").children().first().remove();
				}
		    });
		
	});

	$('#btnSaveAllowance').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-allowance-attendance').serialize();
        var validator = $('#form-input-allowance-attendance').validate({
                            rules: {
                                    start_date: {
                                        required: true
                                    },
                                    total_absen: {
                                        required: true
                                    },
                                    allowance_attendance: {
                                        required: true
                                    }
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'MasterShiftTime/SaveAllowance';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    alert('Berhasil disimpan..');
                     $("#ModalAttendanceAllowance").modal('hide');
                    showDialog();
                }else{  
                    $("#lblMessage").remove();
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

    $('#btnSaveAttClass').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-allowance-class').serialize();
        var validator = $('#form-input-allowance-class').validate({
                            rules: {
                                    start_date_class: {
                                        required: true
                                    },
                                    allowance_attendance_class: {
                                        required: true
                                    }
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'MasterShiftTime/SaveAttendanceClass';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    alert('Berhasil disimpan..');
                    $("#ModalAttendanceClass").modal('hide');
                    showDialog();
                }else{  
                    $("#lblMessage").remove();
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

    $('#btnSaveOvertime').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-overtime').serialize();
        var validator = $('#form-input-overtime').validate({
                            rules: {
                                    start_date_overtime: {
                                        required: true
                                    },
                                    
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'MasterShiftTime/SaveOvertime';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    alert('Berhasil disimpan..');
                    $("#ModalOvertime").modal('hide');
                    showDialog();
                }else{  
                    $("#lblMessage").remove();
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

	function working_sch(val){
		$("#panel-working").removeClass('hidden');
		$('html, body').animate({
						scrollTop: $("#panel-working").offset().top
				},1000);
		$('#tabel-standart-working').DataTable({
				ajax: {		            
		            "url": "datatabel_standard_working",
		            "type": "GET",
		            "data":{'shift': $(val).data("id")},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"order": [[ 8, "asc" ]],
				"searching": false,
				"destroy": true,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"columnDefs": [
		            {
		                "targets": [ 8 ],
		                "visible": false
		            }
		        ],
				"initComplete": function(settings, json) {
					$("#tabel-standart-working_wrapper").children().first().remove();
				}
		    });
	}

	function showrest(val){
		$('#ViewTable').DataTable({
				ajax: {		            
		            "url": "datatabel_rest",
		            "type": "GET",
		            "data":{'time': $(val).data("id")},
		        },
		        pageLength : 5,
    			lengthMenu: [[5, 10, 20], [5, 10, 20]],
				"bPaginate": true,
				"bLengthChange" : false,
				"searching": false,
				"destroy": true,
				"oLanguage": {
					"oPaginate": {
						"sFirst": "<<", 
						"sPrevious": "<",
						"sNext": ">",
						"sLast": ">>"
					}
				},
				"initComplete": function(settings, json) {
					$("#ViewTable_wrapper").children().first().remove();
				}
		    });
		$('#addModal').modal({backdrop: 'static', keyboard: false}) ;
	}

	function showDialog(){
		$('#tabel-attendence-allowance').DataTable({
			ajax: {		            
	            "url": "MasterShiftTime/getdata_attendance_allowance",
	            "type": "GET",
	            "data":{'class': $("#class_allow").val()},
	        },
	        pageLength : 5,
			lengthMenu: [[5, 10, 20], [5, 10, 20]],
			"bPaginate": true,
			"bLengthChange" : false,
			"searching": false,
			"destroy": true,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "<<", 
					"sPrevious": "<",
					"sNext": ">",
					"sLast": ">>"
				}
			},
			"initComplete": function(settings, json) {
				$("#tabel-attendence-allowance").css('width','100%');
				$("#tabel-attendence-allowance_wrapper").children().first().remove();
			}
	    });

	    $('#tabel-class-allowance').DataTable({
			ajax: {		            
	            "url": "MasterShiftTime/getdata_class_allowance",
	            "type": "GET",
	            "data":{'class': $("#class_allow_2").val()},
	        },
	        pageLength : 5,
			lengthMenu: [[5, 10, 20], [5, 10, 20]],
			"bPaginate": true,
			"bLengthChange" : false,
			"searching": false,
			"destroy": true,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "<<", 
					"sPrevious": "<",
					"sNext": ">",
					"sLast": ">>"
				}
			},
			"initComplete": function(settings, json) {
				$("#tabel-class-allowance").css('width','100%');
				$("#tabel-class-allowance_wrapper").children().first().remove();
			}
	    });

	    $('#tbl-working_status').DataTable({
			ajax: {		            
	            "url": "MasterShiftTime/getdata_working_status",
	            "type": "GET",
	            "data":{'ws': $("#working_status").val()},
	        },
	        pageLength : 5,
			lengthMenu: [[5, 10, 20], [5, 10, 20]],
			"bPaginate": true,
			"bLengthChange" : false,
			"searching": false,
			"destroy": true,
			"oLanguage": {
				"oPaginate": {
					"sFirst": "<<", 
					"sPrevious": "<",
					"sNext": ">",
					"sLast": ">>"
				}
			},
			"initComplete": function(settings, json) {
				$("#tbl-working_status").css('width','100%');
				$("#tbl-working_status_wrapper").children().first().remove();
			}
	    });
	}
	
	$('#btnAddAllowanceAttendance').on('click', function (event) {
		$("#lbl-title-allow").text('Add');
		$("#allowance_attendance").val('0');
		$("#total_absen").val('0');
		$("#id_allow").val('');
		$("#start_date").val('');
		$("#end_date").val('');
		$('#ModalAttendanceAllowance').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnAddAllowanceClass').on('click', function (event) {
		$("#lbl-title-allow_class").text('Add');
		$("#allowance_attendance_class").val('0');
		$("#id_allow").val('');
		$("#start_date").val('');
		$("#end_date").val('');
		$('#ModalAttendanceClass').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnAddOvertime').on('click', function (event) {
		$("#lbl-title-overtimr").text('Add');
		$("#id_overtime").val('');
		$("#start_date_overtime").val('');
		$("#end_date_overtime").val('');
		$('#ModalOvertime').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('#btnAddGroup').on('click', function (event) {
		$("#lbl-title-group").text('Add');
		$("#name").val('');
		$("#id_group").val('');
		$('#ModalGroupShift').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnAddShift').on('click', function (event) {
		$("#lbl-title-shift").text('Add');
		$("#id_shift").val('');

		$("#lbl-title-pattern").text('Edit');
   		$("#shift_code").val('');
   		$("#shift_name").val('');
   		$("#OTAuto").val('');
        $("#shift").val(0).trigger('chosen:updated');
        $("#shift_type").val(0).trigger('chosen:updated');
        $("#day_type").val(0).trigger('chosen:updated');
        $("#otVal").val(0).trigger('chosen:updated');
       	$("#btnDelete").css("display","none");
		$('#ModalShift').modal({backdrop: 'static', keyboard: false}) ;
	});

	function showAttendanceAllowance(val){
		showloader('body');
		$.get('MasterShiftTime/editallowanceattendance', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title-allow").text('Edit');
           		$("#allowance_attendance").val(data[0]['Allowance']);
           		$("#total_absen").val(data[0]['TotalAbsence']);
	            $("#kelas").val(data[0]['RecnumClass']).trigger('chosen:updated');

	            if(data[0]['StartDate'] != null){
	            	$("#start_date").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
	            }
	            if(data[0]['EndDate'] != null){
	            	$("#end_date").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
	            }
	       
	            $("#id_allow").val(data[0]['Recnum']);
           		$('#ModalAttendanceAllowance').modal({backdrop: 'static', keyboard: false}) ;
           		hideloader();
        });
	}

	function showAttendanceClass(val){
		showloader('body');
		$.get('MasterShiftTime/editallowanceclass', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title-allow_class").text('Edit');
           		$("#allowance_attendance_class").val(data[0]['Allowance']);
	            $("#kelas_class").val(data[0]['RecnumClass']).trigger('chosen:updated');

	            if(data[0]['StartDate'] != null){
	            	$("#start_date_class").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
	            }
	            if(data[0]['EndDate'] != null){
	            	$("#end_date_class").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
	            }
	       
	            $("#id_att_class").val(data[0]['Recnum']);
           		$('#ModalAttendanceClass').modal({backdrop: 'static', keyboard: false}) ;
           		hideloader();
        });
	}

	function showOvertime(val){
		showloader('body');
		$.get('MasterShiftTime/editovertime', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title-overtime").text('Edit');
	            $("#component_salary").val(data[0]['RecnumComponentSalary']).trigger('chosen:updated');
	            $("#select_working").val(data[0]['RecnumWorkingStatus']).trigger('chosen:updated');

	            if(data[0]['StartDate'] != null){
	            	$("#start_date_overtime").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
	            }
	            if(data[0]['EndDate'] != null){
	            	$("#end_date_overtime").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
	            }
	       
	            $("#id_overtime").val(data[0]['Recnum']);
           		$('#ModalOvertime').modal({backdrop: 'static', keyboard: false}) ;
           		hideloader();
        });
	}

	function modalDayWorking(val) {
		$("#lbl-title-standart").text('Edit');
		$.get('MasterShiftTime/edittime', { id: $(val).data('id') }, function(data){ 
         		
           		$("#shift_code_2").val(data[0]['Code']);
           		$("#shift_name_2").val(data[0]['shiftname']);
           		$("#day_name").val(data[0]['IsDay']);

           		$("#mandat").val(data[0]['late']);
           		$("#mandat1").val(data[0]['early']);

           		$("#in").val(data[0]['time_in']);
           		$("#out").val(data[0]['time_out']);

           		$("#ROTAuto").val(data[0]['ReturnOtAuto']);
           		
           		$("#TH").val(data[0]['WorkingHour']);

	            $("#id_time").val(data[0]['Recnum']);
           		$('#ModalStandart').modal({backdrop: 'static', keyboard: false}) ;
           		
           		hideloader();
        });
		
		$('#ModalStandart').modal({backdrop: 'static', keyboard: false}) ;
	}

	$('#btnAllowance').on('click', function (event) {
		$("#lbl-title-working").text('Add');
		
		$("#id_working").val('');

		showDialog();
		$('#ModalWorkingHour').modal({backdrop: 'static', keyboard: false}) ;
	});

	

	$('.btn-shift-edit').on('click', function (event) {
		$("#lbl-title-group").text('Edit');
		$("#name").val($(this).prev().text());
		$("#id_group").val($(this).prev().data('id'));
		$('#ModalGroupShift').modal({backdrop: 'static', keyboard: false}) ;
	});

	$('.btn-shift-delete').on('click', function (event) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			var id= $(this).prev().prev().data('id'); 
		    $.get('MasterShiftTime/del_group_shift', { id:id }, function(data){  			 				
 				window.location.reload();
            });
		} 
	});
	$('#class_allow').on('change', function() {
		showDialog();
	});
	$('#class_allow_2').on('change', function() {
		showDialog();
	});
	$('#working_status').on('change', function() {
		showDialog();
	});

	function modalshift(val){
		showloader('body');
		$("#lbl-title-shift").text('Edit');
		$.get('MasterShiftTime/editshift', { id: $(val).data('id') }, function(data){ 
         		$("#lbl-title-pattern").text('Edit');
           		$("#shift_code").val(data[0]['Code']);
           		$("#shift_name").val(data[0]['IsDesc']);
           		$("#OTAuto").val(data[0]['OTAuto']);
	            $("#shift").val(data[0]['RecnumGroupShift']).trigger('chosen:updated');
	            $("#shift_type").val(data[0]['RecnumShiftType']).trigger('chosen:updated');
	            $("#day_type").val(data[0]['RecnumDayType']).trigger('chosen:updated');
	            $("#otVal").val(data[0]['RecnumOTValidation']).trigger('chosen:updated');
	            var checked = data[0]["StatusHoliday"] == 1 ? true: false;
            	if(checked){ $("#isHoliday").attr('checked','checked')}else{ $("#isHoliday").removeAttr('checked')}

            	var checked_late = data[0]["LateMinusOT"] == 1 ? true: false;
            	if(checked_late){ $("#LMO").attr('checked','checked')}else{ $("#LMO").removeAttr('checked')}

            	var checked_early = data[0]["EarlyOutMinusOT"] == 1 ? true: false;
            	if(checked_early){ $("#EOMO").attr('checked','checked')}else{ $("#EOMO").removeAttr('checked')}

	            $("#id_shift").val(data[0]['Recnum']);
           		$('#ModalShift').modal({backdrop: 'static', keyboard: false}) ;
           		$("#btnDelete").css("display","inline-block");
           		hideloader();
        });
	}

	
	$('#btnDelete').on('click', function (event) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$.get('MasterShiftTime/deleteshift', { id: $("#id_shift").val() }, function(data){ 
				if(!data.error){
					window.location.reload();
				}else{
					alert(data);
				}
			});
		}
	});

	function deleteAttendanceAllowance(val){
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$.get('MasterShiftTime/deleteAttendanceAllowance', { id: $(val).data('id') }, function(data){ 
				if(!data.error){
					showDialog();
				}else{
					alert(data);
				}
			});
		}
	}
	function deleteAttendanceClass(val){
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$.get('MasterShiftTime/deleteAttendanceClass', { id: $(val).data('id') }, function(data){ 
				if(!data.error){
					showDialog();
				}else{
					alert(data);
				}
			});
		}
	}
	function deleteOvertime(val){
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			$.get('MasterShiftTime/deleteOvertime', { id: $(val).data('id') }, function(data){ 
				if(!data.error){
					showDialog();
				}else{
					alert(data);
				}
			});
		}
	}
</script>
