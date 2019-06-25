<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MasterShiftTime extends CI_Controller {
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
        	$data['menu'] = $this->M_menu->getMenu(147,0,"","Class");
    			$data['title'] = 'Master Shift Time';
    			$data['main'] = 'tms/shifttime';
    			$data['js'] = 'script/shifttime';
    			$data['modal'] = 'modal/shifttime';
    			$data['group_shift'] = $this->admin->getmaster('GroupShift');
          $data['shift_type'] = $this->admin->getmaster('ShiftType');		
          $data['day_type'] = $this->admin->getmaster('DayType'); 
          $data['master_shift'] = $this->admin->getmaster('MasterShift'); 
          $data['class'] = $this->admin->getmaster('Class'); 
          $data['ot'] = $this->admin->getmaster('OTValidation');   
          $data['working_status'] = $this->admin->getmaster('WorkingStatus'); 
          $data['component_salary'] = $this->admin->getmaster('ComponentSalary'); 
    			$this->load->view('home',$data,FALSE); 

    }else{
        //jika session belum terdaftar, maka redirect ke halaman login
        redirect("login");

    }				  
						
	}

	public function getdata()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $books = $this->Datatabel->get_shift_name($this->input->get('eventid'));

    $data = array();

    foreach($books->result() as $r) {
        
         $data[] = array(
              "<button class='btn btn-xs btn-primary shift'  data-id='". $r->Recnum ."' onclick='working_sch(this)'>Standar Working</button>",
              $r->Code,
              "<a href='javascript:void(0)'  data-id='". $r->Recnum ."' onclick='modalshift(this)'>".$r->IsDesc.' </a>',
              $r->validasiname,
              $r->DayNames,
              $r->ShiftTypeNames
         );
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
  public function getdata_standart()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $books = $this->Datatabel->get_standard_working($this->input->get('shift'));

    $data = array();

    foreach($books->result() as $r) {
        
         $data[] = array(

              "<a href='javascript:void(0)' onclick='modalDayWorking(this)' data-id='". $r->Recnum ."' data-shift='". $this->input->get('shift') ."'>".$r->IsDay.' </a>',
              "<button class='btn btn-xs btn-warning working-sch'  data-id='". $r->Recnum ."' onclick='showrest(this)'>Rest</button>",
              $r->In1,
              $r->Out1,
              $r->EarlyOutTolerance,
              $r->LateTolerance,
              $r->WorkingHour,
              $r->DayNames,
              $r->sort_day
         );
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

  public function getdata_rest()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $books = $this->Datatabel->get_rest($this->input->get('time'));

    $data = array();

    foreach($books->result() as $r) {
        
         $data[] = array(
              $r->StartTime,
              $r->EndTime,
              $r->Total,
              $r->DeductWorkingHour,
              $r->RestFor,
              "<button class='btn btn-xs btn-warning'  data-id='". $r->Recnum ."' onclick='showrest(this)'><i class='ace-icon fa fa-pencil'></i></button><button class='btn btn-xs btn-danger'  data-id='". $r->Recnum ."' onclick='showrest(this)'><i class='ace-icon fa fa-trash-o'></i></button>",
         );
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
  public function getdata_attendance_allowance()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $books = $this->Datatabel->get_attendance_allowance($this->input->get('class'));

    $data = array();
    $no=0;
    foreach($books->result() as $r) {
        $no++;
         $data[] = array(
              $no,
              $r->TotalAbsence,
              number_format($r->Allowance),
              date("Y-m-d",strtotime($r->StartDate)),
              (empty($r->EndDate)? '' : date("Y-m-d",strtotime($r->EndDate)) ),              
              "<button type='button' class='btn btn-xs btn-warning'  data-id='". $r->Recnum ."' onclick='showAttendanceAllowance(this)'><i class='ace-icon fa fa-pencil'></i></button><button type='button' class='btn btn-xs btn-danger'  data-id='". $r->Recnum ."' onclick='deleteAttendanceAllowance(this)'><i class='ace-icon fa fa-trash-o'></i></button>",
         );
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

  public function getdata_class_allowance()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $books = $this->Datatabel->get_class_allowance($this->input->get('class'));

    $data = array();
    $no=0;
    foreach($books->result() as $r) {
        $no++;
         $data[] = array(
              $no,
              $r->IsDesc,
              number_format($r->Allowance),
              date("Y-m-d",strtotime($r->StartDate)),
              (empty($r->EndDate)? '' : date("Y-m-d",strtotime($r->EndDate)) ),              
              "<button type='button' class='btn btn-xs btn-warning'  data-id='". $r->Recnum ."' onclick='showAttendanceClass(this)'><i class='ace-icon fa fa-pencil'></i></button><button type='button' class='btn btn-xs btn-danger'  data-id='". $r->Recnum ."' onclick='deleteAttendanceClass(this)'><i class='ace-icon fa fa-trash-o'></i></button>",
         );
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
  public function getdata_working_status()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $books = $this->Datatabel->get_working_status($this->input->get('ws'));

    $data = array();
    $no=0;
    foreach($books->result() as $r) {
        $no++;
         $data[] = array(
              $no,
              $r->IsDesc,
              date("Y-m-d",strtotime($r->StartDate)),
              (empty($r->EndDate)? '' : date("Y-m-d",strtotime($r->EndDate)) ),              
              "<button type='button' class='btn btn-xs btn-warning'  data-id='". $r->Recnum ."' onclick='showOvertime(this)'><i class='ace-icon fa fa-pencil'></i></button><button type='button' class='btn btn-xs btn-danger'  data-id='". $r->Recnum ."' onclick='deleteOvertime(this)'><i class='ace-icon fa fa-trash-o'></i></button>",
         );
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

  public function getdata_schedule()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));

    $books = $this->Datatabel->get_schedule_pattern($this->input->get('eventid'));

    $data = array();

    foreach($books->result() as $r) {
        
         $data[] = array(
              "<button class='btn btn-xs btn-primary shift'  data-id='". $r->Recnum ."' onclick='working_sch(this)'>Standar Working</button>",
              $r->Code,
              "<a href='javascript:void(0)'  data-id='". $r->Recnum ."'>".$r->IsDesc.' </a>',
              $r->validasiname,
              $r->DayNames,
              $r->ShiftTypeNames
         );
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

  public function add_group_shift() 
  {
      $name = $this->input->post("id_group", TRUE);
      $desc = $this->input->post("name", TRUE);
      $start_date = $this->input->post("start_date", TRUE);
      $end_date = $this->input->post("end_date", TRUE);

       
      $sd = date("Y-m-d H:i:s",strtotime($start_date));           
      $start_date = $sd;           
 
      $end_date = date("Y-m-d H:i:s",strtotime($end_date));

      $recLogin = $this->session->userdata('user_id');
      $data = array(
        "IsDesc" => $desc,
      );

      if($this->input->post('id_group') != "") {
        $data['EditBy'] = $recLogin;
        $data['EditDate'] = date('Y-m-d');

        $this->db->set($data);
        $this->db->where('Recnum', $this->input->post('id_group'));
        $result  =  $this->db->update('GroupShift'); 

      }else{
        $data['CreateBy'] = $recLogin;
        $data['CreateDate'] = date('Y-m-d');

        $result  = $this->db->insert('GroupShift', $data);
      }
         
      redirect(site_url("MasterShiftTime"));
  }

  public function del_group_shift(){
    $response = [];
    $response['error'] = TRUE; 

    $this->db->from('GroupShift');
    $this->db->where('Recnum', $this->input->get('id'))->delete();
    if ($this->db->affected_rows() <= 0){
        $response['error'] = FALSE;
    }
                
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function add_shift() 
  {
      $start_date = $this->input->post("start_date", TRUE);
      $end_date = $this->input->post("end_date", TRUE);

      $sd = date("Y-m-d H:i:s",strtotime($start_date));           
      $start_date = $sd;           
 
      $end_date = date("Y-m-d H:i:s",strtotime($end_date));

      $recLogin = $this->session->userdata('user_id');
      $data = array(
        "IsDesc"        => $this->input->post("shift_name", TRUE),
        "Code"          => $this->input->post("shift_code", TRUE),
        "RecnumGroupShift"      => filter_null($this->input->post("shift")) ,
        "RecnumShiftType"       => filter_null($this->input->post("shift_type")),
        "RecnumDayType"         => filter_null($this->input->post("day_type")),
        "RecnumOTValidation"    => filter_null($this->input->post("otVal")),
        "OTAuto"                => filter_null($this->input->post("OTAuto")),
        "StatusHoliday"         => format_data($this->input->post("isHoliday"), 'switch'),
        "LateMinusOT"           => format_data($this->input->post('LMO'), 'switch'),
        "EarlyOutMinusOT"       => format_data($this->input->post("EOMO"), 'switch'),
      );

      if($this->input->post('id_shift') != "") {
        $data['EditBy'] = $recLogin;
        $data['EditDate'] = date('Y-m-d');

        $this->db->set($data);
        $this->db->where('Recnum', $this->input->post('id_shift'));
        $result  =  $this->db->update('MasterShift'); 

      }else{
        $data['CreateBy'] = $recLogin;
        $data['CreateDate'] = date('Y-m-d');
        $result  = $this->db->insert('MasterShift', $data);
        
      }
      
      redirect(site_url("MasterShiftTime"));
  }

  public function add_time() 
  {
      $start_date = $this->input->post("start_date", TRUE);
      $end_date = $this->input->post("end_date", TRUE);

      $sd = date("Y-m-d H:i:s",strtotime($start_date));           
      $start_date = $sd;           
 
      $end_date = date("Y-m-d H:i:s",strtotime($end_date));

      $recLogin = $this->session->userdata('user_id');
      $data = array(
      
        "WorkingHour"     => filter_null($this->input->post("TH")),
        "ReturnOtAuto"    => filter_null($this->input->post("ROTAuto")),
        "In1"             => format_data($this->input->post("in"), 'time'),
        "Out1"            => format_data($this->input->post('out'), 'time'),
        "LateTolerance"   => format_data($this->input->post("mandat"), 'time'),
        "EarlyOutTolerance"  => format_data($this->input->post("mandat1"), 'time'),
      );

      if($this->input->post('id_time') != "") {
        $data['EditBy'] = $recLogin;
        $data['EditDate'] = date('Y-m-d');

        $this->db->set($data);
        $this->db->where('Recnum', $this->input->post('id_time'));
        $result  =  $this->db->update('MasterTime'); 

      }else{
        $data['CreateBy'] = $recLogin;
        $data['CreateDate'] = date('Y-m-d');
        $result  = $this->db->insert('MasterTime', $data);
        
      }
      
      redirect(site_url("MasterShiftTime"));
  }

  public function editshift(){
      $id = $this->input->get('id'); 
      $data = $this->admin->getShift($id);
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function editallowanceattendance(){
      $id = $this->input->get('id'); 
      $data = $this->admin->getTable($id, 'AttendancePerClass');
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  public function editallowanceclass(){
      $id = $this->input->get('id'); 
      $data = $this->admin->getTable($id, 'ShiftPerClass');
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  public function editovertime(){
      $id = $this->input->get('id'); 
      $data = $this->admin->getTable($id, 'OvertimeComponent');
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function edittime(){
      $id = $this->input->get('id'); 
      $data = $this->admin->getTime($id);
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function deleteshift(){
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->delShift($this->input->get('id'))){
      $response['error'] = FALSE;
    } 
                
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  public function deleteAttendanceAllowance(){
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->deleteTable($this->input->get('id'),'AttendancePerClass')){
      $response['error'] = FALSE;
    } 
                
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  public function deleteAttendanceClass(){
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->deleteTable($this->input->get('id'),'ShiftPerClass')){
      $response['error'] = FALSE;
    } 
                
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function deleteOvertime(){
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->deleteTable($this->input->get('id'),'OvertimeComponent')){
      $response['error'] = FALSE;
    } 
                
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function SaveAllowance()
  {   
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array(
      'RecnumClass'  => $this->input->get('kelas'),
      'TotalAbsence'  => $this->input->get('total_absen'),
      'Allowance'     => $this->input->get('allowance_attendance')                     
    );

    if(!empty($this->input->get('start_date'))){
      $data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('start_date'))));
    }
    if(!empty($this->input->get('end_date'))){
      $data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('end_date'))));
    }


    if($this->input->get('id_allow') != "") {
      $data['EditBy'] = $recLogin;
      $data['EditDate'] = date('Y-m-d');

      $this->db->set($data);
      $this->db->where('Recnum', $this->input->get('id_allow'));
      $result  =  $this->db->update('AttendancePerClass'); 
      if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
        $response['error']= FALSE;
      }

    }else{
      $data['CreateBy'] = $recLogin;
      $data['CreateDate'] = date('Y-m-d');
      $result  = $this->db->insert('AttendancePerClass', $data);
      if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
        $response['error']= FALSE;
      }
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function SaveAttendanceClass()
  {   
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array(
      'RecnumClass'  => $this->input->get('kelas_class'),
      'RecnumMasterShift'  => $this->input->get('shift_class'),
      'Allowance'     => $this->input->get('allowance_attendance_class')                     
    );

    if(!empty($this->input->get('start_date_class'))){
      $data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('start_date_class'))));
    }
    if(!empty($this->input->get('end_date_class'))){
      $data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('end_date_class'))));
    }


    if($this->input->get('id_att_class') != "") {
      $data['EditBy'] = $recLogin;
      $data['EditDate'] = date('Y-m-d');

      $this->db->set($data);
      $this->db->where('Recnum', $this->input->get('id_att_class'));
      $result  =  $this->db->update('ShiftPerClass'); 
      if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
        $response['error']= FALSE;
      }

    }else{
      $data['CreateBy'] = $recLogin;
      $data['CreateDate'] = date('Y-m-d');
      $result  = $this->db->insert('ShiftPerClass', $data);
      if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
        $response['error']= FALSE;
      }
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function SaveOvertime()
  {   
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array(
      'RecnumWorkingStatus'  => $this->input->get('select_working'),
      'RecnumComponentSalary'  => $this->input->get('component_salary'),           
    );

    if(!empty($this->input->get('start_date_overtime'))){
      $data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('start_date_overtime'))));
    }
    if(!empty($this->input->get('end_date_overtime'))){
      $data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('end_date_overtime'))));
    }


    if($this->input->get('id_overtime') != "") {
      $data['EditBy'] = $recLogin;
      $data['EditDate'] = date('Y-m-d');

      $this->db->set($data);
      $this->db->where('Recnum', $this->input->get('id_overtime'));
      $result  =  $this->db->update('OvertimeComponent'); 
      if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
        $response['error']= FALSE;
      }

    }else{
      $data['CreateBy'] = $recLogin;
      $data['CreateDate'] = date('Y-m-d');
      $result  = $this->db->insert('OvertimeComponent', $data);
      if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
        $response['error']= FALSE;
      }
    }

    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
