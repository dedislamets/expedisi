<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GenerateTable extends CI_Controller {
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
			$data['title'] = 'Generate Master Table';
			$data['main'] = 'setting/master-table';
			$data['js'] = 'script/generate_master_table';
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
      	$row = $this->db->query("select Recnum,IsDesc,ISNULL(ParentId,0) as ParentId from GeneralTableMaster")->result_array();
        foreach($row as $key => $item)
		{										
			$data[]= [ 		'id' => $item['Recnum'],
							'parent' => $item['ParentId']== 0 ? "#" : $item['ParentId'],
							'text'	=> $item['IsDesc'],							
						  ];
		}
   		
          echo json_encode($data);
    }
    public function viewColumn()
    {
    	$id = $this->input->get('id'); 
    	$row_data = $this->db->query("SELECT * from GeneralTableMaster WHERE Recnum=".$id)->result_array();
    	$row = $this->db->query("SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '". $row_data[0]['IsTable'] ."' ORDER BY ORDINAL_POSITION")->result_array();
    	
    	$arr_tabel = array();
    	$arr_tabel[$row_data[0]['IsTable']] = $row;
    	//print("<pre>".print_r($arr_tabel,true)."</pre>");
        echo json_encode($arr_tabel);
    }
    public function viewTable()
    {
    	$table = $this->input->get('tabel'); 
    	$row = $this->db->query("SELECT * from ".$table)->result_array();
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
	public function crud(){
		$response = [];
		$data = array();
		$response['error'] = TRUE;
		$jsonArray = json_decode(file_get_contents('php://input'),true);

		if ($jsonArray['oper'] == 'del' ) {
				try {
					$this->db->from($this->input->get('tabel'));
			        $this->db->where('Recnum', $jsonArray['id'])->delete();
			        if ($this->db->affected_rows() > 0){
			            $response['error'] = FALSE;
						$response['msg'] = 'Sukses';  
			        }
				} catch (Exception $e) {
					$response['msg'] = $e->getMessage();
				}
				
				
		}else{
				$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
			  	$recLogin = $this->session->userdata('user_id');
			  	foreach($this->input->post() as $key=>$value){
				    if($key != 'tabel' && $key != 'grid-table_id' && $key != 'Recnum'){
					    $data[$key] = $value;
					}
				}
				$data['EditBy'] = $recLogin;
				$data['EditDate'] = date('Y-m-d');

				$this->db->where('Recnum', $this->input->post('Recnum'));
		  		$this->db->update($this->input->post('tabel'),$data);

			  	if ($this->db->affected_rows() > 0){
			  		$response['error']= FALSE;
			  		
			  	}
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
