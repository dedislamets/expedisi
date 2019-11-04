<!-- inline scripts related to this page -->
<script type="text/javascript">
	function chosen(){
		$('.chosen-select').chosen({allow_single_deselect:true}); 
		//resize the chosen on window resize

		$(window)
		.off('resize.chosen')
		.on('resize.chosen', function() {
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
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
	$('#include-sub').on('click', function () {
	    $('#jstree').jstree(true).settings.core.data.url = 'getLocationTree?sub='+ $('#include-sub').prop('checked');
		$('#jstree').jstree(true).refresh();
	});
	function gridview(val){
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
			url:'getLocationEmployeeOrg?id='+val+'&sub='+ $('#include-sub').prop('checked'),
            editurl: 'clientArray',
            datatype: "json",
			height: 250,
			colNames:['Emp.ID','Name','Section','Position','Status'],
			colModel:[
				
				{name:'EmployeeId',index:'EmployeeId', width:60,  editable: true},
				{name:'EmployeeName',index:'EmployeeName',width:150, editable:true,},
				{name:'Section',index:'Section', width:90,editable: true,editoptions:{size:"20",maxlength:"30"}},
				{name:'Position',index:'Position', width:90,editable: true,editoptions:{size:"20",maxlength:"30"}},
				{name:'Status',index:'Status', width:90,editable: true,editoptions:{size:"20",maxlength:"30"}},
			], 
			loadonce: true,
			viewrecords : true,
			rowNum:10,
			rowList:[10,20,30],
			pager : pager_selector,
			rownumbers: true,
			gridview: true,
	        //multiboxonly: true,
			loadComplete : function() {
				var table = this;
				setTimeout(function(){
					styleCheckbox(table);
							
					updateActionIcons(table);
					updatePagerIcons(table);
					enableTooltips(table);
				}, 0);
			},
	
			//editurl: "./dummy.php",//nothing is saved
			caption: "Location Member"
			//,autowidth: true,
	
		});
		$(window).triggerHandler('resize.jqGrid');//trigger window resize to make the grid get the correct size
		//navButtons
		jQuery(grid_selector).jqGrid('navGrid',pager_selector,
			{ 	//navbar options
				edit: false,
				editicon : 'ace-icon fa fa-pencil blue',
				add: false,
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

		function style_search_filters(form) {
			form.find('.delete-rule').val('X');
			form.find('.add-rule').addClass('btn btn-xs btn-primary');
			form.find('.add-group').addClass('btn btn-xs btn-success');
			form.find('.delete-group').addClass('btn btn-xs btn-danger');
		}
		function style_search_form(form) {
			var dialog = form.closest('.ui-jqdialog');
			var buttons = dialog.find('.EditTable')
			buttons.find('.EditButton a[id*="_reset"]').addClass('btn btn-sm btn-info').find('.ui-icon').attr('class', 'ace-icon fa fa-retweet');
			buttons.find('.EditButton a[id*="_query"]').addClass('btn btn-sm btn-inverse').find('.ui-icon').attr('class', 'ace-icon fa fa-comment-o');
			buttons.find('.EditButton a[id*="_search"]').addClass('btn btn-sm btn-purple').find('.ui-icon').attr('class', 'ace-icon fa fa-search');
		}
		function beforeDeleteCallback(e) {
					var form = $(e[0]);
					if(form.data('styled')) return false;
					
					form.closest('.ui-jqdialog').find('.ui-jqdialog-titlebar').wrapInner('<div class="widget-header" />')
					style_delete_form(form);
					
					form.data('styled', true);
				}
		function updatePagerIcons(table) {
			var replacement = 
			{
				'ui-icon-seek-first' : 'ace-icon fa fa-angle-double-left bigger-140',
				'ui-icon-seek-prev' : 'ace-icon fa fa-angle-left bigger-140',
				'ui-icon-seek-next' : 'ace-icon fa fa-angle-right bigger-140',
				'ui-icon-seek-end' : 'ace-icon fa fa-angle-double-right bigger-140'
			};
			$('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function(){

				var icon = $(this);
				var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
				
				if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
			})
		}
		function styleCheckbox(table) {
		/**
			$(table).find('input:checkbox').addClass('ace')
			.wrap('<label />')
			.after('<span class="lbl align-top" />')
	
	
			$('.ui-jqgrid-labels th[id*="_cb"]:first-child')
			.find('input.cbox[type=checkbox]').addClass('ace')
			.wrap('<label />').after('<span class="lbl align-top" />');
		*/
		}
		function updateActionIcons(table) {
			
			// var replacement = 
			// {
			// 	'ui-ace-icon fa fa-pencil' : 'ace-icon fa fa-pencil blue',
			// 	'ui-ace-icon fa fa-trash-o' : 'ace-icon fa fa-trash-o red',
			// 	'ui-icon-disk' : 'ace-icon fa fa-check green',
			// 	'ui-icon-cancel' : 'ace-icon fa fa-times red'
			// };
			// $(table).find('.ui-pg-div span.ui-icon').each(function(){
			// 	var icon = $(this);
			// 	var $class = $.trim(icon.attr('class').replace('ui-icon', ''));
			// 	if($class in replacement) icon.attr('class', 'ui-icon '+replacement[$class]);
			// })
			
		}
		function enableTooltips(table) {
			$('.navtable .ui-pg-button').tooltip({container:'body'});
			$(table).find('.ui-pg-div').tooltip({container:'body'});
		}
		$(document).one('ajaxloadstart.page', function(e) {
			$.jgrid.gridDestroy(grid_selector);
			$('.ui-jqdialog').remove();
		});
	}
</script>

<script type="text/javascript">
								 		
	$('#jstree').jstree({		
		'core' : {	
			'check_callback': true,		
			'data':
				{
			    'url':'getLocationTree?sub='+ $('#include-sub').prop('checked'),
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
   		gridview(data.selected);
   		$("#grid-table").jqGrid('setGridParam',{datatype:'json',url: 'getLocationEmployeeOrg?id='+data.selected+'&sub='+ $('#include-sub').prop('checked')}).trigger('reloadGrid');		      			      
    });   
    $('#jstree').on('ready.jstree', function() {
	    $("#jstree").jstree("open_node", $("#2"));     
	});			 						 			
	gridview(23);
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
					
		 			bootboxmodal('Input Location', renameCloneIdsAndNames(html,'Add'));
		 			$("#parentIDEdit").removeAttr("disabled");
					$("#SortAdd").val(1);
					$("#EmpReqAdd").val(0);
					$("<span id='Recnum' data-id=''></span").appendTo(".modal-footer");

		 			$('.date-picker').datepicker({
						autoclose: true,
						todayHighlight: true
					});
				
				    $.get('Location/getParent', { sub: $('#include-sub').prop('checked') }, function(data){  
				    		$("#parentIDAdd").empty();
				    		$.each(data,function(i,value){
			                	$("#parentIDAdd").append('<option value='+value.Recnum+'>'+value.LocationName+'</option>');
			            	})
			            	$("#parentIDAdd").val(node.id).trigger('chosen:updated');
							
				    });

				    setTimeout(function() {
						$(".chosen-container").css('width','100%');
						$('.chosen-select').chosen({
					    	allow_single_deselect:true,
					    	width: '100%'
					    }); 
					}, 600);
					
	             }
	        },
	        'item2' : {
	            'label' : 'Edit',
	            'action' : function () { 	  	     
		 			var html = $(".grab").clone();
					
		 			bootboxmodal('Edit Location', renameCloneIdsAndNames(html,'Edit'));
		 			$.get('Location/EditOrg', { id: node.id }, function(data){  
		 				$("#parentIDEdit").attr("disabled","disabled");		
		 							 				
			 			$("#parentIDEdit").val(data["data"][0]["ParentId"]).trigger('chosen:updated');
			 			$("#icityEdit").val(data["data"][0]["RecnumCity"]).trigger('chosen:updated');
			 			
						$("#OrgNameEdit").val(data["data"][0]["LocationName"]);
						$("#OrgNameEdit").attr('value',data["data"][0]["LocationName"]);

						$("#SortEdit").val(data["data"][0]["Sort"]);
						$("#SortEdit").attr('value',data["data"][0]["Sort"]);

						$("#dateRangeStartEdit").attr('value',data["data"][0]["fStartDate"]);
						$("#dateRangeEndEdit").attr('value',data["data"][0]["fEndDate"]);

						var checked = data["data"][0]["IsActive"] == 1 ? true: false;

						if(checked){ $("#isActiveEdit").attr('checked','checked')}else{ $("#isActiveEdit").removeAttr('checked')}
						$("<span id='Recnum' data-id='"+node.id+"'></span").appendTo(".modal-footer");

					    setTimeout(function() {
							$(".chosen-container").css('width','100%');
							$('.chosen-select').chosen({
						    	allow_single_deselect:true,
						    	width: '100%'
						    }); 
						}, 600);
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
	            'action' : function (e) { 
	            	var jml = $(e.reference).text().split("(")[1].replace(")","");
	            	if(jml>0){
	            		alert("Data tidak bisa dihapus");
	            		return;
	            	} 
	            	var r = confirm("Yakin dihapus?");
					if (r == true) {
						var id= node.id; 
					    $.get('Location/DelOrg', { id:id }, function(data){  			 				
			 				$('#jstree').jstree(true).settings.core.data.url = 'getLocationTree?sub='+ $('#include-sub').prop('checked');
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
			        	$("#parentIDEdit").removeAttr("disabled");
			        	if($("#Recnum").attr("data-id")==''){
							$.validator.addMethod("valueNotEquals", function(value, element, arg){
							  return arg !== value;
							 }, "Value must not equal arg.");

							$.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });

			        		var validator = $('#FormAdd').validate({
							rules: {
								  	icityAdd: {
							  			valueNotEquals: "0"
									},
									OrgNameAdd: {
							  			required: true
									},
									dateRangeStartAdd: {
							  			required: true
									}          
								},
							messages: {
							   icityAdd: { valueNotEquals: "Please select an item!" },
							  } 
							});
						 	validator.valid();
						 	$status = validator.form();
						 	if($status) {	
					        	var sParam = $('#FormAdd').serialize();
					        	$.get('Location/SaveOrg',sParam, function(data){
									if(data.error==false){				
										$('#jstree').jstree(true).settings.core.data.url = 'getLocationTree?sub='+ $('#include-sub').prop('checked');
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
			        		$.validator.addMethod("valueNotEquals", function(value, element, arg){
							  return arg !== value;
							 }, "Value must not equal arg.");

							$.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });

			        		var validator = $('#FormEdit').validate({
							rules: {
								  	icityEdit: {
							  			valueNotEquals: "0"
									},
									OrgNameEdit: {
							  			required: true
									},
									dateRangeStartEdit: {
							  			required: true
									}          
								},
							messages: {
							   icityEdit: { valueNotEquals: "Please select an item!" }
							  } 
							});
						 	validator.valid();
						 	$status = validator.form();
						 	if($status) {	
					        	var sParam = $('#FormEdit').serialize()+ "&Recnum="+ $("#Recnum").attr("data-id");
					        	$.get('Location/UpdateOrg',sParam, function(data){
									if(data.error==false){				
										$('#jstree').jstree(true).settings.core.data.url = 'getLocationTree?sub='+ $('#include-sub').prop('checked');
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
	    objClone.find('select').each( function() {
	    	$( this ).addClass('chosen-select');
	    });
	    return objClone;
	}


</script>