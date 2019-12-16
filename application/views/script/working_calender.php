<script type="text/javascript">

	jQuery(function($) {

	/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events div.external-event').each(function() {

			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()) // use the element's text as the event title
			};

			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
		});




		/* initialize the calendar
		-----------------------------------------------------------------*/

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();


		var calendar = $('#calendar').fullCalendar({
			//isRTL: true,
			//firstDay: 1,// >> change first day of week 
			allDay: true,
			buttonHtml: {
				prev: '<i class="ace-icon fa fa-chevron-left"></i>',
				next: '<i class="ace-icon fa fa-chevron-right"></i>'
			},
		
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			events: function(start, end, timezone, callback) {                        
               $.ajax({
                 url: '<?php echo base_url() ?>WorkingCalender/get_events',
                 dataType: 'json',
                 data: {
                  start: start.unix(),
                  end: end.unix(),                          
                 },
                 success: function(msg) {                            
                     var events = msg.events;
                     callback(events);
                 }
               });
           	},
			
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date) { // this function is called when something is dropped
				// retrieve the dropped element's stored Event Object
				var originalEventObject = $(this).data('eventObject');
				var $extraEventClass = $(this).attr('data-class');
				var dataid = $(this).attr('data-id');
				
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = false;
				if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
				

				$('#day_tipe').val(dataid).trigger('chosen:updated');
				$('#name').val('');
	            $('#description').val('');
	            $('#start_date').val(moment(date).format('YYYY-MM-DD HH:mm'));
	            $('#end_date').val(moment(date).format('YYYY-MM-DD HH:mm'));

	            $('#event_id').val('');
	            $('#addModal').modal({backdrop: 'static', keyboard: false}) ;
				
			}
			,
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				$('#ViewTable').DataTable({
					ajax: {		            
			            "url": "WorkingCalender/getdata_participant",
			            "type": "GET",
			            "data":{'eventid': 0},
			        },			
					"bPaginate": true,	
					"destroy": true,
				});
				$('#name').val('');

	            $('#start_date').val(moment(start).format('YYYY-MM-DD HH:mm'));
	            $('#end_date').val(moment(end).format('YYYY-MM-DD HH:mm'));

	            $('#event_id').val('');
	            $('#addModal').modal({backdrop: 'static', keyboard: false});
	            $('#IsPublic').prop('checked','checked');
				$("#tblPartisipant").css('display','none');
				$('#btnAddParticipant').attr('disabled','disabled');

				//calendar.fullCalendar('unselect');
			}
			,
			eventClick: function(event, jsEvent, view) {
				$('#ViewTable').DataTable({
					ajax: {		            
			            "url": "WorkingCalender/getdata_participant",
			            "type": "GET",
			            "data":{'eventid': event.id},
			        },			
					"bPaginate": true,	
					"destroy": true,
				});
				$('#name').val(event.title);
				$('#day_tipe').val(event.day_tipe).trigger('chosen:updated');

	            $('#start_date').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
	            if(event.end) {
	                $('#end_date').val(moment(event.end).format('YYYY-MM-DD HH:mm'));
	            } else {
	                $('#end_date').val(moment(event.start).format('YYYY-MM-DD HH:mm'));
	            }
	            if(event.public != 1) { 
	            	$("#IsPublic").removeAttr('checked');
	            	$("#tblPartisipant").css('display','block');
	            	
	            } else {
	            	$('#IsPublic').prop('checked','checked');
	            	$("#tblPartisipant").css('display','none');

	        	}
	            
	            $('#event_id').val(event.id);
	            $('#addModal').modal({backdrop: 'static', keyboard: false}) ;
				

			}
			
		});


	})

	 $(document).ready(function(){ 
        
       $('#start_date').datetimepicker({
		 format: 'YYYY-MM-DD HH:mm',
		 icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-arrows ',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		 }
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});

		$('#end_date').datetimepicker({
		 format: 'YYYY-MM-DD HH:mm',
		 icons: {
			time: 'fa fa-clock-o',
			date: 'fa fa-calendar',
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down',
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-arrows ',
			clear: 'fa fa-trash',
			close: 'fa fa-times'
		 }
		}).next().on(ace.click_event, function(){
			$(this).prev().focus();
		});
        var zone = "05:30";   
    }); 

	$('#btnAddParticipant').on('click', function (event) {
		event.preventDefault();
		oTable = $('#myTable').DataTable({
				ajax: {		            
		            "url": "WorkingCalender/getdata",
		            "type": "GET",
		            "data":{'eventid': $('#event_id').val()},
		        },			
				"bPaginate": true,	
				"destroy": true,
		});
	   	$('#ModalParticipant').modal({backdrop: 'static', keyboard: false});
	});

	$('#submit_button').click(function () {
        var checked_courses = $('input[name="selected_courses[]"]:checked').length;
        if (checked_courses != 0) {
            CheckedTrue();
        } else {
            alert("Silahkan pilih terlebih dahulu");
        }
    });

    function CheckedTrue() {
        var b = $("#txtSelected");
        b.val('');
        var str = "";
        var rowcollection = oTable.$(':checkbox', { "page": "all" });
        rowcollection.each(function () {
            if (this.checked) {
                str += this.value + ";";
            }
        });
        b.val(str);                        
        EditData(str);
    }

    function EditData(val) {
        $.get('WorkingCalender/simpan_participant', { event: $('#event_id').val(), empid: val }, function(data){ 
           if(data.error==false){
           		$('#ModalParticipant').modal('hide');
           		$('#ViewTable').DataTable({
					ajax: {		            
			            "url": "WorkingCalender/getdata_participant",
			            "type": "GET",
			            "data":{'eventid': $('#event_id').val()},
			        },			
					"bPaginate": true,	
					"destroy": true,
				});
           }   
        });                
    }
    $('#IsPublic').on('click', function () {
	    if(!$('#IsPublic').prop('checked')){
	    	$("#tblPartisipant").css('display','block');
	    }else{
	    	$("#tblPartisipant").css('display','none');
	    }
	});
	$('#btnSchedule').on('click', function () {
	    $.post('WorkingCalender/add_event', $("#form1").serialize(), function(data){ 
           if(data.error==false){
           		$('#event_id').val(data.insert_id);
           		$('#btnAddParticipant').removeAttr('disabled');
           		alertok('Berhasil disimpan..');
           }else{	
				$("#lblMessage").remove();
	            alerterror(data.msg);
				$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
										  					  	
			}
        });    
	});
</script>