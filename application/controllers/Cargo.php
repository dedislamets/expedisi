<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cargo extends CI_Controller {
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
      if(CheckMenuRole('cargo')){
        redirect("errors");
      }
			$data['title'] = 'Entry Routing Slip';
			$data['main'] = 'cargo/index';
			$data['js'] = 'script/cargo';
			$data['modal'] = 'modal/cargo';	
      $data['totalrow'] = 0;
      $data['totalrowmulti'] = 1;
      $data['totalrowhistory'] = 0;
      $data['totalrowbiaya'] = 0;
      $data['kota_asal'] = $this->db->query('select distinct kota from master_city')->result();
      $data['kota_tujuan'] = $data['kota_asal'];
      $data['data_detail'] = array();
      $data['data_multi'] = array();
      $data['data_biaya'] = array();
      $data['moda_only'] = $this->admin->getmaster('tb_moda');
      $data['project'] = $this->admin->getmaster('tb_project');
      // $data['barang'] = $this->admin->getmaster('barang');

      $last = $this->admin->get_num_rows('tb_routingslip');

      $count = $this->db->query("SELECT no_routing FROM tb_routingslip WHERE MONTH(CreatedDate) = MONTH(CURDATE()) AND YEAR(CreatedDate)=YEAR(CURDATE()) ORDER BY CreatedDate DESC LIMIT 1")->result();
      if(empty($count)){
        $last_no = '001';      
      }else{

        $last_no = $count[0]->no_routing;
        $last_no = explode("-", $last_no);
        $last_no = str_pad(($last_no[2]+1), 3, '0', STR_PAD_LEFT);
      }
      $data['no_routing'] = "";
      // $data['no_routing'] = "FH-" . date("Y") . date("m") . "-". $last_no;

      $moda = $this->db->query("SELECT A.moda_name,A.moda_img, B.moda_kategori,C.* FROM tb_moda A
              INNER JOIN tb_moda_kat B ON A.id=B.id_moda
              INNER JOIN tb_moda_sub C ON B.id=C.id_moda_kat");

      $data_arr = array();
      foreach($moda->result() as $key => $value)
      {
          $data_arr[$value->moda_name]['data'][$value->moda_kategori][] = $value;
          $data_arr[$value->moda_name]['img'] = $value->moda_img;
      }

        // print("<pre>".print_r($data_arr,true)."</pre>"); exit();

      $data['moda'] = $data_arr;


      $data['mode'] = "new";		
			$this->load->view('home',$data,FALSE); 
    }else{
        redirect("login");
    }				  
						
	}

  public function getPrefixAuto()
  {
    $prefix = $this->input->get('prefix');
    $last = $this->admin->get_num_rows('tb_routingslip');

    $count = $this->db->query("SELECT no_routing FROM tb_routingslip WHERE MONTH(CreatedDate) = MONTH(CURDATE()) AND YEAR(CreatedDate)=YEAR(CURDATE()) ORDER BY CreatedDate DESC LIMIT 1")->result();
    if(empty($count)){
      $last_no = '001';      
    }else{

      $last_no = $count[0]->no_routing;
      $last_no = explode("-", $last_no);
      $last_no = str_pad(($last_no[2]+1), 3, '0', STR_PAD_LEFT);
    }
    $pref="";
    if($prefix == "Bali Tower"){
      $pref = "BTS";
    }elseif ($prefix == "FIBERHOME") {
      $pref = "FH";
    }elseif ($prefix == "TA Material HO") {
      $pref = "TA";
    }elseif ($prefix == "TA Material Kalimantan") {
      $pref = "TA";
    }elseif ($prefix == "TA Material KTI") {
      $pref = "TA";
    }elseif ($prefix == "TA Material Surabaya") {
      $pref = "TA";
    }elseif ($prefix == "TA NTE") {
      $pref = "TA";
    }elseif ($prefix == "TA TAG") {
      $pref = "TA";
    }elseif ($prefix == "Telkom Indonesia Consumer") {
      $pref = "TIC";
    }elseif ($prefix == "Telkom Indonesia") {
      $pref = "TI";
    }
    
    $nomor = $pref ."-" . date("Y") . date("m") . "-". $last_no;
    if($prefix == "") $nomor = "";

    $this->output->set_content_type('application/json')->set_output(json_encode($nomor));
  }



   
	public function Header()
	{       
    
    	$response = [];
    	$response['error'] = TRUE; 
    	$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    	$recLogin = $this->session->userdata('user_id');
    	
    	$data=[];

    	$this->db->trans_begin();
    	$arr_par = array('id' => $this->input->post('id_rs'));

      $data['no_routing'] = $this->input->post('nomor_rs');
      $data['mod_no_routing'] = $this->input->post('mod_no_routing');
      $data['requestor'] = $this->input->post('requestor');

      $data['id_moda'] = $this->input->post('moda_tran');
      $data['id_moda_kat'] = $this->input->post('moda_kat');
      $data['moda_name'] = $this->input->post('text-moda');

      $data['agent'] = $this->input->post('agent');
      $data['agent2'] = $this->input->post('agent2');
      $data['agent3'] = $this->input->post('agent3');
      // $data['pickup_date'] = $this->input->post('pickup_date');
      // $data['pickup_address'] = $this->input->post('pickup_address');
      // $data['no_kendaraan'] = $this->input->post('nomor_plat');
      // $data['driver'] = $this->input->post('driver');

      $data['spk_no'] = $this->input->post('nomor_spk');
      $data['nama_project'] = $this->input->post('project');
      $data['tgl_spk'] = date("Y-m-d", strtotime($this->input->post('tgl_do')));

      $data['id_pengirim'] = $this->input->post('id_pengirim');
      $data['nama_pengirim'] = $this->input->post('nama_pengirim');

      $data['alamat_pengirim'] = $this->input->post('alamat_pengirim');
      $data['kota_pengirim'] = $this->input->post('region_pengirim');
      $data['kec_pengirim'] = $this->input->post('kecamatan_pengirim');
      $data['zip_pengirim'] = $this->input->post('zip_pengirim');
      $data['hp_pengirim'] = $this->input->post('phone_pengirim');
      $data['attn_pengirim'] = $this->input->post('attn_pengirim');

      $data['id_penerima'] = $this->input->post('id_penerima');
      $data['nama_penerima'] = $this->input->post('nama_penerima');
      $data['alamat_penerima'] = $this->input->post('alamat_penerima');
      $data['kota_penerima'] = $this->input->post('region_penerima');
      $data['kec_penerima'] = $this->input->post('kecamatan_penerima');
      $data['zip_penerima'] = $this->input->post('zip_penerima');
      $data['hp_penerima'] = $this->input->post('phone_penerima');
      $data['attn_penerima'] = $this->input->post('attn_penerima');

      $data['no_pelayaran'] = $this->input->post('pelayaran_no');
      $data['eta'] = ($this->input->post('text-moda') == "LAUT") ? $this->input->post('eta_laut') : $this->input->post('eta');
      $data['etd'] = ($this->input->post('text-moda') == "LAUT") ? $this->input->post('etd_laut') : $this->input->post('etd');
      $data['tgl_pelayaran'] = $this->input->post('tgl_pelayaran');

      $data['awb'] = $this->input->post('awb');
      $data['origin'] = $this->input->post('origin');
      $data['destination'] = $this->input->post('dest');

      $data['flight_no'] = $this->input->post('flight_no');
      $data['flight_date'] = $this->input->post('flight_date');

      $data['agent_hp'] = $this->input->post('agent_hp');
      $data['agent_hp2'] = $this->input->post('agent_hp2');
      $data['agent_hp3'] = $this->input->post('agent_hp3');
      $data['armada'] = $this->input->post('armada');
      $data['no_container'] = $this->input->post('no_container');
      $data['link'] = $this->input->post('link');

      if(!empty($this->input->post('tgl_terima_doc'))){
        $data['received_doc'] = $this->input->post('tgl_terima_doc');
      }
      if(!empty($this->input->post('tgl_serah_acc'))){
        $data['sent_acc'] = $this->input->post('tgl_serah_acc');
      }
      if(!empty($this->input->post('received_date'))){
        $data['received_date'] = $this->input->post('received_date');
      }

      $data['driver']         = $this->input->post('driver');
      $data['no_kendaraan']   = $this->input->post('nomor_plat');
      $data['pickup_address'] = $this->input->post('pickup_address');
      $data['pickup_date']    = $this->input->post('pickup_date');
      $data['pickup_time']    = $this->input->post('pickup_time');
      $data['site_name']      = $this->input->post('site_name');
      $data['received_by']     = $this->input->post('received_by');

	    if($this->input->post('mode') === "edit"){
	        
          if(!empty($this->input->post('driver')) && !empty($this->input->post('pickup_date')) && !empty($this->input->post('pickup_address') )){
            $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $this->input->post('id_rs', TRUE)));
            if($routing['status'] == "INPUT"){
              $data['status'] = 'PICKUP';

              $data_hist = array();
              $data_hist['remark'] = 'Barang sudah dipickup';
              $data_hist['id_routing'] = $this->input->post('id_rs');
              $data_hist['created_by'] = $this->session->userdata('username');
              $data_hist['status'] = 'PICKUP';

              $this->db->insert('tb_routingslip_history', $data_hist);
            }
          }

          if(!empty($this->input->post('received_by',TRUE)) && !empty($this->input->post('received_date',TRUE)) ){
            $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $this->input->post('id_rs', TRUE)));
            if($routing['status'] == "DALAM PERJALANAN"){
              $data['status'] = 'DITERIMA';

              $data_hist = array();
              $data_hist['remark'] = 'Barang sudah diterima oleh '. $this->input->post('received_by',TRUE);
              $data_hist['id_routing'] = $this->input->post('id_rs',TRUE);
              $data_hist['created_by'] = $this->session->userdata('username');
              $data_hist['status'] = 'DITERIMA';

              $this->db->insert('tb_routingslip_history', $data_hist);
            }
          }

          if(!empty($this->input->post('tgl_serah_acc'))){
            $data['sent_acc'] = $this->input->post('tgl_serah_acc');
            $data['status'] = 'CLOSED';
          }

          $total_cost_biaya = intval($this->input->post('total-row-biaya'));
          for ($i=1; $i <= $total_cost_biaya ; $i++) { 
            if(!empty($this->input->post('aktifitas_biaya_'.$i,TRUE) )){
              $data_biaya = array();
              $data_biaya['id_routing'] = $this->input->post('id_rs',TRUE);
              $data_biaya['aktifitas'] = $this->input->post('aktifitas_biaya_'.$i,TRUE);
              $data_biaya['qty'] = $this->input->post('qty_biaya_'.$i,TRUE);
              $data_biaya['satuan'] = $this->input->post('satuan_biaya_'.$i,TRUE);
              $data_biaya['harga'] = $this->input->post('harga_biaya_'.$i,TRUE);
              $data_biaya['biaya'] = str_replace('.', '',  $this->input->post('biaya_'.$i,TRUE));

              if(!empty($this->input->post('id_detail_biaya_'.$i) )){
                if($this->input->post('deleted_biaya_'.$i) == "1"){
                  $this->admin->deleteTable("id",$this->input->post('id_detail_biaya_'.$i, TRUE), 'tb_routingslip_biaya' );
                }else{
                  $this->db->set($data_biaya);
                  $this->db->where(array( "id" => $this->input->post('id_detail_biaya_'.$i) ));
                  $this->db->update('tb_routingslip_biaya');      
                }
              }else{
                $this->db->insert('tb_routingslip_biaya', $data_biaya);
              }
              
            }
          }
          $data['EditBy'] = $recLogin;
          $data['EditDate'] = date('Y-m-d H:i:s');

	      	$this->db->set($data);
	        $this->db->where($arr_par);
	        $result  =  $this->db->update('tb_routingslip'); 

	        if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	            $response['error']= FALSE;
              $response['id']= $this->input->post('id_rs', TRUE);
              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                // print("<pre>".print_r($this->input->post(),true)."</pre>");exit();
                if(!empty($this->input->post('id_detail'.$i) )){
                  unset($data);
                  $data['id_routing'] = $this->input->post('id_rs');
                  $data['no_routing'] = $this->input->post('nomor_rs');
                  $data['id_barang'] = $this->input->post('id_barang'.$i);
                  $data['qty'] = $this->input->post('qty'.$i);
                  $data['satuan'] = $this->input->post('satuan'.$i);
                  $data['kg'] = $this->input->post('kg'.$i);

                  $this->db->set($data);
                  $this->db->where(array( "id" => $this->input->post('id_detail'.$i) ));
                  $this->db->update('tb_routingslip_detail');
                }else{
                  unset($data);
                  $data['id_routing'] = $this->input->post('id_rs');
                  $data['no_routing'] = $this->input->post('nomor_rs');
                  $data['id_barang'] = $this->input->post('id_barang'.$i);
                  $data['qty'] = $this->input->post('qty'.$i);
                  $data['satuan'] = $this->input->post('satuan'.$i);
                  $data['kg'] = $this->input->post('kg'.$i);
                  $this->db->insert('tb_routingslip_detail', $data);
                }
              }

              $total_cost = intval($this->input->post('total-row-multi'));
              for ($i=1; $i <= $total_cost ; $i++) { 
                if(!empty($this->input->post('aktifitas_'.$i,TRUE) )){
                  unset($data);
                  $data['id_routing'] = $this->input->post('id_rs');
                  $data['rute'] = $this->input->post('aktifitas_'.$i,TRUE);

                  if(!empty($this->input->post('id_detail_multi_'.$i) )){
                    if($this->input->post('deleted_'.$i) == 1 ){
                      $this->admin->deleteTable("id",$this->input->post('id_detail_multi_'.$i), 'tb_routingslip_multi' );
                    }else{
                      $this->db->set($data);
                      $this->db->where(array( "id" => $this->input->post('id_detail_multi_'.$i) ));
                      $this->db->update('tb_routingslip_multi');                      
                    }
                  }else{
                    $this->db->insert('tb_routingslip_multi', $data);
                  }
                  
                }
              }
	        }
	    }else{
        $data['CreatedDate'] = date('Y-m-d H:i:s');
        $data['CreatedBy'] = $recLogin;
        if(!empty($this->input->post('driver')) && !empty($this->input->post('pickup_date')) /*&& !empty($this->input->post('pickup_address')  )*/){
          $data['status'] = 'PICKUP';
        }

        $result_header = $this->admin->getmaster('tb_routingslip',array('no_routing' => $this->input->post('nomor_rs')));
        if($result_header){
          $response['error']= TRUE;
          $response['message'] = "Nomor Routing Slip tidak boleh duplikat !";
        }else{
          $result  = $this->db->insert('tb_routingslip', $data);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $last_id = $this->db->insert_id();
              $response['id']= $last_id;
              $total = intval($this->input->post('total-row'));
              for ($i=1; $i <= $total ; $i++) { 
                if(!empty($this->input->post('id_barang'.$i) )){
                  unset($data);
                  $data['no_routing'] = $this->input->post('nomor_rs');
                  $data['id_routing'] = $last_id;
                  $data['id_barang'] = $this->input->post('id_barang'.$i);
                  $data['qty'] = $this->input->post('qty'.$i);
                  $data['satuan'] = $this->input->post('satuan'.$i);
                  $data['kg'] = $this->input->post('kg'.$i);
                  
                  $this->db->insert('tb_routingslip_detail', $data);
                  
                }
              }

              $total_cost = intval($this->input->post('total-row-multi'));
              for ($i=1; $i <= $total_cost ; $i++) { 
                if(!empty($this->input->post('aktifitas_'.$i,TRUE) )){
                  unset($data);
                  $data['id_routing'] = $last_id;
                  $data['rute'] = $this->input->post('aktifitas_'.$i,TRUE);

                  $this->db->insert('tb_routingslip_multi', $data);
                  
                }
              }

              $total_cost_biaya = intval($this->input->post('total-row-biaya'));
              for ($i=1; $i <= $total_cost_biaya ; $i++) { 
                if(!empty($this->input->post('aktifitas_biaya_'.$i,TRUE) )){
                  $data_biaya = array();
                  $data_biaya['id_routing'] =$last_id;
                  $data_biaya['aktifitas'] = $this->input->post('aktifitas_biaya_'.$i,TRUE);
                  $data_biaya['biaya'] = str_replace('.', '',  $this->input->post('biaya_'.$i,TRUE));

                  if(!empty($this->input->post('id_detail_biaya_'.$i) )){
                    if($this->input->post('deleted_biaya_'.$i) == "1"){
                      $this->admin->deleteTable("id",$this->input->post('id_detail_biaya_'.$i, TRUE), 'tb_routingslip_biaya' );
                    }else{
                      $this->db->set($data_biaya);
                      $this->db->where(array( "id" => $this->input->post('id_detail_biaya_'.$i) ));
                      $this->db->update('tb_routingslip_biaya');      
                    }
                  }else{
                    $this->db->insert('tb_routingslip_biaya', $data_biaya);
                  }
                  
                }
              }

              unset($data);
              
              $data['remark'] = 'Membuat Routing Slip';
              $data['id_routing'] = $last_id;
              $data['created_by'] = $this->session->userdata('username');
              $data['status'] = 'INPUT';

              $this->db->insert('tb_routingslip_history', $data);
              $response['error']= FALSE;

              if(!empty($this->input->post('driver')) && !empty($this->input->post('pickup_date')) /*&& !empty($this->input->post('pickup_address') )*/){

                  $data_hist = array();
                  $data_hist['remark'] = 'Barang sudah dipickup';
                  $data_hist['id_routing'] = $last_id;
                  $data_hist['created_by'] = $this->session->userdata('username');
                  $data_hist['status'] = 'PICKUP';

                  $this->db->insert('tb_routingslip_history', $data_hist);
                
              }
          }
        } 
      }

    	$this->db->trans_complete();                      
  	 $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

  public function edit($id){
    if($this->admin->logged_id())
    {
      $data['title'] = 'Edit Routing Slip';
      $data['main'] = 'cargo/index';
      $data['js'] = 'script/cargo';
      $data['modal'] = 'modal/cargo';  

      $data['data'] = $this->admin->get_array('tb_routingslip',array( 'id' => $id));
      $data['moda_only'] = $this->admin->getmaster('tb_moda');
      $data['kota_asal'] = $this->db->query('select distinct kota from master_city')->result();
      $data['kota_tujuan'] = $data['kota_asal'];
      $data['kec_pengirim'] = $this->db->query("select distinct kecamatan from master_city where kota='". $data['data']['kota_pengirim'] ."'")->result();
      $data['zip_pengirim'] = $this->db->query("select distinct kodepos from master_city where kota='". $data['data']['kota_pengirim'] ."' and kecamatan='". $data['data']['kec_pengirim'] ."'")->result();
      $data['kec_penerima'] = $this->db->query("select distinct kecamatan from master_city where kota='". $data['data']['kota_penerima'] ."'")->result();
      $data['zip_penerima'] = $this->db->query("select distinct kodepos from master_city where kota='". $data['data']['kota_penerima'] ."' and kecamatan='". $data['data']['kec_penerima'] ."'")->result();
      $data['project'] = $this->admin->getmaster('tb_project');
      $data['barang'] = $this->admin->get_result_array('barang');

      $data['totalrow'] = 0;
      $data['totalrowmulti'] = 1;
      $data['totalrowhistory'] = 0;
      $data['totalrowbiaya'] = 0;

      if(empty($data['data'])){
        redirect("Cargo");
      }

      // $data['data']['pengirim']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_pengirim']),'cust_name');
      // $data['data']['penerima']= $this->admin->get_row('master_customer',array( 'id' => $data['data']['id_penerima']),'cust_name');
      $data['data_detail'] = $this->admin->get_result_array('tb_routingslip_detail',array( 'id_routing' => $id));

      foreach ($data['data_detail'] as $key => $value) {
        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];

        $data['totalrow'] ++;
      }

      $data['data_multi'] = $this->admin->get_result_array('tb_routingslip_multi',array( 'id_routing' => $id));

      foreach ($data['data_multi'] as $key => $value) {
        $data['totalrowmulti'] ++;
      }

      $data['data_history'] = $this->admin->get_result_array('tb_routingslip_history',array( 'id_routing' => $id));

      foreach ($data['data_history'] as $key => $value) {
        $data['totalrowhistory'] ++;
      }

      $data['data_biaya'] = $this->admin->get_result_array('tb_routingslip_biaya',array( 'id_routing' => $id));

      foreach ($data['data_biaya'] as $key => $value) {
        $data['totalrowbiaya'] ++;
      }

      
      $data['mode'] ='edit';

      $moda = $this->db->query("SELECT A.moda_name,A.moda_img, B.moda_kategori,C.* FROM tb_moda A
              INNER JOIN tb_moda_kat B ON A.id=B.id_moda
              INNER JOIN tb_moda_sub C ON B.id=C.id_moda_kat");

      $data_arr = array();
      foreach($moda->result() as $key => $value)
      {
          $data_arr[$value->moda_name]['data'][$value->moda_kategori][] = $value;
          $data_arr[$value->moda_name]['img'] = $value->moda_img;
      }

      $data['moda'] = $data_arr;

    
      $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");
    } 
  }
  public function getModaKategori()
  {
    $arr_par = array(
      'id_moda' => $this->input->get('id')
    );

    $data = $this->admin->getmaster('tb_moda_kat',$arr_par);
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  public function getBarang()
  {
    $data = $this->admin->get_result_array('barang');
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
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

  public function delete()
	{
    $response = [];
    $response['error'] = TRUE; 
    if($this->admin->deleteTable("id_detail",$this->input->get('id'), 'connote_detail' )){
      $response['error'] = FALSE;
    } 

    $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
	}

  public function getInfoModa()
  {
    $this->db->select("A.moda_name,A.moda_img, B.*");
    $this->db->from("tb_moda A");
    $this->db->join('tb_moda_kat B', 'A.id=B.id_moda');
    // $this->db->join('tb_moda_sub C', 'B.id=C.id_moda_kat');
    $query = $this->db->where('C.id', $this->input->get('id'))->get()->row();
    $this->output->set_content_type('application/json')->set_output(json_encode($query));
  }

  public function updatehistory()
  {       
      
    $response = [];
    $response['error'] = TRUE; 
    $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
    $recLogin = $this->session->userdata('user_id');
    $data = array(
        'status' => $this->input->post("status_history"),                 
    );

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
        $data['created_by'] = $this->session->userdata('username');
        $data['status'] = $this->input->post("status_history");

        $this->db->insert('tb_routingslip_history', $data);
    }
                          
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }
}
