<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Moda extends CI_Controller {
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
      if(CheckMenuRole('moda')){
        redirect("errors");
      }
			$data['title'] = 'Master Moda';
			$data['main'] = 'moda/index';
			$data['js'] = 'script/moda';
			$data['modal'] = 'modal/moda';
      $data['moda'] = $this->admin->get('tb_moda');

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
        $order = $this->input->get("order");
        $search= $this->input->get("search");
        $search = $search['value'];
        $col = 10;
        $dir = "";

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
            0=>'moda_kategori',
           
        );
        $valid_sort = array(
            0=>'moda_kategori',
           
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
        $this->db->select("tb_moda_kat.*,tb_moda.moda_name");
        $this->db->join("tb_moda", "tb_moda.id=tb_moda_kat.id_moda");
        $this->db->where('tb_moda.id', $this->input->get('id',true));
        $pengguna = $this->db->get("tb_moda_kat");
        $data = array();
        foreach($pengguna->result() as $r)
        {

            $data[] = array( 
                        $r->id,
                        $r->moda_name,
                        $r->moda_kategori,
                        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->id.'"  >
                          <i class="icofont icofont-ui-edit"></i>Edit
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id.'" >
                          <i class="icofont icofont-trash"></i>Hapus
                        </button> ',
                   );
        }
        $total_pengguna = $this->totalPengguna($search, $valid_columns, $this->input->get('id',true));

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_pengguna,
            "recordsFiltered" => $total_pengguna,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalPengguna($search, $valid_columns,$id)
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
      $this->db->join("tb_moda", "tb_moda.id=tb_moda_kat.id_moda");
      $this->db->where('tb_moda.id', $id);
      $query = $this->db->get("tb_moda_kat");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

    public function edit(){
        $id = $this->input->get('id');
        $arr_par = array('id' => $id);
        $data = $this->admin->getmaster('tb_moda_kat',$arr_par);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Save()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      $data = array(
          'moda_kategori'   => $this->input->post('kategori'),
          'id_moda'  => $this->input->post('moda'),
      );

      $this->db->trans_begin();

      if($this->input->post('id') != "") {

          $this->db->set($data);
          $this->db->where('id', $this->input->post('id'));
          $result  =  $this->db->update('tb_moda_kat');  

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }else{  

          $result  = $this->db->insert('tb_moda_kat', $data);
          
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }

      $this->db->trans_complete();
                          
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id",$this->input->get('id'), 'tb_moda_kat' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
