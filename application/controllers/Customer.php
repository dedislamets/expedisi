<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller {
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
			$data['title'] = 'Master Vendor';
			$data['main'] = 'vendor/list';
			$data['js'] = 'script/list-vendor';
			$data['modal'] = 'modal/vendor';

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
                          <i class="icofont icofont-ui-edit"></i>Edit
                        </button>
                        <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="hapus(this)"  data-id="'.$r->id.'" >
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
      $query = $this->db->get("master_customer");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

  public function edit(){
      $id = $this->input->get('id');
      $arr_par = array('id' => $id);
      $data = $this->admin->getmaster('master_customer',$arr_par);
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
  }

  public function Save()
  {       
      
      $response = [];
      $response['error'] = TRUE; 
      $response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
      $recLogin = $this->session->userdata('user_id');
      $data = array(
          'cust_name'   => $this->input->post('cust_name'),
          'cust_address'  => $this->input->post('cust_address'),
          'phone1'  => $this->input->post('phone1'),
          'phone2'        => $this->input->post('phone2'),
          'attn'        => $this->input->post('attn'),
          'region'        => $this->input->post('region'),
                      
      );

      $this->db->trans_begin();

      if($this->input->post('id') != "") {
          $data['EditBy'] = $recLogin;
          $data['EditDate'] = date('Y-m-d');

          $this->db->set($data);
          $this->db->where('id', $this->input->post('id'));
          $result  =  $this->db->update('master_customer');  

          if(!$result){
              print("<pre>".print_r($this->db->error(),true)."</pre>");
          }else{
              $response['error']= FALSE;
          }
      }else{  
          $data['CreateBy'] = $recLogin;
          $data['CreateDate'] = date('Y-m-d');

          $result  = $this->db->insert('master_customer', $data);
          
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
      if($this->admin->deleteTable("id",$this->input->get('id'), 'master_customer' )){
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }

}
