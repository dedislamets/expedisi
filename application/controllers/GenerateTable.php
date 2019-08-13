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
			$data['modal'] = 'modal/master-table';
			$data['parent'] = $this->admin->getmaster('GeneralTableMaster','ISNULL(ParentId,0)=0');
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

	public function delete(){
	    $response = [];
	    $response['error'] = TRUE; 
	    if($this->admin->deleteTable($this->input->get('id'),'GeneralTableMaster')){
	      $response['error'] = FALSE;
	    } 
	                
	    $this->output->set_content_type('application/json')->set_output(json_encode($response));
	  }
	public function alter()
	{		
		$recLogin = $this->session->userdata('user_id');
		$data = array();
  		$data['IsDesc'] = $this->input->post('tabel_name');
  		$data['IsTable'] = ( $this->input->post('parent_table')== 0 ? '' : $this->input->post('tabel_name'));
  		$data['Icon'] = '';
  		$data['ParentId'] = ( $this->input->post('parent_table')== 0 ? NULL : $this->input->post('parent_table'));
  		$data['CreateBy'] = $recLogin;
		$data['CreateDate'] = date('Y-m-d');
		$query =$this->db->insert('GeneralTableMaster', $data);

		if($this->input->post('parent_table')> 0){
			$sql = "CREATE TABLE " . $this->input->post('tabel_name') . "(";
			for ($i=1; $i <= $this->input->post('count') ; $i++) { 
				if($i==1){	
					$sql .= $this->input->post('field') ." " . $this->input->post('type_data') ;
					$sql .= ($this->input->post('val_limit')=='' || $this->input->post('type_data')=='int' ? '' : '('.$this->input->post('val_limit').')') ;
					$sql .= " ". ($this->input->post('isNull')=='on' ? '' : 'NOT NULL');
					$sql .= " " . ($this->input->post('isPK')=='on' && $this->input->post('type_data')=='int' ? 'IDENTITY(1,1)' : '');
					$sql .= " " . ($this->input->post('isPK')=='on' ? 'PRIMARY KEY' : '')  .",";
				}else{
					$sql .= $this->input->post('field'.$i) ." " . $this->input->post('type_data'.$i) ;
					$sql .= ($this->input->post('val_limit'.$i)=='' || $this->input->post('type_data'.$i)=='int' ? '' : '('.$this->input->post('val_limit'.$i).')') ;
					$sql .= " ". ($this->input->post('isNull'.$i)=='on' ? '' : 'NOT NULL') ;
					$sql .= " " . ($this->input->post('isPK'.$i)=='on' && $this->input->post('type_data'.$i)=='int' ? 'DENTITY(1,1)' : '');
					$sql .= " " . ($this->input->post('isPK'.$i)=='on' ? 'PRIMARY KEY' : '')  .",";
				}
			}
			//$sql = substr_replace($sql ,"", -1);
			$sql .="CreateBy varchar(20),CreateDate datetime,EditBy varchar(20), EditDate datetime)";

		  	$query = $this->db->query($sql); 
		}
  		
	  	
	  	$this->output->set_content_type('application/json')->set_output(json_encode($query));
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
				    if($key != 'tabel' && $key != 'grid-table_id' && $key != 'Recnum' && $key != 'csrf_token'){
					    $data[$key] = $value;
					}
				}

				if($this->input->post('Recnum') != "") {
			        $data['EditBy'] = $recLogin;
			        $data['EditDate'] = date('Y-m-d');

			        $this->db->where('Recnum', $this->input->post('Recnum'));
		  			$this->db->update($this->input->post('tabel'),$data);

			    }else{
			        $data['CreateBy'] = $recLogin;
			        $data['CreateDate'] = date('Y-m-d');
			        $this->db->insert($this->input->post('tabel'), $data);
			        
			    }

			  	if ($this->db->affected_rows() > 0){
			  		$response['error']= FALSE;
			  		
			  	}
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
}
