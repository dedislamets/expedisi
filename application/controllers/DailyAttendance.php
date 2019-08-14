<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DailyAttendance extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	    $this->load->model('Datatabel');
	   	$this->load->model('M_menu','',TRUE);
	   	$this->load->database();
	   	$this->load->library(array('cek_error'));  
     	ini_set('display_errors','on');  
     	ini_set("memory_limit","512M"); 
     	ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
		  ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');
     	error_reporting(E_ALL^E_NOTICE);
	}
	public function index()
	{		
		if($this->admin->logged_id())
    {
        	$data['menu'] = $this->M_menu->getMenu(147,0,"","Class");
    			$data['title'] = 'Daily Attendance';
    			$data['main'] = 'tms/dailyattendance';
    			$data['js'] = 'script/dailyattendance';
    			$data['modal'] = 'modal/dailyattendance';
		      $data['master_shift'] = $this->admin->getmaster('MasterShift');
          $data['absen_type'] = $this->admin->getmaster('AbsenType');
          $data['permit_type'] = $this->admin->getmaster('Permission');
          $data['location'] = $this->admin->getmaster('Location');
			   $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}
	public function datatabel()
	{

          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $start = date('Y-m-d'); 
          if(!empty($this->input->get('start')))
          	$start= date("Y-m-d", strtotime($this->input->get('start')));
        
          $end = date('Y-m-d'); 
          if(!empty($this->input->get('end')))
          	$end = date("Y-m-d", strtotime($this->input->get('end')));


          $absen_type = $this->input->get('absen_type');
          $shift_type = $this->input->get('shift_type');
          
          if($absen_type == 'null')
            $absen_type = '';
          if($shift_type == 'null')
            $shift_type = '';
          if(!empty($absen_type)){
            $absen_type = explode(",",$absen_type);
            $absen_type = "'" . implode("','", $absen_type) . "'";
          }
          if(!empty($shift_type)){
            $shift_type = explode(",",$shift_type);
            $shift_type = "'" . implode("','", $shift_type) . "'";
          }
          
          $advance = $this->input->get('advance');
          if(!empty($advance)){
            $advance = substr($advance, 0, -1);
            $advance = explode(";",$advance);
            $advance = "'" . implode("','", $advance) . "'";
          }

          $ot = ($this->input->get('ot')=='true' ? 1 : 0);
          $late = ($this->input->get('late')=='true' ? 1 : 0);
          $early = ($this->input->get('early')=='true' ? 1 : 0);
          $absen = ($this->input->get('absen')=='true' ? 1 : 0);
          $resign = ($this->input->get('resign')=='true' ? 1 : 0);
          
          $books = $this->Datatabel->get_daily_attendance($start,$end,$ot,$late,$early,$absen,$resign, $absen_type, $shift_type, $advance);

          $data = array();
          $x=1;
          foreach($books->result() as $r) {
               $data[] = array(
                    $x,
                    '<button class="btn btn-primary btn-xs" onclick="showModal(\''. $r->EmployeeId .'\')">
                        <i class="ace-icon fa fa-book  bigger-110 icon-only"></i>
                      </button><button class="btn btn-info btn-xs" onclick="showModal3(\''. $r->EmployeeId .'\')">
                        <i class="ace-icon fa fa-info-circle  bigger-110 icon-only"></i>
                      </button></button><button class="btn btn-warning btn-xs" onclick="showattendance(this);"">
                        <i class="ace-icon fa fa-pencil-square-o  bigger-110 icon-only"></i>
                      </button>',
                    $r->EmployeeId,
                    $r->EmployeeName,
                    $r->DateSchedule,
                    $r->ShiftCode,
                    $r->In1,
                    $r->Out1,
                    empty($r->HourIn) ? '1900-01-01 00:00:00' : $r->HourIn,
                    empty($r->HourOut) ? '1900-01-01 00:00:00' : $r->HourOut,
                    $r->AbsenTypeCode,
                    $r->Late,
                    $r->EarlyOut,
                    $r->OutOffice,
                    $r->RealOT,
                    $r->PointOT,
                    empty($r->StartBeforeWD) ? '1900-01-01 00:00:00' : $r->StartBeforeWD,
                    empty($r->EndBeforeWD) ? '1900-01-01 00:00:00' : $r->EndBeforeWD,
                    empty($r->StartAfterWD) ? '1900-01-01 00:00:00' : $r->StartAfterWD,
                    empty($r->EndAfterWD) ? '1900-01-01 00:00:00' : $r->EndAfterWD,
                    $r->StartHoliday,
                    $r->EndHoliday,
                    $r->TotalDailyAllowance,
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

  public function process()
  {
    $start= date("Y-m-d", strtotime($this->input->post('periode_start')));
    $end= date("Y-m-d", strtotime($this->input->post('periode_end')));
    
    // $config['upload_path']   = './uploaded_file/';
    // $config['allowed_types'] = 'doc|docx|xls|xlsx|pdf|zip|rar|jpg|jpeg';
    // $this->load->library('upload', $config);
           
    // if ( ! $this->upload->do_upload('file_nya')) {
    //     $data['error_upload'] = array('error' => $this->upload->display_errors());
    //     $this->session->set_userdata('status_upload',
    //     '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
    //     $data['error_upload']['error'].'</div>');
    // }else {
    //     $this->session->set_userdata('status_upload','<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>File berhasil diupload</div>');
                                               
    // }

    // redirect(base_url());
    $books = $this->Datatabel->get_list_day($start,$end);

    $startTime = time(); 
     
    $endTime = time() - $startTime; 
    header('Content-Length: '.strlen($endTime));

    $data = array();
    $x=1;
    foreach($books->result() as $r) {
      //$data[] = array($r->calc_date);
      $this->admin->execEmpProcessDaily($r->calc_date);  
      sleep(10);
      $response['success'] = true;
      echo json_encode($response);
    }

    
    

    //echo json_encode($data);
    exit();
  }

  public function progress()
  {   

    if (strlen(session_id()) === 0) {
        session_start();
    }

    if (isset($_SESSION['pros'])) {
        echo $_SESSION['pros'];

        if ($_SESSION['pros'] == $_SESSION['max']) {
            unset($_SESSION['pros']);
        }
    } else {
        echo '0';
        $_SESSION['pros']=0;
    }
  }
}
