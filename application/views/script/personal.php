
<script type="text/javascript">
	$('.number').priceFormat({
        prefix: '',
        centsSeparator: '',
        centsLimit: 0,
        thousandsSeparator: ''
    });
	function chosen(){
		$('.chosen-select').chosen({allow_single_deselect:true}); 
		//resize the chosen on window resize

		$(window).off('resize.chosen')
		.on('resize.chosen', function() {
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': '100%'});
			})
		}).trigger('resize.chosen');
		//resize chosen on sidebar collapse/expand
		$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
			if(event_name != 'sidebar_collapsed') return;
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			})
		});
	}
	chosen();
	$('.date-picker').datepicker({
		autoclose: false,
		todayHighlight: true
	});
	myTabel  = $('#ViewTable').DataTable({
		     	//processing	: true,
				//serverSide	: true,
				ajax: {		            
		            "url": "datatabel",
		            "type": "GET"
		        },			
		        //"sScrollY": "200px",
				"bPaginate": true,	
				columnDefs:[
						{
							targets:8, render:function(data){
				      			return moment(data).format('DD MMM YYYY'); 
				    		}
				    	},
				    	{ "width": "130px", "targets": [3,5] }
				    	]	 ,   	 
		  		"fnDrawCallback": function (oSettings) {
		  			$('.js_popover').popover('hide');
                    $(".js_popover").popover({
                        html: true,
                        trigger: 'hover click',
                        placement: 'right',
                        animated: true,
                        content: function (e) { 
                        	html = '<div class="col-md-4"><div class="row no-padding"><img class="img-responsive" src="' + $(this).data('img') + '" /></div></div><div class="col-md-8"><p style="font-weight:bold;margin:0;">'+$(this).data('name')+'</p><p style="margin:0;">'+$(this).data('id')+' / '+$(this).data('status')+'</p><p style="margin:0;">'+$(this).data('location')+'</p><p style="margin:0;">'+$(this).data('org')+'</p><p style="margin:0;">'+$(this).data('class')+'</p><p style="margin:0;" >'+ moment($(this).data('join')).format('DD MMM YYYY') +'</p></div><div class="col-md-12 row text-center" style="margin-bottom: 10px !important;margin-top: 8px !important;"><a href="#" onclick="showModal(\''+$(this).data('id')+'\')">Personal info</a> | <a href="#" onclick="showModal2(\''+$(this).data('id')+'\')">Employee Data</a> | <a href="#" onclick="showModal3(\''+$(this).data('id')+'\')">Additional Info</a></div>';
                        	return html; 
                        }
                    });
                    
                },
                "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			      
			    }
		    });


    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
    
    new $.fn.dataTable.Buttons( myTabel , {
                    buttons: [
                      
                      {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      }     
                    ]
                } );
    myTabel .buttons().container().appendTo( $('.tableTools-container') );
    
    
    ////

    setTimeout(function() {
        $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
        });
    }, 500);
    
    function generateDataModalEdit(empid){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_foto_profil",{id: empid}, function(data){    
            $("#profileimg").attr("src",data+"?t=" + new Date().getTime());
        });
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_biodata",{id: empid}, function(data){   
            $("#recnumid").val(data['basic'][0]['Recnum']);
            $("#empid").val(data['basic'][0]['EmployeeId']);
            $("#empname").val(data['basic'][0]['EmployeeName']);
            $("#empplace").val(data['basic'][0]['PlaceOfBirth']);
            $("#finger").val(data['basic'][0]['FingerId']);
            $("#office_mail").val(data['basic'][0]['OfficeMail']);
            $("#personal_mail").val(data['basic'][0]['PersonalMail']);
            $("#kk").val(data['basic'][0]['FamilyCardNo']);
            $("#ktp").val(data['basic'][0]['KtpNo']);
            $("#alias").val(data['basic'][0]['Alias']);
            $("#npwp").val(data['basic'][0]['NPWPNo']);
            $("#height").val(data['basic'][0]['Height']);
            $("#weight").val(data['basic'][0]['Weight']);
            $("#ext").val(data['basic'][0]['Ext']);
            $("#comp_name").val(data['basic'][0]['ComputerName']);
            $("#ip").val(data['basic'][0]['IPAddress']);
            $("#shirt").val(data['basic'][0]['UniSizeShirt']);
            $("#shirt_short").val(data['basic'][0]['UniSizeShirtShort']);
            $("#pants").val(data['basic'][0]['UniSizePants']);
            $("#helmet").val(data['basic'][0]['UniSizeHelmet']);
            $("#shoes").val(data['basic'][0]['UniSizeShoes']);
            $("#shoes_office").val(data['basic'][0]['UniSizeShoesOffice']);
            $("#hat").val(data['basic'][0]['UniSizeHat']);
            $("#passport").val(data['basic'][0]['PasporNo']);
            $("#poh").val(data['basic'][0]['HomeBase']);
            $("#phone").val(data['basic'][0]['Handphone']);
            if(data['basic'][0]['DateOfBirth'] != null){
                $("#dateBirth").val(moment(data['basic'][0]['DateOfBirth']).format('DD-MM-YYYY'));
            }
            if(data['basic'][0]['MarriedDate'] != null){
                $("#married").val(moment(data['basic'][0]['MarriedDate']).format('DD-MM-YYYY'));
            }
            if(data['basic'][0]['JoinDate'] != null){
                $("#join").val(moment(data['basic'][0]['JoinDate']).format('DD-MM-YYYY'));
            }
            $("#country").val(data['basic'][0]['RecnumCountry']).trigger('chosen:updated');
            $("#religion").val(data['basic'][0]['RecnumReligion']).trigger('chosen:updated');
            $("#blood").val(data['basic'][0]['RecnumBlood']).trigger('chosen:updated');
            $("#gender").val(data['basic'][0]['RecnumGender']).trigger('chosen:updated');

            var checked = data['basic'][0]["UseLens"] == 1 ? true: false;
            if(checked){ $("#isLens").attr('checked','checked')}else{ $("#isLens").removeAttr('checked')}
            
            // Present Address
   
            $("#address").text((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PAddress']));
            $("#rt").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRT']));
            $("#rw").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRW']));
            $("#pos").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PPostCode']));
            $("#countryAddress").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRecnumCountry'])).trigger('chosen:updated');

            $("#prov").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRecnumProvince'])).trigger('chosen:updated');
            setprov('prov','city');
            setTimeout(function(){ 
                $("#city").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRecnumCity'])).trigger('chosen:updated');
                setcity('city','state', (typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRecnumKecamatan']));
                setstate('state', 'kel',(typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRecnumKelurahan']));
             }, 1000);

            setTimeout(function(){ 
                setstate('state', 'kel',(typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PRecnumKelurahan']));
             }, 3000);

            $("#name_emergency_1").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC1Name']));
            $("#relation_emergency_1").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC1Relation']));
            $("#phone2_emergency_1").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC1Handphone']));
            $("#address_emergency_1").text((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC1Address']));

            // CUrrent Address
            $("#address_current").text((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CAddress']));
            $("#rt_current").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRT']));
            $("#rw_current").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRW']));
            $("#pos_current").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CPostCode']));
            $("#ccountryAddress").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRecnumCountry'])).trigger('chosen:updated');

            $("#cprov").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRecnumProvince'])).trigger('chosen:updated');
            setprov('cprov','ccity');
            setTimeout(function(){ 
                $("#ccity").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRecnumCity'])).trigger('chosen:updated');
                setcity('ccity','cstate', (typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRecnumKecamatan']));
                setstate('cstate', 'ckel',(typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRecnumKelurahan']));
             }, 1000);

            setTimeout(function(){ 
                setstate('cstate', 'ckel',(typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['CRecnumKelurahan']));
             }, 3000);

            $("#name_emergency_2").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC2Name']));
            $("#relation_emergency_2").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC2Relation']));
            $("#phone2_emergency_2").val((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC2Handphone']));
            $("#address_emergency_2").text((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['EC2Address']));

            // Family Detail
            $("#tabel-family>tbody").html('');
            var tabel='';
            for (index = 0, len = data['family_detail'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalFamily(\''+ data['family_detail'][index]["Recnum"] +'\')">'+ data['family_detail'][index]["KTPNo"] +'</a></td>';
                tabel += '<td>'+ data['family_detail'][index]["FamilyName"] +'</td>';
                tabel += '<td>'+ data['family_detail'][index]["relasi"] +'</td>';
                tabel += '<td>'+ moment(data['family_detail'][index]["BirthOfDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ data['family_detail'][index]["Age"] +'</td>';
                tabel += '<td>'+ data['family_detail'][index]["gender"] +'</td>';
                tabel += '<tr>';                
            }
            
            $(tabel).appendTo($("#tabel-family").children('tbody'));

            // Family Status
            tabel='';
            $("#tabel-status>tbody").html('');
            for (index = 0, len = data['family_status'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalFamilyStatus(\''+ data['family_status'][index]["Recnum"] +'\')">'+ data['family_status'][index]["family_status"] +'</a></td>';
                tabel += '<td>'+ moment(data['family_status'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ moment(data['family_status'][index]["EndDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<tr>';                
            }
            
            $(tabel).appendTo($("#tabel-status").children('tbody'));

            // Family Marital
            tabel='';
            $("#tabel-marital>tbody").html('');
            for (index = 0, len = data['family_marital'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalFamilyMarital(\''+ data['family_marital'][index]["Recnum"] +'\')">'+ data['family_marital'][index]["marital"] +'</a></td>';
                tabel += '<td>'+ moment(data['family_marital'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ moment(data['family_marital'][index]["EndDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<tr>';                
            }
            
            $(tabel).appendTo($("#tabel-marital").children('tbody'));

            // Family Tax
            tabel='';
            $("#tabel-tax>tbody").html('');
            for (index = 0, len = data['family_tax'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalFamilyTax(\''+ data['family_tax'][index]["Recnum"] +'\')">'+ data['family_tax'][index]["tax"] +'</a></td>';
                tabel += '<td>'+ moment(data['family_tax'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<tr>';                
            }
            
            $(tabel).appendTo($("#tabel-tax").children('tbody'));

            // Education
            tabel='';
            $("#tabel-education>tbody").html('');
            for (index = 0, len = data['education'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalEdu(\''+ data['education'][index]["Recnum"] +'\')">'+ data['education'][index]["NameSchool"] +'</a></td>';
                tabel += '<td>'+ (data['education'][index]["Majoring"]== null ? '': data['education'][index]["Majoring"])  +'</td>';
                tabel += '<td>'+ moment(data['education'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ moment(data['education'][index]["EndDate"]).format('DD MMM YYYY') +'</td>';
                
                tabel += '<td>'+ data['education'][index]["level_school"] +'</td>';
                tabel += '<tr>';                
            }

            $(tabel).appendTo($("#tabel-education").children('tbody'));

            // Training
            tabel='';
            $("#tabel-training>tbody").html('');
            for (index = 0, len = data['training'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalTraining(\''+ data['training'][index]["Recnum"] +'\')">'+ data['training'][index]["materi"] +'</a></td>';
                tabel += '<td>'+ data['training'][index]["CertificateNo"] +'</td>';

                tabel += '<td>'+ moment(data['training'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                
                tabel += '<td>'+ data['training'][index]["Score"] +'</td>';
                tabel += '<tr>';                
            }

            $(tabel).appendTo($("#tabel-training").children('tbody'));


        });
        $("#action").text('Edit');
        $("#liFamily").removeClass("hidden");
        $("#liAddress").removeClass("hidden");
        $("#liEducation").removeClass("hidden");
    }

	function showModal(empid){
		generateDataModalEdit(empid);
        $('#modal-personal').modal({backdrop: 'static', keyboard: false}) ;
	}
    function generateDataModalEmployee(empid){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_employee_data",{id: empid}, function(data){ 
            $("#recnumid").val(data['basic'][0]['Recnum']);
            $("#empid").val(data['basic'][0]['EmployeeId']);

            // Reward
            var tabel='';
            for (index = 0, len = data['reward'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalReward(\''+ data['reward'][index]["Recnum"] +'\')">'+ data['reward'][index]["RewardDesc"] +'</a></td>';
                tabel += '<td>'+ moment(data['reward'][index]["RewardDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ formatnomor(data['reward'][index]["Allowance"]) +'</td>';
                tabel += '<tr>';                
            }
            $("#tabel-reward > tbody").html('');
            $(tabel).appendTo($("#tabel-reward").children('tbody'));

            // Punishment
            tabel='';
            for (index = 0, len = data['punish'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalPunish(\''+ data['punish'][index]["Recnum"] +'\')">'+ data['punish'][index]["IsDesc"] +'</a></td>';
                tabel += '<td>'+ moment(data['punish'][index]["PunishmentDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ formatnomor(data['punish'][index]["Deduction"]) +'</td>';
                tabel += '<tr>';                
            }
            $("#tabel-punish > tbody").html('');
            $(tabel).appendTo($("#tabel-punish").children('tbody'));

            // Inventaris
            tabel='';
            for (index = 0, len = data['inventaris'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalInventory(\''+ data['inventaris'][index]["Recnum"] +'\')">'+ data['inventaris'][index]["InventoryName"] +'</a></td>';
                tabel += '<td>'+ formatnomor(data['inventaris'][index]["Total"]) +'</td>';
                //tabel += '<td>'+ moment(data['inventaris'][index]["ReceiveDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ moment(data['inventaris'][index]["ExpiredDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ data['inventaris'][index]["StatusInventory"] +'</td>';
                tabel += '<td>'+ (data['inventaris'][index]["ReturnDate"]== null ? '': moment(data['inventaris'][index]["ReturnDate"]).format('DD MMM YYYY'))  +'</td>';
                tabel += '<tr>';                
            }
            $("#tabel-inventory > tbody").html('');
            $(tabel).appendTo($("#tabel-inventory").children('tbody'));

            $("#action-data").text('Edit');
  
            // Grade
            tabel='';
            for (index = 0, len = data['grade'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalGrade(\''+ data['grade'][index]["Recnum"] +'\')">'+ data['grade'][index]["ClassName"] +'</a></td>';
                
                tabel += '<td>'+ moment(data['grade'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ (data['grade'][index]["EndDate"]== null ? '': moment(data['grade'][index]["EndDate"]).format('DD MMM YYYY'))  +'</td>';
                tabel += '<td>'+ (data['grade'][index]["SkNo"]== null ? '' : data['grade'][index]["SkNo"]) +'</td>';
                tabel += '<td>'+ (data['grade'][index]["Remark"]== null ? '' : data['grade'][index]["Remark"]) +'</td>';
               
                tabel += '<tr>';                
            }
            $("#tabel-grade > tbody").html('');
            $(tabel).appendTo($("#tabel-grade").children('tbody'));

            // Org
            tabel='';
            for (index = 0, len = data['org'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalOrg(\''+ data['org'][index]["Recnum"] +'\')">'+ data['org'][index]["OrgName"] +'</a></td>';
                tabel += '<td>'+ data['org'][index]["Struktural"] +'</td>';
                tabel += '<td>'+ data['org'][index]["Fungsional"] +'</td>';
                tabel += '<td>'+ moment(data['org'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ (data['org'][index]["EndDate"]== null ? '': moment(data['org'][index]["EndDate"]).format('DD MMM YYYY'))  +'</td>';
                
                tabel += '<td>'+ (data['org'][index]["SkNo"]== null ? '' : data['org'][index]["SkNo"]) +'</td>';
                tabel += '<td>'+ (data['org'][index]["Remark"]== null ? '' : data['org'][index]["Remark"]) +'</td>';
               
                tabel += '<tr>';                
            }
            $("#tabel-organization > tbody").html('');
            $(tabel).appendTo($("#tabel-organization").children('tbody'));

            // Status
            tabel='';
            for (index = 0, len = data['status'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalStatus(\''+ data['status'][index]["Recnum"] +'\')">'+ data['status'][index]["IsName"] +'</a></td>';
                tabel += '<td>'+ (data['status'][index]["DateAlert"]== null ? '': moment(data['status'][index]["DateAlert"]).format('DD MMM YYYY'))  +'</td>';
                tabel += '<td>'+ moment(data['status'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ (data['status'][index]["EndDate"]== null ? '': moment(data['status'][index]["EndDate"]).format('DD MMM YYYY'))  +'</td>';
                
                tabel += '<td>'+ (data['status'][index]["SkNo"]== null ? '' : data['status'][index]["SkNo"]) +'</td>';
                tabel += '<td>'+ (data['status'][index]["Remark"]== null ? '' : data['status'][index]["Remark"]) +'</td>';
               
                tabel += '<tr>';                
            }
            $("#tabel-employee-status > tbody").html('');
            $(tabel).appendTo($("#tabel-employee-status").children('tbody'));

            // Salary
            tabel='';
            for (index = 0, len = data['salary'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalSalary(\''+ data['salary'][index]["Recnum"] +'\')">'+ data['salary'][index]["IsDesc"] +'</a></td>';
                tabel += '<td>'+ formatnomor(data['salary'][index]["Total"]) +'</td>';
                tabel += '<td>'+ moment(data['salary'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ (data['salary'][index]["EndDate"]== null ? '': moment(data['salary'][index]["EndDate"]).format('DD MMM YYYY'))  +'</td>';
                tabel += '<tr>';                
            }
            $("#tabel-salary > tbody").html('');
            $(tabel).appendTo($("#tabel-salary").children('tbody'));



            
        });
    }
    function showModal2(empid){
        generateDataModalEmployee(empid);
        $('#modal-employee-data').modal({backdrop: 'static', keyboard: false}) ;
    }
    function generateDataModalAdditional(empid){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_additional",{id: empid}, function(data){ 
            $("#recnumid").val(data['basic'][0]['Recnum']);
            $("#empid").val(data['basic'][0]['EmployeeId']);
            // experience
            var tabel='';
            for (index = 0, len = data['experience'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalReward(\''+ data['experience'][index]["Recnum"] +'\')">'+ data['experience'][index]["Company"] +'</a></td>';
                tabel += '<td>'+ data['experience'][index]["Position"] +'</td>';
                tabel += '<td>'+ moment(data['experience'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ moment(data['experience'][index]["EndDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ data['experience'][index]["Remark"] +'</td>';
                tabel += '<tr>';                
            }
            $("#tabel-reward > tbody").html('');
            $(tabel).appendTo($("#tabel-reward").children('tbody'));

            // Vehicle
            tabel='';
            for (index = 0, len = data['vehicle'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalTraining(\''+ data['vehicle'][index]["Recnum"] +'\')">'+ data['vehicle'][index]["PoliceNo"] +'</a></td>';
                tabel += '<td>'+ data['vehicle'][index]["FrameNo"] +'</td>';
                tabel += '<td>'+ data['vehicle'][index]["MachineNo"] +'</td>';

                tabel += '<td>'+ moment(data['vehicle'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                
                tabel += '<td>'+ data['vehicle'][index]["Remark"] +'</td>';
                tabel += '<tr>';                
            }
            $("#tabel-vehicle > tbody").html('');
            $(tabel).appendTo($("#tabel-vehicle").children('tbody'));

            // SIM
            tabel='';
            for (index = 0, len = data['sim'].length; index < len; ++index) {
                tabel += '<tr>';
                tabel += '<td>'+ (index+1) +'</td>';
                tabel += '<td><a href="javascript:void(0)" onclick="EditModalTraining(\''+ data['sim'][index]["Recnum"] +'\')">'+ data['sim'][index]["IsName"] +'</a></td>';
                tabel += '<td>'+ data['sim'][index]["SimNo"] +'</td>';

                tabel += '<td>'+ moment(data['sim'][index]["StartDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<td>'+ moment(data['sim'][index]["EndDate"]).format('DD MMM YYYY') +'</td>';
                tabel += '<tr>';                
            }
            $("#tabel-sim > tbody").html('');
            $(tabel).appendTo($("#tabel-sim").children('tbody'));

        });
    }
    function showModal3(empid){

        generateDataModalAdditional(empid);
        $('#modal-additional').modal({backdrop: 'static', keyboard: false}) ;
    }

	$(document).on('change', '#file', function(){
        var name = document.getElementById("file").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
           alert("Invalid Image File");
        }

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file").files[0]);
        var f = document.getElementById("file").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000)
        {
           alert("Image File Size is very big");
        }
        else
        {
           form_data.append("file", document.getElementById('file').files[0]);
           form_data.append("csrf_token", $("input[name=csrf_token]").val());
           form_data.append("id", document.getElementById("empid").value);
           $.ajax({
                url:"<?php echo base_url(); ?>PersonalAdministration/foto_profil",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                    $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                },   
                success:function(data)
                {
                    $('#uploaded_image').html('');
                    $(".profile-img").empty();
                    $('.profile-img').html(data.foto);
                }
           });
        }
    });

    function formatnomor(nomor,icomma) {
        var parts = nomor.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    function savebiodata(){
    	var valid = false;
    	var sParam = $('#form-biodata').serialize();
    	var validator = $('#form-biodata').validate({
							rules: {
									empname: {
							  			required: true
									},
									empplace: {
							  			required: true
									},
									kk: {
							  			required: true
									},
									ktp: {
							  			required: true
									},
									office_mail: {
							  			required: true
									},
									personal_mail: {
							  			required: true
									},
									join: {
							  			required: true
									},
									dateBirth: {
							  			required: true
									}          
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'PersonalAdministration/SaveEmp';
	 		if($("#action").text()=='Edit'){
	 			link = 'PersonalAdministration/UpdateEmp';
		 	}
	 		$.get(link,sParam, function(data){
				if(data.error==false){									
					alertok('Berhasil disimpan..');
					//window.location.reload();
				}else{	
                    alerterror(data.msg);
					$("#lblMessage").remove();
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}

	 	return false;
    }
    function saveaddress(){
    	var valid = false;
    	var sParam = $('#form-address').serialize()+ "&recnumid="+ $("#recnumid").val();
    	var validator = $('#form-address').validate();
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'PersonalAdministration/SaveAddrs';
	 		$.get(link,sParam, function(data){
				if(data.error==false){									
					generateDataModalEdit($("#empid").val());                          
                    alertok('Berhasil disimpan..');
				}else{	
					$("#lblMessage").remove();
                    alerterror(data.msg);
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}

	 	return false;
    }

    function EditModalFamily(id){
    	$.get("<?php echo base_url(); ?>PersonalAdministration/get_family",{recnum: id}, function(data){    
            $("#RecnumFamily").val(data[0]['Recnum']);
            $("#fa_name").val(data[0]['FamilyName']);
            $("#fa_nik").val(data[0]['KTPNo']);
            $("#fa_gender").val(data[0]['RecnumGender']).trigger('chosen:updated');
            $("#fa_relasi").val(data[0]['RecnumFamilyRelationship']).trigger('chosen:updated');
            $("#fa_place").val(data[0]['PlaceOfBirth']).trigger('chosen:updated');
            if(data[0]['BirthOfDate'] != null){
            	$("#fa_birth_date").val(moment(data[0]['BirthOfDate']).format('DD-MM-YYYY'));
            }
            $("#fa_blood").val(data[0]['RecnumBlood']==null ? 0 : data[0]['RecnumBlood']).trigger('chosen:updated');
            $("#fa_job").val(data[0]['Job']);
			var checked = data[0]["MarriedStatus"] == 1 ? true: false;
            if(checked){ $("#isMarried").attr('checked','checked')}else{ $("#isMarried").removeAttr('checked')}
        });
    	$('#modal-family-detail').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalFamilyStatus(id){
    	$.get("<?php echo base_url(); ?>PersonalAdministration/get_status",{recnum: id}, function(data){    
            $("#RecnumFamilyStatus").val(data[0]['Recnum']);
            $("#fa_prorate").val(data[0]['ProrateLimitMedical']);
            $("#fa_status").val(data[0]['RecnumFamilyStatus']).trigger('chosen:updated');
            $("#dateRangeStart_stat").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            if(data[0]['EndDate'] != null){
            	$("#dateRangeEnd_stat").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }
        });
    	$('#modal-family-status').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalFamilyMarital(id){
    	$.get("<?php echo base_url(); ?>PersonalAdministration/get_marital",{recnum: id}, function(data){    
            $("#RecnumFamilyMarital").val(data[0]['Recnum']);
            $("#fa_marital").val(data[0]['RecnumMaritalStatus']).trigger('chosen:updated');
            $("#dateRangeStart_marital").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            if(data[0]['EndDate'] != null){
            	$("#dateRangeEnd_marital").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }
        });
    	$('#modal-family-marital').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalFamilyTax(id){
    	$.get("<?php echo base_url(); ?>PersonalAdministration/get_tax",{recnum: id}, function(data){    
            $("#RecnumTax").val(data[0]['Recnum']);
            $("#fa_tax").val(data[0]['RecnumTaxMethod']).trigger('chosen:updated');
            $("#dateRangeStart_tax").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
        });
    	$('#modal-family-tax').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalEdu(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_education",{recnum: id}, function(data){    
            $("#RecnumEducation").val(data[0]['Recnum']);
            $("#edu_school").val(data[0]['RecnumMajoring']).trigger('chosen:updated');
            $("#edu_gpa").val(data[0]['Score']);
            $("#edu_school").val(data[0]['NameSchool']);
            $("#edu_certificate").val(data[0]['CertificateNo']);
            $("#edu_level").val(data[0]['RecnumEducation']).trigger('chosen:updated');

            if(data[0]['EndDate'] != null){
                $("#dateRangeEnd_edu").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['StartDate'] != null){
                $("#dateRangeStart_edu").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
        });
        $('#modal-education').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalTraining(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_training",{recnum: id}, function(data){    
            $("#RecnumTraining").val(data[0]['Recnum']);
            $("#training").val(data[0]['RecnumMateriTraining']).trigger('chosen:updated');
            $("#tra_score").val(data[0]['Score']);
            $("#tra_trainer").val(data[0]['TrainerName']);
            $("#tra_certificate").val(data[0]['CertificateNo']);

            if(data[0]['EndDate'] != null){
                $("#dateRangeEnd_tra").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['StartDate'] != null){
                $("#dateRangeStart_tra").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }

            var checked = data[0]["License"] == 1 ? true: false;
            if(checked){ $("#isLicense").attr('checked','checked')}else{ $("#isLicense").removeAttr('checked')}
        });
        $('#modal-training').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalReward(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_tabel_reward",{recnum: id}, function(data){    
            $("#RecnumReward").val(data[0]['Recnum']);
            $("#reward_by").val(data[0]['RewardBy']).trigger('chosen:updated');
            $("#reward_desc").val(data[0]['RewardDesc']);
            $("#allowance").val(data[0]['Allowance']);
            if(data[0]['AllwoanceDate'] != null){
                $("#allowance_date").val(moment(data[0]['AllwoanceDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['RewardDate'] != null){
                $("#dateRangeStart_reward").val(moment(data[0]['RewardDate']).format('DD-MM-YYYY'));
            }
        });
        $('#modal-reward').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalPunish(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_tabel_punish",{recnum: id}, function(data){    
            $("#RecnumPunish").val(data[0]['Recnum']);
            $("#punish_type").val(data[0]['RecnumPunishmentType']).trigger('chosen:updated');
            $("#punish_by").val(data[0]['PunishmentBy']).trigger('chosen:updated');
            $("#punish_desc").val(data[0]['PunishmentDesc']);
            $("#deduction").val(data[0]['Deduction']);
            if(data[0]['DeductionDate'] != null){
                $("#deduction_date").val(moment(data[0]['DeductionDate']).format('DD-MM-YYYY'));
            }
            
            if(data[0]['EndDate'] != null){
                $("#dateRangeEnd_punish").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }
            if(data[0]['StartDate'] != null){
                $("#dateRangeStart_punish").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
        });
        $('#modal-punishment').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalInventory(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_tabel_inv",{recnum: id}, function(data){    
            $("#RecnumInventaris").val(data[0]['Recnum']);
            $("#item").val(data[0]['RecnumInventory']).trigger('chosen:updated');
            $("#item_status").val(data[0]['RecnumStatusInventory']).trigger('chosen:updated');
            $("#qty").val(data[0]['Total']);
            if(data[0]['ExpiredDate'] != null){
                $("#expired_date").val(moment(data[0]['ExpiredDate']).format('DD-MM-YYYY'));
            }
            
            if(data[0]['ReturnDate'] != null){
                $("#return_date").val(moment(data[0]['ReturnDate']).format('DD-MM-YYYY'));
            }
     
        });
        $('#modal-inventaris').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalGrade(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_tabel_class",{recnum: id}, function(data){    
            $("#RecnumGrade").val(data[0]['Recnum']);
            $("#grade_class").val(data[0]['RecnumClass']).trigger('chosen:updated');
            $("#SKNo").val(data[0]['SkNo']);
            $("#grade_remark").val(data[0]['Remark']);
            if(data[0]['StartDate'] != null){
                $("#dateRangeStart_grade").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
            
            if(data[0]['EndDate'] != null){
                $("#dateRangeEnd_grade").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }

            if(data[0]['SKDate'] != null){
                $("#SK_Date").val(moment(data[0]['SkDate']).format('DD-MM-YYYY'));
            }
     
        });
        $('#modal-grade').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalStatus(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_tabel_working",{recnum: id}, function(data){    
            $("#RecnumStatus").val(data[0]['Recnum']);
            $("#work_status").val(data[0]['RecnumWorkingStatus']).trigger('chosen:updated');
            $("#SKNo2").val(data[0]['SkNo']);
            $("#status_remark").val(data[0]['Remark']);
            if(data[0]['StartDate'] != null){
                $("#dateRangeStart_status").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
            
            if(data[0]['EndDate'] != null){
                $("#dateRangeEnd_status").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }

            if(data[0]['DateAlert'] != null){
                $("#SK_alert").val(moment(data[0]['DateAlert']).format('DD-MM-YYYY'));
            }
     
        });
        $('#modal-emp-status').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalOrg(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_tabel_org",{recnum: id}, function(data){    
            $("#RecnumOrg").val(data[0]['Recnum']);
            $("#tipemove").val(data[0]['RecnumTypeMoveOrganization']).trigger('chosen:updated');
            $("#SKNo3").val(data[0]['SkNo']);
            $("#org_remark").val(data[0]['Remark']);

            $("#fungsional").val(data[0]['RecnumPositionFunctional']).trigger('chosen:updated');
            $("#structural").val(data[0]['RecnumPositionStructural']).trigger('chosen:updated');
            $("#orgz").val(data[0]['RecnumOrganization']).trigger('chosen:updated');
            $("#ss").val(data[0]['RecnumOrganizationSecondary']).trigger('chosen:updated');
            $("#sf").val(data[0]['RecnumPositionFunctionalSecondary']).trigger('chosen:updated');
            $("#sp").val(data[0]['RecnumPositionStructuralSecondary']).trigger('chosen:updated');
            $("#coa").val(data[0]['RecnumCOA']).trigger('chosen:updated');
            $("#mentor").val(data[0]['RecnumMentor']).trigger('chosen:updated');
            $("#secretary").val(data[0]['RecnumSecretary']).trigger('chosen:updated');
            $("#kpp").val(data[0]['RecnumKPP']).trigger('chosen:updated');
            $("#hr").val(data[0]['RecnumAdminHR']).trigger('chosen:updated');
            $("#head1").val(data[0]['RecnumHead1']).trigger('chosen:updated');
            $("#location").val(data[0]['RecnumLocation']).trigger('chosen:updated');

            if(data[0]['StartDate'] != null){
                $("#dateRangeStart_org").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
            
            if(data[0]['EndDate'] != null){
                $("#dateRangeEnd_org").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }

            if(data[0]['SkDate'] != null){
                $("#SK_Date_Org").val(moment(data[0]['SkDate']).format('DD-MM-YYYY'));
            }
     
        });
        $('#modal-emp-org').modal({backdrop: 'static', keyboard: false});
    }
    function EditModalSalary(id){
        $.get("<?php echo base_url(); ?>PersonalAdministration/get_tabel_salary",{recnum: id}, function(data){    
            $("#RecnumSalary").val(data[0]['Recnum']);
            $("#component").val(data[0]['RecnumComponentSalary']).trigger('chosen:updated');
            $("#SKNo4").val(data[0]['SkNo']);
            $("#salary_remark").val(data[0]['Remark']);
            $("#salary_value").val(data[0]['Total']);


            if(data[0]['StartDate'] != null){
                $("#dateRangeStart_salary").val(moment(data[0]['StartDate']).format('DD-MM-YYYY'));
            }
            
            if(data[0]['EndDate'] != null){
                $("#dateRangeEnd_salary").val(moment(data[0]['EndDate']).format('DD-MM-YYYY'));
            }

            if(data[0]['SkDate'] != null){
                $("#SK_Date_Salary").val(moment(data[0]['SkDate']).format('DD-MM-YYYY'));
            }
     
        });
        $('#modal-salary').modal({backdrop: 'static', keyboard: false});
    }

    $('#btnAdd').on('click', function () {
    	$("#action").text('Add');
    	$("#empid").val('');
    	$("#empid").removeAttr('readonly');
        $("#empname").val('');
        $("#empplace").val('');
        $("#liFamily").addClass("hidden");
        $("#liAddress").addClass("hidden");
        $("#liEducation").addClass("hidden");
	   	$('#modal-personal').modal({backdrop: 'static', keyboard: false});
	});
	$('#btnAddDetail').on('click', function () {
	 	$("#RecnumFamily").val('');
        $("#fa_name").val('');
        $("#fa_nik").val('');
        $("#fa_birth_date").val('');
        $("#fa_job").val(0);
		$("#isMarried").removeAttr('checked');
	   	$('#modal-family-detail').modal({backdrop: 'static', keyboard: false});
	});

	$('#btnAddStatus').on('click', function () {
	 	$("#RecnumFamilyStatus").val('');
        $("#dateRangeStart_stat").val('');
        $("#dateRangeEnd_stat").val('');
        $("#fa_prorate").val(0);
	   	$('#modal-family-status').modal({backdrop: 'static', keyboard: false});
	});
	$('#btnAddMarital').on('click', function () {
	 	$("#RecnumFamilyMarital").val('');
        $("#dateRangeStart_marital").val('');
	   	$('#modal-family-marital').modal({backdrop: 'static', keyboard: false});
	});

	$('#btnAddTax').on('click', function () {
	 	$("#RecnumTax").val('');
        $("#dateRangeStart_tax").val('');
	   	$('#modal-family-tax').modal({backdrop: 'static', keyboard: false});
	});
	$('#btnAddEdu').on('click', function () {
	 	$("#RecnumEducation").val('');
        $("#dateRangeStart_edu").val('');
        $("#dateRangeEnd_edu").val('');
        $("#edu_school").val('');
        $("#edu_gpa").val('');
	   	$('#modal-education').modal({backdrop: 'static', keyboard: false});
	});
    $('#btnAddTraining').on('click', function () {
        $("#RecnumTraining").val('');
        $("#dateRangeStart_tra").val('');
        $("#dateRangeEnd_tra").val('');
        $("#tra_certificate").val('');
        $("#tra_trainer").val('');
        $("#tra_score").val('');
        $('#modal-training').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddReward').on('click', function () {
        $("#RecnumReward").val('');
        $("#dateRangeStart_reward").val('');
        $("#allowance_date").val('');
        $("#reward_desc").val('');
        $("#allowance").val('');
        $('#modal-reward').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddPunish').on('click', function () {
        $("#RecnumPunish").val('');
        $("#dateRangeStart_punish").val('');
        $("#dateRangeEnd_punish").val('');
        $("#deduction_date").val('');
        $("#deduction").val('');
        $("#punish_desc").val('');
        $('#modal-punishment').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddInventory').on('click', function () {
        $("#RecnumInventaris").val('');
        $("#lifeofuse").val('');
        $("#expired_date").val('');
        $("#qty").val(0);
        $("#return_date").val('');
        $("#item_remark").val('');
        $("#item").val(0).trigger('chosen:updated');
        $('#modal-inventaris').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddGrade').on('click', function () {
        $("#RecnumGrade").val('');
        $("#dateRangeStart_grade").val('');
        $("#dateRangeEnd_grade").val('');
        $("#SKNo").val('');
        $("#SK_Date").val('');
        $("#grade_remark").text('');
        $("#grade_class").val(0).trigger('chosen:updated');
        $('#modal-grade').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddEmpStatus').on('click', function () {
        $("#RecnumStatus").val('');
        $("#dateRangeStart_status").val('');
        $("#dateRangeEnd_status").val('');
        $("#SKNo2").val('');
        $("#SK_alert").val('');
        $("#status_remark").text('');
        $("#salary_type").val(0).trigger('chosen:updated');
        $("#work_status").val(0).trigger('chosen:updated');
        $('#modal-emp-status').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddOrg').on('click', function () {
        $("#RecnumOrg").val('');
        $("#dateRangeStart_org").val('');
        $("#dateRangeEnd_org").val('');
        $("#SKNo3").val('');
        $("#SK_Date_Org").val('');
        $("#org_remark").text('');
        $("#tipemove").val(0).trigger('chosen:updated');
        $("#fungsional").val(0).trigger('chosen:updated');
        $("#structural").val(0).trigger('chosen:updated');
        $("#orgz").val(0).trigger('chosen:updated');
        $('#modal-emp-org').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddSalary').on('click', function () {
        $("#RecnumSalary").val('');
        $("#dateRangeStart_salary").val('');
        $("#dateRangeEnd_salary").val('');
        $("#SKNo4").val('');
        $("#salary_value").val(0);
        $("#SK_Date_Salary").val('');
        $("#salary_remark").text('');
        $("#component").val(0).trigger('chosen:updated');

        $('#modal-salary').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddExperience').on('click', function () {
        $("#RecnumExperience").val('');
        $("#dateRangeStart_experience").val('');
        $("#dateRangeEnd_experience").val('');
        $("#company").val('');
        $("#netto").val(0);
        $("#pph").val(0);
        $("#experience_position").val('');
        $("#experience_remark").text('');

        $('#modal-experience').modal({backdrop: 'static', keyboard: false});
    });
    $('#btnAddVehicle').on('click', function () {
        $("#RecnumVehicle").val('');
        $("#dateRangeStart_vehicle").val('');
        $("#dateRangeEnd_vehicle").val('');
        $("#police_no").val('');
        $("#frame_no").val('');
        $("#machine_no").val('');
        $("#vehicle_remark").text('');
        $("#vehicle_code").val(0).trigger('chosen:updated');

        $('#modal-vehicle').modal({backdrop: 'static', keyboard: false});
    });

    $('#btnAddSIM').on('click', function () {
        $("#RecnumSIM").val('');
        $("#dateRangeStart_sim").val('');
        $("#dateRangeEnd_sim").val('');
        $("#sim_no").val('');
        $("#sim_remark").text('');
        $("#sim_code").val(0).trigger('chosen:updated');

        $('#modal-sim').modal({backdrop: 'static', keyboard: false});
    });

    $('#btnAddMembership').on('click', function () {
        $("#RecnumMembership").val('');
        $("#membership_no").val('');
        $("#dateRangeStart_membership").val('');
        $("#dateRangeEnd_membership").val('');
        $("#percent_from_company").val(0);
        $("#value_from_company").val(0);
        $("#percent_from_employee").val(0);
        $("#value_from_employee").val(0);
        $("#membership_remark").text('');
        $("#membership_type").val(0).trigger('chosen:updated');

        $('#modal-membership').modal({backdrop: 'static', keyboard: false});
    });

	$('#btnSaveFamily').on('click', function () {
    	var valid = false;
    	var sParam = $('#form-input-family').serialize()+ "&recnumid="+ $("#recnumid").val();

        $.validator.addMethod("valueNotEquals", 
            function(value, element, arg){
                              return arg !== value;
        }, "Value must not equal arg.");

        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    	var validator = $('#form-input-family').validate({
							rules: {
									fa_name: {
							  			required: true
									},
									fa_nik: {
							  			required: true
									},
									fa_birth_date: {
							  			required: true
									},
                                    fa_blood: {
                                        valueNotEquals: "0"
                                    },   
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'PersonalAdministration/SaveFamily';
	 		$.get(link,sParam, function(data){
				if(data.error==false){	
                    generateDataModalEdit($("#empid").val());								
					alertok('Berhasil disimpan..');
					//window.location.reload();
				}else{	
					$("#lblMessage").remove();
                    alerterror(data.msg);
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
	});

	$('#btnSaveFamilyStatus').on('click', function () {
    	var valid = false;
    	var sParam = $('#form-input-status').serialize()+ "&recnumid="+ $("#recnumid").val();
    	var validator = $('#form-input-status').validate({
							rules: {
									dateRangeStart_stat: {
							  			required: true
									},
									fa_prorate: {
							  			required: true
									},
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'PersonalAdministration/SaveStatus';
	 		$.get(link,sParam, function(data){
				if(data.error==false){		
                    generateDataModalEdit($("#empid").val());							
					alertok('Berhasil disimpan..');
				}else{	
					$("#lblMessage").remove();
                    alerterror(data.msg);
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
	});
	$('#btnSaveFamilyMarital').on('click', function () {
    	var valid = false;
    	var sParam = $('#form-input-marital').serialize()+ "&recnumid="+ $("#recnumid").val();
    	var validator = $('#form-input-marital').validate({
							rules: {
									dateRangeStart_marital: {
							  			required: true
									}
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'PersonalAdministration/SaveMarital';
	 		$.get(link,sParam, function(data){
				if(data.error==false){		
                    generateDataModalEdit($("#empid").val());							
					alertok('Berhasil disimpan..');
				}else{	
					$("#lblMessage").remove();
                    alerterror(data.msg);
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
	});

	$('#btnSaveTax').on('click', function () {
    	var valid = false;
    	var sParam = $('#form-input-tax').serialize()+ "&recnumid="+ $("#recnumid").val();
    	var validator = $('#form-input-tax').validate({
							rules: {
									dateRangeStart_tax: {
							  			required: true
									}
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		var link = 'PersonalAdministration/SaveTax';
	 		$.get(link,sParam, function(data){
				if(data.error==false){									
					generateDataModalEdit($("#empid").val());                          
                    alertok('Berhasil disimpan..');
				}else{	
					$("#lblMessage").remove();
                    alerterror(data.msg);
					$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
											  					  	
				}
			},'json');
	 	}
	});

    $('#btnSaveEducation').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-education').serialize()+ "&recnumid="+ $("#recnumid").val();
        var validator = $('#form-input-education').validate({
                            rules: {
                                    edu_school: {
                                        required: true
                                    }
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveEdu';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEdit($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    alerterror(data.msg);
                    $("#lblMessage").remove();
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

    $('#btnSaveTraining').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-training').serialize()+ "&recnumid="+ $("#recnumid").val();
        var validator = $('#form-input-training').validate({
                            rules: {
                                    tra_certificate: {
                                        required: true
                                    }
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveTraining';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEdit($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg);
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

    $('#btnSaveReward').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-reward').serialize()+ "&recnumid="+ $("#recnumid").val();
        var validator = $('#form-input-reward').validate({
                            rules: {
                                    reward_desc: {
                                        required: true
                                    },
                                    allowance: {
                                        required: true
                                    }
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveReward';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{ 
                    alerterror(data.msg); 
                    $("#lblMessage").remove();
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

    $('#btnSavePunish').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-punish').serialize()+ "&recnumid="+ $("#recnumid").val();
        var validator = $('#form-input-punish').validate({
                            rules: {
                                    deduction: {
                                        required: true
                                    }
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SavePunish';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg); 
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });
    $('#btnSaveInventaris').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-inventaris').serialize()+ "&recnumid="+ $("#recnumid").val();

        $.validator.addMethod("valueNotEquals", 
            function(value, element, arg){
                              return arg !== value;
        }, "Value must not equal arg.");

        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
        var validator = $('#form-input-inventaris').validate({
                            rules: {
                                    qty: {
                                        required: true
                                    },
                                    item: {
                                        valueNotEquals: "0"
                                    },
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveInventaris';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg); 
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });
    $('#btnSaveGrade').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-grade').serialize()+ "&recnumid="+ $("#recnumid").val();

        $.validator.addMethod("valueNotEquals", 
            function(value, element, arg){
                              return arg !== value;
        }, "Value must not equal arg.");

        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
        var validator = $('#form-input-grade').validate({
                            rules: {
                                    grade_class: {
                                        valueNotEquals: "0"
                                    },
                                    dateRangeStart_grade: {
                                        required: true
                                    },
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveGrade';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg); 
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });
    $('#btnSaveStatus').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-emp-status').serialize()+ "&recnumid="+ $("#recnumid").val();

        $.validator.addMethod("valueNotEquals", 
            function(value, element, arg){
                              return arg !== value;
        }, "Value must not equal arg.");

        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
        var validator = $('#form-input-emp-status').validate({
                            rules: {
                                    work_status: {
                                        valueNotEquals: "0"
                                    },
                                    dateRangeStart_status: {
                                        required: true
                                    },
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveWorkingStatus';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg); 
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });
    $('#btnSaveOrg').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-emp-org').serialize()+ "&recnumid="+ $("#recnumid").val() +"&empid=" + $("#empid").val() ;

        $.validator.addMethod("valueNotEquals", 
            function(value, element, arg){
                              return arg !== value;
        }, "Value must not equal arg.");

        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
        var validator = $('#form-input-emp-org').validate({
                            rules: {
                                    tipemove: {
                                        valueNotEquals: "0"
                                    },
                                    orgz: {
                                        valueNotEquals: "0"
                                    },
                                    structural: {
                                        valueNotEquals: "0"
                                    },
                                    fungsional: {
                                        valueNotEquals: "0"
                                    },
                                    location: {
                                        valueNotEquals: "0"
                                    },
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveEmpOrg';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg); 
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });
    $('#btnSaveSalary').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-salary').serialize()+ "&recnumid="+ $("#recnumid").val();

        $.validator.addMethod("valueNotEquals", 
            function(value, element, arg){
                              return arg !== value;
        }, "Value must not equal arg.");

        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
        var validator = $('#form-input-salary').validate({
                            rules: {
                                    component: {
                                        valueNotEquals: "0"
                                    },
                                    dateRangeStart_salary: {
                                        required: true
                                    },
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveSalary';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg); 
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

    $('#btnSaveExperience').on('click', function () {
        var valid = false;
        var sParam = $('#form-input-salary').serialize()+ "&recnumid="+ $("#recnumid").val();

        $.validator.addMethod("valueNotEquals", 
            function(value, element, arg){
                              return arg !== value;
        }, "Value must not equal arg.");

        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
        var validator = $('#form-input-salary').validate({
                            rules: {
                                    component: {
                                        valueNotEquals: "0"
                                    },
                                    dateRangeStart_salary: {
                                        required: true
                                    },
                                }
                            });
        validator.valid();
        $status = validator.form();
        if($status) {
            var link = 'PersonalAdministration/SaveSalary';
            $.get(link,sParam, function(data){
                if(data.error==false){                                  
                    generateDataModalEmployee($("#empid").val());                          
                    alertok('Berhasil disimpan..');
                }else{  
                    $("#lblMessage").remove();
                    alerterror(data.msg); 
                    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                    
                }
            },'json');
        }
    });

	$('#modal-personal').on('show', function() {
	  	$('#modal-personal').css('opacity', .5);
	  	$('#modal-personal').unbind();
	});
	$('#modal-personal').on('hidden', function() {
	  	$('#modal-personal').css('opacity', 1);
	  	$('#modal-personal').removeData("modal").modal({});
	});
	$('#prov').on('change', function() {
	  	setprov('prov','city');
	});
	$('#city').on('change', function() {
		setcity('city','state','0');
	});
	$('#state').on('change', function() {
		setstate('state', 'kel','0');
	  	
	});
	$('#cprov').on('change', function() {
		setprov('cprov','ccity');
	  	
	});
	$('#ccity').on('change', function() {
	  	setcity('ccity','cstate','0');
	});
	$('#cstate').on('change', function() {
	  	setstate('cstate', 'ckel','0');
	});

	function setprov(prov,city){
		$.get('PersonalAdministration/getCity', { id: $('#'+prov).val() }, function(data){  
	    		$('#'+city).empty();
	    		$('#'+city).append('<option value="0">- Choose -</option>');
	    		$.each(data,function(i,value){
                	$('#'+city).append('<option value='+value.Recnum+'>'+value.IsDesc+'</option>');
            	})
            	$('#'+city).val(0).trigger('chosen:updated');			
	    });
	}
	function setcity(kota,state,val){
		$.get('PersonalAdministration/getState', { id: $('#'+kota).val() }, function(data){  
	    		$('#'+state).empty();
	    		$('#'+state).append('<option value="0">- Choose -</option>');
	    		$.each(data,function(i,value){
                	$('#'+state).append('<option value='+value.Recnum+'>'+value.IsDesc+'</option>');
            	})
            	$('#'+state).val(val).trigger('chosen:updated');			
	    });
	}
	function setstate(state,kel,val){
		$.get('PersonalAdministration/getKel', { id: $('#'+state).val() }, function(data){  
	    		$('#'+kel).empty();
	    		$('#'+kel).append('<option value="0">- Choose -</option>');
	    		$.each(data,function(i,value){
                	$('#'+kel).append('<option value='+value.Recnum+'>'+value.IsDesc+'</option>');
            	})
            	$('#'+kel).val(val).trigger('chosen:updated');			
	    });
	}
    $('.btn-filter').on('click', function (event) {
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
    $('#btnFind').on('click', function (event) {
        showloader('#ModalFind');
        var checked_courses = $('#iframe').contents().find('input[name="selected_courses[]"]:checked').length;
        if (checked_courses != 0) {
            CheckedTrue();
            
        } else {
            alert("Silahkan pilih terlebih dahulu");
        }
        hideloader();
    });
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
        var action = $("#rAction input[type='radio']:checked").val();
        myTabel .ajax.url("datatabel?advance=" + str).load();  
    }
</script>