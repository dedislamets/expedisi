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
			$data['title'] = 'Entry Routing Slip';
			$data['main'] = 'cargo/index';
			$data['js'] = 'script/cargo';
			$data['modal'] = 'modal/cargo';	

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
      $data['id_spk'] = $this->input->post('id_spk');

      $data['id_moda'] = $this->input->post('moda_tran');
      $data['moda_name'] = $this->input->post('text-moda');

      $data['agent'] = $this->input->post('agent');
      $data['pickup_date'] = $this->input->post('pickup_date');
      $data['pickup_address'] = $this->input->post('pickup_address');
      $data['no_kendaraan'] = $this->input->post('nomor_plat');

      $data['driver'] = $this->input->post('driver');
      $data['no_pelayaran'] = $this->input->post('pelayaran_no');
      $data['eta'] = ($this->input->post('jenis_moda') == "Laut") ? $this->input->post('eta_laut') : $this->input->post('eta');
      $data['etd'] = ($this->input->post('jenis_moda') == "Laut") ? $this->input->post('etd_laut') : $this->input->post('etd');
      $data['tgl_pelayaran'] = $this->input->post('tgl_pelayaran');

      $data['awb'] = $this->input->post('awb');
      $data['origin'] = $this->input->post('origin');
      $data['destination'] = $this->input->post('dest');

      $data['flight_no'] = $this->input->post('flight_no');
      $data['flight_date'] = $this->input->post('flight_date');

	    if($this->input->post('mode') === "edit"){
	        

	      	$this->db->set($data);
	        $this->db->where($arr_par);
	        $result  =  $this->db->update('tb_routingslip'); 

	        if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	            $response['error']= FALSE;
	        }
	    }else{
        $data['CreatedDate'] = date('Y-m-d H:i:s');

        $result_header = $this->admin->getmaster('tb_routingslip',array('no_routing' => $this->input->post('nomor_rs')));
        if($result_header){
          $response['error']= TRUE;
          $response['message'] = "Nomor Routing Slip tidak boleh duplikat !";
        }else{
          $result  = $this->db->insert('tb_routingslip', $data);
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
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
      $data['title'] = 'Edit Routing Slip';
      $data['main'] = 'cargo/index';
      $data['js'] = 'script/cargo';
      $data['modal'] = 'modal/cargo';  

      $data['data'] = $this->admin->get_array('tb_routingslip',array( 'id' => $id));
      if(empty($data['data'])){
        redirect("Cargo");
      }
      // $data['data_detail'] = $this->admin->get_result_array('tb_spk_detail',array( 'spk_no' => $data['data']['spk_no']));
      $data['mode'] ='edit';

      // print("<pre>".print_r($data,true)."</pre>"); exit();
    
      $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");
    } 

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
    $this->db->select("A.moda_name,A.moda_img, B.moda_kategori,C.*");
    $this->db->from("tb_moda A");
    $this->db->join('tb_moda_kat B', 'A.id=B.id_moda');
    $this->db->join('tb_moda_sub C', 'B.id=C.id_moda_kat');
    $query = $this->db->where('C.id', $this->input->get('id'))->get()->row();
    $this->output->set_content_type('application/json')->set_output(json_encode($query));
  }
}
