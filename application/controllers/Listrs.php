<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listrs extends CI_Controller {
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
      if(CheckMenuRole('listrs')){
        redirect("errors");
      }
      $data['title'] = 'List Routing Slip';
      $data['main'] = 'cargo/list';
      $data['js'] = 'script/list-rs';
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
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
      );
      $valid_sort = array(
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
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
      $this->db->select("A.`cust_name` penerima,B.`cust_name` pengirim,R.*, spk_no,nama_project");
      $this->db->from("tb_routingslip R");
      // $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
      $this->db->join('master_customer A', 'R.id_penerima = A.id');
      $this->db->join('master_customer B', 'R.id_pengirim = B.id');
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_routing,
                      $r->CreatedDate,
                      $r->spk_no,
                      $r->nama_project,
                      $r->penerima,
                      $r->moda_name,
                      $r->status,
                      '<a href="Cargo/edit/'.$r->id.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-ui-edit"></i>
                      </a>
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="deleteList(this)"  data-id="'.$r->id.'" >
                        <i class="icofont icofont-ui-delete"></i>
                      </button>
                      <a href="cetak/rs?id='.$r->id .'" target="_blank"  class="btn btn-primary btn-sm">
                        <i class="icofont icofont-print"></i>T 1
                      </a>
                      <a href="cetak/rsa?id='.$r->id .'" target="_blank"  class="btn btn-primary btn-sm">
                        <i class="icofont icofont-print"></i>T 2
                      </a>
                      <a href="trace/view/'.$r->id.'" class="btn btn-success btn-sm "><i class="icofont icofont-long-drive" ></i>Riwayat
                      </a>
                      
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

  public function dataTableRS()
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
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
      );
      $valid_sort = array(
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
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
      $this->db->select("A.`cust_name` penerima,B.`cust_name` pengirim,R.*, spk_no,nama_project");
      $this->db->from("tb_routingslip R");
      // $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
      $this->db->join('master_customer A', 'R.id_penerima = A.id');
      $this->db->join('master_customer B', 'R.id_pengirim = B.id');
      $this->db->join('tb_invoice_routing I', 'I.id_routing = R.id','left');
      $this->db->where('I.id_routing', NULL);
      if(!empty($this->input->get('r',true))){
        $this->db->where_not_in('R.id', explode(",", $this->input->get('r',true)));
      }
      $pengguna = $this->db->get();
      // print("<pre>".print_r($this->db->last_query(),true)."</pre>");exit();

      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_routing,
                      $r->CreatedDate,
                      $r->spk_no,
                      $r->nama_project,
                      $r->penerima,
                      $r->moda_name,
                      $r->status,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih('.$r->id.')"  data-id="'.$r->id.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
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
  public function dataTableRSVendor()
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
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
      );
      $valid_sort = array(
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
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
      $this->db->select("A.`cust_name` penerima,B.`cust_name` pengirim,R.*, spk_no,nama_project");
      $this->db->from("tb_routingslip R");
      // $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
      $this->db->join('master_customer A', 'R.id_penerima = A.id');
      $this->db->join('master_customer B', 'R.id_pengirim = B.id');
      // $this->db->join('tb_invoice_vendor I', 'I.id_routing = R.id','left');
      // $this->db->where('I.id_routing', NULL);
      // $this->db->where('R.status <>', "DITERIMA");
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_routing,
                      $r->CreatedDate,
                      $r->spk_no,
                      $r->nama_project,
                      $r->penerima,
                      $r->moda_name,
                      $r->status,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih('.$r->id.')"  data-id="'.$r->id.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
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
    $this->db->from("tb_routingslip R");
    // $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
    $this->db->join('master_customer A', 'R.id_penerima = A.id');
    $query = $this->db->join('master_customer B', 'R.id_pengirim = B.id')->get();
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
      if($this->admin->deleteTable("id",$this->input->get('id'), 'tb_routingslip' )){
        // $this->admin->deleteTable("spk_no",$this->input->get('spk'), 'tb_spk_detail' );
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
