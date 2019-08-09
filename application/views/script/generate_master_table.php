<!-- inline scripts related to this page -->
<script type="text/javascript">

	$('#jenis').on('change', function() {
	  	$('#jstree').jstree(true).settings.core.data.url = 'getTableTree';
		$('#jstree').jstree(true).refresh();
	});
	function gridview(val,tabel_name){

		$.ajax({
            url: 'GenerateTable/viewColumn?id='+val,
            dataType: 'json',
            success: function(msg) { 
             	var ColModel1 = [];
             	var ColNames1 = [];
             	var strName, strValue ;
             	var tabel = '';
             	//Get Index Name
             	for(strName in msg)
				{
				   tabel = strName;
				}

             	ColNames1.push('Action');
             	ColModel1.push({
             		name:'myac',
             		index:'', 
             		width:80, 
             		fixed:true, 
             		sortable:false, 
             		resize:false,
					formatter:'actions', 
					formatoptions:{ 
						keys:true,
						delbutton: true,
						editbutton:true,
						addbutton:true,
						editformbutton: true,
						delOptions: {
						    url: 'GenerateTable/crud',
						    mtype: 'GET',
						    reloadAfterSubmit: true,
						    ajaxDelOptions: {
						        contentType: "application/json"
						    },
						    onclickSubmit: function (eparams) {
                                 alert(eparams);
                             },
						    serializeDelData: function(postdata) {
						        return JSON.stringify(postdata);
						    }
						},
						editOptions: {
						    editurl: 'GenerateTable/crud',
						    reloadAfterSubmit: false,
						    closeAfterEdit: true,
						    keys: true,
						    ajaxEditOptions: {
						        contentType: "application/json"
						    },
						    afterSave:function (rowid) {
                              alert(rowid); 

                            },
                            serializeEditData: function(postdata) {
						        return JSON.stringify(postdata);
						    }
						}
					}
				});
             	for (j=0; j<msg[tabel].length; j++) {
					ColNames1.push(msg[tabel][j]['COLUMN_NAME']);

					var arr = {
				    		'name' : msg[tabel][j]['COLUMN_NAME'],
				    		'index': msg[tabel][j]['COLUMN_NAME'], 
				    	};
			    	if(msg[tabel][j]['COLUMN_NAME'] == 'IsDesc' || msg[tabel][j]['COLUMN_NAME'] == 'IsName'){
				    	arr['editable'] = true;
				    	arr['width'] = 200;
			    	}else if(msg[tabel][j]['COLUMN_NAME'] == 'Recnum'){
			    		arr['hidden'] = true;
			    		arr['editable'] = false;
			    	}else if(msg[tabel][j]['COLUMN_NAME'] == 'CreateBy' || msg[tabel][j]['COLUMN_NAME'] == 'CreateDate' || msg[tabel][j]['COLUMN_NAME'] == 'EditBy' || msg[tabel][j]['COLUMN_NAME'] == 'EditDate'){
			    		arr['editable'] = false;
			    	}else{
			    		arr['editable'] = true;
			    		arr['editrules'] = { required : true };
			    	}
			    	ColModel1.push(arr);
				}
				$("#grid-table").jqGrid('clearGridData');
				bindingdata(ColNames1,ColModel1,tabel,tabel_name);
				$("#grid-table").jqGrid('setGridParam',{
					datatype:'json',
					editurl: 'clientArray',
					url: 'GenerateTable/viewTable?tabel='+ tabel }).trigger('reloadGrid');
            }
        });
	}
	function bindingdata(colName,colMod, tabel, tabel_name){
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
			url:'GenerateTable/viewTable?tabel='+tabel,
            editurl: 'clientArray',
            datatype: "json",
			height: 400,
			colNames: colName,
			colModel: colMod, 
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
			//,autowidth: true,
	
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
				height: 'auto',
                width: 620,
                editCaption: "The Edit Dialog",
                recreateForm: true,
                closeAfterEdit: true,
                reloadAfterSubmit: true,
				beforeShowForm : function(e) {
					//var form = $(e[0]);
					//form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					//style_edit_form(form);
				},
                errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                onclickSubmit: function (response, postdata) {
                	alert('Edit');
					// EditPost(postdata);
					// $("#jqGrid").jqGrid('setGridParam',{datatype:'json',url: '/ajax_data/rincian_coa?id='+ $("#kd_coa").val()}).trigger('reloadGrid');			      
				}
			},
			{
				height: 'auto',
                width: 620,
                closeAfterAdd: true,
                recreateForm: true,
                savekey: [true, 13], 
                reloadAfterSubmit: true,
				beforeShowForm : function(e) {
					var form = $(e[0]);
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar')
					.wrapInner('<div class="widget-header" />')
					//style_edit_form(form);
				},
				errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                onclickSubmit: function (response, postdata) {
                	alert('add');
					// AddPost(postdata);
					// $("#jqGrid").jqGrid('setGridParam',{datatype:'json',url: '/ajax_data/rincian_coa?id='+ $("#kd_coa").val()}).trigger('reloadGrid');			      
				}
			},
			{
				errorTextFormat: function (data) {
                    return 'Error: ' + data.responseText
                },
                onclickSubmit: function (response, postdata) {
                	alert('Delete');
					DeletePost(postdata);
					// $("#jqGrid").jqGrid('setGridParam',{datatype:'json',url: '/ajax_data/rincian_coa?id='+ $("#kd_coa").val()}).trigger('reloadGrid');			      
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
</script>

<script type="text/javascript">
								 		
	$('#jstree').jstree({		
		'core' : {	
			'check_callback': true,		
			'data':
				{
			    'url':'getTableTree',
			    'dataType':'json'
			 	}

		},	
		"search" : {  
                 "case_insensitive" : true,  
                 "show_only_matches" : true
             },		
        'contextmenu' : {
				        'items' : customMenu
				   },		
		"types" : {		    
		    "root" : {
		      "icon" : "/static/3.3.4/assets/images/tree_icon.png",
		      "valid_children" : ["default"]
		    },
		    "default" : {
		      "valid_children" : ["default"]
		    },
		    "file" : {
		      "icon" : "glyphicon glyphicon-file",
		      "valid_children" : []
		    }
	  	},	
	  	"plugins" : [
	    	"contextmenu","themes", "xml_data", "ui","types", "search"
	  		]
	});		

	$('#search_field').keyup(function(){
	    //$('#'+js).jstree(true).show_all();
	    $('#jstree').jstree('search', $(this).val());
	});

    $('#jstree').on("changed.jstree", function (e, data) {		
    	$.jgrid.gridUnload("#grid-table")		    	
   		gridview(data.selected, data.node.text);	      
    });   
    $('#jstree').on('ready.jstree', function() {   
	     $("#jstree").jstree("open_node",0);  
	});			 						 			
	//gridview(23);
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true
	})

	function customMenu(node)
	{
	    var items = {
	        'item1' : {
	            'label' : 'Create',
	            'action' : function () { 	     
					var html = $(".grab").clone();
					
		 			bootboxmodal('Input Position', renameCloneIdsAndNames(html,'Add'));
		 			
					$("#parentTextAdd").attr('value',node.text);
					$("#parentTextAdd").val(node.text);
					$("#SortAdd").val(1);
					$("#EmpReqAdd").val(0);
					$("#jenisAdd").val($("#jenis").val()).change();
					$("<span id='Recnum' data-id=''></span").appendTo(".modal-footer");

		 			$('.date-picker').datepicker({
						autoclose: true,
						todayHighlight: true
					});
					$('.dec').priceFormat({
				        prefix: '',
				        centsSeparator: '.',
				        centsLimit: 0,
				        thousandsSeparator: ','
				    });

				    $.get('Position/getParent', { jenis: $("#jenis").val(),sub: $('#include-sub').prop('checked') }, function(data){  
				    		
				    		$("#parentIDAdd").empty();
				    		$.each(data,function(i,value){
			                	$("#parentIDAdd").append('<option value='+value.Recnum+'>'+value.PositionName+'- '+value.PositionId+'</option>');
			            	})
				    		$("#parentIDAdd").val(node.id);
							$("#parentIDAdd").attr('value',node.id);
				    });
	             }
	        },
	        'item2' : {
	            'label' : 'Edit',
	            'action' : function () { 	  	     
		 			var html = $(".grab").clone();
					
		 			bootboxmodal('Edit Position', renameCloneIdsAndNames(html,'Edit'));
		 			$.get('Position/EditOrg', { id: node.id }, function(data){  			 				
			 			$("#parentIDEdit").val(data["data"][0]["ParentId"]);
						$("#parentIDEdit").attr('value',data["data"][0]["ParentId"]);

						$("#codeEdit").val(data["data"][0]["PositionId"]);
						$("#codeEdit").attr('value',data["data"][0]["PositionId"]);
						$("#OrgNameEdit").val(data["data"][0]["PositionName"]);
						$("#OrgNameEdit").attr('value',data["data"][0]["OrgName"]);
						$("#SortEdit").val(data["data"][0]["Sort"]);
						$("#SortEdit").attr('value',data["data"][0]["Sort"]);
						$("#EmpReqEdit").attr('value',data["data"][0]["TotalManPowerPlan"]);
					
						$("#jenisEdit").val(data["data"][0]["Positiontype"]).change();
						$("#dateRangeStartEdit").attr('value',data["data"][0]["fStartDate"]);
						$("#dateRangeEndEdit").attr('value',data["data"][0]["fEndDate"]);

						var checked = data["data"][0]["IsActive"] == 1 ? true: false;

						if(checked){
							$("#isActiveEdit").attr('checked','checked');
						}else{
							$("#isActiveEdit").removeAttr('checked');
						}
						$("<span id='Recnum' data-id='"+node.id+"'></span").appendTo(".modal-footer");
			        });
		 			
					// $("#SortAdd").val(1);
					// $("#EmpReqAdd").val(0);

		 			$('.date-picker').datepicker({
						autoclose: true,
						todayHighlight: true
					});
					$('.dec').priceFormat({
				        prefix: '',
				        centsSeparator: '.',
				        centsLimit: 0,
				        thousandsSeparator: ','
				    });
		            	            	
	             }
	        },
	        'item3' : {
	            'label' : 'Delete',
	            'action' : function () { 
	            	var r = confirm("Yakin dihapus?");
					if (r == true) {
						var id= node.id; 
					    $.get('Position/DelOrg', { id:id }, function(data){  			 				
			 				$('#jstree').jstree(true).settings.core.data.url = 'getPositionTree?sub='+ $('#include-sub').prop('checked')+'&jenis='+ $("#jenis").val();
							$('#jstree').jstree(true).refresh();
			            });
					} 
	             }
	        }
	    }

	    return items;
	}

	function bootboxmodal(title, html){
		var dialog = bootbox.dialog({
			title: title,
			message: html,
			buttons: {
			    cancel: {
			        label: "Cancel",
			        callback: function(){
			            //Example.show('Custom cancel clicked');
			        }
			    },
			    noclose: {
			        label: "Submit",
			        callback: function(e){
			        	if($("#Recnum").attr("data-id")==''){
			        		var validator = $('#FormAdd').validate({
							rules: {
								  	codeAdd: {
							  			required: true
									},
									OrgNameAdd: {
							  			required: true
									},
									SortAdd: {
							  			required: true
									},
									dateRangeStartAdd: {
							  			required: true
									}          
								}
							});
						 	validator.valid();
						 	$status = validator.form();
						 	if($status) {	
						 		$('#jenisAdd').removeAttr('disabled');
					        	var sParam = $('#FormAdd').serialize();
					        	$('#jenisAdd').attr('disabled', 'disabled');
					        	$.get('Position/SaveOrg',sParam, function(data){
									if(data.error==false){				
										$('#jstree').jstree(true).settings.core.data.url = 'getPositionTree?sub='+ $('#include-sub').prop('checked')+'&jenis='+ $("#jenis").val();
										$('#jstree').jstree(true).refresh();
										
										dialog.modal('hide');
									}else{	
										$("#lblMessage").remove();
										$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
																  					  	
									}
								  },'json');
					           	return false;
				           	}else{
				           		return false;
				           	}
			        	}else{
			        		var validator = $('#FormEdit').validate({
							rules: {
								  	codeEdit: {
							  			required: true
									},
									OrgNameEdit: {
							  			required: true
									},
									SortEdit: {
							  			required: true
									},
									dateRangeStartAdd: {
							  			required: true
									}          
								}
							});
						 	validator.valid();
						 	$status = validator.form();
						 	if($status) {	
					        	var sParam = $('#FormEdit').serialize()+ "&Recnum="+ $("#Recnum").attr("data-id");
					        	$.get('Position/UpdateOrg',sParam, function(data){
									if(data.error==false){				
										$('#jstree').jstree(true).settings.core.data.url = 'getPositionTree?sub='+ $('#include-sub').prop('checked')+'&jenis='+ $("#jenis").val();
										$('#jstree').jstree(true).refresh();
										
										dialog.modal('hide');
									}else{	
										$("#lblMessage").remove();
										$("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
																  					  	
									}
								  },'json');
					           	return false;
				           	}else{
				           		return false;
				           	}
			        	}
			        	
			        }
			    }
			}
		});
	}
	function renameCloneIdsAndNames( objClone, ref ) {
		$(objClone).attr('id',$(objClone).attr('id')+ ref);
		objClone.find( '[id]' ).each( function() {
	        var strNewId = $(this).attr('id')+ ref;
	        var strNewName  = $( this ).attr( 'name' )+ ref;
	        var strNewDate  = $( this ).attr( 'name' )+ ref;
	        if($(this).attr('id') != "csrf_token"){
	        	$( this ).attr( 'id', strNewId );
	        	$( this ).attr( 'name', strNewName );
	        }
	    });
	    objClone.find('.input-daterange').each( function() {
	    	
	    	$(this).removeClass('input-daterange');
	    	$( this ).addClass('input-daterange'+ ref);

	    });
	    
	    return objClone;
	}


</script>