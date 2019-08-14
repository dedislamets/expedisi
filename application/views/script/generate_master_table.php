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
             		name:'Recnum',
             		index:'Recnum', 
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
						    url: 'GenerateTable/crud?tabel='+tabel,
						    mtype: 'POST',
						    reloadAfterSubmit: true,
						    ajaxDelOptions: {
						        contentType: "application/json"
						    },
						    onclickSubmit: function (eparams) {
                                 console.log(eparams);
                             },
						    serializeDelData: function(postdata) {
						        return JSON.stringify(postdata);
						    }
						},
						editOptions: {
						    editurl: 'GenerateTable/crud',
						    reloadAfterSubmit: true,
						    closeAfterEdit: true,
						    refreshtext: 'Reload',
						    keys: true,
						    ajaxEditOptions: {
						        contentType: "application/json"
						    },
						    beforeShowForm : function(e) {
								$('<tr class="FormData" style="display:none"><td class="CaptionTD">Tabel</td><td class="DataTD"><input type="text" id="tabel" name="tabel" class="FormElement form-control" ></td></tr>')
						        .appendTo("#TblGrid_grid-table>tbody");
						        $("#tabel").val(tabel);
						        $("#tr_Recnum").css('display','none');
							},
						    onclickSubmit: function (response, postdata) {                   	
								EditPost(postdata);

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
				    	arr['editrules'] = { required : true };
			    	}else if(msg[tabel][j]['COLUMN_NAME'] == 'Recnum'){
			    		arr['hidden'] = false;
			    		arr['editable'] = true;
			    	}else if(msg[tabel][j]['COLUMN_NAME'] == 'CreateBy' || msg[tabel][j]['COLUMN_NAME'] == 'CreateDate' ||msg[tabel][j]['COLUMN_NAME'] == 'EditBy' || msg[tabel][j]['COLUMN_NAME'] == 'EditDate'){
			    		arr['editable'] = false;
			    		if(msg[tabel][j]['DATA_TYPE'] == 'datetime'){
			    			arr['formatter'] = 'date';
			    			arr['formatoptions'] = { srcformat: 'd/m/Y', newformat: 'd/m/Y'};
			    		}
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
	gridview(1,'Organization');
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
	            	$("#myModalLabel").text('Add Table');	     
					$('#addModal').modal({backdrop: 'static', keyboard: false}) ;
	             }
	        },
	        'item2' : {
	            'label' : 'Edit',
	            'action' : function () { 
	            	$("#myModalLabel").text('Edit Table');
	            	var id= node.id; 
	            	var tabel_name = node.text;
	            	$("#tabel_name").val(tabel_name);
	            	$("#parent_table").val(node.parent).trigger('chosen:updated');
	            	$.get('GenerateTable/viewColumn',{ id:id }, function(data){
          				for (j=0; j<data[tabel_name].length; j++) {
          					var html = $(".cl").clone();
							renameCloneIdsAndNames(html, j, data[tabel_name][j],'edit');
							$('.baris').last().after(html);
          				}
          				$('.baris').first().remove();
			        }).done(function() {
					    
					})
					.fail(function(error) {
						$("#lblMessage").remove();
					    $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+error.responseText+"!</strong></div>").appendTo(".modal-footer");
					});	  	     
		 			$('#addModal').modal({backdrop: 'static', keyboard: false}) ;            	
	             }
	        },
	        'item3' : {
	            'label' : 'Delete',
	            'action' : function () { 
	            	var r = confirm("Yakin dihapus?");
					if (r == true) {
						var id= node.id; 
					    $.get('GenerateTable/delete', { id:id }, function(data){  			 				
			 				window.location.reload();
			            });
					} 
	             }
	        }
	    }

	    return items;
	}

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