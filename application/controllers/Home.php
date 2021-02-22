<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	    $this->load->model('M_menu','',TRUE);
	   
	}
	public function index()
	{		
		if($this->admin->logged_id()){
        	
            $this->db->limit(6);
            $this->db->select("B.*,no_routing");
            $this->db->from("tb_routingslip_history B");
            $this->db->join('tb_routingslip A', 'A.id = B.id_routing');
            $this->db->order_by("created_date","desc");
            $data['history'] = $this->db->get()->result_array();

            $data['list_kurir'] = $this->db->get_where('tb_routingslip',array('status <>'=> 'DITERIMA'))->result_array();

            $this->db->from("tb_invoice");
            $this->db->join('tb_term', 'tb_term.id = tb_invoice.id_term');
            $this->db->where('tb_invoice.id_term <>', 6);
            $this->db->where('tb_invoice.status <>', 'LUNAS');
            $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) <', 5);
            $data['total_duedate'] = $this->db->get()->num_rows();

            $this->db->from("tb_invoice_vendor");
            $this->db->join('tb_term', 'tb_term.id = tb_invoice_vendor.id_term');
            $this->db->where('tb_invoice_vendor.id_term <>', 6);
            $this->db->where('tb_invoice_vendor.status <>', 'LUNAS');
            $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) <', 5);
            $data['total_duedate_vendor'] = $this->db->get()->num_rows();

			$data['main'] = 'home';
			$data['total_SPK'] = $this->db->from('tb_spk')->get()->num_rows();
            $data['total_routing'] = $this->db->from('tb_routingslip')->get()->num_rows();
            $data['perjalanan'] = $this->db->get_where('tb_routingslip',array('status'=> 'DALAM PERJALANAN'))->num_rows();
            $data['pickup'] = $this->db->get_where('tb_routingslip',array('status'=> 'INPUT'))->num_rows();
			$data['js'] = 'home/js';
            // print("<pre>".print_r($data,true)."</pre>");
            // exit();
			$this->load->view('home',$data,FALSE); 

        }else{

            //jika session belum terdaftar, maka redirect ke halaman login
            redirect("login");

        }				  
						
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function getMap(){
        $maps = $this->db->query("SELECT tbl.*,logg.`latitude`,logg.`longitude`,logg.`status`,logg.`created_date` FROM (
                                    SELECT A.`no_routing`,B.`id_routing`,MAX(B.id) id
                                    FROM tb_routingslip A
                                    JOIN tb_routingslip_history B ON A.id=B.`id_routing`
                                    GROUP BY A.`no_routing`
                                    ORDER BY A.no_routing,B.`id_routing`,B.id DESC
                                )tbl
                                JOIN tb_routingslip_history logg ON tbl.id=logg.id
                                WHERE logg.`status` NOT IN ('INPUT','DITERIMA')");
        $this->output->set_content_type('application/json')->set_output(json_encode($maps->result()));
    }
	
}
