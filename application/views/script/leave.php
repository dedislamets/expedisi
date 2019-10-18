<!-- inline scripts related to this page -->
<script type="text/javascript">

	var grid_selector_left = "#grid-table-left";
	var pager_selector_left = "#grid-pager-left";
	
	
	var parent_column = $(grid_selector_left).closest('[class*="col-"]');
	//resize to fit page size
	$(window).on('resize.jqGrid', function () {
		$(grid_selector_left).jqGrid( 'setGridWidth', parent_column.width() );
    })
	
	//resize on sidebar collapse/expand
	$(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
		if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
			//setTimeout is for webkit only to give time for DOM changes and then redraw!!!
			setTimeout(function() {
				$(grid_selector_left).jqGrid( 'setGridWidth', parent_column.width() );
			}, 20);
		}
    })
	function gridview_left(val){
		$(grid_selector_left).jqGrid('clearGridData');

		$(grid_selector_left).jqGrid('setGridParam',{
			datatype:'json',
			editurl: 'clientArray',
			url: 'Leave/listLeave?id='+ val }
		).trigger('reloadGrid');
	}

	jQuery(grid_selector_left).jqGrid({
			url: 'Leave/listLeave?id=0',
	        editurl: 'clientArray',
	        datatype: "json",
			height: 250,
			colNames:['Actions','Recnum','Periode','Saldo'],
			colModel:[
				{name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,
					formatter:'actions', 
					formatoptions:{ 
						keys:true,
						delbutton: true,
						editformbutton: true,
					}
				},
				// {name:'StartDate',index:'StartDate', width:60,  editable: true,
				// 	formatter:'date', 
				// 	formatoptions:{ 
				// 		srcformat:'d/m/Y', 
				// 		newformat: 'd/m/Y'
				// 	}
				// },
				{name:'Recnum',index:'Recnum',width:100, editable:false, hidden: true},
				{name:'Periode',index:'Periode',width:350, editable:true,},
				{name:'EndingBalance',index:'EndingBalance',width:100, editable:true,},
				
			], 
			loadonce: true,
			viewrecords : true,
			rowNum:10,
			rowList:[10,20,30],
			pager : pager_selector_left,
			rownumbers: false,
			gridview: true,
	        //multiboxonly: true,
			loadComplete : function() {
				var table = this;
				setTimeout(function(){
					//styleCheckbox(table);
							
					//updateActionIcons(table);
					//updatePagerIcons(table);
					//enableTooltips(table);
				}, 0);
			},

			//editurl: "./dummy.php",//nothing is saved
			caption: ""
		});
		$(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size
		//navButtons
		jQuery(grid_selector_left).jqGrid('navGrid',pager_selector_left,
			{ 	//navbar options
				edit: false,
				editicon : 'ace-icon fa fa-pencil blue',
				add: true,
				addicon : 'ace-icon fa fa-plus-circle purple',
				del: false,
				delicon : 'ace-icon fa fa-trash-o red',
				search: true,
				searchicon : 'ace-icon fa fa-search orange',
				refresh: true,
				refreshicon : 'ace-icon fa fa-refresh green',
				view: true,
				viewicon : 'ace-icon fa fa-search-plus grey',
			},
			{
				//edit record form
				//closeAfterEdit: true,
				//width: 700,
				recreateForm: true,
				beforeShowForm : function(e) {
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_edit_form(form);
				}
			},
			{
				//new record form
				//width: 700,
				closeAfterAdd: true,
				recreateForm: true,
				viewPagerButtons: false,
				beforeShowForm : function(e) {
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
					.wrapInner('<div class="widget-header" />')
					style_edit_form(form);
				}
			},
			{
				//delete record form
				recreateForm: true,
				beforeShowForm : function(e) {
					var form = $(e[0]);
					if(form.data('styled')) return false;
					
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_delete_form(form);
					
					form.data('styled', true);
				},
				onClick : function(e) {
					//alert(1);
				}
			},
			{
				//search form
				recreateForm: true,
				afterShowSearch: function(e){
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
					style_search_form(form);
				},
				afterRedraw: function(){
					style_search_filters($(this));
				}
				,
				multipleSearch: true,
				/**
				multipleGroup:true,
				showQuery: true
				*/
			},
			{
				//view record form
				recreateForm: true,
				beforeShowForm: function(e){
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
				}
			}
		)
	function gridview(val){

		$.ajax({
            url: 'Leave/ListEmp?id='+val,
            dataType: 'json',
            success: function(msg) { 
             	
				$("#grid-table").jqGrid('clearGridData');
				bindingdata("List Emp Leave", val);
				$("#grid-table").jqGrid('setGridParam',{
					datatype:'json',
					editurl: 'clientArray',
					url: 'Leave/ListEmp?id='+ val }
				).trigger('reloadGrid');
            }
        });
	}
	function bindingdata(tabel_name, val){
		var grid_selector = "#grid-table";
		var pager_selector = "#grid-pager";
		
		
		var parent_column = $(grid_selector).closest('[class*="col-"]');
		//resize to fit page size
		$(window).on('resize.jqGrid', function () {
			$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
	    })
		
		//resize on sidebar collapse/expand
		$(document).on('settings.ace.jqGrid' , function(ev, event_name, collapsed) {
			if( event_name === 'sidebar_collapsed' || event_name === 'main_container_fixed' ) {
				//setTimeout is for webkit only to give time for DOM changes and then redraw!!!
				setTimeout(function() {
					$(grid_selector).jqGrid( 'setGridWidth', parent_column.width() );
				}, 20);
			}
	    })
		jQuery(grid_selector).jqGrid({
			url:'Leave/ListEmp?id='+val,
            editurl: 'clientArray',
            datatype: "json",
			height: 400,
			colNames: ['Actions','Emp.ID','Name', 'Absen Type', 'Date'],
			colModel: [
				{name:'myac',index:'', width:80, fixed:true, sortable:false, resize:false,
					formatter:'actions', 
					formatoptions:{ 
						keys:true,
						delbutton: true,
						editformbutton: true,
					}
				},
				{name:'EmployeeId',index:'EmployeeId',width:80, editable:true,},
				{name:'EmployeeName',index:'EmployeeName',width:300, editable:true,},
				{name:'AbsenType',index:'AbsenType',width:350, editable:true,},
				{name:'DateIn',index:'DateIn', width:120,  editable: true,
					formatter:'date', 
					formatoptions:{ 
						srcformat:'d/m/Y', 
						newformat: 'd/m/Y'
					}
				},
			], 
			//loadonce: true,
			viewrecords : true,
			cellsubmit: 'clientArray',
			rowNum:10,
			rowList:[10,20,30],
			pager : pager_selector,
			rownumbers: true,
			gridview: true,
			multiselect:false,
			//editurl: "./dummy.php",//nothing is saved
			caption: tabel_name

	
		});
		$(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size
		//navButtons
		jQuery(grid_selector).jqGrid('navGrid',pager_selector,
			{ 	//navbar options
				edit: false,
				editicon : 'ace-icon fa fa-pencil blue',
				add: true,
				addicon : 'ace-icon fa fa-plus-circle purple',
				del: false,
				delicon : 'ace-icon fa fa-trash-o red',
				search: true,
				searchicon : 'ace-icon fa fa-search orange',
				refresh: true,
				refreshicon : 'ace-icon fa fa-refresh green',
				view: true,
				viewicon : 'ace-icon fa fa-search-plus grey',
			},
			{
				refreshtext: 'Reload',
		     	closeAfterEdit: true
			},
			{
				height: 'auto',
                width: 620,
                closeAfterAdd: true,
                recreateForm: true,
                savekey: [true, 13], 
                reloadAfterSubmit: true,
			    beforeShowForm : function(e) {
					$('<tr class="FormData" style="display:none"><td class="CaptionTD">Tabel</td><td class="DataTD"><input type="text" id="tabel" name="tabel" class="FormElement form-control" ></td></tr>')
			        .appendTo("#TblGrid_grid-table>tbody");
			        $("#tabel").val(tabel);
			        $("#tr_Recnum").css('display','none');
				},
				errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                onclickSubmit: function (response, postdata) {
					AddPost(postdata);
					// $("#jqGrid").jqGrid('setGridParam',{datatype:'json',url: '/ajax_data/rincian_coa?id='+ $("#kd_coa").val()}).trigger('reloadGrid');			      
				}
			},
			{
				
			},
			{
				//search form
				recreateForm: true,
				afterShowSearch: function(e){
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
					style_search_form(form);
				},
				afterRedraw: function(){
					style_search_filters($(this));
				}
				,
				multipleSearch: true,
				/**
				multipleGroup:true,
				showQuery: true
				*/
			},
			{
				//view record form
				recreateForm: true,
				beforeShowForm: function(e){
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-title').wrap('<div class="widget-header" />')
				}
			}
		);
		
		$(document).one('ajaxloadstart.page', function(e) {
			$.jgrid.gridDestroy(grid_selector);
			$('.ui-jqdialog').remove();
		});
	}

	function DeletePost(params) {				
		alert(params);
		// $.get('/ajax_data/delete_coa_rincian',{id:params}, function(data){				
		// 	if(data.error==false){				
		// 		swal("Data telah dihapus!", "", "success");	
		// 		$('#jqGrid').trigger('reloadGrid');								  		
		// 	}else{	
		// 		alertpop("Maaf, data gagal dihapus!!");						  					  	
		// 	}
		//   },'json');
	}
	function EditPost(params) {				
		$.post('GenerateTable/crud',params, function(data){
			if(data.error==false){		
				$("#cData").trigger('click');
				$("#grid-table").trigger('reloadGrid');		
			}else{
				alert(data.msg);
			}					
		},'json');	
	}
	function AddPost(params) {				
		$.post('GenerateTable/crud',params, function(data){
			if(data.error==false){		
				$("#cData").trigger('click');
				$("#grid-table").trigger('reloadGrid');		
			}else{
				alert(data.msg);
			}					
		},'json');	
	}

	function addRow() {
		var nomor = $('.baris').length;
		if( nomor>0 ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		var html = $(".cl").clone();
		renameCloneIdsAndNames(html, nomor,'add');
		$('.baris').last().after(html);
	}
	function delRow(val) {
		$(val).parent().parent().parent().remove();
	}

	$('#submit_button').on('click', function (e) {

        var valid = false;
        var sParam = $('#form1').serialize() + "&count=" + $('.baris').length;
        $.post('GenerateTable/alter',sParam, function(data){
          
        }).done(function() {
		    alert("Create Table Success" );
		    window.location.reload();
		})
		.fail(function(error) {
			$("#lblMessage").remove();
		    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+error.responseText+"!</strong></div>").appendTo(".modal-footer");
		});
		return false;
    });
	jQuery(grid_selector_left).click(function(e) {

		var el = e.target;
		var recnum = $(el).parent().children().first().next().text();
		gridview(recnum);
	});

	$('#emp').on('change', function() {
	  	gridview_left($("#emp").val());	
	});

</script>

<script type="text/javascript">
								 		
	//gridview_left(0);						 			
	gridview(1);
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})


	function renameCloneIdsAndNames( objClone, ref, data=[], status ) {		
		$(objClone).removeClass('cl');
		var x = 1;
		objClone.find( '[id]' ).each( function() {

	        var strNewId = $(this).attr('id')+ ref;
	        var strNewName  = $( this ).attr( 'name' )+ ref;
	        if($(this).attr('id') != "csrf_token"){
	        	$( this ).attr( 'id', strNewId );
	        	$( this ).attr( 'name', strNewName );
	        	if(status=="add"){
		        	if($( this ).context.tagName == "SELECT"){
						$( this ).val('varchar');
		        	}else{
		        		$( this ).val('');
		        	}
	        	}else{
	        		switch(x) {
					  	case 3:
						    $( this ).val(data['DATA_TYPE']);
						    break;
						case 4:
						    $( this ).val(data['CHARACTER_MAXIMUM_LENGTH']);
						    break;
						case 5:
						  	if(data['IS_NULLABLE'] == 'YES'){
						  		$(this).attr('checked','checked');
						  	}else{
						  		$(this).removeAttr('checked');
						  	}
						    break;
						case 6:
						  	if(data['PRIMARYKEYCOLUMN'] != ""){
						  		$(this).attr('checked','checked');
						  	}else{
						  		$(this).removeAttr('checked');
						  	}
						    break;
						case 7:
						  	$( this ).val('');
						    break;
					  	default:
					    	$( this ).val(data['COLUMN_NAME']);
					}
		        }
	        }
	        if($(this).hasClass('label-name'))
	        	$( this ).text('Field '+ref );
	        x++;
	    });
	    
	    return objClone;
	}


</script>