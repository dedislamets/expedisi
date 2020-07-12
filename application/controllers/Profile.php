<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
        {
        	$data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Class");
			$data['title'] = 'Profile';
			$data['main'] = 'profile/index';
			$data['js'] = 'script/profile';
			$data['modal'] = 'modal/profile';
			$data['gol'] = $this->admin->getgolongan();	
			$data['grade'] = $this->admin->getgrade();
			$data['rank'] = $this->admin->getrank();
			$data['org'] = $this->admin->getClassParentOrg();	
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

	public function update()
    {
        
    	$username = $this->session->userdata('user_nik');
        $password = $this->Acak($this->input->post('last_password', TRUE), "goldenginger");

        $login_tbl  = $this->admin->get('V_SecAccessGroup', array('EmployeeId' => $username));
        // print("<pre>".print_r($password,true)."</pre>");exit();
        if($password !== $login_tbl[0]->IsPassword){
            $response['error'] = TRUE;
            $response['msg'] = "Password lama anda tidak cocok!!";
        }elseif ($this->input->post('password') !== $this->input->post('ulangi_password')) {
            $response['error'] = TRUE;
            $response['msg'] = "Password baru anda tidak cocok dengan ulangi password!!";
        }else{

            $new_password = $this->Acak($this->input->post('ulangi_password', TRUE), "goldenginger");
            $data = array(
          		'IsPassword'  => $new_password
          	);

            $this->db->set($data);
	        $this->db->where('RecnumEmployee', $this->session->userdata('user_id'));
	        $result  =  $this->db->update('SecAccessGroup'); 
            
            if(!$result){
	            $response['error']= TRUE;
	            $response['msg'] = $this->db->error();
	        }else{
	            $response['error']= FALSE;
	            $response['msg'] = "sukses";
	        }
        }
    	
    	$this->output->set_content_type('application/json')->set_output(json_encode($response));
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
