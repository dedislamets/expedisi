<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cetak extends CI_Controller {
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
      $data['title'] = 'List Invoice Customer';
      $data['main'] = 'invoice/list';
      if(!empty($this->input->get('id',TRUE))){
        $id = $this->input->get('id',TRUE);
        $data['data'] = $this->admin->get_array('tb_invoice',array( 'id' => $id));
        $data['rekening'] = $this->admin->get_array('tb_rekening',array( 'id' => $data['data']['id_rekening']));
        $data['data_detail'] = $this->admin->get_result_array('tb_invoice_detail',array( 'id_invoice' => $id));
        $data['data_biaya'] = $this->admin->get_result_array('tb_invoice_opt_charge',array( 'id_invoice' => $id));

        foreach ($data['data_detail'] as $key => $value) {
          $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
          $routing = $this->admin->get_array('tb_routingslip',array( 'id' => $value['id_routing']));
          $penerima =  $this->admin->get_array('master_customer',array( 'id' => $routing['id_penerima']));

          $data['data_detail'][$key]['spk'] = $routing['spk_no'];
          $data['data_detail'][$key]['pickup_date'] = $routing['pickup_date'];
          $data['data_detail'][$key]['dari'] = $routing['site_name'];
          $data['data_detail'][$key]['tujuan'] = $routing['nama_penerima'];
          $data['data_detail'][$key]['layanan'] = $routing['moda_name'];

          $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
          $data['data_detail'][$key]['berat'] = $item['berat_barang'];
        }
      }
      $data['page'] = "invoice";
			$this->load->view('cetak',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}

  public function payment()
  {   
    if($this->admin->logged_id())
    {
      if(!empty($this->input->get('id',TRUE))){
        $id = $this->input->get('id',TRUE);
        $data['data'] = $this->admin->get_array('tb_payment',array( 'id' => $id));

        $data['data_detail'] = $this->admin->get_result_array('tb_invoice_detail',array( 'id_invoice' => $id));
        $data['data_biaya'] = $this->admin->get_result_array('tb_invoice_opt_charge',array( 'id_invoice' => $id));

        foreach ($data['data_detail'] as $key => $value) {
          $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
          $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
          $data['data_detail'][$key]['berat'] = $item['berat_barang'];
        }
      }
      $data['page'] = "payment";
      $this->load->view('cetak',$data,FALSE); 

    }else{
        redirect("login");

    }         
            
  }

  public function sj()
  {   
    if($this->admin->logged_id())
    {
      $id = $this->input->get('id',TRUE);
      $data['data'] = $this->admin->get_array('tb_routingslip',array( 'id' => $id));
      $data['penerima'] =  $this->admin->get_array('master_customer',array( 'id' => $data['data']['id_penerima']));
      $data['moda'] = $this->admin->get_array('tb_moda',array( 'id' => $data['data']['id_moda']));
      $data['multi'] = $this->admin->get('tb_routingslip_multi',array( 'id_routing' => $id));
      $data['data_detail'] = $this->admin->get_result_array('tb_routingslip_detail',array( 'id_routing' => $id));
      $data['data_biaya'] = $this->admin->get_result_array('tb_routingslip_biaya',array( 'id_routing' => $id));

      foreach ($data['data_detail'] as $key => $value) {

        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];
      }
              // print("<pre>".print_r($data['data_detail'],true)."</pre>");exit();
      $data['page'] = "sj";

      $this->load->view('cetak',$data,FALSE); 
    }else{
        redirect("login");
    }                    
  }

  public function rs()
  {   
    if($this->admin->logged_id())
    {
      $id = $this->input->get('id',TRUE);
      $data['data'] = $this->admin->get_array('tb_routingslip',array( 'id' => $id));
      $data['penerima'] =  $this->admin->get_array('master_customer',array( 'id' => $data['data']['id_penerima']));
      $data['moda'] = $this->admin->get_array('tb_moda',array( 'id' => $data['data']['id_moda']));
      $data['multi'] = $this->admin->get('tb_routingslip_multi',array( 'id_routing' => $id));
      $data['data_detail'] = $this->admin->get_result_array('tb_routingslip_detail',array( 'id_routing' => $id));
      $data['data_biaya'] = $this->admin->get_result_array('tb_routingslip_biaya',array( 'id_routing' => $id));

      foreach ($data['data_detail'] as $key => $value) {

        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];
      }
              // print("<pre>".print_r($data['data_detail'],true)."</pre>");exit();
      $data['page'] = "routing";

      $this->load->view('cetak',$data,FALSE); 
    }else{
        redirect("login");
    }                    
  }

  public function rsa()
  {   
    if($this->admin->logged_id())
    {
      $id = $this->input->get('id',TRUE);
      $data['data'] = $this->admin->get_array('tb_routingslip',array( 'id' => $id));
      $data['moda'] = $this->admin->get_array('tb_moda',array( 'id' => $data['data']['id_moda']));
      $data['multi'] = $this->admin->get('tb_routingslip_multi',array( 'id_routing' => $id));
      $data['data_detail'] = $this->admin->get_result_array('tb_routingslip_detail',array( 'id_routing' => $id));
      $data['data_biaya'] = $this->admin->get_result_array('tb_routingslip_biaya',array( 'id_routing' => $id));

      foreach ($data['data_detail'] as $key => $value) {

        $item = $this->admin->get_array('barang',array( 'id_barang' => $value['id_barang']));
        $data['data_detail'][$key]['nama_barang'] = $item['nama_barang'];
        $data['data_detail'][$key]['berat'] = $item['berat_barang'];
      }

      $data['page'] = "routing_new";
      $this->load->view('cetak',$data,FALSE); 
    }else{
        redirect("login");
    }                    
  }
}
