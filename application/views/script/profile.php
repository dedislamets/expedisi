<script type="text/javascript">
	$(document).ready(function(){ 
		$.get("<?php echo base_url(); ?>PersonalAdministration/get_biodata",{id: "<?php echo $this->session->userdata('user_nik') ?>"}, function(data){   
            $("#recnumid").val(data['basic'][0]['Recnum']);
            $("#empid").text(data['basic'][0]['EmployeeId']);
            $("#empname").text(data['basic'][0]['EmployeeName']);
            $("#address").text((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PAddress']));
            $("#personal_mail").text(data['basic'][0]['PersonalMail']);
            if(data['basic'][0]['JoinDate'] != null){
                $("#join").val(moment(data['basic'][0]['JoinDate']).format('DD-MM-YYYY'));
            }
        })
	})
</script>