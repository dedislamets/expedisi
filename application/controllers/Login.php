<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
    }

    public function index()
    {

            if($this->admin->logged_id())
            {
                //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
                redirect("home");

            }else{

                //jika session belum terdaftar

                //set form validation
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                //set message form validation
                $this->form_validation->set_message('required', '<div class="alert alert-danger" >
                    <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

                //cek validasi
                if ($this->form_validation->run() == TRUE) {

                    //get data dari FORM
                    $username = $this->input->post("username", TRUE);
                    $password = $this->input->post('password', TRUE);

                    //checking data via model
                    $checking = $this->admin->check_login('V_SecAccessGroup', array('PersonalMail' => $username), array('IsPassword' => $password));

                    //jika ditemukan, maka create session
                    if ($checking != FALSE) {
                        foreach ($checking as $apps) {
                            $session_data = array(
                                'user_id'   => $apps->RecnumEmployee,
                                'user_nik'  => $apps->EmployeeId,
                                'user_name' => $apps->EmployeeName,
                                'user_mail' => $apps->PersonalMail,
                            );
                            //set session userdata
                            $this->session->set_userdata($session_data);

                            redirect('home/');

                        }
                    }else{

                        $data['error'] = '<div class="alert alert-danger">
                            <div class="header"><b><i class="fa fa-exclamation-circle"></i></b> Username atau Password salah!</div></div>';
                        $this->load->view('login', $data);
                    }

                }else{
                    $this->load->view('login');
                }

            }

    }

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}