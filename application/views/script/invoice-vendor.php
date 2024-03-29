<script type="text/javascript">
	Dropzone.autoDiscover = false;
	var app = new Vue({
        el: "#app",
        mounted: function () {
	      // this.loadHistory();
	    },
	    updated: function () {
	    	var that = this;
	    	
	    },
        data: {
        	mode:'new',
        	id_routing: '',
        	term: '2',
        	id_invoice:'',
        	last_status:'<?= empty($data) ? "INPUT" : $data['status'] ?>',
        	list_item: [],
        	store_item: []
        },
        methods: {
        	loadItem: function (event){
        		let copy = JSON.parse(JSON.stringify(this.store_item));
    			this.list_item =  copy;
    			$("#total-row").val(copy.length);
        	},
        	restItem: function(event){
        		this.list_item=[];
        		$("#total-row").val(0);
        		this.calculateTotal();
        	},
        	calculateTotal: function(){
        		var totalAmount = 0; 
				$("[id^='price_']").each(function() {
					var id = $(this).attr('id');
					id = id.replace("price_",'');
					var price = $('#price_'+id).val();
					var quantity  = $('#kg_'+id).val();
					if(!quantity) {
						quantity = 1;
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
				var taxRate = 1;
				var subTotal = totalAmount;	
				subTotal = parseFloat(subTotal)+parseFloat(other_cost);
				$('#total').val(subTotal.toLocaleString('id-ID'));		
        	}
        }
    });


	$(document).ready(function(){  
		

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

		$('#ViewTableSPK').DataTable({
			ajax: {		            
	            "url": "<?= base_url(); ?>listrs/dataTableRSVendor",
	            "type": "GET"
	        },
	        processing	: true,
			serverSide	: true,			
			"bPaginate": true,	
			"autoWidth": true,

	    });

		if($("#mode").val() == 'edit') {
			app.mode = 'edit';
			pilih_edit($("#id_invoice").val());

		}else{
			var c_date = new Date();
			$("#tgl_invoice").val(c_date.toLocaleDateString('en-CA'));
			$("#tgl_submit").val(c_date.toLocaleDateString('en-CA'));

			var nextWeek = moment().add(30, 'd').format('YYYY-MM-DD');
			$("#due_date").val(nextWeek);
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
    $("#btnReset").on('click', function (event) {
    	app.calculateTotal();
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
		baris += '<td style="width:8%"><input type="text" id="kode'+ nomor +'" name="kode'+ nomor +'" placeholder="Kode Item" class="form-control hidden"><input type="text" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control hidden" value=""><a href="javascript:void(0)" class="btn hor-grd btn-grd-success" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
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
		baris += '<td style="width:8%"><input type="text" id="id_detail_biaya_'+ nomor +'" name="id_detail_biaya_'+ nomor +'" class="form-control hidden" value=""><input type="hidden" id="deleted_'+ nomor +'" name="deleted_'+ nomor +'" value="0"> <a href="javascript:void(0)" class="btn hor-grd btn-grd-danger" onclick="cancelBiaya(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
		
		baris += '<td><input type="text" name="aktifitas_'+ nomor +'" id="aktifitas_'+ nomor +'" class="form-control"/></td>';
		baris += '<td><input type="number" id="biaya_'+ nomor +'" name="biaya_'+ nomor +'" placeholder="" class="form-control" value="0" ></td>';
		
	
		baris += '</tr>';
		
		var last = $('#tbody-table-biaya tr:last').html();
		if(last== undefined){
			$(baris).appendTo("#tbody-table-biaya");
		}else{
			$('#tbody-table-biaya tr:last').after(baris);
		}
	});

    $('#btnBrowse').on('click', function (event) {
    	$('#modalBrowse').modal({backdrop: 'static', keyboard: false}) ;
    });
    

    function cari_dealer(val) {
		event.preventDefault();
		$("#id-row").val($(val).prev().prev().attr('id'));
		$("#modalBarang").modal({backdrop: 'static', keyboard: false}) ;  	   
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
		 		var link = '<?= base_url(); ?>invoicevendor/Header';
		 		$.post(link,sParam, function(data){
					if(data.error==false){	
						alertOK(window.location.reload());
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
    		// alertError('Anda belum memasukkan daftar item..');
    		// flag = false;
    	}else{
    		$("#tbody-table").find('tr').each(function (i, el) {
		        var $tds = $(this).find('td');
		        if($tds.eq(1).children().val() != undefined){
			        var productId = $tds.eq(1).children().val().trim();
			        if(productId==""){
			        	alertError('Item belum dipilih..');
			        	flag= false;
			        }

			        // var price = $($tds[6]).children().val();
			        // if(price == 0){
			        // 	alertError('Harga Barang belum di berikan..');
			        // 	flag= false;
			        // }
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
		$.get('<?= base_url()?>invoicevendor/get', { id: val }, function(data){ 

				$("#no_routing").val(data['data']['no_routing']);
				$("#id_routing").val(data['data']['id']);
				$("#project").val(data['data']['nama_project']);
				$("#tgl_do").val(data['data']['tgl_spk']);

				$("#id_pengirim").val(data['data']['id_pengirim']);
				// $("#attn_pengirim").text(data['data']['attn_pengirim']);
				$("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				$("#alamat_pengirim").text(data['data']['alamat_pengirim']);
				$("#origin").text(data['data']['kec_pengirim'] + ' - ' + data['data']['kota_pengirim']);

				$("#attn_penerima").text(data['data']['attn_penerima']);
				$("#nama_penerima").text(data['data']['penerima']['cust_name']);
				$("#alamat_penerima").text(data['data']['alamat_penerima']);
				$("#project").text(data['data']['nama_project']);
				$("#moda").text(data['data']['moda_name']);
				$("#destination").text(data['data']['kec_penerima'] + ' - ' + data['data']['kota_penerima']);
				$("#spk").text(data['data']['spk_no']);
				$("#note").text("Jasa Pengiriman (" + $("#origin").text() + ") - (" + $("#destination").text() + ")");
				$("#vendor").text(data['data']['agent']);
				$("#pickup").text(data['data']['pickup_address']);

				$("#ViewTableBrg tbody").empty();
				app.store_item = data['data_detail'];
				// const tbody = $("#ViewTableBrg tbody");
				// var baris;
				// tbody.html('');
				// $.each(data['data_detail'], function(_, obj) {
				//     var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
				// 	if( $.isNumeric( nomor ) ) 	{
				// 		nomor = parseInt(nomor) + 1;
				// 	}else{		
				// 		nomor = 1
				// 	}

				// 	$('#total-row').val(nomor);
				// 	$(".no-data").remove();
				// 	baris = '<tr>';
				// 	baris += '<td style="width:1%">'+ nomor+'</td>';
				// 	baris += '<td style="width:8%"><input type="hidden" id="kode'+ nomor +'" name="kode'+ nomor +'" class="form-control " value="'+ obj.id_barang +'"><input type="hidden" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control " value="' + obj.id+'"><a href="javascript:void(0)" class="btn hor-grd btn-grd-success btn-sm" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger btn-sm" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
				// 	baris += '<td>' + obj.nama_barang+'</td>';
				// 	baris += '<td><input type="number" id="qty_'+ nomor +'" name="qty_'+ nomor +'" value="' + obj.qty+'" class="form-control" style="width:100%"></td>';
					
				// 	baris += '<td><input type="text" name="satuan'+ nomor +'" id="satuan'+ nomor +'" class="form-control" value="' + obj.satuan+'" /></td>';
				// 	baris += '<td><input type="text" name="kg_'+ nomor +'" id="kg_'+ nomor +'" class="form-control" value="' + obj.kg+'" /></td>';
				// 	baris += '<td><input type="number" id="price_'+ nomor +'" name="price_'+ nomor +'" value="0" class="form-control" style="width:100%"></td>';
				// 	baris += '<td><input type="text" id="sub_'+ nomor +'" name="sub_'+ nomor +'" value="0" class="form-control" style="width:100%;text-align:right;" readonly></td>';
				
				// 	baris += '</tr>';
					
				// 	var last = $('#tbody-table tr:last').html();
				// 	if(last== undefined){
				// 		$(baris).appendTo("#tbody-table");
				// 	}else{
				// 		$('#tbody-table tr:last').after(baris);
				// 	}
				// });
				
				

				$('#modalBrowse').modal('hide');
			// }
			
		})
	}

	function pilih_edit(val){
		$.get('<?= base_url()?>invoicevendor/get_edit', { id: val }, function(data){ 
				$("#no_routing").val(data['data']['no_routing']);
				$("#id_routing").val(data['data']['id_routing']);
				$("#tgl_do").val(data['data']['tgl_spk']);

				$("#id_pengirim").val(data['data_routing']['id_pengirim']);
				// $("#attn_pengirim").text(data['data_routing']['attn_pengirim']);
				$("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				$("#origin").text(data['data_routing']['kec_pengirim'] + ' - ' + data['data_routing']['kota_pengirim']);
				
				
				// $("#attn_penerima").text(data['data_routing']['attn_penerima']);
				$("#nama_penerima").text(data['data']['penerima']['cust_name']);
				$("#alamat_penerima").text(data['data_routing']['alamat_penerima']);
				$("#project").text(data['data_routing']['nama_project']);
				$("#moda").text(data['data_routing']['moda_name']);
				$("#destination").text(data['data_routing']['kec_penerima'] + ' - ' + data['data_routing']['kota_penerima']);
				$("#spk").text(data['data_routing']['spk_no']);
				$("#vendor").text(data['data_routing']['agent']);
				$("#pickup").text(data['data_routing']['pickup_address']);

				$("#ViewTableBrg tbody").empty();
				app.store_item = data['data_detail_routing'];
				let copy = JSON.parse(JSON.stringify(data['data_detail']));
    			app.list_item =  copy;
				// const tbody = $("#ViewTableBrg tbody");
				// var baris;
				// tbody.html('');
				// $.each(data['data_detail'], function(_, obj) {
				//     var nomor = $('#tbody-table tr:nth-last-child(1) td:first-child').html();
				// 	if( $.isNumeric( nomor ) ) 	{
				// 		nomor = parseInt(nomor) + 1;
				// 	}else{		
				// 		nomor = 1
				// 	}

				// 	$('#total-row').val(nomor);
				// 	$(".no-data").remove();
				// 	baris = '<tr>';
				// 	baris += '<td style="width:1%">'+ nomor+'</td>';
				// 	baris += '<td style="width:8%"><input type="hidden" id="kode'+ nomor +'" name="kode'+ nomor +'" class="form-control " value="'+ obj.id_barang +'"><input type="hidden" id="id_detail'+ nomor +'" name="id_detail'+ nomor +'" class="form-control " value="' + obj.id+'"><a href="javascript:void(0)" class="btn hor-grd btn-grd-success disabled" onclick="cari_dealer(this)"><i class="icofont icofont-search"></i> Cari</a><a href="javascript:void(0)" class="btn hor-grd btn-grd-danger disabled" onclick="cancel(this)"><i class="icofont icofont-trash"></i> Del</a></td>';
				// 	baris += '<td>' + obj.nama_barang+'</td>';
				// 	baris += '<td><input type="number" id="qty_'+ nomor +'" name="qty_'+ nomor +'" value="' + obj.qty+'" class="form-control" style="width:100%"></td>';
					
				// 	baris += '<td><input type="text" name="satuan'+ nomor +'" id="satuan'+ nomor +'" class="form-control" value="' + obj.satuan+'" /></td>';
				// 	baris += '<td><input type="text" name="kg_'+ nomor +'" id="kg_'+ nomor +'" class="form-control" value="' + obj.kg+'" /></td>';
				// 	baris += '<td><input type="number" id="price_'+ nomor +'" name="price_'+ nomor +'" value="' + obj.price+'" class="form-control" style="width:100%"></td>';
				// 	baris += '<td><input type="text" id="sub_'+ nomor +'" name="sub_'+ nomor +'" value="' + parseFloat(obj.subtotal).toLocaleString('id-ID')+'" class="form-control" style="width:100%;text-align:right;" readonly></td>';
				
				// 	baris += '</tr>';
					
				// 	var last = $('#tbody-table tr:last').html();
				// 	if(last== undefined){
				// 		$(baris).appendTo("#tbody-table");
				// 	}else{
				// 		$('#tbody-table tr:last').after(baris);
				// 	}
				// });
				
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
		var id = $(val).prev().val();
		$.each(app.list_item, function(_, obj) {
			if(obj.id == id){
				app.list_item.splice(_,1);
				$("#total-row").val(app.list_item.length);
			}
		})
		// $(val).parent().parent().remove();	
		// app.list_item.splice
	}
	function cancelBiaya(val) {
		var id=$(val).prevAll()[1].value;
		if(id != ""){
			$(val).prevAll()[0].value = 1;
			$(val).parent().parent().addClass('hidden');
			$(val).parent().next().next().children().val(0);
			app.calculateTotal();

		}else{
			$(val).parent().parent().remove();
		}
	}

	$(document).on('blur', "[id^=qty_]", function(){
		app.calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		app.calculateTotal();
	});	
	$(document).on('blur', "[id^=biaya_]", function(){
		app.calculateTotal();
	});	
	
</script>