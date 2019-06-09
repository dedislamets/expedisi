<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Position extends CI_Controller {
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
        	$data['menu'] = $this->M_menu->getMenu(147,0,"","Position");
			$data['title'] = 'Position Structure';
			$data['main'] = 'organization/position';
			$data['js'] = 'script/position';
			$data['modal'] = 'modal/position';
			$data['org'] = $this->admin->getPosParentOrg(1,1);	
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
      	$row = $this->db->query("select Recnum,PositionId,PositionName,ParentId,Positiontype,total from V_Position org
      		cross apply (
				select count(*) as total from [Fn_EmpPositionTree] ('1','2019-01-01',recnum,".$sub.") 
			)x where Positiontype='".$this->input->get('jenis')."' or Recnum=23")->result_array();
        foreach($row as $key => $item)
		{										
			$data[]= [ 		'id' => $item['Recnum'],
							'parent' => $item['ParentId']== 0 ? "#" : $item['ParentId'],
							'text'	=> $item['PositionName']	.'- '.$item['PositionId'].' ('.$item['total'].')',							
						  ];
		}
   		
          echo json_encode($data);
    }
    public function getEmployeeOrg()
    {
    	$recnumEmployee = $this->input->get('id'); 
    	$sub = $this->input->get('sub')=='false' ? '0':'1'; 
    	if($this->input->get('_search')== 'true'){
    		$filter = json_decode($this->input->get('filters'));
   	
    		$row = $this->db->query("SELECT EmployeeId,EmployeeName,NameOrganization as Section,NamePositionStructural as Position, NameWorkingStatus as Status from [Fn_EmpPositionTree] ('1','2019-01-01','". $recnumEmployee ."',".$sub.") where ". $filter->rules[0]->field ." like '%". $filter->rules[0]->data."%'")->result_array();
    		 	//echo $this->db->last_query();
    	}else{
    		$row = $this->db->query("SELECT EmployeeId,EmployeeName,NameOrganization as Section,NamePositionStructural as Position, NameWorkingStatus as Status from [Fn_EmpPositionTree] ('1','2019-01-01','". $recnumEmployee ."',".$sub.")")->result_array();
    	}
      	
 
        echo json_encode($row);
    }
    public function getParent()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$sub = $this->input->get('sub')=='false' ? '0':'1'; 
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($this->admin->getPosParentOrg($this->input->get('jenis'),$sub)));
	}
    public function SaveOrg()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
		    'PositionId' 			=> $this->input->get('codeAdd'),
		    'ParentId'			=> $this->input->get('parentIDAdd'),
		    'PositionName'			=> $this->input->get('OrgNameAdd'),	
		    'StartDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeStartAdd')))),
		    'EndDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeEndAdd')))),
		    'Sort'				=> $this->input->get('SortAdd'),
		    'TotalManPowerPlan'	=> $this->input->get('EmpReqAdd'),
		    'Positiontype'	=> $this->input->get('jenisAdd'),	
		    'CreateBy'			=> $recLogin,
		    'CreateDate'		=> date('Y-m-d'),	        		        
		);
		if($this->input->get('OfficialAdd')!=''){
			$data['Official'] = $this->input->get('OfficialAdd');
		}
		if(!empty($this->input->get('isActiveAdd'))){
			$data['isActive'] = TRUE;
		}

		$this->db->insert('Position', $data);
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
		    'PositionId' 			=> $this->input->get('codeEdit'),
		    'ParentId'			=> $this->input->get('parentIDEdit'),
		    'PositionName'			=> $this->input->get('OrgNameEdit'),	
		    'StartDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeStartEdit')))),
		    'EndDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeEndEdit')))),
		    'Sort'				=> $this->input->get('SortEdit'),
		    'TotalManPowerPlan'	=> $this->input->get('EmpReqEdit'),	
		    'EditBy'			=> $recLogin,
		    'EditDate'			=> date('Y-m-d'),	        		        
		);
		if(!empty($this->input->get('isActiveEdit'))){
			$data['isActive'] = TRUE;
		}

		$this->db->where('Recnum', $this->input->get('Recnum'));
        $this->db->update('Position',$data);

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
		$data['data'] = $this->admin->getPosEditOrg($this->input->get('id'));	
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function DelOrg(){
		$response = [];
		$response['error'] = TRUE; 
		if($this->admin->delPosOrg($this->input->get('id'))){
			$response['error'] = FALSE;
		}	
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
