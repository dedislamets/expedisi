<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
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
        	$live = $this->db->from('Province')		
				->get()
				->result();
			$recLogin = $this->session->userdata('user_id');
			$data['menu'] = $this->M_menu->getMenu($recLogin,0,"");
			$data['live'] = $live;	
			$data['title'] = 'Home';
			$data['main'] = 'home';
			$data['js'] = 'home/js';
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

	
}
