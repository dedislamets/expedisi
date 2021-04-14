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
        	
            $this->db->limit(5);
            $this->db->select("B.*,no_routing");
            $this->db->from("tb_routingslip_history B");
            $this->db->join('tb_routingslip A', 'A.id = B.id_routing');
            $this->db->join('tb_user U', 'U.id_user = A.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->order_by("created_date","desc");
            $data['history'] = $this->db->get()->result_array();

            $data['list_kurir'] = $this->db->get_where('tb_routingslip',array('status <>'=> 'DITERIMA'))->result_array();

            $this->db->from("tb_invoice");
            $this->db->join('tb_term', 'tb_term.id = tb_invoice.id_term');
            $this->db->join('tb_user U', 'U.id_user = tb_invoice.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('tb_invoice.id_term <>', 6);
            $this->db->where('tb_invoice.status <>', 'LUNAS');
            $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) <', 5);
            $data['total_duedate'] = $this->db->get()->num_rows();

            $this->db->from("tb_invoice_vendor");
            $this->db->join('tb_term', 'tb_term.id = tb_invoice_vendor.id_term');
            $this->db->join('tb_user U', 'U.id_user = tb_invoice_vendor.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('tb_invoice_vendor.id_term <>', 6);
            $this->db->where('tb_invoice_vendor.status <>', 'LUNAS');
            $this->db->where('TIMESTAMPDIFF(DAY,CURDATE(),due_date) <', 5);
            $data['total_duedate_vendor'] = $this->db->get()->num_rows();

			$data['main'] = 'home';
			$data['total_SPK'] = $this->db->from('tb_spk')->get()->num_rows();

            $this->db->from('tb_routingslip');
            $this->db->join('tb_user U', 'U.id_user = tb_routingslip.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $data['total_routing'] = $this->db->get()->num_rows();

            $this->db->from('tb_routingslip');
            $this->db->join('tb_user U', 'U.id_user = tb_routingslip.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('tb_routingslip.status','DALAM PERJALANAN');
            $data['perjalanan'] = $this->db->get()->num_rows();

            $this->db->from('tb_routingslip');
            $this->db->join('tb_user U', 'U.id_user = tb_routingslip.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('tb_routingslip.status','INPUT');
            $data['pickup'] = $this->db->get()->num_rows();

            $this->db->from('tb_routingslip');
            $this->db->join('tb_user U', 'U.id_user = tb_routingslip.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('tb_routingslip.status','DITERIMA');
            $data['diterima'] = $this->db->get()->num_rows();

            $this->db->from('tb_routingslip');
            $this->db->join('tb_user U', 'U.id_user = tb_routingslip.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('tb_routingslip.status','CLOSED');
            $data['closed'] = $this->db->get()->num_rows();

            $this->db->from('tb_routingslip');
            $this->db->join('tb_user U', 'U.id_user = tb_routingslip.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('MONTH(tb_routingslip.createdDate)', date('m'));
            $this->db->where('YEAR(tb_routingslip.createdDate)', date('Y'));
            $data['current_routing_total'] = $this->db->get()->num_rows();

            $this->db->select('DATE(tb_routingslip.createdDate) AS tgl, COUNT(no_routing) AS jml');
            $this->db->from('tb_routingslip');
            $this->db->join('tb_user U', 'U.id_user = tb_routingslip.CreatedBy');
            $this->db->where('U.cabang',$this->session->userdata('cabang'));
            $this->db->where('MONTH(tb_routingslip.createdDate)', date('m'));
            $this->db->where('YEAR(tb_routingslip.createdDate)', date('Y'));
            $this->db->group_by('DATE(tb_routingslip.createdDate)');
            $records = $this->db->get()->result_array();

            $data_chart=[];
            foreach($records as $row) {
                $data_chart[] = ['type' => date('d M',strtotime($row['tgl'])), 'visits' =>$row['jml']];
            }
            $data['chart_rs'] = json_encode($data_chart);

            $records_finance = $this->db->query("SELECT * FROM (
                                SELECT DATE(tb_invoice.tgl_invoice) AS tgl, COUNT(no_invoice) AS jml ,'cust' AS inv
                                FROM `tb_invoice` 
                                JOIN `tb_user` `U` ON `U`.`id_user` = `tb_invoice`.`CreatedBy` 
                                WHERE `U`.`cabang` = '". $this->session->userdata('cabang') ."' AND MONTH(tb_invoice.tgl_invoice) = '".date('m')."' 
                                AND YEAR(tb_invoice.tgl_invoice) = '". date('Y') ."' 
                                GROUP BY DATE(tb_invoice.tgl_invoice)
                                UNION ALL
                                SELECT DATE(tb_invoice_vendor.tgl_invoice) AS tgl, COUNT(no_invoice) AS jml  ,'vendor' AS inv
                                FROM `tb_invoice_vendor` 
                                JOIN `tb_user` `U` ON `U`.`id_user` = `tb_invoice_vendor`.`CreatedBy` 
                                WHERE `U`.`cabang` = '". $this->session->userdata('cabang') ."' AND MONTH(tb_invoice_vendor.tgl_invoice) = '". date('m') ."' 
                                AND YEAR(tb_invoice_vendor.tgl_invoice) = '". date('Y') ."' 
                                GROUP BY DATE(tb_invoice_vendor.tgl_invoice)
                            )t_graph order by tgl")->result();

            // echo $this->db->last_query();exit();

            $data_chart_finance=[];
            foreach($records_finance as $row) {
                if(array_search(date('d M',strtotime($row->tgl)), array_column($data_chart_finance, 'tgl')) !== false) {
                    foreach($data_chart_finance as $key=>$rs) {
                        if(date('d M',strtotime($row->tgl)) == $data_chart_finance[$key]['tgl']){
                            if ($row->inv == 'cust'){
                                $data_chart_finance[$key]['jml_inv'] += $row->jml;
                            }else{
                                $data_chart_finance[$key]['jml_vendor'] += $row->jml;
                            } 
                        }
                    }
                }else{
                    $data_chart_finance[] = [
                                'tgl' => date('d M',strtotime($row->tgl)), 
                                'jml_inv' => ($row->inv == 'cust' ? intval($row->jml) : 0),
                                'jml_vendor' => ($row->inv == 'vendor' ? intval($row->jml) : 0) 
                            ];
                }
            }
            $data['chart_finance'] = json_encode($data_chart_finance);

            $sql_routing_blm_invoice = $this->db->query("SELECT `tb_routingslip`.no_routing FROM `tb_routingslip`,tb_user U where U.id_user = tb_routingslip.CreatedBy and tb_routingslip.status in ('DITERIMA','CLOSED') and U.cabang='". $this->session->userdata('cabang') ."' and no_routing NOT in ( select no_routing from tb_invoice_routing)");
            $data['routing_blm_invoice'] = $sql_routing_blm_invoice->num_rows();

            $sql_routing_sdh_invoice = $this->db->query("SELECT `tb_routingslip`.no_routing FROM `tb_routingslip`,tb_user U where U.id_user = tb_routingslip.CreatedBy and U.cabang='". $this->session->userdata('cabang') ."' and no_routing in ( select no_routing from tb_invoice_routing)");
            $data['routing_sdh_invoice'] = $sql_routing_sdh_invoice->num_rows();

			$data['js'] = 'home/js';
            // print("<pre>".print_r($data['chart_finance'],true)."</pre>");
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
