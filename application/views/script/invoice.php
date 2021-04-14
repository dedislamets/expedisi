<script type="text/javascript">
	Dropzone.autoDiscover = false;
	var app = new Vue({
        el: "#app",
        mounted: function () {
	      // this.initmodal();
	    },
	    updated: function () {
	    	var that = this;
	    	if(that.last_status == 'DITERIMA'){
      			app.dropzone();
	    		
	    	}
	    },
        data: {
        	mode:'new',
        	id_routing: '',
        	term: '2',
        	id_invoice:'',
        	last_status:'<?= empty($data) ? "INPUT" : $data['status'] ?>',
        	tag:['Sesuai Routing'],
        	tag_select: 'Sesuai Routing',
        	list_routing: []
        },
        methods: {
        	dropzone: function(){
		    	var that = this;
		    	var foto_upload= new Dropzone("#dropzone",{
					url: "<?= base_url()?>trace/proses_upload",
					maxFilesize: 5,
					method:"post",
					acceptedFiles:"image/*",
					paramName:"userfile",
					dictInvalidFileType:"Type file ini tidak dizinkan",
					dictFileTooBig: 'Image is larger than 16MB',
					addRemoveLinks:true,	
					init: function() {  
		              	myDropzone = this;            
		              	$.get('<?= base_url()?>trace/getImage', { id: $("#id_rs").val() }, function(data){ 
							$.each(data, function(key,value) {
					          var mockFile = { name: value.name, size: value.size,token: value.token };

					          myDropzone.emit("addedfile", mockFile);
					          myDropzone.emit("thumbnail", mockFile, value.path);
					          myDropzone.emit("complete", mockFile);
					          $('<a href="' + value.path +'" class="preview-dropzone" target="_blank" >Preview File</a>').insertAfter(mockFile._removeLink);  
					        });
				           
				        });                                  
		          	}    		
				});

				foto_upload.on("sending",function(a,b,c){
					a.token=Math.random();
					c.append("token_foto",a.token); 
					c.append("id_rs", $("#id_rs").val()); 
					c.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');
				});

				//Event ketika foto dihapus
				foto_upload.on("removedfile",function(a){
					var token=a.token;
					var csrfName = $('#csrf_token').attr('name'); // Value specified in $config['csrf_token_name']
		          	var csrfHash = $('#csrf_token').val();
					$.ajax({
						type:"post",
						data:{token:token,[csrfName]: csrfHash},
						url:"<?= base_url()?>trace/remove_foto",
						cache:false,
						dataType: 'json',
						success: function(){
							console.log("Foto terhapus");
						},
						error: function(){
							console.log("Error");

						}
					});
				});
		    },
		    initmodal: function(){
		    	var list="";
		    	$.each(this.list_routing, function(_, obj) {
					list += obj.id_routing + ",";
				})
				if(list.substr(list.length-1) == ",")
					list = list.slice(0, -1);
		    	$('#ViewTableSPK').DataTable({
					ajax: {		            
			            "url": "<?= base_url(); ?>listrs/dataTableRS?r=" + list,
			            "type": "GET"
			        },
			        processing	: true,
					serverSide	: true,			
					"bPaginate": true,	
					"autoWidth": true,
					"destroy" : true
			    });
		    }
        }
    });


	$(document).ready(function(){  
		var c_date = new Date();
		$("#tgl_invoice").val(c_date.toLocaleDateString('en-CA'));
		$("#tgl_submit").val(c_date.toLocaleDateString('en-CA'));

		var nextWeek = moment().add(30, 'd').format('YYYY-MM-DD');
		$("#due_date").val(nextWeek);

		$(".js-example-basic-single").select2();
		$(".moda").val($('#moda_tran option:selected').text());


		$('.list-moda').hover(
			function(){
				$(this).css('background-image','linear-gradient(to right,  #144322 , red, yellow)');
			},
			function(){
				$(this).css('background-image','none');
			}
		);

		

		if($("#mode").val() == 'edit') {
			app.mode = 'edit';
			pilih_edit($("#id_invoice").val());

		}
	})


	$('#ModalTableBrg').DataTable({
		ajax: {		            
	            "url": "<?= base_url(); ?>spk/dataTableBrg",
	            "type": "GET"
	        },
        processing	: true,
		serverSide	: true,			
		"bPaginate": true,	
		"autoWidth": true,
    });


    $("#btnCariBarang").on('click', function (event) {
    	$('#modalBarang').modal({backdrop: 'static', keyboard: false}) ;
    });

	$("#id_pengirim").change(function(e, params){   
		$.get('<?= base_url() ?>defaults/getbyid/master_customer/id', { id	: $(this).val() }, function(data){ 
			$("#nama_pengirim").val(data['cust_name']);			
	    });
	});
	$("#id_penerima").change(function(e, params){   
		$.get('<?= base_url() ?>defaults/getbyid/master_customer/id', { id	: $(this).val() }, function(data){ 
			$("#nama_penerima").val(data['cust_name']);			
	    });
	});
	$("#id_term").change(function(e, params){   
		app.term = $(this).val();
		if($(this).val() == 2){
			$(".due").removeClass('hidden');
			var nextWeek = moment($("#tgl_submit").val()).add(30, 'd').format('YYYY-MM-DD');
			$("#due_date").val(nextWeek);
		}else if($(this).val() == 6){
			$(".due").addClass('hidden');
			$("#due_date").val('');
		}
		
	});

	$("#tgl_submit").change(function(e, params){   
		if($("#id_term").val() == 2){
			$(".due").removeClass('hidden');
			var nextWeek = moment($("#tgl_submit").val()).add(30, 'd').format('YYYY-MM-DD');
			$("#due_date").val(nextWeek);
		}else if($("#id_term").val() == 6){
			$(".due").addClass('hidden');
			$("#due_date").val('');
		}
		
	});

	$('#btnAdd').on('click', function (event) {
		event.preventDefault();
		var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
		if( $.isNumeric( nomor ) ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		$('#total-row').val(nomor);
		$(".no-data").remove();
		var baris = '<tr>';
		baris += '<td style="width:1%">'+ nomor+'</td>';
		baris += '<td style="width:8%"><input type="text" id="kode'+ nomor +'" name="kode'+ nomor +'" placeholder="Kode Item" class="form-control hidden"><input type="text" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control hidden" value=""><a href="javascript:void(0)" class="btn hor-grd btn-grd-success hidden" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger hidden" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
		baris += '<td style="width:39%">Nama Item</td>';
		baris += '<td>Berat</td>';
		baris += '<td style="width:25%"><input type="text" name="satuan'+ nomor +'" id="satuan'+ nomor +'" class="form-control"/></td>';
		baris += '<td style="width:25%"><input type="number" id="qty'+ nomor +'" name="qty'+ nomor +'" placeholder="Qty" class="form-control" style="width:100%"></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table");
		}else{
			$('#tbody-table tr:last').after(baris);
		}
	});

	$('#btnAddBiaya').on('click', function (event) {
		event.preventDefault();
		var nomor = $('#tbody-table-biaya tr:nth-last-child(1) td:first-child').html();
		if( $.isNumeric( nomor ) ) 	{
			nomor = parseInt(nomor) + 1;
		}else{		
			nomor = 1
		}

		$('#total-row-biaya').val(nomor);
		$(".no-data").remove();
		var baris = '<tr>';
		baris += '<td style="width:1%">'+ nomor+'</td>';
		baris += '<td style="width:8%"><input type="text" id="id_detail_biaya_'+ nomor +'" name="id_detail_biaya_'+ nomor +'" class="form-control hidden" value=""><input type="hidden" id="deleted_'+ nomor +'" name="deleted_'+ nomor +'" value="0"> <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger btn-sm" onclick="cancelBiaya(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
		baris += '<td><input type="hidden" id="id_routing_biaya'+ nomor +'" name="id_routing_biaya'+ nomor +'" class="form-control " value="">-</td>';
		baris += '<td><input type="text" name="aktifitas_'+ nomor +'" id="aktifitas_'+ nomor +'" class="form-control"/></td>';
		baris += '<td><input type="number" id="biaya_'+ nomor +'" name="biaya_'+ nomor +'" placeholder="" class="form-control" value="0" style="text-align:right;"></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table-biaya tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table-biaya");
		}else{
			$('#tbody-table-biaya tr:last').after(baris);
		}
	});

    $('#btnBrowse').on('click', function (event) {
    	app.initmodal();
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });
    

    function cari_dealer(val) {
		event.preventDefault();
		$("#id-row").val($(val).prev().prev().attr('id'));
		$("#modalBarang").modal({backdrop: 'static', keyboard: false}) ;  	   
	}

	function setTag(val){
		app.tag_select = $(val).text();
		$("#id_tag").val($(val).data('id'));
		$.get('<?= base_url()?>invoice/getTag', { tag: app.tag_select, id: $("#id_pengirim").val(), rs: $("#id_routing").val() }, function(data){ 
			$("#attn_pengirim").text('');
			$("#alamat_pengirim").text(data['tag']['other_address']);
		})
	}
  

    $('#btn-finish').on('click', function (event) {
    	event.preventDefault();
		var valid = false;
    	var sParam = $('#form-invoice').serialize();
    	var validator = $('#form-invoice').validate({
							rules: {
									no_routing: {
							  			required: true
									},
									no_invoice: {
							  			required: true
									},
									note: {
							  			required: true
									},
									
								}
							});
	 	validator.valid();
	 	$status = validator.form();
	 	if($status) {
	 		if(validateBarang()){
		 		var link = '<?= base_url(); ?>invoice/Header';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alertOK(window.location.href="<?= base_url(); ?>invoice/edit/"+ data.last_id);
					}else{	
						alertError(data.message);				  	
					}
				},'json');
		 	}
	 	}
        
    });


	function validateBarang(){
    	var flag = true;
    	if($("#tbody-table").html().trim() == ""){
    		alertError('Anda belum memasukkan daftar item..');
    		flag = false;
    	}else{
    		$("#tbody-table").find('tr').each(function (i, el) {
		        var $tds = $(this).find('td');
		        if($tds.eq(1).children().val() != undefined){
			        var productId = $tds.eq(1).children().val().trim();
			        if(productId==""){
			        	alertError('Item belum dipilih..');
			        	flag= false;
			        }
			        var qty = $($tds[6]).children().val();
			        var price = $($tds[7]).children().val();
			        var price_chartered = $($tds[8]).children().val();

			        if(parseInt(qty)>0){
			        	// if(price == 0){
				        // 	alertError('Harga Kg Barang belum di berikan..');
				        // 	flag= false;
				        // }
			        }else{
			        	// if(price_chartered == 0){
				        // 	alertError('Harga Chartered Barang belum di berikan..');
				        // 	flag= false;
				        // }
			        }
			        
			    }
		    });
    	}
    	return flag;
    }


	function hapus(val) {
		var r = confirm("Yakin dihapus?");
		if (r == true) {
			
			$.get('Connote/delete', { id: $(val).data('id') }, function(data){ 
				datatable.ajax.reload();
			})
		}
	}

	function pilih(val){
		$.get('<?= base_url()?>invoice/get', { id: val }, function(data){ 
				app.tag = data['data_tag'];
				$.each(data['data_tag'], function(_, obj) {
					if(obj.tag == "Sesuai Routing")
						$("#id_tag").val(obj.id)
				})
				// $("#no_routing").val(data['data']['no_routing']);
				// $("#id_routing").val(data['data']['id']);
				// $("#project").val(data['data']['nama_project']);
				// $("#tgl_do").val(data['data']['tgl_spk']);

				$("#id_pengirim").val(data['data']['id_pengirim']);
				$("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				$("#alamat_pengirim").text(data['data']['alamat_pengirim']);
				$("#alamat_penagihan").text(data['data']['alamat_pengirim']);
				$("#origin").text(data['data']['kec_pengirim'] + ' - ' + data['data']['kota_pengirim']);

				$("#attn_penerima").text(data['data']['attn_penerima']);
				$("#nama_penerima").text(data['data']['penerima']['cust_name']);
				$("#alamat_penerima").text(data['data']['alamat_penerima']);
				$("#project").text(data['data']['nama_project']);
				$("#moda").text(data['data']['moda_name']);
				$("#destination").text(data['data']['kec_penerima'] + ' - ' + data['data']['kota_penerima']);
				// $("#spk").text(data['data']['spk_no']);
				$("#note").text("Jasa Pengiriman (" + $("#origin").text() + ") - (" + $("#destination").text() + ")");
				app.list_routing.push({
					id_routing: data['data']['id'],
        			no_routing: data['data']['no_routing'],
        			tanggal: data['data']['CreatedDate'],
        			spk: data['data']['spk_no'],
        			project: data['data']['nama_project']
				}); 
				var id_rs = data['data']['id'];
				var routing = data['data']['no_routing'];

				$('#total-row-invoice').val(app.list_routing.length);
				// $("#ViewTableBrg tbody").empty();
				const tbody = $("#ViewTableBrg tbody");
				var baris;
				// tbody.html('');
				$.each(data['data_detail'], function(_, obj) {
				    var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
					if( $.isNumeric( nomor ) ) 	{
						nomor = parseInt(nomor) + 1;
					}else{		
						nomor = 1
					}

					$('#total-row').val(nomor);
					$(".no-data").remove();
					baris = '<tr>';
					baris += '<td style="width:1%">'+ nomor+'</td>';
					baris += '<td style="width:8%"><input type="hidden" id="kode'+ nomor +'" name="kode'+ nomor +'" class="form-control " value="'+ obj.id_barang +'"><input type="hidden" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control " value="' + obj.id+'"><a href="javascript:void(0)" class="btn hor-grd btn-grd-success hidden" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger hidden" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
					baris += '<td><input type="hidden" id="id_routing_item'+ nomor +'" name="id_routing_item'+ nomor +'" class="form-control " value="' + id_rs +'">' + obj.no_routing+'</td>';
					baris += '<td>' + obj.nama_barang+'</td>';
					baris += '<td><input type="number" id="qty_'+ nomor +'" name="qty_'+ nomor +'" value="' + obj.qty+'" class="form-control" style="width:100%"></td>';
					
					baris += '<td><input type="text" name="satuan'+ nomor +'" id="satuan'+ nomor +'" class="form-control" value="' + obj.satuan+'" /></td>';
					baris += '<td><input type="text" name="kg_'+ nomor +'" id="kg_'+ nomor +'" class="form-control" value="' + obj.kg+'" /></td>';
					var readonly_kg ="";
					var readonly_charter ="readonly";
					if(obj.kg>0){
						readonly_kg = "readonly";
						readonly_charter="";
					}
					baris += '<td><input type="number" id="price_'+ nomor +'" name="price_'+ nomor +'" value="0" class="form-control" style="width:100%" '+ readonly_kg +'></td>';
					baris += '<td><input type="number" id="prices_chartered_'+ nomor +'" name="prices_chartered_'+ nomor +'" value="0" class="form-control" style="width:100%" '+ readonly_charter +'></td>';
					baris += '<td><input type="text" id="sub_'+ nomor +'" name="sub_'+ nomor +'" value="0" class="form-control" style="width:100%;text-align:right;" readonly></td>';
				
					baris += '</tr>';
					
					var last = $('#tbody-table tr:last').html();
					if(last== undefined){
						$(baris).appendTo("#tbody-table");
					}else{
						$('#tbody-table tr:last').after(baris);
					}
				});
				
				// $("#ViewTableBiaya tbody").empty();
				const tbodyBiaya = $("#ViewTableBiaya tbody");
				var barisBiaya;
				// tbodyBiaya.html('');
				$.each(data['data_biaya'], function(_, obj) {
				    var nomor = $('#tbody-table-biaya tr:nth-last-child(1) td:first-child').html();
					if( $.isNumeric( nomor ) ) 	{
						nomor = parseInt(nomor) + 1;
					}else{		
						nomor = 1
					}

					$('#total-row-biaya').val(nomor);
					$(".no-data").remove();
					baris = '<tr>';
					baris += '<td style="width:1%">'+ nomor+'</td>';
					baris += '<td style="width:8%">' + (app.last_status == "LUNAS" ? "" : '<input type="hidden" id="id_detail_biaya_'+ nomor +'" name="id_detail_biaya_'+ nomor +'" class="form-control " value="' + obj.id+'"><input type="hidden" id="deleted_'+ nomor +'" name="deleted_'+ nomor +'" value="0"> <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger btn-sm" onclick="cancelBiaya(this)"><i class="icofont icofont-trash"></i> Del</a>') + '</td>';
					baris += '<td><input type="hidden" id="id_routing_biaya'+ nomor +'" name="id_routing_biaya'+ nomor +'" class="form-control " value="' + id_rs +'">' + routing+'</td>';
					baris += '<td><input type="text" name="aktifitas_'+ nomor +'" id="aktifitas_'+ nomor +'" class="form-control" value="' + obj.aktifitas +'" /></td>';
					
					baris += '<td><input type="number" id="biaya_'+ nomor +'" name="biaya_'+ nomor +'" value="' + parseFloat(obj.biaya)+'" class="form-control" style="width:100%;text-align:right;"></td>';
				
					baris += '</tr>';
					
					var last = $('#tbody-table-biaya tr:last').html();
					if(last== undefined){
						$(baris).appendTo("#tbody-table-biaya");
					}else{
						$('#tbody-table-biaya tr:last').after(baris);
					}
				});

				calculateTotal();

				$('#modalBrowse').modal('hide');
		
			
		})
	}

	function pilih_edit(val){
		$.get('<?= base_url()?>invoice/get_edit', { id: val }, function(data){ 
				 // remark karana multi invoice
				// app.tag = data['data_tag'];
				// $.each(data['data_tag'], function(_, obj) {
				// 	if(obj.id == data['data']['id_tag']){
				// 		$("#id_tag").val(obj.id)
				// 		app.tag_select = obj.tag;
				// 		$("#alamat_pengirim").text(obj.other_address);
				// 	}
				// })
				
				// $("#no_routing").val(data['data']['no_routing']);
				// $("#id_routing").val(data['data']['id_routing']);
				// $("#tgl_do").val(data['data']['tgl_spk']);

				// $("#id_pengirim").val(data['data_routing']['id_pengirim']);
				// $("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				// $("#origin").text(data['data_routing']['kec_pengirim'] + ' - ' + data['data_routing']['kota_pengirim']);
				
				// $("#nama_penerima").text(data['data']['penerima']['cust_name']);
				// $("#alamat_penerima").text(data['data_routing']['alamat_penerima']);
				// $("#project").text(data['data_routing']['nama_project']);
				// $("#moda").text(data['data_routing']['moda_name']);
				// $("#destination").text(data['data_routing']['kec_penerima'] + ' - ' + data['data_routing']['kota_penerima']);
				// $("#spk").text(data['data_routing']['spk_no']);

				app.list_routing = data['data_routing'];

				$("#ViewTableBrg tbody").empty();
				const tbody = $("#ViewTableBrg tbody");
				var baris;
				tbody.html('');
				$.each(data['data_detail'], function(_, obj) {
				    var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
					if( $.isNumeric( nomor ) ) 	{
						nomor = parseInt(nomor) + 1;
					}else{		
						nomor = 1
					}

					$('#total-row').val(nomor);
					$(".no-data").remove();
					baris = '<tr>';
					baris += '<td style="width:1%">'+ nomor+'</td>';
					baris += '<td style="width:8%"><input type="hidden" id="kode'+ nomor +'" name="kode'+ nomor +'" class="form-control " value="'+ obj.id_barang +'"><input type="hidden" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control " value="' + obj.id+'"><a href="javascript:void(0)" class="btn hor-grd btn-grd-success hidden" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger hidden" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
					baris += '<td><input type="hidden" id="id_routing_item'+ nomor +'" name="id_routing_item'+ nomor +'" class="form-control " value="' + obj.id_routing +'">' + obj.routing+'</td>';
					baris += '<td>' + obj.nama_barang+'</td>';
					baris += '<td><input type="number" id="qty_'+ nomor +'" name="qty_'+ nomor +'" value="' + obj.qty+'" class="form-control" style="width:100%"></td>';
					
					baris += '<td><input type="text" name="satuan'+ nomor +'" id="satuan'+ nomor +'" class="form-control" value="' + obj.satuan+'" /></td>';
					baris += '<td><input type="text" name="kg_'+ nomor +'" id="kg_'+ nomor +'" class="form-control" value="' + obj.kg+'" /></td>';
					var readonly_kg ="readonly";
					var readonly_charter ="";
					if(parseInt(obj.kg)>0){
						readonly_charter = "readonly";
						readonly_kg="";
					}
					baris += '<td><input type="number" id="price_'+ nomor +'" name="price_'+ nomor +'" value="' + obj.price+'" class="form-control" style="width:100%" '+ readonly_kg +'></td>';
					baris += '<td><input type="number" id="prices_chartered_'+ nomor +'" name="prices_chartered_'+ nomor +'" value="' + obj.price_chartered+'" class="form-control" style="width:100%" '+ readonly_charter +'></td>';

				
					baris += '<td><input type="text" id="sub_'+ nomor +'" name="sub_'+ nomor +'" value="' + parseFloat(obj.subtotal).toLocaleString('id-ID')+'" class="form-control" style="width:100%;text-align:right;" readonly></td>';
				
					baris += '</tr>';
					
					var last = $('#tbody-table tr:last').html();
					if(last== undefined){
						$(baris).appendTo("#tbody-table");
					}else{
						$('#tbody-table tr:last').after(baris);
					}
				});
				
				$("#ViewTableBiaya tbody").empty();
				const tbodyBiaya = $("#ViewTableBiaya tbody");
				var barisBiaya;
				tbodyBiaya.html('');
				$.each(data['data_biaya'], function(_, obj) {
				    var nomor = $('#tbody-table-biaya tr:nth-last-child(1) td:first-child').html();
					if( $.isNumeric( nomor ) ) 	{
						nomor = parseInt(nomor) + 1;
					}else{		
						nomor = 1
					}

					$('#total-row-biaya').val(nomor);
					$(".no-data").remove();
					baris = '<tr>';
					baris += '<td style="width:1%">'+ nomor+'</td>';
					baris += '<td style="width:8%">' + (app.last_status == "LUNAS" ? "" : '<input type="hidden" id="id_detail_biaya_'+ nomor +'" name="id_detail_biaya_'+ nomor +'" class="form-control " value="' + obj.id+'"><input type="hidden" id="deleted_'+ nomor +'" name="deleted_'+ nomor +'" value="0"> <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger btn-sm" onclick="cancelBiaya(this)"><i class="icofont icofont-trash"></i> Del</a>') + '</td>';
					baris += '<td><input type="hidden" id="id_routing_biaya'+ nomor +'" name="id_routing_biaya'+ nomor +'" class="form-control " value="' + obj.id_routing +'">' + obj.routing+'</td>';
					baris += '<td><input type="text" name="aktifitas_'+ nomor +'" id="aktifitas_'+ nomor +'" class="form-control" value="' + obj.aktifitas +'" /></td>';
					
					baris += '<td><input type="text" id="biaya_'+ nomor +'" name="biaya_'+ nomor +'" value="' + parseFloat(obj.biaya)+'" class="form-control" style="width:100%;text-align:right;"></td>';
				
					baris += '</tr>';
					
					var last = $('#tbody-table-biaya tr:last').html();
					if(last== undefined){
						$(baris).appendTo("#tbody-table-biaya");
					}else{
						$('#tbody-table-biaya tr:last').after(baris);
					}
				});

				$('#modalBrowse').modal('hide');
			// }
			
		})
	}

	function pilih_item(val){
		var el = $("#id-row").val();
		var itemno= $(val).data('id');
		var x= true;

		$("#tbody-table").find('tr').each(function (i, el) {
	        var $tds = $(this).find('td');
	        if($tds.eq(1).children().val() != undefined){
		        var productId = $tds.eq(1).children().val().trim();
		        if(productId==itemno){
		        	alert('Item No sudah ada, silahkan masukan item lain..');
		        	x=false;
		        }
		    }
	    });
	    if(x){
			$("#"+el).val(itemno);
			var tks = $(val).parent().prev().prev().prev().prev().text();
			$("#"+el).parent().next().html(tks.replace("\n", "<br>"));
			$("#"+el).parent().next().next().text($(val).parent().prev().prev().text());
			$("#"+el).parent().next().next().next().children().val($(val).parent().prev().text());
			$("#"+el).parent().next().next().next().next().children().val(1);
			$("#"+el).parent().next().next().next().next().children().focus();
			$("#modalBarang").modal('hide');
		}
	}

	function cancel(val) {
		var id=$(val).prevAll()[1].value;
		if(id != ""){
			var r = confirm("Yakin dihapus?");
			if (r == true) {
				$.get('<?= base_url()?>spk/delete', { id: id }, function(data){ 
					$(val).parent().parent().remove();
				})
			}
		}else{
			$(val).parent().parent().remove();
		}
	}

	function cancelRouting(val) {
		var id = $(val).prev().val();
		const swalWithBootstrapButtons = Swal.mixin({
		  customClass: {
		    confirmButton: 'btn btn-danger btn-round',
		    cancelButton: 'btn btn-primary btn-round'
		  },
		})
		swalWithBootstrapButtons.fire({
		  title: 'Yakin di hapus Routing Slip ini?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonText: `Ya!`,
		  denyButtonText: `Tidak`,
		}).then((result) => {
		  if (result.isConfirmed) {
		    $.each(app.list_routing, function(_, obj) {
				if(obj.id_routing == id){
					app.list_routing.splice(_,1);
					$("#total-row-invoice").val(app.list_routing.length);
					//hapus detail brg
					var table_item = document.getElementById('ViewTableBrg');
					var total_remove =0;
					for (var i = 1; i < table_item.rows.length; i++) {
					  if(table_item.rows[i].cells.length) {
					  	if(table_item.rows[i].cells[2].firstElementChild.value == id){
					  		table_item.rows[i].remove();
					  		total_remove++;
					  	}
					  }
					}
					$("#total-row").val($("#total-row").val()-total_remove);
					//hapus detail biaya
					var table_biaya = document.getElementById('ViewTableBiaya');
					var total_remove =0;
					for (var i = 1; i < table_biaya.rows.length; i++) {
					  if(table_biaya.rows[i].cells.length) {
					  	if(table_biaya.rows[i].cells[2].firstElementChild.value == id){
					  		table_biaya.rows[i].remove();
					  		total_remove++;
					  	}
					  }
					}
					$("#total-row-biaya").val($("#total-row-biaya").val()-total_remove);
				}
			})
		  } 
		})
	}
	function cancelBiaya(val) {
		$(val).parent().parent().remove();
	}

	$(document).on('blur', "[id^=qty_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=prices_chartered_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=biaya_]", function(){
		calculateTotal();
	});	

	$(document).on('blur', "[id^=tax_percent]", function(){
		calculateTotal();
	});	

	function calculateTotal(){
		var totalAmount = 0; 
		$("[id^='price_']").each(function() {
			var id = $(this).attr('id');
			id = id.replace("price_",'');
			
			var quantity  = $('#kg_'+id).val();
			if(!quantity) {
				quantity = 1;
			}
			if(parseInt(quantity)>0){
				var price = $('#price_'+id).val();
				$('#price_'+id).removeAttr('readonly');
				$('#prices_chartered_'+id).attr('readonly','readonly');
			}else{
				var price = $('#prices_chartered_'+id).val();
				quantity=1;
				$('#prices_chartered_'+id).removeAttr('readonly');
				$('#price_'+id).attr('readonly','readonly');
			}
			var total = price*quantity;
			$('#sub_'+id).val(parseFloat(total).toLocaleString('id-ID'));
			totalAmount += total;			
		});
		var other_cost = 0;
		$("[id^='biaya_']").each(function() {
			var id = $(this).attr('id');
			id = id.replace("biaya_",'');
			var biaya = $('#biaya_'+id).val();
			if(!biaya) {
				biaya = 0;
			}
			other_cost += parseFloat(biaya);			
		});
		$('#other_cost').val(parseFloat(other_cost).toLocaleString('id-ID'));	
		$('#subtotal').val(parseFloat(totalAmount).toLocaleString('id-ID'));	
		var taxRate = $('#tax_percent').val();
		var subTotal = totalAmount;	
		if(subTotal) {
			var taxAmount = (subTotal+ other_cost)*(taxRate/100);
			$('#tax').val(taxAmount.toLocaleString('id-ID'));
			var wht = taxAmount*2;
			// $('#wht').val(wht.toLocaleString('id-ID'));
			subTotal = parseFloat(subTotal)+parseFloat(taxAmount)+parseFloat(other_cost);
			$('#total').val(subTotal.toLocaleString('id-ID'));		
			// var amountPaid = $('#amountPaid').val();
			// var totalAftertax = $('#totalAftertax').val();	
			// if(amountPaid && totalAftertax) {
			// 	totalAftertax = totalAftertax-amountPaid;			
			// 	$('#amountDue').val(totalAftertax);
			// } else {		
			// 	$('#amountDue').val(subTotal);
			// }
		}
	}

	
</script>