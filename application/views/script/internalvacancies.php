<script type="text/javascript">
	$.ajaxSetup({
        data: {
            csrf_token: <?php echo "'". $this->security->get_csrf_hash()."'" ?>
        }
    });     
	$(".btn-view-more").on('click', function()
  	{
	    var judul = $(this).text().trim();

	    $.get("<?php echo base_url(); ?>InternalVacancies/getKontenVacancy",{recnum: $(this).data('id')  }, function(data){
	      //bootboxmodal(judul, data[0]['RemarkJobDescription'] + data[0]['RemarkQualification']);
	      $("#title-vacancies").text(data[0]['PositionStructural']);
	      $(".jobdesc").html(data[0]['RemarkJobDescription']);
	      $("#title-location").html(data[0]['Location']);
	      $(".qualification").html(data[0]['RemarkQualification']);
	      $('#ModalVacancies').modal({backdrop: 'static', keyboard: false}) ;
	    });
  	});
</script>