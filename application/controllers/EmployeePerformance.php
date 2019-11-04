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
            $data['modal'] = 'modal/performance';

            $id = $this->input->get('id');
            $data['id'] = $id; 

            $data_new_emp = array();
            $i=0;
            foreach($this->admin->getDetailPersonPerformance($id) as $r) {
                $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
                    $url = base_url() .'assets/profile/nophoto.jpg' ; 
                }

                $IdHead = $this->db->get_where('Employee', array('Recnum' => $r->RecnumHead1))->result();
            
                $url_head = base_url() .'assets/profile/'. $IdHead[0]->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($IdHead[0]->EmployeeId .'.jpg')){
                    $url_head = base_url() .'assets/profile/nophoto.jpg' ; 
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
           
            $cek_subordinat = $this->admin->getSubOrdinat($this->session->userdata('user_id'));

            $subordinat = array();
            $i=0;
            foreach($cek_subordinat as $r) {
                $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
                    $url = base_url() .'assets/profile/nophoto.jpg' ; 
                }
                $subordinat[$i]['url'] = $url;
                $subordinat[$i] = (object) $subordinat[$i];
                $i++;
            }
            $data['subordinat'] = $subordinat;
            $data['keyperformancescore'] = $this->admin->getmaster('ScoreKeyPerformance');
            $data['keypercompetency'] = $this->admin->getmaster('ScoreCompetency');
            $data['calc'] = $this->admin->getmaster('CalculationMethod');
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

        $row_data = $this->Datatabel->get_KPM($this->input->get("id"));

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
                    '<button type="button" class="btnEdit btn btn-block btn-sm" onclick="editmodal(this)"  data-id="'.$r->Recnum.'">
                        Edit
                      </button>',
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

    public function ListCompetency()
    {
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $row_data = $this->Datatabel->get_Competency($this->input->get("id"));

        $data = array();

        foreach($row_data->result() as $r) {
               $data[] = array(
                    $r->Competency,
                    $r->CompetencyGroup,
                    $r->IsTarget,
                    $r->IsActual,
                    // $r->Gap,
                    '<button type="button" class="btnEdit btn btn-block btn-sm" onclick="editmodal_2(this)"  data-id="'.$r->Recnum.'">
                        Edit
                      </button>',
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
    public function ListSummaryPerformance()
    {
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $row_data = $this->Datatabel->get_Summary_Performance($this->input->get("id"));

        $data = array();

        foreach($row_data->result() as $r) {
               $data[] = array(
                    $r->Category,
                    $r->IsScore,
                    $r->IsWeight,
                    $r->TotalScore,
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
    public function ListSummaryCompetency()
    {
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $row_data = $this->Datatabel->get_Summary_Competency($this->input->get("id"));

        $data = array();

        foreach($row_data->result() as $r) {
               $data[] = array(
                    $r->Category,
                    $r->IsScore,
                    $r->IsWeight,
                    $r->TotalScore,
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

    public function ListSummary()
    {
        
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $row_data = $this->Datatabel->get_Summary($this->input->get("id"));

        $data = array();

        foreach($row_data->result() as $r) {
               $data[] = array(
                    $r->Category,
                    $r->IsScore,
                    $r->IsWeight,
                    $r->TotalScore,
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

    public function SaveKPR()
    {       
        
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'RecnumEmpPerformance'  => $this->input->get('id'),
            'IsDesc'                => $this->input->get('IsDesc'),
            'WeightPercentage'      => $this->input->get('WeightPercentage'),
            'RecnumCalculationMethod' => $this->input->get('calc'),
            'IsTarget'          => format_data($this->input->get("IsTarget"), 'number'),
            'IsActual'          => format_data($this->input->get("IsActual"), 'number'),
            'Remark'            => $this->input->get('remark'),              
        );

        //print("<pre>".print_r($data,true)."</pre>");exit();

        $this->db->trans_begin();

        if($this->input->get('txtRecnum') != "") {
            $data['EditBy'] = $recLogin;
            $data['EditDate'] = date('Y-m-d');

            $this->db->set($data);
            $this->db->where('Recnum', $this->input->get('txtRecnum'));
            $result  =  $this->db->update('PerformanceKPM');  

            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }else{
            $data['CreateBy'] = $recLogin;
            $data['CreateDate'] = date('Y-m-d');

            $result  = $this->db->insert('PerformanceKPM', $data);
            
            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }

        $this->db->trans_complete();
                            
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function edit(){
        $id = $this->input->get('id'); 
        $data = $this->admin->getmaster('PerformanceKPM',"Recnum=" . $id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}
