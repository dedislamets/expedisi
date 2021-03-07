<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listoutstanding extends CI_Controller {
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
      if(CheckMenuRole('listoutstanding')){
        redirect("errors");
      }
      $data['title'] = 'List Outstanding Invoice';
      $data['main'] = 'invoice/list-outstanding';
      $data['js'] = 'script/list-outstanding';
      // $data['modal'] = 'modal/barang';

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
          0=>'no_invoice',
          1=>'due_date',
          2=>'TIMESTAMPDIFF(DAY,CURDATE(),due_date)',
          3=>'term',
          4=>'total',
          5=>'no_routing'
      );
      $valid_sort = array(
          0=>'no_invoice',
          1=>'due_date',
          2=>'TIMESTAMPDIFF(DAY,CURDATE(),due_date)',
          3=>'term',
          4=>'total',
          5=>'no_routing',
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

      $this->db->select("I.id,no_invoice,due_date AS due_date,TIMESTAMPDIFF(DAY,CURDATE(),due_date) AS selisih_hari,term,GROUP_CONCAT(DISTINCT `IR`.`no_routing`) no_routing,
                        CASE WHEN TIMESTAMPDIFF(DAY,CURDATE(),due_date) BETWEEN 1 AND 5 THEN 'Hampir Jatuh Tempo' 
                        WHEN TIMESTAMPDIFF(DAY,CURDATE(),due_date) = 0 THEN 'Jatuh Tempo'
                        WHEN TIMESTAMPDIFF(DAY,CURDATE(),due_date) < 0 THEN 'Melewati Jatuh Tempo'
                        ELSE '' END status_due,total");
      $this->db->from("tb_invoice I");
      $this->db->join('tb_invoice_routing IR', 'IR.id_invoice = I.id');
      $this->db->join('tb_term', 'tb_term.id = I.id_term');
      $this->db->join('tb_user U', 'U.id_user = I.CreatedBy');
      $this->db->where('U.cabang',$this->session->userdata('cabang'));
      $this->db->where("I.status  NOT IN ('LUNAS','VOID') ");
      $this->db->where('I.id_term <>', 6);
      $this->db->group_by('I.id,tgl_invoice');

     
      $filter_status = $this->input->get('status',true);
      if ($filter_status > 0 ){
        if($filter_status ==1 ){
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) BETWEEN 1 AND 5');
        }elseif ($filter_status ==2) {
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) <', 0);
        }elseif ($filter_status ==3) {
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date)', 0);
        }elseif ($filter_status ==4) {
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) >', 5);
        }
      }
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_invoice,
                      $r->no_routing,
                      date("d M Y", strtotime($r->due_date)),
                      $r->term,
                      $r->selisih_hari,
                      number_format($r->total),
                      $r->status_due,
                     
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

  public function dataTableVendor()
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
          0=>'no_invoice',
          1=>'due_date',
          2=>'TIMESTAMPDIFF(DAY,CURDATE(),due_date)',
          3=>'term',
          4=>'total',
          5=>'no_routing'
      );
      $valid_sort = array(
          0=>'no_invoice',
          1=>'due_date',
          2=>'TIMESTAMPDIFF(DAY,CURDATE(),due_date)',
          3=>'term',
          4=>'total',
          5=>'no_routing',
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
      $this->db->select("tb_invoice_vendor.id,no_invoice,due_date AS due_date,TIMESTAMPDIFF(DAY,CURDATE(),due_date) AS selisih_hari,term,no_routing,
                        CASE WHEN TIMESTAMPDIFF(DAY,CURDATE(),due_date) BETWEEN 1 AND 5 THEN 'Hampir Jatuh Tempo' 
                        WHEN TIMESTAMPDIFF(DAY,CURDATE(),due_date) = 0 THEN 'Jatuh Tempo'
                        WHEN TIMESTAMPDIFF(DAY,CURDATE(),due_date) < 0 THEN 'Melewati Jatuh Tempo'
                        ELSE '' END status_due,total");
      $this->db->from("tb_invoice_vendor");
      $this->db->join('tb_term', 'tb_term.id = tb_invoice_vendor.id_term');
      $this->db->where('tb_invoice_vendor.id_term <>', 6);
      $this->db->where('tb_invoice_vendor.status <>', 'LUNAS');

      $filter_status = $this->input->get('status',true);
      if ($filter_status > 0 ){
        if($filter_status ==1 ){
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) BETWEEN 1 AND 5');
        }elseif ($filter_status ==2) {
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) <', 0);
        }elseif ($filter_status ==3) {
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date)', 0);
        }elseif ($filter_status ==4) {
          $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) >', 5);
        }
      }
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_invoice,
                      $r->no_routing,
                      date("d M Y", strtotime($r->due_date)),
                      $r->term,
                      $r->selisih_hari,
                      number_format($r->total),
                      $r->status_due,
                     
                 );
      }
      $total_pengguna = $this->totalPenggunaVendor($search, $valid_columns);

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
    $this->db->from("tb_invoice");
    $this->db->join('tb_term', 'tb_term.id = tb_invoice.id_term');
    $this->db->where('tb_invoice.id_term <>', 6);
     $this->db->where("tb_invoice.status  NOT IN ('LUNAS','VOID') ");
    $this->db->join('tb_user U', 'U.id_user = tb_invoice.CreatedBy');
    $this->db->where('U.cabang',$this->session->userdata('cabang'));
    $query = $this->db->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }
  public function totalPenggunaVendor($search, $valid_columns)
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
    $this->db->from("tb_invoice_vendor");
    $this->db->join('tb_term', 'tb_term.id = tb_invoice_vendor.id_term');
    $this->db->where('tb_invoice_vendor.id_term <>', 6);
    $this->db->where('tb_invoice_vendor.status <>', 'LUNAS');
    $query = $this->db->get();
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
      if($this->admin->deleteTable("id",$this->input->get('id'), 'tb_invoice_vendor' )){
        $this->admin->deleteTable("id_invoice",$this->input->get('id'), 'tb_invoice_vendor_detail' );
        $this->admin->deleteTable("id_invoice",$this->input->get('id'), 'tb_invoice_vendor_opt_charge' );
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
