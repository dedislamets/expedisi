<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ScheduleGroup extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
	   	$this->load->model('Datatabel');
	   	$this->load->database();
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
    {
        	$data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Class");
    			$data['title'] = 'Schedule Group';
    			$data['main'] = 'tms/schedulegroup';
    			$data['js'] = 'script/schedulegroup';
    			$data['modal'] = 'modal/schedulegroup';
    			$data['group_shift'] = $this->admin->getmaster('GroupShift');
          $data['master_shift'] = $this->admin->getmaster('MasterShift');
          $data['pattern'] = $this->admin->getmaster('PatternSchedule');
          $data['shift_type'] = $this->admin->getmaster('ShiftType');		
          $data['day_type'] = $this->admin->getmaster('DayType'); 
          $data['ot'] = $this->admin->getmaster('OTValidation');   
    			$this->load->view('home',$data,FALSE); 

    }else{
        //jika session belum terdaftar, maka redirect ke halaman login
        redirect("login");

    }				  
						
	}

  

  public function getdata_schedule()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $books = $this->Datatabel->get_schedule_pattern();

    $data = array();
    $x=1;
    foreach($books->result() as $r) {
        
         $data[] = array(
              $x,
              $r->Code,
              "<a href='javascript:void(0)' onclick='editmodal(this)' class='patten-form'  data-id='". $r->Recnum ."'>".$r->IsDesc.' </a>',
              $r->RecnumShift1,
              $r->Formation1,
              $r->RecnumShift2,
              $r->Formation2,
              $r->RecnumShift3,
              $r->Formation3,
              $r->RecnumShift4,
              $r->Formation4,
              $r->RecnumShift5,
              $r->Formation5,
              $r->RecnumShift6,
              $r->Formation6,
              $r->RecnumShift7,
              $r->Formation7,
              $r->RecnumShift8,
              $r->Formation8,
         );
         $x++;
    }

    $output = array(
         "draw" => $draw,
           "recordsTotal" => $books->num_rows(),
           "recordsFiltered" => $books->num_rows(),
           "data" => $data
      );
    echo json_encode($output);
    exit();
  }
  public function edit(){
      $id = $this->input->get('id'); 
      $data = $this->admin->getPattern($id);
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  public function delete(){
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->delPattern($this->input->get('id'))){
      $response['error'] = FALSE;
    } 
                
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  public function add_schedule() 
  {
      $start_date = $this->input->post("start_date", TRUE);
      $end_date = $this->input->post("end_date", TRUE);

      $sd = date("Y-m-d H:i:s",strtotime($start_date));           
      $start_date = $sd;           
 
      $end_date = date("Y-m-d H:i:s",strtotime($end_date));

      $recLogin = $this->session->userdata('user_id');
      $data = array(
        "IsDesc"        => $this->input->post("pattern_name", TRUE),
        "Code"          => $this->input->post("pattern_code", TRUE),
        "RecnumShift1"  => filter_null($this->input->post("pattern1")) ,
        "Formation1"    => $this->input->post("total1", TRUE),
        "RecnumShift2"  => filter_null($this->input->post("pattern2")),
        "Formation2"    => $this->input->post("total2", TRUE),
        "RecnumShift3"  => filter_null($this->input->post("pattern3")),
        "Formation3"    => $this->input->post("total3", TRUE),
        "RecnumShift4"  => filter_null($this->input->post("pattern4")),
        "Formation4"    => $this->input->post("total4", TRUE),
        "RecnumShift5"  => filter_null($this->input->post("pattern5")),
        "Formation5"    => $this->input->post("total5", TRUE),
        "RecnumShift6"  => filter_null($this->input->post("pattern6")),
        "Formation6"    => $this->input->post("total6", TRUE),
        "RecnumShift7"  => filter_null($this->input->post("pattern7")),
        "Formation7"    => $this->input->post("total7", TRUE),
        "RecnumShift8"  => filter_null($this->input->post("pattern8")),
        "Formation8"    => $this->input->post("total8", TRUE),
        'StartDate'     => format_data($this->input->post('start_date'), 'date'),
        'EndDate'       => format_data($this->input->post('end_date'), 'date'),
      );
      
      //vdebug($data);

      if($this->input->post('id_schedule') != "") {
        $data['EditBy'] = $recLogin;
        $data['EditDate'] = date('Y-m-d');

        $this->db->set($data);
        $this->db->where('Recnum', $this->input->post('id_schedule'));
        $result  =  $this->db->update('PatternSchedule'); 

      }else{
        $data['CreateBy'] = $recLogin;
        $data['CreateDate'] = date('Y-m-d');
        $result  = $this->db->insert('PatternSchedule', $data);
        
      }
      
      redirect(site_url("ScheduleGroup"));
  }
}
