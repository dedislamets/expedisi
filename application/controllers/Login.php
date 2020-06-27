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
                    $password = $this->Acak($this->input->post('password', TRUE), "goldenginger");

                    //checking data via model
                    $checking = $this->admin->check_login('V_SecAccessGroup', array('PersonalMail' => $username), array('IsPassword' => $password), array('EmployeeId' => $username));

                    $data['setup'] = $this->admin->masterSetup();
                    // echo $checking; exit();
                    //jika ditemukan, maka create session
                    if (!empty($checking)) {
                        foreach ($checking as $apps) {
                            $session_data = array(
                                'user_id'   => $apps->RecnumEmployee,
                                'user_nik'  => $apps->EmployeeId,
                                'user_name' => $apps->EmployeeName,
                                'user_mail' => $apps->PersonalMail,
                                'posisi'    => $apps->PositionStructural,
                                'logo'      => $data['setup'][0]->Icon,
                                'app_name'  => $data['setup'][0]->AplicationName,
                            );
                            //set session userdata
                            $this->session->set_userdata($session_data);
                            // print("<pre>".print_r($session_data,true)."</pre>");exit();
                            redirect('home/');

                        }
                    }else{

                        $data['error'] = '<div class="alert alert-danger">
                            <div class="header"><b><i class="fa fa-exclamation-circle"></i></b> Username atau Password salah!</div></div>';
                        $this->load->view('login', $data);
                    }

                }else{
                    $data['setup'] = $this->admin->masterSetup();
                    $this->load->view('login', $data);
                }

            }

    }

    public function keluar()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    function TidakAcak($varMsg,$strKey) {
        try {
            $char_replace="";
            $Msg = $varMsg;
            $intLength = strlen($Msg);
            $intKeyLength = strlen($strKey);
            $intKeyOffset = $intKeyLength;
            $intLastChar = ord(substr($strKey, -1));
            

            for ($n=0; $n < $intLength ; $n++) { 
                $intKeyOffset = $intKeyOffset + 1;
                if($intKeyOffset > $intKeyLength) {
                    $intKeyOffset = 1;
                }
                $intAsc = ord(substr($Msg,$n, 1));

                if($intAsc > 32 && $intAsc < 127){
                    $intAsc = $intAsc - 32;
                    $intSkip = $n+1 % 94;
                    $intAsc = $intAsc - $intSkip;

                    if($intAsc < 1) {
                        $intAsc = $intAsc + 94;
                    }
                    $intAsc = $intAsc - $intLastChar;
                    while ( $intAsc < 1) {
                       $intAsc = $intAsc + 94;
                    }
                    $char_replace .= chr($intAsc + 32);
                    
                    $Msg = $char_replace . substr($varMsg, $n+1) ;
                    //$Msg = str_replace(substr($Msg, $n,1),chr($intAsc + 32), $Msg);
                    // echo $Msg . "-". chr($intAsc + 32) ."<br>";
                }
                $intLastChar = ord(substr($strKey, $intKeyOffset-1));
               
            }
            return $Msg;
        } catch (Exception $e) {
            echo $e;
        }
    }
    
     function Acak($varMsg,$strKey) {
        try {
            $Msg = $varMsg;
            $char_replace="";
            $intLength = strlen($Msg);
            $intKeyLength = strlen($strKey);
            $intKeyOffset = $intKeyLength;
            $intKeyChar = ord(substr($strKey, -1));
            for ($n=0; $n < $intLength ; $n++) { 
                $intKeyOffset = $intKeyOffset + 1;

                if($intKeyOffset > $intKeyLength) {
                    $intKeyOffset = 1;
                }
                $intAsc = ord(substr($Msg,$n, 1));

                if($intAsc > 32 && $intAsc < 127){
                    $intAsc = $intAsc - 32;
                    $intAsc = $intAsc + $intKeyChar;

                    while ( $intAsc > 94) {
                       $intAsc = $intAsc - 94;
                    }

                    $intSkip = $n+1 % 94;
                    $intAsc = $intAsc + $intSkip;
                    if($intAsc > 94){
                        $intAsc = $intAsc - 94;
                    }

                    $char_replace .= chr($intAsc + 32);
                    
                    $Msg = $char_replace . substr($varMsg, $n+1) ;
                }

                $intKeyChar = ord(substr($strKey, $intKeyOffset-1));
            }
            return $Msg;
        } catch (Exception $e) {
            
        }
    }
}