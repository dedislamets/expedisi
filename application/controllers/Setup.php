<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        if(CheckMenuRole('setup')){
            redirect("errors");
        }
    }

    public function index()
    {

        if($this->admin->logged_id()){
            
            $data['title'] = 'Home';
            $data['main'] = 'setup/index';
            $data['js'] = 'script/no-script';
            $data['setup'] = $this->admin->getmaster('setup');
            $this->load->view('home',$data,FALSE); 

        }else{

            redirect("login");

        }  

    }
    
    public function simpan()
    {
        $this->form_validation->set_rules('prefix_invoice', 'prefix_invoice', 'required');
        $this->form_validation->set_rules('start_invoice', 'start_invoice', 'required');
        $this->form_validation->set_message('required', '<div class="alert alert-danger" >
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'prefix_invoice'         =>  $this->input->post('prefix_invoice') ,
                'start_invoice'   =>  $this->input->post('start_invoice') ,
            );
            $this->db->set($data);
            $this->db->update('setup');

            $this->session->set_flashdata('message', '<div class="alert alert-success" >
            <b><i class="fa fa-exclamation-circle"></i> Berhasil</b> update !!</div>');
            redirect('setup');

        }else{

            $this->session->set_flashdata('message', '<div class="alert alert-danger" >
            <div class="header"><b><i class="fa fa-exclamation-circle"></i> Field</b> tidak boleh kosong !!</div></div>');
            redirect($_SERVER['HTTP_REFERER']);
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
            0=>'app_code',
            1=>'base_url',
            2=>'tabel_user',
            3=>'key_tbl',
            4=>'field_password',
            5=>'driver',
            6=>'encrypt_type'
        );
        $valid_sort = array(
            0=>'app_code',
            1=>'base_url',
            2=>'tabel_user',
            3=>'key_tbl',
            4=>'field_password',
            5=>'driver',
            6=>'encrypt_type'
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
        $pengguna = $this->db->get("app_tbl");
        // echo $this->db->last_query();exit();
        $data = array();
        foreach($pengguna->result() as $r)
        {
            $data[] = array( 
                        $r->app_code,
                        $r->base_url,
                        $r->tabel_user,
                        $r->key_tbl,
                        $r->field_password,
                        $r->driver,
                        $r->encrypt_type,
                        '<button type="button" rel="tooltip" class="btn btn-sm " onclick="editmodal(this)"  data-id="'.$r->app_code.'"  >
                          Edit
                        </button>',
                   );
        }
        $total_aplikasi = $this->totalAplikasi();

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_aplikasi,
            "recordsFiltered" => $total_aplikasi,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalAplikasi()
    {
      $query = $this->db->select("COUNT(*) as num")->get("app_tbl");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
    }

    public function app_edit(){
        $id = $this->input->get('id');
        $arr_par = array('app_code' => $id);
        $data = $this->admin->getmaster('app_tbl',$arr_par);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}