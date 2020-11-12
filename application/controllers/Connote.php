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
        	// $data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Class");
			$data['title'] = 'Entry Connote';
			$data['main'] = 'connote/index';
			$data['js'] = 'script/connote';
			$data['modal'] = 'modal/connote';	
			$data['kota_asal'] = $this->db->query('select distinct kota_asal from tb_origin')->result();
			$data['kota_tujuan'] = $this->db->query('select distinct kota_tujuan from tb_origin')->result();
			$data['moda'] = $this->admin->getmaster('tb_moda');
			$data['resi'] = "TA-GDGBKS2011111";

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
}
