<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Spk extends CI_Controller {
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
			$data['title'] = 'Entry DO';
			$data['main'] = 'do/index';
			$data['js'] = 'script/spk';
			$data['modal'] = 'modal/do';	
			$data['kota_asal'] = $this->db->query('select distinct kota from master_city')->result();
			$data['kota_tujuan'] = $data['kota_asal'];
			$data['moda'] = $this->admin->getmaster('tb_moda');
      $data['totalrow'] = 0;
      $data['data_detail'] = array();
      $data['mode'] = 'new';
      // print("<pre>".print_r($data['resi'],true)."</pre>");exit();

			$this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");
    }				  
						
	}

	public function get_autocomplete(){
    if (!empty($this->input->get("term"))) {
      $result = $this->admin->autocomplete('barang','nama_barang','nama_barang',$this->input->get("term"));
      if (count($result) > 0) {
        foreach ($result as $row){            	
            $arr_result[] = array(
        				"value"=>$row->id_barang,
        				"label"=>$row->nama_barang,
        				"jenis" => $row->jenis_barang,
        				"satuan" => $row->satuan,
        				"berat_barang" => $row->berat_barang,
        			);
            echo json_encode($arr_result);
        }
      }
    }
  }

  public function Save()
	{       
    
  	$response = [];
  	$response['error'] = TRUE; 
  	$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
  	$recLogin = $this->session->userdata('user_id');
  	
  	$data=[];

  	$this->db->trans_begin();
  	$arr_par = array('conn_code' => $this->input->post('resi'));
  	$result_header = $this->admin->getmaster('connote',$arr_par);

    if(!$result_header){
       	$data = array(
          'conn_code'   => $this->input->post('resi'),
          'conn_date'   => date('Y-m-d'),
          'id_cabang'	=> 'GDGJKT',
          'input_by'	=> $recLogin
      	);
      	$result  = $this->db->insert('connote', $data);
    }

    $arr_par = array(
    	'conn_code' => $this->input->post('resi'),
    	'id_barang' => $this->input->post('kode_barang')
    );
  	// $this->admin->getmaster('connote_detail',$arr_par);
  	// echo $this->db->last_query();
  	$this->db->from('connote_detail');
    $this->db->where($arr_par);
    $result_header = $this->db->get();
     
    if ($result_header->num_rows() > 0) {
    	foreach($result_header->result() as $r)
        {
	    	unset($data);
	       	$data['conn_code'] = $this->input->post('resi');
	        $data['id_barang'] = $this->input->post('kode_barang');
	        $data['qty'] = intval($r->qty) + intval($this->input->post('qty'));

	      	$this->db->set($data);
	        $this->db->where($arr_par);
	        $result  =  $this->db->update('connote_detail'); 

        }
    }else{

    	unset($data);
    	$data['conn_code'] = $this->input->post('resi');
        $data['id_barang'] = $this->input->post('kode_barang');
        $data['berat_actual'] = $this->input->post('berat_actual');
        $data['qty'] = $this->input->post('qty');
        $result  = $this->db->insert('connote_detail', $data);
    }
        
    if(!$result){
          print("<pre>".print_r($this->db->error(),true)."</pre>");
    }else{
          $response['error']= FALSE;
    }
    
    	
    $this->db->trans_complete();                      
  	$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function Header()
	{       
    
  	$response = [];
  	$response['error'] = TRUE; 
  	$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
  	$recLogin = $this->session->userdata('user_id');
  	
  	$data=[];

  	$this->db->trans_begin();
  	$arr_par = array('spk_no' => $this->input->post('nomor_spk'));

    $data['spk_no'] = $this->input->post('nomor_spk');
    $data['nama_project'] = $this->input->post('project');
    $data['tgl_spk'] = date("Y-m-d", strtotime($this->input->post('tgl_do')));

    $data['id_pengirim'] = $this->input->post('id_pengirim');
    $data['alamat_pengirim'] = $this->input->post('alamat_pengirim');
    $data['kota_pengirim'] = $this->input->post('region_pengirim');
    $data['kec_pengirim'] = $this->input->post('kecamatan_pengirim');
    $data['zip_pengirim'] = $this->input->post('zip_pengirim');
    $data['hp_pengirim'] = $this->input->post('phone_pengirim');
    $data['attn_pengirim'] = $this->input->post('attn_pengirim');

    $data['id_penerima'] = $this->input->post('id_penerima');
    $data['alamat_penerima'] = $this->input->post('alamat_penerima');
    $data['kota_penerima'] = $this->input->post('region_penerima');
    $data['kec_penerima'] = $this->input->post('kecamatan_penerima');
    $data['zip_penerima'] = $this->input->post('zip_penerima');
    $data['hp_penerima'] = $this->input->post('phone_penerima');
    $data['attn_penerima'] = $this->input->post('attn_penerima');


    if($this->input->post('mode') == "edit"){
        

      	$this->db->set($data);
        $this->db->where($arr_par);
        $result  =  $this->db->update('tb_spk'); 
        // echo $this->db->last_query();exit();

        if(!$result){
            print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
          $total = intval($this->input->post('total-row'));
          for ($i=1; $i <= $total ; $i++) { 
            if(!empty($this->input->post('kode'.$i) )){
              unset($data);
              $data['spk_no'] = $this->input->post('nomor_spk');
              $data['id_barang'] = $this->input->post('kode'.$i);
              $data['qty'] = $this->input->post('qty'.$i);
              $data['satuan'] = $this->input->post('satuan'.$i);

              if(!empty($this->input->post('id_detail'.$i) )){
                $this->db->set($data);
                $this->db->where(array( "id" => $this->input->post('id_detail'.$i) ));
                $this->db->update('tb_spk_detail');
              }else{
                $this->db->insert('tb_spk_detail', $data);
              }
            }
          }
          $response['error']= FALSE;
        }
    }else{
      $result  = $this->db->insert('tb_spk', $data);
      if(!$result){
          print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
          $last_id = $this->db->insert_id();

          $total = intval($this->input->post('total-row'));
          for ($i=1; $i <= $total ; $i++) { 
            if(!empty($this->input->post('kode'.$i) )){
              unset($data);
              $data['spk_no'] = $this->input->post('nomor_spk');
              $data['id_spk'] = $last_id;
              $data['id_barang'] = $this->input->post('kode'.$i);
              $data['qty'] = $this->input->post('qty'.$i);
              $data['satuan'] = $this->input->post('satuan'.$i);
              $this->db->insert('tb_spk_detail', $data);
              
            }
          }
          $response['error']= FALSE;
      }
    }

    

    $this->db->trans_complete();                      
  	$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function dataTableDetail()
  {
  	$draw = intval($this->input->get("draw"));
      $pengguna=$this->db->query("SELECT a.*,b.`nama_barang`,b.`satuan` FROM connote_detail a,barang b WHERE a.`id_barang`=b.`id_barang` and a.conn_code='". $this->input->get("resi") ."' ORDER BY id_detail DESC");

      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->nama_barang,
                      $r->qty,
                      $r->satuan,
                      $r->berat_actual,
                      '<button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id_detail.'" >
                        <i class="icofont icofont-trash"></i>Hapus
                      </button> ',
                 );
      }
      $total_pengguna = $pengguna->num_rows();

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function edit($id){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Edit DO';
      $data['main'] = 'do/index';
      $data['js'] = 'script/spk';
      $data['modal'] = 'modal/do';  
      $data['kota_asal'] = $this->db->query('select distinct kota from master_city')->result();
      $data['kota_tujuan'] = $data['kota_asal'];
      $data['data'] = $this->admin->get_array('tb_spk',array( 'id' => $id));
      $data['data_detail'] = $this->admin->get_result_array('tb_spk_detail',array( 'spk_no' => $data['data']['spk_no']));
      $data['kec_pengirim'] = $this->db->query("select distinct kecamatan from master_city where kota='". $data['data']['kota_pengirim'] ."'")->result();
      $data['zip_pengirim'] = $this->db->query("select distinct kodepos from master_city where kota='". $data['data']['kota_pengirim'] ."' and kecamatan='". $data['data']['kec_pengirim'] ."'")->result();
      $data['kec_penerima'] = $this->db->query("select distinct kecamatan from master_city where kota='". $data['data']['kota_penerima'] ."'")->result();
      $data['zip_penerima'] = $this->db->query("select distinct kodepos from master_city where kota='". $data['data']['kota_penerima'] ."' and kecamatan='". $data['data']['kec_penerima'] ."'")->result();
      
      $data['totalrow'] = 0;
      $data['mode'] ='edit';
      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];

        $data['totalrow'] ++;
      }
      // print("<pre>".print_r($data,true)."</pre>"); exit();
    
      $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");
    } 

  }

  public function get(){
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id");
      $data['data'] = $this->admin->get_array('tb_spk',array( 'id' => $id));
      $data['data_detail'] = $this->admin->get_result_array('tb_spk_detail',array( 'spk_no' => $data['data']['spk_no'], 'id_spk' => $id));
      
      $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_pengirim']),'cust_name');
      $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_penerima']),'cust_name');

      $data['totalrow'] = 0;
      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $satuan = $data['data_detail'][$key]['satuan'];
        $qty = $data['data_detail'][$key]['qty'];
        unset($data['data_detail'][$key]['id']);
        unset($data['data_detail'][$key]['id_barang']);
        unset($data['data_detail'][$key]['id_spk']);
        unset($data['data_detail'][$key]['spk_no']);
        unset($data['data_detail'][$key]['qty']);
        unset($data['data_detail'][$key]['satuan']);
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];
        $data['data_detail'][$key]['satuan'] = $satuan;
        $data['data_detail'][$key]['qty'] = $qty;
        $data['totalrow'] ++;
      }
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
      // print("<pre>".print_r($data,true)."</pre>"); exit();
    

    }else{
        redirect("login");
    } 

  }

  public function delete()
	{
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->deleteTable("id",$this->input->get('id'), 'tb_spk_detail' )){
      $response['error'] = FALSE;
    } 

    $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
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
          0=>'cust_name',
          1=>'region',
          2=>'phone1',
          3=>'phone2',
          4=>'attn',
          5=>'active',
      );
      $valid_sort = array(
          0=>'cust_name',
          1=>'region',
          2=>'phone1',
          3=>'phone2',
          4=>'attn',
          5=>'active',
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
      $pengguna = $this->db->get("master_customer");
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->cust_name,
                      $r->region,
                      $r->phone1,
                      $r->phone2,
                      $r->attn,
                      $r->active,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->id.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>'
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
    $query = $this->db->get("master_customer");
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function dataTableBrg()
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
          0=>'nama_barang',
          1=>'jenis_barang',
          2=>'berat_barang',
          3=>'satuan',
      );
      $valid_sort = array(
          0=>'nama_barang',
          1=>'jenis_barang',
          2=>'berat_barang',
          3=>'satuan',
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
      $pengguna = $this->db->get("barang");
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->nama_barang,
                      $r->jenis_barang,
                      $r->berat_barang,
                      $r->satuan,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih_item(this);void(0)"  data-id="'.$r->id_barang.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
                 );
      }
      $total_pengguna = $this->totalBrg($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }

  public function totalBrg($search, $valid_columns)
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
    $query = $this->db->get("barang");
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }

  public function getCustomer(){
    $id = $this->input->get('id');
    $arr_par = array('id' => $id);
    $data = $this->admin->getmaster('master_customer',$arr_par);
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function getKecamatan()
  {
    $arr_par = array(
      'kota' => $this->input->get('kota')
    );

    $data = $this->admin->getmaster('master_city',$arr_par,'','kecamatan','kecamatan');
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  public function getZipCode()
  {
    $arr_par = array(
      'kota' => $this->input->get('kota'),
      'kecamatan' => $this->input->get('kecamatan')
    );

    $data = $this->admin->getmaster('master_city',$arr_par,'','kodepos','kodepos');
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
}
