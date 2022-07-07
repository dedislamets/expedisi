<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Listinvoice extends CI_Controller {
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
      if(CheckMenuRole('listinvoice')){
        redirect("errors");
      }
      $data['title'] = 'List Invoice Customer';
      $data['main'] = 'invoice/list';
      $data['js'] = 'script/list-invoice';
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
          1=>'tgl_invoice',
          2=>'term',
          3=>'group_routing',
          4=>'group_project',
          5=>'group_cust',
          6=>'due_date',
          7=>'total',
          8=>'status',
      );
      $valid_sort = array(
          0=>'no_invoice',
          1=>'tgl_invoice',
          2=>'term',
          3=>'group_routing',
          4=>'group_project',
          5=>'group_cust',
          6=>'due_date',
          7=>'total',
          8=>'status',
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

      $this->db->from("list_invoice");
    
      $this->db->where('cabang',$this->session->userdata('cabang'));
      // $this->db->join('tb_routingslip R', 'R.id = I.id_routing');
      // $this->db->join('master_customer A', 'R.id_penerima = A.id');
      // $this->db->order_by("no_invoice","DESC");

      $pengguna = $this->db->get();
      // echo $this->db->last_query();exit();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_invoice,
                      $r->tgl_invoice,
                      $r->group_routing,
                      $r->group_project,
                      $r->term,
                      $r->due_date,
                      number_format($r->total),
                      number_format($r->sudah_dibayar),
                      $r->status,
                      '<a href="'. (empty($r->sp_no) ? 'invoice' : 'invoiceti') .'/edit/'.$r->id.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-ui-edit"></i>
                      </a>' . ($r->status == "LUNAS" || $r->status == "VOID" ? "" : '
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="deleteList(this)"  data-id="'.$r->id.'" >
                        <i class="icofont icofont-ui-delete"></i> Void
                      </button>
                      <a href="cetak?id='.$r->id.'" class="btn btn-success btn-sm" target="_blank"><i class="icofont icofont-print" ></i>
                      </a>'),
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
    $this->db->from("list_invoice");
    $this->db->where('cabang',$this->session->userdata('cabang'));
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

      $arr_par = array('id' => $this->input->get('id'));
      $inv = $this->admin->get_array('tb_invoice', $arr_par);

      if(intval($inv['sudah_dibayar']) > 0){
        $response['msg'] = "Tidak dapat di Void karena sudah ada pembayaran!"; 
      }else{ 
        $data['status'] = 'VOID';

        $this->db->set($data);
        $this->db->where($arr_par);
        $result  =  $this->db->update('tb_invoice'); 

        if($result){
          $response['error'] = FALSE;
        } 
      }


      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
