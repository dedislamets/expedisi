<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class WorkingCalender extends CI_Controller {
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
			$data['title'] = 'Working Calender';
			$data['main'] = 'tms/workingcalender';
			$data['js'] = 'script/working_calender';
			$data['modal'] = 'modal/working_calender';
			$data['day_tipe'] = $this->admin->getmaster('DayType');		
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

	public function get_events()
  	{
		$start = $this->input->get("start");
		$end = $this->input->get("end");

     	$startdt = new DateTime('now'); 
     	$startdt->setTimestamp($start); 
     	$start_format = $startdt->format('Y-m-d H:i:s');

     	$enddt = new DateTime('now'); 
     	$enddt->setTimestamp($end); 
     	$end_format = $enddt->format('Y-m-d H:i:s');

     	$events = $this->admin->get_events($start_format, $end_format);

     	$data_events = array();

     	foreach($events->result() as $r) {

	       $data_events[] = array(
	         "id" 		=> $r->Recnum,
	         "title" 	=> empty($r->IsDesc) ? $r->tipe : $r->IsDesc,
	         "description" => $r->tipe,
	         "end" 		=> $r->EndDate,
	         "start" 	=> $r->StartDate,
	         "day_tipe" => $r->RecnumDayType,
	         "public" 	=> $r->IsPublic,
	         "className" =>  empty($r->Colour) ? 'label-success' : 'label-'. $r->Colour
	       );
     	}

     	echo json_encode(array("events" => $data_events));
     	exit();
   	}

   	public function add_event() 
    {
        $name = $this->input->post("day_tipe", TRUE);
        $desc = $this->input->post("name", TRUE);
        $start_date = $this->input->post("start_date", TRUE);
        $end_date = $this->input->post("end_date", TRUE);

         
        $sd = date("Y-m-d H:i:s",strtotime($start_date));           
        $start_date = $sd;           
   
        $end_date = date("Y-m-d H:i:s",strtotime($end_date));

       	$recLogin = $this->session->userdata('user_id');
       	$data = array(
			     "IsDesc" => $desc,
	        "RecnumDayType" => $name,
          "IsPublic" => ($this->input->post("IsPublic")== 'on' ? 1 : 0),
	        "StartDate" => $start_date,
	        "EndDate" => $end_date, 
		    );


        //print("<pre>".print_r($this->input->post("IsPublic"),true)."</pre>");
        if ($this->input->post("IsPublic") != 'on'){
          $this->db->from('CalenderParticipant');
          $this->db->where('RecnumCalenderEvent', $this->input->post('eventid'))->delete();
        }

       	if($this->input->post('eventid') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	  $this->db->where('Recnum', $this->input->post('eventid'));
		   	  $result  =  $this->db->update('CalenderEvent');	

        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('CalenderEvent', $data);
        }
           
       	redirect(site_url("WorkingCalender"));
    }

    public function getdata()
	{

          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Datatabel->get_personal_calendar($this->input->get("eventid"));

          $data = array();

          foreach($books->result() as $r) {
               $data[] = array(
                    '<td><input type="checkbox" name="selected_courses[]" value="'.$r->Recnum .'"></td>',
                    $r->EmployeeId,
                    $r->EmployeeName,
                    $r->NameOrganization,
                    
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

	public function getdata_participant()
	{

          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Datatabel->get_partisipant($this->input->get("eventid"));

          $data = array();

          foreach($books->result() as $r) {
               $data[] = array(
                    $r->EmployeeId,
                    $r->EmployeeName,
                    $r->NameOrganization,
                    $r->NameLocation,
                    "<a href='#' class='btn btn-danger btn-minier' data-id='" . $r->Recnum. "' onclick='hapusdata(this)'><i class='fa fa-trash'></i>&nbsp;Delete</a>"
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
	
	public function simpan_participant() 
    {
    	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";

       	$recLogin = $this->session->userdata('user_id');
       	
		$kode   = $this->input->get('empid');
	    $kode = str_replace(";",",",rtrim($kode,";"));
	    $kode = explode(",", $kode);

		try {
			$this->db->trans_begin();
			for ($i=0; $i < count($kode) ; $i++) { 
		    	unset($data);
			    $data = array(
			        "RecnumCalenderEvent" => $this->input->get('event'),
			        "RecnumEmployee" 	=> $kode[$i],
			        'CreateBy'			=> $recLogin,
				    'CreateDate'		=> date('Y-m-d'),
				);
				$result  = $this->db->insert('CalenderParticipant', $data);
				if(!$result){
		        	print("<pre>".print_r($this->db->error(),true)."</pre>");
		        	$this->db->trans_rollback();
		        }else{
		        	$response['error']= FALSE;
		        	$this->db->trans_complete();
		        }


		    }
		} catch (Exception $e) {
			$this->db->trans_rollback();
		}
	    
	    $this->output->set_content_type('application/json')->set_output(json_encode($response));  	
    }
}
