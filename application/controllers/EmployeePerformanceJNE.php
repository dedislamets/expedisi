<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EmployeePerformanceJNE extends CI_Controller {
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
        	$data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Position");
			$data['title'] = 'Performance Management';
			$data['main'] = 'performance/list-performance';
			$data['js'] = 'script/performance';
			$data['modal'] = 'modal/leave';

   //    $data_new_emp = array();
   //    $i=0;
   //    foreach($this->admin->getDetailPersonPerformance($this->session->userdata('user_id')) as $r) {
   //        $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
   //        if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
   //            $url = base_url() .'assets/profile/no-profile-copy.png' ; 
   //        }

   //        $data_new_emp[$i]['EmployeeId'] = $r->EmployeeId;
   //        $data_new_emp[$i]['url'] = $url;
   //        $data_new_emp[$i]['EmployeeName'] = $r->EmployeeName;
   //        $data_new_emp[$i]['LocationName'] = $r->LocationName;
   //        $data_new_emp[$i]['PositionStructural'] = $r->PositionStructural;
   //        $data_new_emp[$i]['StartDate'] = date("d M Y", strtotime($r->JoinDate));
   //        $data_new_emp[$i] = (object) $data_new_emp[$i];
   //        $i++;
   //    }
			// $data['new_employee'] = $data_new_emp;
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


          $start = date('Y-m-d'); 
          if(!empty($this->input->get('start')))
              $start= date("Y-m-d", strtotime($this->input->get('start')));
          
          $end = date('Y-m-d'); 
          if(!empty($this->input->get('end')))
              $end = date("Y-m-d", strtotime($this->input->get('end')));

          $books = $this->Datatabel->get_Performance($this->session->userdata('user_id'), $start, $end);

          $data = array();

          foreach($books->result() as $r) {
               $data[] = array(
                    '<a class="btn btn-block btn-sm" href="EmployeePerformanceJNE/detail?id='.$r->Recnum.'&start='. $start .'&end='. $end.'">
                        Detail
                      </a>',
                    $r->PerformanceStatus,
                    $r->EmployeeId,
                    $r->EmployeeName,
                    $r->StartDate,
                    $r->EndDate,
                    $r->Remark,
                    $r->IsColour,
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
            $data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Position");
            $data['title'] = 'Performance Management';
            $data['main'] = 'performance/performance-jne';
            $data['js'] = 'script/detail-performance-jne';
            $data['modal'] = 'modal/performance-jne';

            $id = $this->input->get('id');
            $start = $this->input->get('start');
            $end = $this->input->get('end');
            $data['id'] = $id; 

            $data_new_emp = array();
            $i=0;
            foreach($this->admin->getDetailPersonPerformance($this->session->userdata('user_id'), $start, $end, $id) as $r) {
              
                $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
                    $url = base_url() .'assets/profile/nophoto.jpg' ; 
                }

                $IdHead = $this->db->get_where('Employee', array('Recnum' => $r->RecnumHead1))->result();
                // print("<pre>".print_r($r,true)."</pre>");exit();
                $url_head = base_url() .'assets/profile/'. $IdHead[0]->EmployeeId .'.jpg' ; 
                if(!$this->admin->checkRemoteFile($IdHead[0]->EmployeeId .'.jpg')){
                    $url_head = base_url() .'assets/profile/nophoto.jpg' ; 
                }

                $data_new_emp[$i]['EmployeeId'] = $r->EmployeeId;
                $data_new_emp[$i]['url'] = $url;
                $data_new_emp[$i]['IsPeriod'] = $r->IsPeriod ;
                $data_new_emp[$i]['url_head'] = $url_head;
                $data_new_emp[$i]['JoinDate'] = date("d M Y", strtotime($r->joindate));
                $data_new_emp[$i]['EmployeeName'] = $r->EmployeeName;
                $data_new_emp[$i]['WorkingStatus'] = $r->WorkingStatus;
                $data_new_emp[$i]['Class'] = $r->Class;
                $data_new_emp[$i]['PositionStructural'] = $r->PositionStructural;
                $data_new_emp[$i]['PositionFunctional'] = $r->PositionFunctional;
                $data_new_emp[$i]['Organization'] = $r->Organization;
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
            $data['nilai'] = $this->admin->getmaster('NilaiKompetensiJNE');
            $data['evaluator'] = $this->admin->getmaster('Evaluator');
            $data['area'] = $this->admin->getmaster('Vf_FindAreaPerformance','',1);
            $data['priority'] = $this->admin->getmaster('Vf_FindPriority','',1);
            $data['task_status'] = $this->admin->getmaster('Vf_FindTaskStatus','',1);

            $row_data = $this->Datatabel->get_Function_id('Fn_ListPerformanceCompetencyJNE', $id);

            $data_competency = array();
            $i=0;
            foreach($row_data->result() as $r) {
                   $data_competency[$i]['Competency'] = $r->Competency;
                    $data_competency[$i]['IsWeight'] =  $r->IsWeight;
                    $data_competency[$i]['ScoreHead1'] =  $r->ScoreHead1;
                    $data_competency[$i]['ProofOfBehaviorHead1'] =  $r->ProofOfBehaviorHead1;
                    $data_competency[$i]['ScoreHead2'] =  $r->ScoreHead2;
                    $data_competency[$i]['ProofOfBehaviorHead2'] =  $r->ProofOfBehaviorHead2;
                    $data_competency[$i]['AverageScore'] =  $r->AverageScore;
                    $data_competency[$i]['Action'] =  '<button type="button" class="btnEdit btn btn-block btn-sm" onclick="editmodal_2(this)"  data-id="'.$r->RecnumCompetency.'">
                          Edit
                        </button> ';
                    $data_competency[$i] = (object) $data_competency[$i];
                    $i++;
              }
            $data['competency'] = $data_competency;

            $row_data = $this->Datatabel->get_KPM_Performance_JNE($id);
            $data_key = array();
            $i=0;
            foreach($row_data->result() as $r) {
                   $data_key[$i]['AreaPerformance'] = $r->AreaPerformance;
                    $data_key[$i]['IsDesc'] =  $r->IsDesc;
                    $data_key[$i]['IsTarget'] =  $r->IsTarget;
                    $data_key[$i]['WeightPercentage'] =  $r->WeightPercentage;
                    $data_key[$i]['DataSource'] =  $r->DataSource;
                    $data_key[$i]['CalculationMethod'] =  $r->CalculationMethod;
                    $data_key[$i]['IsActual'] =  $r->IsActual;
                    $data_key[$i]['Score'] =  $r->Score;
                    $data_key[$i]['IsCount'] =  $r->IsCount;
                    $data_key[$i]['Action'] =  '<button type="button" class="btnEdit btn btn-sm" onclick="editmodal(this)"  data-id="'.$r->Recnum.'">
                          Edit
                        </button> | <button type="button" class="btnHapus btn btn-sm btn-danger" onclick="removeList('.$r->Recnum.');" >
                          Delete
                        </button>';
                    $data_key[$i] = (object) $data_key[$i];
                    $i++;
              }
              $data['data_key'] = $data_key;

              $row_data = $this->Datatabel->get_Summary_Performance_JNE($id);
              $data_summary = array();
              $i=0;
              foreach($row_data->result() as $r) {
                    $data_summary[$i]['Aspek'] = $r->Aspek;
                    $data_summary[$i]['TotalBulan'] =  $r->TotalBulan;
                    $data_summary[$i]['Bobot'] =  $r->Bobot;
                    $data_summary[$i]['Nilai'] =  $r->Nilai;
                    $data_summary[$i]['TotalNilai'] =  $r->TotalNilai;
                    $data_summary[$i]['IsNo'] =  $r->IsNo;
                    $data_summary[$i]['IsCount'] =  $r->IsCount;
                
                    $data_summary[$i] = (object) $data_summary[$i];
                    $i++;
                }
              $data['summary'] = $data_summary;

              $row_data = $this->Datatabel->get_Function_id('Fn_ListCoaching', $id);
              $data_conseling = array();
              $i=0;
              foreach($row_data->result() as $r) {
                    $data_conseling[$i]['IsPeriod'] = $r->IsPeriod;
                    $data_conseling[$i]['DateOfCoaching'] =  $r->DateOfCoaching;
                    $data_conseling[$i]['TopikPembahasan'] =  $r->TopikPembahasan;
                    $data_conseling[$i]['FaktorDipertahankan'] =  $r->FaktorDipertahankan;
                    $data_conseling[$i]['FaktorDikembangkan'] =  $r->FaktorDikembangkan;
                    $data_conseling[$i]['PenyebabUtama'] =  $r->PenyebabUtama;
                    $data_conseling[$i]['RencanaAksiEvaluasi'] =  $r->RencanaAksiEvaluasi;
                    $data_conseling[$i]['Action'] =  '<button type="button" class="btnEdit btn btn-sm" onclick="editmodalconseling(this)"  data-id="'.$r->Recnum.'">
                          Edit
                        </button>';
                    $data_conseling[$i] = (object) $data_conseling[$i];
                    $i++;
                }
              $data['conseling'] = $data_conseling;

              $row_data = $this->Datatabel->get_Function_id('Fn_ListPerformanceTaskEmp', $id);
              $data_scheduler = array();
              $i=0;
              foreach($row_data->result() as $r) {
                    $data_scheduler[$i]['Task'] = $r->Task;
                    $data_scheduler[$i]['StartDate'] =  $r->StartDate;
                    $data_scheduler[$i]['EndDate'] =  $r->EndDate;
                    $data_scheduler[$i]['Priority'] =  $r->Priority;
                    $data_scheduler[$i]['CompletationDate'] =  $r->CompletationDate;
                    $data_scheduler[$i]['TaskStatus'] =  $r->TaskStatus;
                    $data_scheduler[$i]['Action'] =  '<button type="button" class="btnEdit btn btn-sm" onclick="editmodaltask(this)"  data-id="'.$r->Recnum.'">
                          Edit
                        </button> | <button type="button" class="btnHapus btn btn-sm btn-danger" onclick="removeListTask('.$r->Recnum.');" >
                          Delete
                        </button>';
                    $data_scheduler[$i] = (object) $data_scheduler[$i];
                    $i++;
                }
              $data['scheduler'] = $data_scheduler;

              $data['penc_aspek_kinerja'] = $this->admin->get_Function_id('Fn_ListPerformanceKPMTotalScore', $id);
              $data['penc_aspek_komp'] = $this->admin->get_Function_id('Fn_ListPerformanceCompetencyJNETotalScore', $id);
              $data['penc_summary'] = $this->admin->get_Function_id('Fn_TotalSummaryEmpPerformanceJNE', $id);
            // print("<pre>".print_r($data,true)."</pre>");exit();
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

        $row_data = $this->Datatabel->get_Function_id('Fn_ListPerformanceCompetencyJNE', 1);

        $data = array();

        foreach($row_data->result() as $r) {
               $data[] = array(
                    $r->Competency,
                    $r->IsWeight,
                    $r->ScoreHead1,
                    $r->ProofOfBehaviorHead1,
                    $r->ScoreHead2,
                    $r->ProofOfBehaviorHead2,
                    $r->AverageScore,
                    '<button type="button" class="btnEdit btn btn-block btn-sm" onclick="editmodal_2(this)"  data-id="'.$r->RecnumCompetency.'">
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
            'RecnumAreaPerformance' => $this->input->get('area_kinerja'),
            'IsTarget'          => format_data($this->input->get("IsTarget"), 'number'),
            'IsActual'          => format_data($this->input->get("IsActual"), 'number'),
            'DataSource'            => $this->input->get('DataSource'), 
            'Remark'            => $this->input->get('remark_kpm'),              
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
    public function SaveCoaching()
    {       
        
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'RecnumPeriod'            => $this->input->get('RecnumPeriod'),
            'DateOfCoaching'      => $this->input->get('DateOfCoaching'),
            'TopikPembahasan'     => $this->input->get('TopikPembahasan'),
            'FaktorDipertahankan' => $this->input->get('FaktorDipertahankan'),
            'FaktorDikembangkan'  => $this->input->get('FaktorDikembangkan'),
            'RencanaAksiEvaluasi' => $this->input->get('RencanaAksiEvaluasi'),
            'PenyebabUtama'       => $this->input->get('PenyebabUtama'),              
        );

        //print("<pre>".print_r($data,true)."</pre>");exit();

        $this->db->trans_begin();

        if($this->input->get('txtRecnumCoaching') != "") {
            $data['EditBy'] = $recLogin;
            $data['EditDate'] = date('Y-m-d');

            $this->db->set($data);
            $this->db->where('Recnum', $this->input->get('txtRecnumCoaching'));
            $result  =  $this->db->update('CoachingJNE');  

            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }else{
            $data['CreateBy'] = $recLogin;
            $data['CreateDate'] = date('Y-m-d');

            $result  = $this->db->insert('CoachingJNE', $data);
            
            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }

        $this->db->trans_complete();
                            
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    public function SaveCompetency()
    {       
        
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'RecnumEvaluator' => $this->input->get('evaluator'),
            'IsActual'        => $this->input->get('nilai'), 
            'Remark'        => $this->input->get('bukti_perilaku'),              
        );

        $this->db->trans_begin();

        if($this->input->get('txtRecnumCompetency') != "") {
            $data['EditBy'] = $recLogin;
            $data['EditDate'] = date('Y-m-d');

            $this->db->set($data);
            $this->db->where('Recnum', $this->input->get('txtRecnumCompetency'));
            $result  =  $this->db->update('PerformanceCompetency');  

            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }else{
            $data['CreateBy'] = $recLogin;
            $data['CreateDate'] = date('Y-m-d');

            $result  = $this->db->insert('PerformanceCompetency', $data);
            
            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }

        $this->db->trans_complete();
                            
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    public function SaveTask()
    {       
        $config['upload_path']="./assets/attach"; //path folder file upload
        $config['allowed_types']='pdf|doc|docx|jpg'; //type file yang boleh di upload
        $config['encrypt_name'] = FALSE; //enkripsi file name upload
        $config['overwrite'] = true;
        $image = '';
        $this->load->library('upload',$config); //call library upload 
        if($this->upload->do_upload("attach_file")){ //upload file
            $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
            $image= $data['upload_data']['file_name']; //set file name ke variable image

        }
        $response = [];
        $response['error'] = TRUE; 
        $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
        $recLogin = $this->session->userdata('user_id');
        $data = array(
            'RecnumEmpPerformance' => $this->input->post('txtIdGet'),
            'Task'        => $this->input->post('task'), 
            'StartDate'   => format_data($this->input->post('start_date'), 'date'), 
            'EndDate'     => format_data($this->input->post('end_date'), 'date'), 
            'RecnumPriority'   => $this->input->post('priority'), 
            'RecnumTaskStatus'   => $this->input->post('task_status'),
            'ReportType'   => $this->input->post('report_type'),
            'SubmissionMethod'   => $this->input->post('sub_method'),
            'CompletationDate'   => format_data($this->input->post('com_date'), 'date'),           
        );
        if(!empty($image))
          $data['AttachFile'] = $image;
        // $response['data']= $data;

        $this->db->trans_begin();

        if($this->input->post('txtRecnumTask') != "") {
            $data['EditBy'] = $recLogin;
            $data['EditDate'] = date('Y-m-d');

            $this->db->set($data);
            $this->db->where('Recnum', $this->input->post('txtRecnumTask'));
            $result  =  $this->db->update('PerformanceTaskEmp');  

            if(!$result){
                print("<pre>".print_r($this->db->error(),true)."</pre>");
            }else{
                $response['error']= FALSE;
            }
        }else{
            $data['CreateBy'] = $recLogin;
            $data['CreateDate'] = date('Y-m-d');

            $result  = $this->db->insert('PerformanceTaskEmp', $data);
            
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
    public function editConseling(){
        $id = $this->input->get('id'); 
        $data = $this->admin->getmaster('CoachingJNE',"Recnum=" . $id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function editCompetency(){
        $id = $this->input->get('id'); 
        $data = $this->admin->getmaster('PerformanceCompetency',"Recnum=" . $id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function editTask(){
        $id = $this->input->get('id'); 
        $data = $this->admin->getmaster('PerformanceTaskEmp',"Recnum=" . $id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function delete()
    {
        $response = [];
        $response['error'] = TRUE; 
        if($this->admin->deleteTable($this->input->post('txtRecnum'), 'PerformanceKPM' )){
          $response['error'] = FALSE;
        } 

        $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
    }
    public function deleteTask()
    {
        $response = [];
        $response['error'] = TRUE; 

        $data = $this->admin->getmaster('PerformanceTaskEmp',"Recnum=" . $this->input->post('txtRecnumTask'));
        // print("<pre>".print_r($data,true)."</pre>");exit();
        if($data){
          if(!empty($data[0]->AttachFile))
            unlink($_SERVER['DOCUMENT_ROOT'].'/assets/attach/'. $data[0]->AttachFile);
        }

        if($this->admin->deleteTable($this->input->post('txtRecnumTask'), 'PerformanceTaskEmp' )){
          $response['error'] = FALSE;
        } 

        $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
    }
}
