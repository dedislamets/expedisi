<script type="text/javascript">
	var app = new Vue({
	    el: "#app",
	    mounted: function () {
	      this.loadHistory();
	    },
	    data: {
	      history: [],
	      productions: {
	        hd: [],
	        pe: [],
	        pp: []
	      },
	      overlay: false,
	      sortedID: [],
	      test: ''
	    },
	    methods: {
	    	loadHistory: function () {
		        var that = this;

		        jQuery.ajax({
		          type: "GET",
		          cache:false,
		          url: '<?= base_url() ?>Trace/getHistory',
		          data: {id: 1},
		          success: function(response) {          
		              that.history = response      
		          },
		        });
		      },
	    }
	})

	$( "#no" ).autocomplete({
      	source: function( request, response ) {
          $.ajax({
            url: "<?=base_url()?>trace/get_autocomplete",
            type: 'get',
            dataType: "json",
            data: {
              term: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          $('#no').val(ui.item.label);
          $('#id').val(ui.item.value).change(); 
          return false;
        }
    })

    $("#id").change(function(e, params){
		$.get('<?= base_url()?>trace/get', { id: $("#id").val() }, function(data){ 
				$("#nomor_spk").text(data['data']['spk_no']);
				$("#moda").text(data['moda']['moda_name'] + '-' + data['moda']['moda_kategori'] + '-' + data['moda']['moda_subkategori']);
				$("#project").text(data['data']['nama_project']);
				$("#tgl_routing").text(data['data_routing']['CreatedDate']);

				$("#attn_pengirim").text(data['data']['attn_pengirim']);
				$("#nama_pengirim").text(data['data']['pengirim']['cust_name']);
				$("#alamat_pengirim").text(data['data']['alamat_pengirim']);
				$("#kota_pengirim").text(data['data']['kota_pengirim']);
				$("#kec_pengirim").text(data['data']['kec_pengirim']);
				$("#zip_pengirim").text(data['data']['zip_pengirim']);
				$("#hp_pengirim").text(data['data']['hp_pengirim']);

				$("#attn_penerima").text(data['data']['attn_penerima']);
				$("#nama_penerima").text(data['data']['penerima']['cust_name']);
				$("#alamat_penerima").text(data['data']['alamat_penerima']);
				$("#kota_penerima").text(data['data']['kota_penerima']);
				$("#kec_penerima").text(data['data']['kec_penerima']);
				$("#zip_penerima").text(data['data']['zip_penerima']);
				$("#hp_penerima").text(data['data']['hp_penerima']);

		})
	})
</script>