<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PackingList extends CI_Controller {
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
			$data['title'] = 'Master Packing List';
			$data['main'] = 'packing/index';
			$data['js'] = 'script/packing';
			$data['modal'] = 'modal/barang';

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
            0=>'conn_date',
            1=>'conn_code',
            2=>'city_from',
            3=>'city_to',
            4=>'conn_from',
            5=>'conn_to',
        );
        $valid_sort = array(
            0=>'conn_date',
            1=>'conn_code',
            2=>'city_from',
            3=>'city_to',
            4=>'conn_from',
            5=>'conn_to',
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
        $pengguna = $this->db->get("connote");
        $data = array();
        foreach($pengguna->result() as $r)
        {

            $data[] = array( 
                        $r->conn_date,
                        $r->conn_code,
                        $r->city_from,
                        $r->city_to,
                        $r->conn_from,
                        $r->conn_to,
                        '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="editmodal(this)"  data-id="'.$r->conn_code.'"  >
                          <i class="icofont icofont-ui-edit"></i>Lihat
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-primary btn-sm " onclick="editmodal(this)"  data-id="'.$r->conn_code.'"  >
                          <i class="icofont icofont-ui-edit"></i>Status
                        </button>
                        ',
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
      $query = $this->db->get("connote");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

    public function edit(){
        $id = $this->input->get('id');
        $arr_par = array('id_barang' => $id);
        $data = $this->admin->getmaster('barang',$arr_par);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

  public function Save()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      $data = array(
          'nama_barang'   => $this->input->post('nama_barang'),
          'jenis_barang'  => $this->input->post('jenis'),
          'berat_barang'  => $this->input->post('berat_barang'),
          'satuan'        => $this->input->post('satuan'),
                      
      );

      $this->db->trans_begin();

      if($this->input->post('id_barang') != "") {
          $data['EditBy'] = $recLogin;
          $data['EditDate'] = date('Y-m-d');

          $this->db->set($data);
          $this->db->where('id_barang', $this->input->post('id_barang'));
          $result  =  $this->db->update('barang');  

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }else{  
          $data['CreateBy'] = $recLogin;
          $data['CreateDate'] = date('Y-m-d');

          $result  = $this->db->insert('barang', $data);
          
          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }

      $this->db->trans_complete();                      
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
  }

  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id_barang",$this->input->get('id'), 'barang' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
