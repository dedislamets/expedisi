<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Connote extends CI_Controller {
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
			$data['title'] = 'Entry Connote';
			$data['main'] = 'connote/index';
			$data['js'] = 'script/connote';
			$data['modal'] = 'modal/connote';	
			$data['kota_asal'] = $this->db->query('select distinct kota_asal from tb_origin')->result();
			$data['kota_tujuan'] = $this->db->query('select distinct kota_tujuan from tb_origin')->result();
			$data['moda'] = $this->admin->getmaster('tb_moda');

			$count = $this->db->query("select count(*) as urut from connote where DATE(conn_date) = CURDATE() and id_cabang='GDGJKT'")->result();

			$data['resi'] = "TA-GDGJKT" . date("ymd"). ($count[0]->urut+1);
              // print("<pre>".print_r($data['resi'],true)."</pre>");exit();

			$image_name     = $data['resi'].'.jpg';
	        $image_dir      = './assets/barcode/';

			if(!file_exists($image_dir . $image_name)){
				$this->load->library('zend');
		        $this->zend->load('Zend/Barcode');
		        $image_resource = Zend_Barcode::factory('code39', 'image', array('text'=> $data['resi']), array())->draw();
		        imagejpeg($image_resource, $image_dir.$image_name);
			}
			
	        $data['barcode'] = './assets/barcode/'.$image_name ;
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

	public function get_autocomplete(){
        if (!empty($this->input->get("term"))) {
            $result = $this->admin->autocomplete('barang','nama_barang','nama_barang',$this->input->get("term"));
            if (count($result) > 0) {
            foreach ($result as $row)
                // $arr_result[] = $row->nama_barang;
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
      	$arr_par = array('conn_code' => $this->input->post('resi'));
      	$result_header = $this->admin->getmaster('connote',$arr_par);

	    if($result_header){
	        $data['conn_from'] = $this->input->post('nama_pengirim');
	        $data['full_address_from'] = $this->input->post('alamat_pengirim');
	        $data['city_from'] = $this->input->post('asal');
	        $data['phone_from'] = $this->input->post('phone_pengirim');
	        $data['zip_code_from'] = $this->input->post('zip_pengirim');

	        $data['conn_to'] = $this->input->post('nama_penerima');
	        $data['full_address_to'] = $this->input->post('alamat_penerima');
	        $data['city_to'] = $this->input->post('tujuan');
	        $data['phone_to'] = $this->input->post('phone_penerima');
	        $data['zip_code_to'] = $this->input->post('zip_penerima');

	        $data['moda'] = $this->input->post('moda_tran');
	        $data['charges'] = 2000000;
	        $data['services'] = $this->input->post('paket');
	        $data['status'] = 1;

	      	$this->db->set($data);
	        $this->db->where($arr_par);
	        $result  =  $this->db->update('connote'); 
	        // echo $this->db->last_query();

	        if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
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

    public function delete()
  	{
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id_detail",$this->input->get('id'), 'connote_detail' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  	}

  	public function getServices()
  	{
  		$arr_par = array(
  			'kota_asal' => $this->input->get('asal'),
  			'kota_tujuan' => $this->input->get('tujuan')
  		);
  		$id_origin = $this->admin->getmaster('tb_origin',$arr_par);
       //  print("<pre>".print_r($id_origin,true)."</pre>");
      	// echo $this->db->last_query();


  		unset($arr_par);
  		$arr_par = array(
  			'id_origin' => $id_origin[0]->id_origin,
  			'kode_moda' => $this->input->get('moda')
  		);
      	$data = $this->admin->getmaster('tb_services',$arr_par);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
  	}
}
