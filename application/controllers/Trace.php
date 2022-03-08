<?php

Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');

defined('BASEPATH') OR exit('No direct script access allowed');
class Trace extends CI_Controller {
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
      if(CheckMenuRole('trace')){
        redirect("errors");
      }
			$data['main'] = 'trace/index';
			$data['js'] = 'script/trace';
			$data['modal'] = 'modal/trace';
      $data['mode'] = 'new';
			$this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}

  public function view($id)
  {   
    if($this->admin->logged_id())
    {
      $data['main'] = 'trace/index';
      $data['js'] = 'script/trace';
      $data['modal'] = 'modal/trace';
      $data['mode'] = 'view';
      $data['routing'] = $this->admin->get_row('tb_routingslip',array( 'id' => $id));
      // print("<pre>".print_r($data,true)."</pre>"); exit();

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
        $this->db->select("*");
        $this->db->from("tb_routingslip");
        // $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
        $this->db->like('no_routing', $no , 'both');
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

  public function Pickup()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      $data = array(
          'driver'   => $this->input->post('driver'),
          'no_kendaraan'  => $this->input->post('nomor_plat'),
          // 'pickup_address' => $this->input->post('pickup_address'),
          'status'        => 'PICKUP',
          'pickup_date' => date('Y-m-d'),
          'etd_pickup' => date("Y-m-d", strtotime($this->input->post('etd_pickup'))),
          'pickup_time' => date('H:i:s'),
                      
      );

      $this->db->set($data);
      $this->db->where('id', $this->input->post('id_rs'));
      $result  =  $this->db->update('tb_routingslip');  

      if(!$result){
          print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
          $response['error']= FALSE;
          unset($data);
          $data['remark'] = 'Barang sudah dipickup';
          $data['id_routing'] = $this->input->post('id_rs');
          $data['latitude'] = $this->input->post('lat');
          $data['longitude'] = $this->input->post('long');
          $data['created_by'] = $this->input->post('driver');
          $data['status'] = 'PICKUP';

          $this->db->insert('tb_routingslip_history', $data);
      }
                          
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function Update()
  {       
      
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array(
        'status' => $this->input->post("status_update"),                 
    );

    if($this->input->post("status_update") == 'DITERIMA'){
      $data['received_by'] = $this->input->post('received_by');
      $data['received_date'] = date('Y-m-d H:i:s');
    }
    $this->db->set($data);
    $this->db->where('id', $this->input->post('id_rs'));
    $result  =  $this->db->update('tb_routingslip');  

    if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
    }else{
        $response['error']= FALSE;
        unset($data);
        $data['remark'] = $this->input->post('remark');
        $data['id_routing'] = $this->input->post('id_rs');
        $data['latitude'] = $this->input->post('lat');
        $data['longitude'] = $this->input->post('long');
        $data['created_by'] = $this->input->post('driver');
        $data['status'] = $this->input->post("status_update");

        $this->db->insert('tb_routingslip_history', $data);
    }
                          
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function Serti()
  {       
      
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array();
    
    $data['received_doc'] = $this->input->post('tgl_terima_doc');
    $data['sent_acc'] = $this->input->post('tgl_serah_acc');
    $data['status'] = 'CLOSED';
    
    $this->db->set($data);
    $this->db->where('id', $this->input->post('id_rs'));
    $result  =  $this->db->update('tb_routingslip');  

    if(!$result){
        print("<pre>".print_r($this->db->error(),true)."</pre>");
    }else{
        $response['error']= FALSE;
        unset($data);
        $data['remark'] = 'Serah Terima';
        $data['id_routing'] = $this->input->post('id_rs');
        // $data['latitude'] = $this->input->post('lat');
        // $data['longitude'] = $this->input->post('long');
        $data['created_by'] = $this->session->userdata('username');
        $data['status'] = 'CLOSED';

        $this->db->insert('tb_routingslip_history', $data);
    }
                          
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function get()
  {
    if($this->admin->logged_id())
    {
      $id= $this->input->get("id",TRUE);
      $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $id));
      // $data['data'] = $this->admin->get_array('tb_spk',array( 'id' => $routing->id_spk));
      $data['data'] = $routing;
      
      // print("<pre>".print_r($routing->id_pengirim,true)."</pre>"); exit();
      $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $routing['id_pengirim']),'cust_name');
      $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $routing['id_penerima']),'cust_name');

      $this->db->select("A.moda_name,A.moda_img, B.moda_kategori,C.*");
      $this->db->from("tb_moda A");
      $this->db->join('tb_moda_kat B', 'A.id=B.id_moda');
      $this->db->join('tb_moda_sub C', 'B.id=C.id_moda_kat');
      $data['moda'] = $this->db->where('C.id', $routing['id_moda'])->get()->row();



      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    

    }else{
        redirect("login");
    } 

  }

  public function info()
  {
      $id= $this->input->get("id",TRUE);
      $routing = $this->admin->get_array('tb_routingslip',array( 'no_routing' => $id));
      $data['data'] = $routing;
      
      // print("<pre>".print_r($routing->id_pengirim,true)."</pre>"); exit();
      $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $routing['id_pengirim']),'cust_name');
      $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $routing['id_penerima']),'cust_name');

      $this->db->select("A.moda_name,A.moda_img, B.moda_kategori,C.*");
      $this->db->from("tb_moda A");
      $this->db->join('tb_moda_kat B', 'A.id=B.id_moda');
      $this->db->join('tb_moda_sub C', 'B.id=C.id_moda_kat');
      $data['moda'] = $this->db->where('C.id', $routing['id_moda'])->get()->row();



      $this->output->set_content_type('application/json')->set_output(json_encode($data));

  }

  public function getHistory()
  {
    $this->db->from("tb_routingslip_history");
    $query = $this->db->where('id_routing', $this->input->get('id',TRUE))->get()->result();
    $this->output->set_content_type('application/json')->set_output(json_encode($query));
  }
  public function tracking()
  {
    $routing = $this->admin->get_array('tb_routingslip',array( 'no_routing' => $this->input->get('id',TRUE)));

    $this->db->from("tb_routingslip_history");
    $query = $this->db->where('id_routing', $routing['id'])->get()->result();
    $this->output->set_content_type('application/json')->set_output(json_encode($query));
  }

  public function proses_upload(){

        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|ico|jpeg';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile')){
          $token=$this->input->post('token_foto');
          $nama=$this->upload->data('file_name');
          $this->db->insert('tb_routingslip_document',array('nama_dokumen'=>$nama,'token'=>$token, 'id_routing' => $this->input->post('id_rs')));
        }


  }
  function remove_foto(){

    //Ambil token foto
    $token=$this->input->post('token');

    
    $foto=$this->db->get_where('tb_routingslip_document',array('token'=>$token));


    if($foto->num_rows()>0){
      $hasil=$foto->row();
      $nama_dokumen=$hasil->nama_dokumen;
      if(file_exists($file='./upload/'.$nama_dokumen)){
        unlink($file);
      }
      $this->db->delete('tb_routingslip_document',array('token'=>$token));

    }


    echo "{}";
  }
  public function getImage()
  {
    $this->db->from("tb_routingslip_document");
    $query = $this->db->where('id_routing', $this->input->get('id'))->get()->result();

    $target_dir = "upload/";
    $file_list = array();

    foreach ($query as $row){
      $file_path = $target_dir.$row->nama_dokumen;
      if(!is_dir($file_path)){

         $size = filesize($file_path);

         $file_list[] = array('token'=>$row->token,'name'=>$row->nama_dokumen,'size'=>$size,'path'=>base_url().$file_path);

      }
      // print("<pre>".print_r($file_list,true)."</pre>"); exit();

    }
    $this->output->set_content_type('application/json')->set_output(json_encode($file_list));
  }


}
