<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Leave extends CI_Controller {
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
        	$data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Position");
			$data['title'] = 'Leave Form';
			$data['main'] = 'tms/leave';
			$data['js'] = 'script/leave';
			$data['modal'] = 'modal/leave';
			$data['empadmin'] = $this->admin->getEmpAdmin();
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

	
    public function listLeave()
    {
    	$id = $this->input->get('id'); 
    	$row_data = $this->db->query("SELECT * from Fn_ListLeaveByPeriod (". $id .",'2019-07-08')")->result_array();
    	$data = [];
    	foreach($row_data as $key => $item)
		{										
			$row_data[$key]['Periode'] = date("d M Y", strtotime($row_data[$key]['StartDate'])) . " - " . date("d M Y", strtotime($row_data[$key]['EndDate']));
		}
    	
        $this->output->set_content_type('application/json')->set_output(json_encode($row_data));
    }
    public function ListEmp()
    {
    	$id = $this->input->get('id'); 
    	$row_data = $this->db->query("SELECT * from Fn_ListEmpByLeaveByPeriod (". $id .")")->result_array();
    	
    	
        $this->output->set_content_type('application/json')->set_output(json_encode($row_data));
    }

}
