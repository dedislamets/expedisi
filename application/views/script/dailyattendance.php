
<script type="text/javascript">

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

    $('#from_permit').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        disableFocus: true,
        icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
        }
    }).on('focus', function() {
        $('#from_permit').timepicker('showWidget');
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    $('#to_permit').timepicker({
        minuteStep: 1,
        showSeconds: true,
        showMeridian: false,
        disableFocus: true,
        icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
        }
    }).on('focus', function() {
        $('#to_permit').timepicker('showWidget');
    }).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

    
    function getProgress() {
        console.log('getProgress');
        $.ajax({
            url: "DailyAttendance/progress",
            type: "GET",
            contentType: false,
            processData: false,
            async: false,
            success: function (data) {
                console.log(data);
                $('#progressbar').css('width', data+'%').children('.sr-only').html(data+"% Complete");
                if(data!=='100'){
                    setTimeout('getProgress()', 2000);
                }
            }
        });
    }
    function progressUpload(event){
        var percent = (event.loaded / event.total) * 100;
        document.getElementById("progress-bar").style.width = Math.round(percent)+'%';    
        document.getElementById("status").innerHTML = Math.round(percent)+"%";
        if(event.loaded==event.total){
            alert('komplit');
        }
    }
	
    $(document).ready(function(){ 

        $('#ProcessForm').on('submit', function(e){
            e.preventDefault();

            var percentComplete = 1;
            $.ajax({
                method: 'post',
                url: 'DailyAttendance/process',
                data:{'actionPerform':'actionPerform'},
                xhr: function(){
                      var xhr = new window.XMLHttpRequest();
                      //Upload progress, request sending to server
                      xhr.upload.addEventListener("progress", function(evt){
                        console.log("in Upload progress");
                        console.log("Upload Done");
                      }, false);
                      //Download progress, waiting for response from server
                      xhr.addEventListener("progress", function(e){
                        console.log("in Download progress");
                        if (e.lengthComputable) {
                          //percentComplete = (e.loaded / e.total) * 100;
                          percentComplete = parseInt( (e.loaded / e.total * 100), 10);
                          console.log(percentComplete);
                          $('#bulk-action-progbar').data("aria-valuenow",percentComplete);
                          $('#bulk-action-progbar').css("width",percentComplete+'%');

                        }
                        else{
                             console.log("Length not computable.");
                        }
                      }, false);
                      return xhr;
                },
                success: function (res) {
                    //...
                }
            });
           
        });

        var d = new Date();

        $("#periode_start").datepicker("setDate", d);
        $("#periode_end").datepicker("setDate", d);

        showloader('body');
        var start = $("#periode_start").val();
        var end = $("#periode_end").val();
        myTable_daily = $('#ViewTable_daily').DataTable({
                    ajax: {                 
                        "url": "DailyAttendance/datatabel",
                        "type": "GET",
                        "data" : {'start': start , 'end' : end }
                    },          
                    "bPaginate": true,  
                    dataSrc: "original.data",
                    columnDefs:[
                            {
                                targets:4, render:function(data){
                                    return moment(data).format('DD MMM YYYY'); 
                                }
                            },
                            {
                                targets:[6,7,8,9,16,17,18,19,20,21], render:function(data){
                                    return moment(data).format('HH:mm'); 
                                }
                            },
                            { "width": "300px", "targets": [1] },
                            { "width": "130px", "targets": [4] },
                        
                    ],
                    "destroy": true,
                    "initComplete": function(settings, json) {
                        hideloader();
                    },
                    error: function (xhr, status, errorThrown) {
                        hideloader();
                        alert(xhr.responseText);
                    }
                });

        $('#btnGo').on('click', function (event) {
            loadData();
        });

        $('#btnProcess').on('click', function (event) {
            showloader('body');
            $('#ModalProcess').modal({backdrop: 'static', keyboard: false}) ;
            hideloader();
        });

        $('#btnFind').on('click', function (event) {
            var checked_courses = $('#iframe').contents().find('input[name="selected_courses[]"]:checked').length;
            if (checked_courses != 0) {
                CheckedTrue();
            } else {
                alert("Silahkan pilih terlebih dahulu");
            }
        });

        $('#btnAdvance').on('click', function (event) {
            showloader('body');
            $("#iframe").attr('src','Iframe/dailyattendance');
            $("#iframe").attr('frameBorder','0');
            $("#iframe").attr('marginHeight','0px');
            $("#iframe").attr('marginWidth','0px');
            $("#iframe").attr('width','100%');
            $("#iframe").attr('style','width:100%; height: 400px; display:block !important');
            $('#ModalFind').modal({backdrop: 'static', keyboard: false}) ;
            hideloader();
        });
        $("#absen_type").change(function(e, params){
             loadData();
        });
        $("#shift_type").change(function(e, params){
             loadData();
        });
    });
    
    function loadData(){
        showloader('body');
        var start = $("#periode_start").val();
        var end = $("#periode_end").val();
        var ot = $("#overtime").prop('checked');
        var late = $("#late").prop('checked');
        var early = $("#early").prop('checked');
        var absen = $("#absen").prop('checked');
        var resign = $("#resign").prop('checked');

        myTable_daily.ajax.url("DailyAttendance/datatabel?start=" + start + "&end=" + end + "&ot=" + ot+ "&late=" + late + "&early=" + early + "&absen=" + absen + "&resign=" + resign + "&absen_type=" + $("#absen_type").val() + "&shift_type=" + $("#shift_type").val()).load();
        hideloader();
    }

    function showattendance(val){
        var data = myTable_daily.row($(val).closest('tr')).data();
        $("#date_attendance_1").val(moment(data[4]).format('DD MMM YYYY'));
        $("#date_attendance").val(data[4]);
        $("#in_s").val(moment(data[6]).format('HH:mm'));
        $("#out_s").val(moment(data[7]).format('HH:mm'));
        $("#in").val(moment(data[8]).format('HH:mm:ss'));
        $("#out").val(moment(data[9]).format('HH:mm:ss'));
        $('#ModalAttendance').modal({backdrop: 'static', keyboard: false}) ;
    }

    function CheckedTrue() {
        var b = $("#txtSelected");
        b.val('');
        var str = "";
        var oTable = document.getElementById("iframe").contentWindow.oTable;
        var rowcollection = oTable.$(':checkbox', { "page": "all" });
        rowcollection.each(function () {
            if (this.checked) {
                str += this.value + ";";
            }
        });
        b.val(str);                        
        $('#ModalFind').modal('hide') ;
        myTable_daily.ajax.url("DailyAttendance/datatabel?advance=" + str).load();
    }

    
</script>
<?php
  $this->load->view('script/personal');
?>