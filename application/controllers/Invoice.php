<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
      date_default_timezone_set('Asia/Jakarta');
      $this->load->helper(array('url','file'));
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
    {
      if(CheckMenuRole('invoice')){
        redirect("errors");
      }
      $data['title'] = 'Invoice Entry Customer';
			$data['main'] = 'invoice/index';
			$data['js'] = 'script/invoice';
			$data['modal'] = 'modal/invoice';
      $data['mode'] = 'new';
      $data['totalrow'] = 0;
      $data['totalrowbiaya'] = 0;
      $data['totalrowrouting'] = 0;
      $data['data_detail'] = array();
      $setup = $this->admin->get_row('setup');

      $last = $this->admin->get_num_rows('tb_invoice');

      $count = $this->db->query("SELECT no_invoice FROM tb_invoice WHERE MONTH(tgl_invoice) = MONTH(CURDATE()) AND YEAR(tgl_invoice)=YEAR(CURDATE()) ORDER BY CreatedDate DESC LIMIT 1")->result();
      if(empty($count)){
        $last_no = '0001';      
      }else{
        $last_no = $count[0]->no_invoice;
        $last_no = explode("/", $last_no);
        $last_no = str_pad(intval(substr( str_replace( '-','',$last_no[0]), 3))+1, 4,'0',STR_PAD_LEFT);
      }
      
      if($last==0){
        $last_no = str_pad($setup->start_invoice +1, 4,'0',STR_PAD_LEFT);
      }


      $data['no_invoice'] = $setup->prefix_invoice . "-" . $last_no . "/" .bulan_ke_romawi(date("m")) ."/". date("Y");
      $data['term'] = $this->admin->getmaster('tb_term');
      $data['rekening'] = $this->admin->getmaster('tb_rekening');
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

  public function getTag(){
    if( trim($this->input->get("tag",TRUE)) == "Sesuai Routing"){
      $rs = $this->admin->get_array('tb_routingslip',array( 'id' => $this->input->get("rs",TRUE)));
      $data['tag']= array(
                    "id" => 0,
                    "main" =>0,
                    "other_address" => $rs['alamat_pengirim'],
                    "tag" => "Sesuai Routing"
                  );
    }else{

      $data['tag']= $this->admin->get_row('master_customer_address',array( 'id_master' => $this->input->get("id",TRUE),'tag' => $this->input->get("tag",TRUE)));
    }
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  public function get(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id");
      $data['data'] = $this->admin->get_array('tb_routingslip',array( 'id' => $id));
      $data['data_detail'] = $this->admin->get_result_array('tb_routingslip_detail',array( 'id_routing' => $id));
      $data['data_biaya'] = $this->admin->get_result_array('tb_routingslip_biaya',array( 'id_routing' => $id));
      $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_pengirim']),'cust_name');
      $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_penerima']),'cust_name');
      $data['data_tag'] = $this->admin->get_result_array('master_customer_address',array( 'id_master' => $data['data']['id_pengirim']));
      $data['data_tag'][] = array(
          "id" => 0,
          "main" =>0,
          "other_address" => $data['data']['alamat_pengirim'],
          "tag" => "Sesuai Routing"
      );
      $data['totalrow'] = 0;
      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $satuan = $data['data_detail'][$key]['satuan'];
        $qty = $data['data_detail'][$key]['qty'];
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];
        $data['data_detail'][$key]['satuan'] = $satuan;
        $data['data_detail'][$key]['qty'] = $qty;
        $data['data_detail'][$key]['kg'] = $value['kg'];
        $data['totalrow'] ++;
      }

      $data['totalrowbiaya'] = 0;
      foreach ($data['data_biaya'] as $key => $value) {
        $data['totalrowbiaya'] ++;
      }
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
      // print("<pre>".print_r($data,true)."</pre>"); exit();
    

    }else{
        redirect("login");
    } 

  }
  public function get_edit(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id");
      $data['data'] = $this->admin->get_array('tb_invoice',array( 'id' => $id));
      $data['data_routing'] = $this->admin->get_result_array('tb_invoice_routing',array( 'id_invoice' => $id));
      $data['totalrowrouting'] = 0;
      foreach ($data['data_routing'] as $key => $value) {
        $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $value['id_routing']));
        $data['data_routing'][$key]['project'] = $routing['nama_project'];
        $data['data_routing'][$key]['spk'] = $routing['spk_no'];
        $data['data_routing'][$key]['tanggal'] = $routing['CreatedDate'];
      }
      $data['data_detail'] = $this->admin->get_result_array('tb_invoice_detail',array( 'id_invoice' => $id));
      // $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $data['data_routing']['id_pengirim']),'cust_name');
      // $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $data['data_routing']['id_penerima']),'cust_name');
      // $data['data_tag'] = $this->admin->get_result_array('master_customer_address',array( 'id_master' => $data['data_routing']['id_pengirim']));
      // $data['data_tag'][] = array(
      //     "id" => 0,
      //     "main" =>0,
      //     "other_address" => $data['data_routing']['alamat_pengirim'],
      //     "tag" => "Sesuai Routing"
      // );

      $data['totalrow'] = 0;
      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $value['id_routing']));
        $satuan = $data['data_detail'][$key]['satuan'];
        $qty = $data['data_detail'][$key]['qty'];

        $data['data_detail'][$key]['routing'] = $routing['no_routing'];
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];
        $data['data_detail'][$key]['satuan'] = $satuan;
        $data['data_detail'][$key]['qty'] = $qty;
        $data['data_detail'][$key]['price'] = $value['price'];
        $data['data_detail'][$key]['kg'] = $value['kg'];
        $data['data_detail'][$key]['subtotal'] = $value['subtotal'];
        $data['totalrow'] ++;
      }

      $data['totalrowbiaya'] = 1;
      $data['data_biaya'] = $this->admin->get_result_array('tb_invoice_opt_charge',array( 'id_invoice' => $id));
      foreach ($data['data_biaya'] as $key => $value) {
        $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $value['id_routing']));
        $data['data_biaya'][$key]['routing'] = $routing['no_routing'];
        $data['totalrowbiaya'] ++;
      }

      $this->output->set_content_type('application/json')->set_output(json_encode($data));
      // print("<pre>".print_r($data,true)."</pre>"); exit();
    

    }else{
        redirect("login");
    } 

  }

  public function Header()
  {       
    
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      
      $data=[];

      $this->db->trans_begin();
      $arr_par = array('id' => $this->input->post('id_invoice'));

      $data['no_invoice'] = $this->input->post('no_invoice',TRUE);
      $data['tgl_invoice'] = date("Y-m-d", strtotime($this->input->post('tgl_invoice',TRUE)));
      $data['tgl_submit_invoice'] = date("Y-m-d", strtotime($this->input->post('tgl_submit',TRUE)));
      if(!empty($this->input->post('due_date',TRUE))){
        $data['due_date'] = date("Y-m-d", strtotime($this->input->post('due_date',TRUE)));
      }

      $data['alamat_penagihan'] = $this->input->post('alamat_penagihan',TRUE);
      // $data['id_routing'] = $this->input->post('id_routing',TRUE);

      $data['id_term'] = $this->input->post('id_term',TRUE);
      $data['id_tag'] = $this->input->post('id_tag',TRUE);
      $data['id_rekening'] = $this->input->post('id_rekening',TRUE);
      $data['remark'] = $this->input->post('note',TRUE);

      $data['subtotal'] = str_replace('.', '',  $this->input->post('subtotal',TRUE));

      $data['cost'] = str_replace('.', '',  $this->input->post('other_cost',TRUE)); 
      $data['total'] = str_replace('.', '',  $this->input->post('total',TRUE)); 

      $data['tax'] = str_replace('.', '', $this->input->post('tax',TRUE));
      $data['tax_percent'] = $this->input->post('tax_percent',TRUE);
      
      if($this->input->post('mode') === "edit"){
          

          $this->db->set($data);
          $this->db->where($arr_par);
          $result  =  $this->db->update('tb_invoice'); 

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;

              $this->admin->deleteTable("id_invoice",$this->input->post('id_invoice',TRUE), 'tb_invoice_routing' );

              $total_routing = intval($this->input->post('total-row-invoice'));
              for ($i=1; $i <= $total_routing ; $i++) { 
                  $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $this->input->post('id_routing_'.$i,TRUE)));

                  unset($data);
                  $data['id_invoice'] = $this->input->post('id_invoice');
                  $data['id_routing'] = $this->input->post('id_routing_'.$i,TRUE);
                  $data['no_routing'] = $routing['no_routing'];
                 
                  $this->db->insert('tb_invoice_routing', $data);
              }

              $this->admin->deleteTable("id_invoice",$this->input->post('id_invoice',TRUE), 'tb_invoice_detail' );

              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                unset($data);
                $data['id_invoice'] = $this->input->post('id_invoice');
                $data['id_routing'] = $this->input->post('id_routing_item'.$i,TRUE);
                $data['id_barang'] = $this->input->post('kode'.$i,TRUE);
                $data['qty'] = $this->input->post('qty_'.$i,TRUE);
                $data['kg'] = $this->input->post('kg_'.$i,TRUE);
                $data['satuan'] = $this->input->post('satuan'.$i,TRUE);
                $data['price'] = str_replace('.', '',  $this->input->post('price_'.$i,TRUE));
                $data['price_chartered'] = str_replace('.', '',  $this->input->post('prices_chartered_'.$i,TRUE));
                $data['subtotal'] = str_replace('.', '',  $this->input->post('sub_'.$i,TRUE));

                $this->db->insert('tb_invoice_detail', $data);
              }

              $this->admin->deleteTable("id_invoice",$this->input->post('id_invoice',TRUE), 'tb_invoice_opt_charge' );

              $total_cost = intval($this->input->post('total-row-biaya'));
              for ($i=1; $i <= $total_cost ; $i++) { 
                if(!empty($this->input->post('aktifitas_'.$i,TRUE) )){
                  unset($data);
                  $data['id_invoice'] = $this->input->post('id_invoice');
                  $data['id_routing'] = $this->input->post('id_routing_biaya'.$i,TRUE);
                  $data['aktifitas'] = $this->input->post('aktifitas_'.$i,TRUE);
                  $data['biaya'] = str_replace('.', '',  $this->input->post('biaya_'.$i,TRUE));

                  $this->db->insert('tb_invoice_opt_charge', $data);
                  
                }
              }
          }
      }else{
        $data['CreatedBy'] = $recLogin;
        $data['status'] = "INPUT";
        $result_header = $this->admin->getmaster('tb_invoice',array('no_invoice' => $this->input->post('no_invoice',TRUE)));
        if($result_header){
          $response['error']= TRUE;
          $response['message'] = "Nomor Invoice tidak boleh duplikat !";
        }else{
          $result  = $this->db->insert('tb_invoice', $data);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $last_id = $this->db->insert_id();
              $response['last_id']= $last_id;
              $total_routing = intval($this->input->post('total-row-invoice'));
              for ($i=1; $i <= $total_routing ; $i++) { 
                if(!empty($this->input->post('kode'.$i,TRUE) )){

                  $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $this->input->post('id_routing_'.$i,TRUE)));

                  unset($data);
                  $data['id_invoice'] = $last_id;
                  $data['id_routing'] = $this->input->post('id_routing_'.$i,TRUE);
                  $data['no_routing'] = $routing['no_routing'];
                 
                  $this->db->insert('tb_invoice_routing', $data);
                  
                }
              }

              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                if(!empty($this->input->post('kode'.$i,TRUE) )){
                  unset($data);
                  $data['id_invoice'] = $last_id;
                  $data['id_routing'] = $this->input->post('id_routing_item'.$i,TRUE);
                  $data['id_barang'] = $this->input->post('kode'.$i,TRUE);
                  $data['qty'] = $this->input->post('qty_'.$i,TRUE);
                  $data['kg'] = $this->input->post('kg_'.$i,TRUE);
                  $data['satuan'] = $this->input->post('satuan'.$i,TRUE);
                  $data['price'] = str_replace('.', '',  $this->input->post('price_'.$i,TRUE));
                  $data['price_chartered'] = str_replace('.', '',  $this->input->post('prices_chartered_'.$i,TRUE));
                  $data['subtotal'] = str_replace('.', '',  $this->input->post('sub_'.$i,TRUE));
                  $this->db->insert('tb_invoice_detail', $data);
                  
                }
              }

              $total_cost = intval($this->input->post('total-row-biaya'));
              for ($i=1; $i <= $total_cost ; $i++) { 
                if(!empty($this->input->post('aktifitas_'.$i,TRUE) )){
                  unset($data);
                  $data['id_invoice'] = $last_id;
                  $data['id_routing'] = $this->input->post('id_routing_biaya'.$i,TRUE);
                  $data['aktifitas'] = $this->input->post('aktifitas_'.$i,TRUE);
                  $data['biaya'] = str_replace('.', '',  $this->input->post('biaya_'.$i,TRUE));
                  $this->db->insert('tb_invoice_opt_charge', $data);
                  
                }
              }
              $response['error']= FALSE;
          }
        } 
      }

      $this->db->trans_complete();                      
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function edit($id){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Edit Invoice Customer';
      $data['main'] = 'invoice/index';
      $data['js'] = 'script/invoice';
      $data['modal'] = 'modal/invoice';  

      $data['data'] = $this->admin->get_array('tb_invoice',array( 'id' => $id));
      $data['term'] = $this->admin->getmaster('tb_term');

      $data['totalrow'] = 0;
      $data['totalrowbiaya'] = 0;
      $data['totalrowrouting'] = 0;


      if(empty($data['data'])){
        redirect("invoice");
      }

      $data['data_detail'] = $this->admin->get_result_array('tb_invoice_detail',array( 'id_invoice' => $id));
      $data['data_biaya'] = $this->admin->get_result_array('tb_invoice_opt_charge',array( 'id_invoice' => $id));
      $data['data_routing'] = $this->admin->get_result_array('tb_invoice_routing',array( 'id_invoice' => $id));
      $data['rekening'] = $this->admin->getmaster('tb_rekening');

      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];

        $data['totalrow'] ++;
      }

      foreach ($data['data_biaya'] as $key => $value) {
        $data['totalrowbiaya'] ++;
      }

      foreach ($data['data_routing'] as $key => $value) {
        $data['totalrowrouting'] ++;
      }

      
      $data['mode'] ='edit';
      // print("<pre>".print_r($data,true)."</pre>"); exit();
    
      $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");
    } 

  }

  public function deleteBiaya()
  {
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->deleteTable("id",$this->input->get('id'), 'tb_invoice_opt_charge' )){
      $response['error'] = FALSE;
    } 

    $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
