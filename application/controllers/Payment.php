<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller {
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
      if(CheckMenuRole('payment')){
        redirect("errors");
      }
      $data['title'] = 'Payment';
      $data['main'] = 'payment/index';
      $data['js'] = 'script/payment';
      $data['mode'] = 'new';
      $data['modal'] = 'modal/payment';
      $data['totalrow'] = 0;
      $data['totalrowbiaya'] = 1;
      $data['data_detail'] = array();
      $data['term'] = $this->admin->getmaster('tb_term');
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
      $tipe = $this->input->get("tipe");

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
          0=>'R.no_routing',
          1=>'nama_project',
          2=>'tgl_submit_invoice',
          3=>'term',
          4=>'due_date',
          5=>'total',
          6=>'status',
      );
      $valid_sort = array(
          0=>'R.no_routing',
          1=>'nama_project',
          2=>'tgl_submit_invoice',
          3=>'term',
          4=>'due_date',
          5=>'total',
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
      if($tipe == 'Customer'){
        $this->db->select("I.*,term,nama_project,cust_name,R.no_routing");
        $this->db->from("tb_invoice I");
        $this->db->join('tb_invoice_routing IR', 'IR.id_invoice = I.id');
        $this->db->join('tb_routingslip R', 'R.id = IR.id_routing');


      }elseif ($tipe == 'Vendor') {
        $this->db->select("I.*,term,nama_project,cust_name");
        $this->db->from("tb_invoice_vendor I");
        $this->db->join('tb_routingslip R', 'R.id = I.id_routing');

      }
      $this->db->join('tb_term', 'tb_term.id = I.id_term');
      $this->db->join('master_customer A', 'R.id_penerima = A.id');
      $this->db->where('I.status <>', "LUNAS");
      $pengguna = $this->db->get();
      // echo $this->db->last_query();exit();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_routing,
                      $r->nama_project,
                      $r->no_invoice,
                      $r->tgl_submit_invoice,
                      $r->term,
                      $r->due_date,
                      $r->total,
                      $r->status,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih('.$r->id.')"  data-id="'.$r->id.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
                 );
      }
      $total_pengguna = $this->totalPengguna($search, $valid_columns, $tipe);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  
  public function totalPengguna($search, $valid_columns, $tipe)
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

    if($tipe == 'Customer'){
      $this->db->from("tb_invoice I");
      $this->db->join('tb_invoice_routing IR', 'IR.id_invoice = I.id');
      $this->db->join('tb_routingslip R', 'R.id = IR.id_routing');
      $this->db->join('tb_term', 'tb_term.id = I.id_term');
      // $this->db->join('master_customer A', 'R.id_penerima = A.id');

    }elseif ($tipe == 'Vendor') {
      $this->db->from("tb_invoice_vendor I");
      $this->db->join('tb_routingslip R', 'R.id = I.id_routing');
      $this->db->join('tb_term', 'tb_term.id = I.id_term');
      // $this->db->join('master_customer A', 'R.id_penerima = A.id');
    }
    

    $query = $this->db->join('master_customer A', 'R.id_penerima = A.id')->get();
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }
  public function Header()
  {       
    
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      
      $data=[];

      $this->db->trans_begin();
      $arr_par = array('id' => $this->input->post('id_payment'));
      $data['no_invoice'] = $this->input->post('no_invoice',TRUE);
      $data['no_payment'] = $this->input->post('no_payment',TRUE);
      $data['tgl_payment'] = date("Y-m-d", strtotime($this->input->post('tgl_payment',TRUE)));
      $data['metode_payment'] = $this->input->post('metode_payment',TRUE);
      if(!empty($this->input->post('type_payment',TRUE))){
        $data['type_payment'] = $this->input->post('type_payment',TRUE);
      }
      
      $data['dibayar'] = $this->input->post('dibayar',TRUE);
      $data['remark'] = $this->input->post('note',TRUE);

      $data['total_payment'] = str_replace('.', '',  $this->input->post('subtotal',TRUE));

      if($this->input->post('mode') === "edit"){
          

          $this->db->set($data);
          $this->db->where($arr_par);
          $result  =  $this->db->update('tb_payment'); 

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $this->update_status_bayar($this->input->post('no_invoice',TRUE),$this->input->post('type_payment',TRUE));
              $response['error']= FALSE;
              
          }
      }else{
        $data['CreatedBy'] = $recLogin;
        $result_header = $this->admin->getmaster('tb_payment',array('no_payment' => $this->input->post('no_payment',TRUE)));
        if($result_header){
          $response['error']= TRUE;
          $response['message'] = "Nomor Payment tidak boleh duplikat !";
        }else{
          $result  = $this->db->insert('tb_payment', $data);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $last_id = $this->db->insert_id();

              $this->update_status_bayar($this->input->post('no_invoice',TRUE),$this->input->post('type_payment',TRUE));

              $response['error']= FALSE;
          }
        } 
      }

      $this->db->trans_complete();                      
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
  function update_status_bayar($no_invoice, $tipe){
    $data['data_payment'] = $this->admin->get_result_array('tb_payment',array( 'no_invoice' => $no_invoice));
    $inv = $this->admin->get_array('tb_invoice',array( 'no_invoice' => $no_invoice));
    if($tipe == "Vendor")
      $inv = $this->admin->get_array('tb_invoice_vendor',array( 'no_invoice' => $no_invoice));

    $dibayar = 0;
    foreach ($data['data_payment'] as $key => $value) {
      $dibayar += intval($value['dibayar']);
    }
    unset($data);
    $data['sudah_dibayar'] = $dibayar;
    $data['status'] = "CICIL";
    if($dibayar >= intval($inv['total'])){
      $data['status'] = "LUNAS";
    }
    $this->db->set($data);
    $this->db->where(array('no_invoice' => $no_invoice));
    if($tipe == "Vendor"){
      $this->db->update('tb_invoice_vendor'); 
    }else{
      $this->db->update('tb_invoice'); 
    }
    
  }
  public function get(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id",TRUE);
      $tipe= $this->input->get("tipe",TRUE);

      $data['data'] = $this->admin->get_array('tb_invoice',array( 'id' => $id));
      if($tipe == "Vendor")
        $data['data'] = $this->admin->get_array('tb_invoice_vendor',array( 'id' => $id));
      // $data['data_routing'] = $this->admin->get_array('tb_routingslip',array( 'id' => $data['data']['id_routing']));

      $data['data_detail'] = $this->admin->get_result_array('tb_invoice_detail',array( 'id_invoice' => $id));
      // $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $data['data_routing']['id_pengirim']),'cust_name');
      // $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $data['data_routing']['id_penerima']),'cust_name');

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
      
    }else{
        redirect("login");
    } 

  }
  public function get_edit(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id");
      $data['data'] = $this->admin->get_array('tb_invoice',array( 'no_invoice' => $id));
      $data['data_routing'] = $this->admin->get_array('tb_routingslip',array( 'id' => $data['data']['id_routing']));

      $data['data_detail'] = $this->admin->get_result_array('tb_invoice_detail',array( 'id_invoice' => $id));
      $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $data['data_routing']['id_pengirim']),'cust_name');
      $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $data['data_routing']['id_penerima']),'cust_name');

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
      
    }else{
        redirect("login");
    } 

  }

  public function update($id)
  {
    if($this->admin->logged_id())
    {
      $data['title'] = 'Edit Payment';
      $data['main'] = 'payment/index';
      $data['js'] = 'script/payment';
      $data['modal'] = 'modal/payment';  

      $data['data'] = $this->admin->get_array('tb_payment',array( 'no_payment' => $id));

      if(empty($data['data'])){
        redirect("payment");
      }
      
      $data['mode'] ='edit';    
      $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");
    } 
  }

}
