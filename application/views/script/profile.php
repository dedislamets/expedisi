<script type="text/javascript">
	$(document).ready(function(){ 
		$.get("<?php echo base_url(); ?>PersonalAdministration/get_biodata",{id: "<?php echo $this->session->userdata('user_nik') ?>"}, function(data){   
            $("#recnumid").val(data['basic'][0]['Recnum']);
            $("#empid").text(data['basic'][0]['EmployeeId']);
            $("#empname").text(data['basic'][0]['EmployeeName']);
            $("#address").text((typeof data['address'][0]== 'undefined' ? '' : data['address'][0]['PAddress']));
            $("#personal_mail").text(data['basic'][0]['PersonalMail']);
            $("#office_mail").text(data['basic'][0]['OfficeMail']);
            $("#hp").text(data['basic'][0]['Handphone']);
            if(data['basic'][0]['JoinDate'] != null){
                $("#join").val(moment(data['basic'][0]['JoinDate']).format('DD-MM-YYYY'));
            }
        })

        $('#btnPassword').on('click', function (event) {
            showloader('body');
            
            $('#ModalAdd').modal({backdrop: 'static', keyboard: false}) ;

            hideloader();
        });

        $('#btnSubmit').on('click', function () {
            var valid = false;
            var sParam = $('#Form').serialize()+ "&id="+ $("#txtID").val();
            var validator = $('#Form').validate({
                                rules: {
                                        password: {
                                            required: true
                                        },
                                        last_password: {
                                            required: true
                                        },
                                        ulangi_password: {
                                            required: true
                                        },
                                          
                                    }
                                });
            validator.valid();
            $status = validator.form();
            if($status) {
                var link = 'Profile/update';
                $.post(link,sParam, function(data){
                    if(data.error==false){                                  
                        Swal.fire({ title: "Berhasil disimpan..!",
                           text: "",
                           timer: 2000,
                           showConfirmButton: false,
                           onClose: () => {
                            window.location.reload();
                          }
                        });
                    }else{  
                        $("#lblMessage").remove();
                        $("<div id='lblMessage' class='alert alert-danger' style='display: inline-block;float: left;width: 68%;padding: 10px;text-align: left;'><strong><i class='ace-icon fa fa-times'></i> "+data.msg+"!</strong></div>").appendTo(".modal-footer");
                                                                        
                    }
                },'json');
            }
        });
	})
</script>