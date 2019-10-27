<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EmployeePerformance extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
        $this->load->model('Datatabel');
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
        {
        	$data['menu'] = $this->M_menu->getMenu(147,0,"","Position");
			$data['title'] = 'Performance Development';
			$data['main'] = 'performance/list-performance';
			$data['js'] = 'script/performance';
			$data['modal'] = 'modal/leave';

            $data_new_emp = array();
            $i=0;
            foreach($this->admin->getNewEmployee() as $r) {
                $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
                    $url = base_url() .'assets/profile/no-profile-copy.png' ; 
                }

                $data_new_emp[$i]['EmployeeId'] = $r->EmployeeId;
                $data_new_emp[$i]['url'] = $url;
                $data_new_emp[$i]['EmployeeName'] = $r->EmployeeName;
                $data_new_emp[$i]['LocationName'] = $r->LocationName;
                $data_new_emp[$i]['PositionStructural'] = $r->PositionStructural;
                $data_new_emp[$i]['JoinDate'] = date("d M Y", strtotime($r->JoinDate));
                $data_new_emp[$i] = (object) $data_new_emp[$i];
                $i++;
            }
			$data['new_employee'] = $data_new_emp;
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

    public function dataTable()
    {

          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));


          $books = $this->Datatabel->get_Performance();

          $data = array();

          foreach($books->result() as $r) {
               $data[] = array(
                    '<a class="btn btn-block btn-sm" href="EmployeePerformance/detail?id='.$r->Recnum.'">
                        Detail
                      </a>',
                    $r->PerformanceStatus,
                    $r->EmployeeId,
                    $r->EmployeeName,
                    $r->StartDate,
                    $r->EndDate,
                    $r->Remark,
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

    public function detail()
    {       
        if($this->admin->logged_id())
        {
            $data['menu'] = $this->M_menu->getMenu(147,0,"","Position");
            $data['title'] = 'Performance Development';
            $data['main'] = 'performance/performance';
            $data['js'] = 'script/detail-performance';
            $data['modal'] = 'modal/leave';

            $data_new_emp = array();
            $i=0;
            foreach($this->admin->getDetailPersonPerformance($this->session->userdata('user_id')) as $r) {
                $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
                    $url = base_url() .'assets/profile/no-profile-copy.png' ; 
                }

                $url_head = base_url() .'assets/profile/'. $r->IdHead .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($r->IdHead .'.jpg')){
                    $url_head = base_url() .'assets/profile/no-profile-copy.png' ; 
                }

                $data_new_emp[$i]['EmployeeId'] = $r->EmployeeId;
                $data_new_emp[$i]['url'] = $url;
                $data_new_emp[$i]['url_head'] = $url_head;
                $data_new_emp[$i]['EmployeeName'] = $r->EmployeeName;
                $data_new_emp[$i]['WorkingStatus'] = $r->WorkingStatus;
                $data_new_emp[$i]['Class'] = $r->Class;
                $data_new_emp[$i]['PositionStructural'] = $r->PositionStructural;
                $data_new_emp[$i]['PositionFunctional'] = $r->PositionFunctional;
                $data_new_emp[$i] = (object) $data_new_emp[$i];
                $i++;
            }
            $data['detail'] = $data_new_emp;
            //$data['detail'] = $this->admin->getDetailPersonPerformance($this->session->userdata('user_id'));
            $cek_subordinat = $this->admin->getSubOrdinat($this->session->userdata('user_id'));


            $subordinat = array();
            $i=0;
            foreach($cek_subordinat as $r) {
                $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
                    $url = base_url() .'assets/profile/no-profile-copy.png' ; 
                }
                $subordinat[$i]['url'] = $url;
                $subordinat[$i] = (object) $subordinat[$i];
                $i++;
            }
            $data['subordinat'] = $subordinat;
            //print_r($data['subordinat']);exit();
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
    public function ListPerformanceKPM()
    {
    	
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));


        $row_data = $this->Datatabel->get_KPM($this->session->userdata('user_id'));

        $data = array();

        foreach($row_data->result() as $r) {
               $data[] = array(
                    $r->IsDesc,
                    $r->WeightPercentage,
                    $r->CalculationMethod,
                    $r->IsTarget,
                    $r->IsActual,
                    $r->Score,
                    $r->TotalScore,
                    $r->Remark,
               );
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $row_data->num_rows(),
                 "recordsFiltered" => $row_data->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();

    }

}
