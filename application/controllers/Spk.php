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

			$count = $this->db->query("select count(*) as urut from connote where DATE(conn_date) = CURDATE() and id_cabang='GDGJKT'")->result();

			$data['resi'] = "TA-GDGJKT" . date("ymd"). ($count[0]->urut+1);
              // print("<pre>".print_r($data['resi'],true)."</pre>");exit();

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
    	$arr_par = array('conn_code' => $this->input->post('resi'));
    	$result_header = $this->admin->getmaster('connote',$arr_par);
      // print("<pre>".print_r($result_header,true)."</pre>");exit();

      $data['conn_code'] = $this->input->post('resi');
      $data['conn_date'] = date('Y-m-d');

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
      $data['id_cabang'] = 'GDGJKT';

      $data['services'] = $this->input->post('paket');
      $data['status'] = 1;
	    if(!empty($result_header)){
	        

	      	$this->db->set($data);
	        $this->db->where($arr_par);
	        $result  =  $this->db->update('connote'); 
	        // echo $this->db->last_query();exit();

	        if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	            $response['error']= FALSE;
	        }
	    }else{
        $result  = $this->db->insert('connote', $data);
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
        'kecamatan' => $this->input->get('kecamatan')
      );

      $data = $this->admin->getmaster('master_city',$arr_par,'','kodepos','kodepos');
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
