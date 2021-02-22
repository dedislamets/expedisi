<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listpayment extends CI_Controller {
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
      if(CheckMenuRole('listpayment')){
        redirect("errors");
      }
      $data['title'] = 'List Payment Invoice';
      $data['main'] = 'payment/list';
      $data['js'] = 'script/list-payment';

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
          0=>'no_payment',
          1=>'tgl_payment',
          2=>'no_invoice',
          3=>'type_payment',
          4=>'total_payment',
      );
      $valid_sort = array(
          0=>'no_payment',
          1=>'tgl_payment',
          2=>'no_invoice',
          3=>'type_payment',
          4=>'total_payment',
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
      // $this->db->select("tb_payment.*");
      $this->db->from("tb_payment");
      // $this->db->join('tb_invoice', 'tb_term.id = tb_invoice.id_term');
      if($this->input->get('status',true) <> "")
        $this->db->where('type_payment', $this->input->get('status',true));

      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_payment,
                      date("d M Y", strtotime($r->tgl_payment)),
                      $r->no_invoice,
                      $r->type_payment,
                      $r->metode_payment,
                      number_format($r->total_payment),
                      number_format($r->dibayar),
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
    $this->db->from("tb_payment");
    // $this->db->join('tb_term', 'tb_term.id = tb_invoice.id_term');
    // $this->db->where('tb_invoice.id_term <>', 6);
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
