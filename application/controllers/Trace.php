<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Trace extends CI_Controller {
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

			$data['main'] = 'trace/index';
			$data['js'] = 'script/trace';
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

  public function get_autocomplete(){
      $no = $this->input->get('term');
      if (!empty($no)) {
        $this->db->select("R.*, tb_spk.spk_no,nama_project");
        $this->db->from("tb_routingslip R");
        $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
        $this->db->like('R.no_routing', $no , 'both');
        $this->db->limit(10);
        $data = $this->db->get()->result();
        if (count($data) > 0) {
              foreach ($data as $row)
                $arr_result[] = array(
                      "value"=>$row->id,
                      "label"=>$row->no_routing,
                     
                    );
                  echo json_encode($arr_result);
              
        }
      }
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

  public function get(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id");
      $routing = $this->admin->get_row('tb_routingslip',array( 'id' => $id));
      $data['data'] = $this->admin->get_array('tb_spk',array( 'id' => $routing->id_spk));
      $data['data_routing'] = $routing;
      
      $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_pengirim']),'cust_name');
      $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_penerima']),'cust_name');

      $this->db->select("A.moda_name,A.moda_img, B.moda_kategori,C.*");
      $this->db->from("tb_moda A");
      $this->db->join('tb_moda_kat B', 'A.id=B.id_moda');
      $this->db->join('tb_moda_sub C', 'B.id=C.id_moda_kat');
      $data['moda'] = $this->db->where('C.id', $routing->id_moda)->get()->row();

      // print("<pre>".print_r($data,true)."</pre>"); exit();


      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    

    }else{
        redirect("login");
    } 

  }

  public function getHistory()
  {
    $this->db->from("tb_routingslip_history");
    $query = $this->db->where('id_routing', $this->input->get('id'))->get()->result();
    $this->output->set_content_type('application/json')->set_output(json_encode($query));
  }

}
