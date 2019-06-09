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
          $data['class'] = $this->admin->getmaster('Class'); 
          $data['ot'] = $this->admin->getmaster('OTValidation');   
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
  public function getdata_standart()
  {

    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));


    $books = $this->Datatabel->get_standard_working($this->input->get('shift'));

    $data = array();

    foreach($books->result() as $r) {
        
         $data[] = array(

              "<a href='javascript:void(0)'  data-id='". $r->Recnum ."'>".$r->IsDay.' </a>',
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
}
