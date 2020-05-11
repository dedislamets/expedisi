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
        	$data['menu'] = $this->M_menu->getMenu(147,0,"","Class");
			$data['title'] = 'Profile';
			$data['main'] = 'profile/index';
			$data['js'] = 'script/profile';
			$data['modal'] = 'modal/class';
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

	
}
