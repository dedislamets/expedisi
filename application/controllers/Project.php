<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Project extends CI_Controller {
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
      if(CheckMenuRole('project')){
        redirect("errors");
      }
			$data['title'] = 'Master Project';
			$data['main'] = 'setup/project';
			$data['js'] = 'script/list-project';
			$data['modal'] = 'modal/project';
			$this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}

    public function dataTable()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $order = $this->input->get("order") ?? "id";
        $search= $this->input->get("search");
        $search = $search['value'];
        $col = 10;
        $dir = "desc";

        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }

        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }

        $valid_columns = array(
            0=>'id',
            1=>'prefix',
            2=>'nama_project',
            3=>'is_active'
        );
        $valid_sort = array(
            0=>'id',
            1=>'prefix',
            2=>'nama_project',
            3=>'is_active'
        );
        if(!isset($valid_sort[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_sort[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
        $this->db->limit($length,$start);
        $pengguna = $this->db->get("tb_project");
        $data = array();
        foreach($pengguna->result() as $r)
        {

            $data[] = array( 
                        $r->id,
                        $r->prefix,
                        $r->nama_project,
                        $r->is_active == 1 ? "Ya": "Tidak",
                        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->id.'"  >
                          <i class="icofont icofont-ui-edit"></i>Edit
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id.'" >
                          <i class="icofont icofont-trash"></i>Hapus
                        </button> ',
                   );
        }
        $total_pengguna = $this->totalPengguna($search, $valid_columns);

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_pengguna,
            "recordsFiltered" => $total_pengguna,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalPengguna($search, $valid_columns)
    {
      $query = $this->db->select("COUNT(*) as num");
      if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                }
                $x++;
            }                 
        }
      $query = $this->db->get("tb_project");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

  public function edit(){
      $id = $this->input->get('id');
      $arr_par = array('id' => $id);
      $row = $this->admin->getmaster('tb_project',$arr_par);
      $data['parent'] = $row;
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function Save()
  {       
    try {
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');

      $data = array(
          'prefix'   => $this->input->post('prefix',TRUE),
          'nama_project'  => $this->input->post('nama_project',TRUE),
          'is_active'  => $this->input->post('status',TRUE) == "on" ? 1 : 0
      );
      $this->db->trans_begin();

      if($this->input->post('id') != "") {
          $this->db->set($data);
          $this->db->where('id', $this->input->post('id',TRUE));
          $result  =  $this->db->update('tb_project');  

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }else{  
          $result  = $this->db->insert('tb_project', $data);
          
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }
      $this->db->trans_commit();

    } catch (Exception $e) {
        $response['error']= TRUE;
        $this->db->trans_rollback();
        print("<pre>".print_r($this->db->error(),true)."</pre>");
    }
    
                          
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 

      try {
        $project = $this->admin->get_array('tb_project',array('id' => $this->input->get('id', TRUE)));

        if(empty( $project)){
            $response['error']= TRUE;
            throw new Exception('Project not found !');
        }else{
          $routing = $this->admin->get_array('tb_routingslip',array('nama_project' => $project['nama_project'] ));

          if(!empty($routing)) {
            throw new Exception('Project already used in routingslip, can not deleted !');
          }
        }

        $result = $this->admin->deleteTable("id",$this->input->get('id',TRUE), 'tb_project' );
        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
            $response['error']= FALSE;
        }
      }catch (Exception $e) {
        $response['error']= TRUE;
        $response['message'] = $e->getMessage();
        $this->output->set_status_header(502);
      }

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }
  public function delete_address()
  {
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->deleteTable("id",$this->input->get('id',TRUE), 'master_customer_address' )){
      $response['error'] = FALSE;
    } 

    $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
