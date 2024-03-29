<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cabang extends CI_Controller {
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
			$data['title'] = 'Master Barang';
			$data['main'] = 'cabang/index';
			$data['js'] = 'script/cabang';
			$data['modal'] = 'modal/cabang';

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
            0=>'kode_cabang',
            1=>'nama_cabang',
            2=>'alamat',
            3=>'telp_cabang',
            4=>'kota',
        );
        $valid_sort = array(
            0=>'kode_cabang',
            1=>'nama_cabang',
            2=>'alamat',
            3=>'telp_cabang',
            4=>'kota',
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
        $pengguna = $this->db->get("tb_cabang");
        $data = array();
        foreach($pengguna->result() as $r)
        {

            $data[] = array( 
                        $r->kode_cabang,
                        $r->nama_cabang,
                        $r->alamat,
                        $r->telp_cabang,
                        $r->kota,
                        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->kode_cabang.'"  >
                          <i class="icofont icofont-ui-edit"></i>Edit
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->kode_cabang.'" >
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
      $query = $this->db->get("tb_cabang");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

    public function edit(){
        $id = $this->input->get('id');
        $arr_par = array('kode_cabang' => $id);
        $data = $this->admin->getmaster('tb_cabang',$arr_par);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function Save()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      $data = array(
          'kode_cabang'   => $this->input->post('kode_cabang'),
          'nama_barang'  => $this->input->post('nama_barang'),
          'alamat'  => $this->input->post('alamat'),
          'telp_cabang'        => $this->input->post('telp_cabang'),
                      
      );

      $this->db->trans_begin();

      if($this->input->post('kode_cabang') != "") {

          $this->db->set($data);
          $this->db->where('kode_cabang', $this->input->post('kode_cabang'));
          $result  =  $this->db->update('tb_cabang');  

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }else{  

          $result  = $this->db->insert('tb_cabang', $data);
          
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
      if($this->admin->deleteTable("id_barang",$this->input->get('id'), 'barang' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
