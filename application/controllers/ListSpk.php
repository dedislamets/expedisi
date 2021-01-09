<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listspk extends CI_Controller {
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
      $data['title'] = 'List DO';
      $data['main'] = 'do/list';
      $data['js'] = 'script/list-spk';
      $data['modal'] = 'modal/barang';
      // print("<pre>".print_r($data,true)."</pre>");

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
          0=>'spk_no',
          1=>'nama_project',
          2=>'tgl_spk',
          3=>'pengirim',
          4=>'kota_pengirim',
          5=>'penerima',
          6=>'kota_penerima',
      );
      $valid_sort = array(
          0=>'spk_no',
          1=>'nama_project',
          2=>'tgl_spk',
          3=>'pengirim',
          4=>'kota_pengirim',
          5=>'penerima',
          6=>'kota_penerima',
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
      $this->db->select("A.`cust_name` penerima,B.`cust_name` pengirim,tb_spk.* ");
      $this->db->from("tb_spk");
      $this->db->join('master_customer A', 'tb_spk.id_penerima = A.id');
      $this->db->join('master_customer B', 'tb_spk.id_pengirim = B.id');
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->spk_no,
                      $r->nama_project,
                      $r->tgl_spk,
                      $r->pengirim,
                      $r->kota_pengirim,
                      $r->penerima,
                      $r->kota_penerima,
                      '<a href="spk/edit/'.$r->id.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-ui-edit"></i>Edit
                      </a>
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="deleteList(this)"  data-id="'.$r->id.'" data-spk="'.$r->spk_no.'"  >
                        <i class="icofont icofont-ui-delete"></i>Hapus
                      </button>
                      ',
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

  public function dataTableSPK()
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
          0=>'spk_no',
          1=>'nama_project',
          2=>'tgl_spk',
          3=>'B.cust_name',
          4=>'kota_pengirim',
          5=>'A.cust_name',
          6=>'kota_penerima',
      );
      $valid_sort = array(
          0=>'spk_no',
          1=>'nama_project',
          2=>'tgl_spk',
          3=>'B.cust_name',
          4=>'kota_pengirim',
          5=>'A.cust_name',
          6=>'kota_penerima',
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
      $this->db->select("A.`cust_name` penerima,B.`cust_name` pengirim,tb_spk.* ");
      $this->db->from("tb_spk");
      $this->db->join('master_customer A', 'tb_spk.id_penerima = A.id');
      $this->db->join('master_customer B', 'tb_spk.id_pengirim = B.id');
      $this->db->join('tb_routingslip R', 'R.id_spk = tb_spk.id','left');
      $this->db->where('R.id_spk', NULL);
      $pengguna = $this->db->get();

      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->spk_no,
                      $r->nama_project,
                      $r->tgl_spk,
                      $r->pengirim,
                      $r->kota_pengirim,
                      $r->penerima,
                      $r->kota_penerima,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih('.$r->id.')"  data-id="'.$r->id.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>'
                 );
      }
      $total_pengguna = $this->totalPenggunaSpk($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function totalPenggunaSpk($search, $valid_columns)
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
    $this->db->from("tb_spk");
    $this->db->join('master_customer A', 'tb_spk.id_penerima = A.id');
    $this->db->join('master_customer B', 'tb_spk.id_pengirim = B.id');
    $this->db->join('tb_routingslip R', 'R.id_spk = tb_spk.id','left');
    $query = $this->db->where('R.id_spk', NULL)->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
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
    $this->db->from("tb_spk");
    $this->db->join('master_customer A', 'tb_spk.id_penerima = A.id');
    $query =  $this->db->join('master_customer B', 'tb_spk.id_pengirim = B.id')->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function edit(){
      $id = $this->input->get('id');
      $arr_par = array('id_barang' => $id);
      $data = $this->admin->getmaster('barang',$arr_par);
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id",$this->input->get('id'), 'tb_spk' )){
        $this->admin->deleteTable("spk_no",$this->input->get('spk'), 'tb_spk_detail' );
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
