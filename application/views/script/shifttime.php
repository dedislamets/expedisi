<script type="text/javascript">
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
	
	$('#btnAddGroup').on('click', function (event) {
		$("#lbl-title-group").text('Add');
		$("#name").val('');
		$("#id_group").val('');
		$('#ModalGroupShift').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnAddShift').on('click', function (event) {
		$("#lbl-title-shift").text('Add');
		$("#id_shift").val('');
		$('#ModalShift').modal({backdrop: 'static', keyboard: false}) ;
	});
	$('#btnAllowance').on('click', function (event) {
		$("#lbl-title-working").text('Add');
		
		$("#id_working").val('');

		$('#tabel-attendence-allowance').DataTable({
			ajax: {		            
	            "url": "MasterShiftTime/getdata_attendance_allowance",
	            "type": "GET",
	            "data":{'class': 1},
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
	            "url": "MasterShiftTime/getdata_attendance_allowance",
	            "type": "GET",
	            "data":{'class': 1},
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
</script>
