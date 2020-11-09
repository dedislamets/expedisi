<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Connote extends CI_Controller {
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
        	// $data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Class");
			$data['title'] = 'Entry Connote';
			$data['main'] = 'connote/index';
			$data['js'] = 'script/connote';
			// $data['modal'] = 'modal/class';	
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

	public function getItem()
    {
      	$data = [];
      	$parent_key = '1';
      	$sub = $this->input->get('sub')=='false' ? '0':'1'; 
      	$query = "select Recnum,IsDesc,ParentId,RecnumGolongan,RecnumGrade,RecnumRank,total from V_Class org
      		cross apply (
				select count(*) as total from [Fn_EmpClassTree] ('1','2019-01-01',recnum,".$sub.") 
			)x where 1=1  ";

		if($this->input->get('gol')!=0){
			$query .= "and RecnumGolongan='".$this->input->get('gol')."' ";
		}
		if($this->input->get('grade')!=0){
			$query .= "and RecnumGrade='".$this->input->get('grade')."' ";
		}
		if($this->input->get('rank')!=0){
			$query .= "and RecnumRank='".$this->input->get('rank')."' ";
		}

		$query .= "or Recnum=183";
      	$row = $this->db->query($query)->result_array();
      	//echo $this->db->last_query();
        foreach($row as $key => $item)
		{										
			$data[]= [ 		'id' => $item['Recnum'],
							'parent' => $item['ParentId']== 0 ? "#" : $item['ParentId'],
							'text'	=> $item['IsDesc'].' ('.$item['total'].')',							
						  ];
		}
   		
          echo json_encode($data);
    }
    public function SaveOrg()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
		    'RecnumGolongan' 		=> $this->input->get('igolAdd'),
		    'RecnumGrade' 		=> $this->input->get('igradeAdd'),
		    'RecnumRank' 		=> $this->input->get('irankAdd'),
		    'ParentId'			=> $this->input->get('parentIDAdd'),
		    'IsDesc'			=> $this->input->get('OrgNameAdd'),	
		    'StartDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeStartAdd')))),
		    'Sort'				=> $this->input->get('SortAdd'),
		    'MaxOT'				=> str_replace(",","",$this->input->get('maxOTAdd')),	
		    'CreateBy'			=> $recLogin,
		    'CreateDate'		=> date('Y-m-d'),	        		        
		);

		if(!empty($this->input->get('dateRangeEndAdd'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEndAdd'))));
		}
		if(!empty($this->input->get('isActiveAdd'))){
			$data['isActive'] = TRUE;
		}
		if(!empty($this->input->get('isOTAdd'))){
			$data['isOT'] = TRUE;
		}
		if(!empty($this->input->get('isPresentAdd'))){
			$data['AlwaysPresent'] = TRUE;
		}

		$this->db->insert('Class', $data);
		//echo $this->db->last_query();
	  	$lastid = $this->db->insert_id();

	  	if($lastid !=null){
	  		$response['error']= FALSE;
	  		$response['id']= $lastid;
	  		
	  	}
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function UpdateOrg()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
		    'RecnumGolongan' 		=> $this->input->get('igolEdit'),
		    'RecnumGrade' 		=> $this->input->get('igradeEdit'),
		    'RecnumRank' 		=> $this->input->get('irankEdit'),
		    'ParentId'			=> $this->input->get('parentIDEdit'),
		    'IsDesc'			=> $this->input->get('OrgNameEdit'),	
		    'StartDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeStartEdit')))),
		    'Sort'				=> $this->input->get('SortEdit'),
		    'MaxOT'				=> str_replace(",","",$this->input->get('maxOTEdit')),	
		    'EditBy'			=> $recLogin,
		    'EditDate'		=> date('Y-m-d'),	        		        
		);

		if(!empty($this->input->get('dateRangeEndEdit'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEndEdit'))));
		}
		if(!empty($this->input->get('isActiveEdit'))){
			$data['isActive'] = TRUE;
		}
		if(!empty($this->input->get('isOTEdit'))){
			$data['isOT'] = TRUE;
		}
		if(!empty($this->input->get('isPresentEdit'))){
			$data['AlwaysPresent'] = TRUE;
		}

		$this->db->where('Recnum', $this->input->get('Recnum'));
        $this->db->update('Class',$data);

        //echo $this->db->last_query();

	  	if ($this->db->affected_rows() > 0){
	  		$response['error']= FALSE;
	  		
	  	}
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function EditOrg()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$data['data'] = $this->admin->getClassEditOrg($this->input->get('id'));	
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function DelOrg(){
		$response = [];
		$response['error'] = TRUE; 
		if($this->admin->delClassOrg($this->input->get('id'))){
			$response['error'] = FALSE;
		}	
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
