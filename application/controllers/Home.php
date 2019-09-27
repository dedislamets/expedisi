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
			$data['dashboard_category'] = $this->admin->getmaster('Vf_FindDashboardCategory','',1);
			$data['category_period'] = $this->admin->getmaster('Vf_FindDashboardPeriod','',1);
			$data['jenis'] = $this->admin->getmaster('DashboardType');
			$data['payroll_period'] = $this->admin->getmaster('Vf_PeriodPayroll','',1);
			//$data['policy'] = $this->admin->getmaster('Fn_DashboardLeaveEmployees ');
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

    public function generateDashboard(){

    	$start = date('Y-m-d'); 
        if(!empty($this->input->get('start')))
        	$start= date("Y-m-d", strtotime($this->input->get('start')));
        
        $end = date('Y-m-d'); 
        if(!empty($this->input->get('end')))
        	$end = date("Y-m-d", strtotime($this->input->get('end')));

    	$row_data = $this->db->query("SELECT * from DashboardType WHERE Recnum='". $this->input->get('recnum') ."'")->result_array();
    	$query = $row_data[0]['IsQuery'];
    	$title = $row_data[0]['IsDesc'];
    	$query = str_replace('@RecnumEmployee', $this->session->userdata('user_id'), $query);
    	$query = str_replace('@StartDate', "'".$start. "'", $query);
    	$query = str_replace('@EndDate', "'". $end . "'", $query);
    	$data_column = $this->db->query($query)->result_array();
    	$arr_data = [];
    	$arr_data['judul'] = $title;
    	$arr_data['data'] = [];
    	foreach($data_column as $k => $value) {
            if(!empty($data_column[$k]['IsDesc'])) {
               array_push($arr_data['data'], $data_column[$k]);
            }
        }
    	$this->output->set_content_type('application/json')->set_output(json_encode($arr_data));
    }
    public function getPeriode(){
    	$id = $this->input->get('id');
    	$this->output->set_content_type('application/json')->set_output(json_encode($this->admin->getmaster('Period', 'Recnum=' . $id)));
    }
	
}
