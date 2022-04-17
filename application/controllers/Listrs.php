<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/Autoloader/autoload.php';
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

class Listrs extends CI_Controller {
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
      if(CheckMenuRole('listrs')){
        redirect("errors");
      }
      $data['title'] = 'List Routing Slip';
      $data['main'] = 'cargo/list';
      $data['js'] = 'script/list-rs';
      $data['modal'] = 'modal/barang';
      // print("<pre>".print_r($data,true)."</pre>");

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
          0=>'no_routing',
          1=>'R.CreatedDate',
          2=>'spk_no',
          3=>'nama_project',
          4=>'nama_pengirim',
          5=>'nama_penerima',
          6=>'moda_name',
          7=>'R.status',
          8=>'A.cust_name',
          9=>'B.cust_name',
      );
      $valid_sort = array(
          0=>'no_routing',
          1=>'R.CreatedDate',
          2=>'spk_no',
          3=>'nama_project',
          4=>'nama_pengirim',
          5=>'nama_penerima',
          6=>'moda_name',
          7=>'R.status',
          8=>'A.cust_name',
          9=>'B.cust_name',
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
      $this->db->select("CASE WHEN IFNULL(R.nama_penerima,'')='' THEN A.cust_name ELSE R.nama_penerima END penerima, 
                CASE WHEN IFNULL(R.nama_pengirim,'')='' THEN B.cust_name ELSE R.nama_pengirim END pengirim,R.*, spk_no,nama_project",FALSE);
      $this->db->from("tb_routingslip R");
      $this->db->join('master_customer A', 'R.id_penerima = A.id','LEFT');
      $this->db->join('master_customer B', 'R.id_pengirim = B.id','LEFT');
      $this->db->join('tb_user U', 'U.id_user = R.CreatedBy');
      $this->db->where('U.cabang',$this->session->userdata('cabang'));
      $pengguna = $this->db->get();
       // print("<pre>".print_r($this->db->last_query(),true)."</pre>");exit();

      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_routing,
                      $r->CreatedDate,
                      $r->spk_no,
                      $r->nama_project,
                      $r->penerima,
                      $r->moda_name,
                      $r->status,
                      '<a href="Cargo/edit/'.$r->id.'"  class="btn btn-warning btn-sm "  >
                        <i class="icofont icofont-ui-edit"></i>
                      </a>
                      <button type="button" rel="tooltip" class="btn btn-danger btn-sm " onclick="deleteList(this)"  data-id="'.$r->id.'" >
                        <i class="icofont icofont-ui-delete"></i>
                      </button>
                      <a href="cetak/rs?id='.$r->id .'" target="_blank"  class="btn btn-primary btn-sm">
                        <i class="icofont icofont-print"></i>T 1
                      </a>
                      <a href="cetak/rsa?id='.$r->id .'" target="_blank"  class="btn btn-primary btn-sm">
                        <i class="icofont icofont-print"></i>T 2
                      </a>
                      <a href="trace/view/'.$r->id.'" class="btn btn-success btn-sm "><i class="icofont icofont-long-drive" ></i>Riwayat
                      </a>
                      
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
  public function dataTableRS()
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
          0=>'R.no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'B.cust_name',
          4=>'A.cust_name',
          5=>'R.nama_penerima',
          6=>'R.nama_pengirim',
          // 5=>'moda_name',
          // 6=>'R.status',
      );
      $valid_sort = array(
          0=>'R.no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'B.cust_name',
          4=>'A.cust_name',
          5=>'R.nama_penerima',
          6=>'R.nama_pengirim',
          // 5=>'moda_name',
          // 6=>'R.status',
      );
      $this->db->order_by('R.CreatedDate DESC');
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
      $this->db->select("DISTINCT CASE WHEN IFNULL(R.nama_penerima,'')='' THEN A.cust_name ELSE R.nama_penerima END penerima, 
      CASE WHEN IFNULL(R.nama_pengirim,'')='' THEN B.cust_name ELSE R.nama_pengirim END pengirim,R.*, spk_no,nama_project", FALSE);
      $this->db->from("tb_routingslip R");
      $this->db->join('tb_routingslip_detail S', 'S.id_routing=R.id');
      $this->db->join('master_customer A', 'R.id_penerima = A.id','LEFT');
      $this->db->join('master_customer B', 'R.id_pengirim = B.id','LEFT');
      $this->db->join('tb_invoice_routing I', 'I.id_routing = R.id AND VOID=0','left');
      $this->db->join('tb_invoice_detail J', 'J.id_routing_detail=S.id AND J.id_routing=S.id_routing','left');
      $this->db->join('tb_user U', 'U.id_user = R.CreatedBy');
      $this->db->where('U.cabang',$this->session->userdata('cabang'));
      $this->db->where('(I.id_routing IS NULL OR J.id_routing_detail IS NULL)');
      // $this->db->where('I.status <>', "DITERIMA");
      if(!empty($this->input->get('r',true))){
        $this->db->where_not_in('R.id', explode(",", $this->input->get('r',true)));
      }

      $pengguna = $this->db->get();
      // print("<pre>".print_r($this->db->last_query(),true)."</pre>");exit();

      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      '<input type="checkbox" name="selected_courses[]" value="'.$r->id.'">',
                      $r->no_routing,
                      // $r->CreatedDate,
                      $r->spk_no,
                      $r->nama_project,
                      $r->penerima,
                      // $r->moda_name,
                      // $r->status,
                      // '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih('.$r->id.')"  data-id="'.$r->id.'"  >
                      //   <i class="icofont icofont-ui-edit"></i>Pilih
                      // </button>',
                 );
      }
      $total_pengguna = $this->totalPenggunaRS($search, $valid_columns);

      $output = array(
          "draw" => $draw,
          "recordsTotal" => $total_pengguna,
          "recordsFiltered" => $total_pengguna,
          "data" => $data
      );
      echo json_encode($output);
      exit();
  }
  public function dataTableRSVendor()
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
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
      );
      $valid_sort = array(
          0=>'no_routing',
          1=>'spk_no',
          2=>'nama_project',
          3=>'pengirim',
          4=>'penerima',
          5=>'moda_name',
          6=>'status',
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
      $this->db->select("A.`cust_name` penerima,B.`cust_name` pengirim,R.*, spk_no,nama_project");
      $this->db->from("tb_routingslip R");
      // $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
      $this->db->join('master_customer A', 'R.id_penerima = A.id');
      $this->db->join('master_customer B', 'R.id_pengirim = B.id');
      // $this->db->join('tb_invoice_vendor I', 'I.id_routing = R.id','left');
      // $this->db->where('I.id_routing', NULL);
      // $this->db->where('R.status <>', "DITERIMA");
      $pengguna = $this->db->get();
      $data = array();
      foreach($pengguna->result() as $r)
      {

          $data[] = array( 
                      $r->no_routing,
                      $r->CreatedDate,
                      $r->spk_no,
                      $r->nama_project,
                      $r->penerima,
                      $r->moda_name,
                      $r->status,
                      '<button type="button" rel="tooltip" class="btn btn-warning btn-sm " onclick="pilih('.$r->id.')"  data-id="'.$r->id.'"  >
                        <i class="icofont icofont-ui-edit"></i>Pilih
                      </button>',
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
    $query = $this->db->select("COUNT(DISTINCT no_routing) as num");
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
    $this->db->from("tb_routingslip R");
    // $this->db->join('tb_spk', 'tb_spk.id = R.id_spk');
    $this->db->join('master_customer A', 'R.id_penerima = A.id','LEFT');
    $this->db->join('master_customer B', 'R.id_pengirim = B.id','LEFT');
    $this->db->join('tb_user U', 'U.id_user = R.CreatedBy');
    $query = $this->db->where('U.cabang',$this->session->userdata('cabang')) ->get();
    
    
    $result = $query->row();
    if(isset($result)) return $result->num;
    return 0;
  }
  public function totalPenggunaRS($search, $valid_columns)
  {
    $query = $this->db->select("COUNT(DISTINCT R.no_routing) as num");
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
    $this->db->from("tb_routingslip R");
    $this->db->join('tb_routingslip_detail S', 'S.id_routing=R.id');
    $this->db->join('master_customer A', 'R.id_penerima = A.id','LEFT');
    $this->db->join('master_customer B', 'R.id_pengirim = B.id','LEFT');
    $this->db->join('tb_invoice_routing I', 'I.id_routing = R.id AND VOID=0','left');
    $this->db->join('tb_invoice_detail J', 'J.id_routing_detail=S.id AND J.id_routing=S.id_routing','left');
    $this->db->join('tb_user U', 'U.id_user = R.CreatedBy');
    $this->db->where('U.cabang',$this->session->userdata('cabang'));
    $query = $this->db->where('(I.id_routing IS NULL OR J.id_routing_detail IS NULL)')->get();
    
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
  public function delete()
  {
      $response = [];
      $response['error'] = TRUE; 
      if($this->admin->deleteTable("id",$this->input->get('id'), 'tb_routingslip' )){
        // $this->admin->deleteTable("spk_no",$this->input->get('spk'), 'tb_spk_detail' );
        $response['error'] = FALSE;
      } 

      $this->output->set_content_type('application/json')->set_output(json_encode($response)); 
  }
  public function upload()
  {   
    if($this->admin->logged_id())
    {
      if(CheckMenuRole('listrs/upload')){
        redirect("errors");
      }
      $data['title'] = 'Upload Routing Slip';
      $data['main'] = 'cargo/upload';
      $data['js'] = 'script/list-rs';
      $data['modal'] = 'modal/no-modal';

      $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");

    }                   
  }
  public function import(){
    
    array_map('unlink', array_filter(
            (array) array_merge(glob("./upload/routing/*"))));
  
    $fileName = $_FILES['file']['name'];

    $config['remove_spaces'] = FALSE;
    $config['upload_path'] = './upload/routing/'; //path upload
    $config['file_name'] = $fileName;  // nama file
    $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
    $config['max_size'] = 10000; // maksimal sizze


    $this->load->library('upload'); //meload librari upload
    $this->upload->overwrite = true;
    $this->upload->initialize($config);
      
    if(! $this->upload->do_upload('file') ){
        echo $this->upload->display_errors();exit();
    }
            
    $inputFileName = './upload/routing/'.$fileName;

    
    $reader = ReaderFactory::create(Type::XLSX); //set Type file xlsx
    $reader->open($inputFileName); //open the file           

    echo "<pre>";           
    $i = 0; 

    foreach ($reader->getSheetIterator() as $sheet) { 
        $routing="";   
        $last_id = 0;         
        foreach ($sheet->getRowIterator() as $rowData) {
          

          if($i>0 && !empty($rowData[0]) && !empty($rowData[1])){
            
            

            $status = "INPUT";
            if(!empty($rowData[10])){
              $status = "PICKUP";
            }elseif (!empty($rowData[15]) && !empty($rowData[16])) {
              $status = "DITERIMA";
            }

            // $tgl =$rowData[9]->format('Y-m-d H:i:s');
            // print("<pre>".print_r($data,true)."</pre>");
            if($routing != $rowData[1])
            {
              $arr_moda = explode("-", $rowData[19]);
              $moda = $this->admin->get_array('tb_moda',array( 'moda_name' => strtoupper(trim($arr_moda[0]))));
              $moda_kat = $this->admin->get_array('tb_moda_kat',array( 'moda_kategori' => strtoupper(trim($arr_moda[1]))));

              $data = array(
                "no_routing"=> $rowData[1],
                "spk_no"=> $rowData[2],
                "nama_project"=> $rowData[3],
                "tgl_spk"=> $rowData[4]->format('Y-m-d H:i:s'),
                "id_moda"=> $moda['id'],
                "id_moda_kat"=> $moda_kat['id'],
                "moda_name"=> $rowData[19],
                "agent"=> $rowData[18],
                "nama_pengirim"=> $rowData[5],
                "alamat_pengirim"=> $rowData[6],
                "nama_penerima"=> $rowData[7],
                "pickup_date"=> $rowData[9]->format('Y-m-d H:i:s'),
                "pickup_address"=> $rowData[10],
                "received_date"=> $rowData[15]->format('Y-m-d H:i:s'),
                "received_by"=> $rowData[16],
                "received_doc"=> $rowData[17]->format('Y-m-d H:i:s'),
                "requestor"=> $rowData[20],
                "mod_no_routing"=> 'Manual',
                "status" => $status,
                'CreatedBy' => $this->session->userdata('user_id')
              );
              $exist  = $this->admin->get_array('tb_routingslip',array( 'UPPER(no_routing)' => strtoupper(trim($rowData[1]))));
              if($exist){
                print_r($rowData[1] . " Duplikat.<br>");
                goto skip;
              }
              $insert = $this->db->insert("tb_routingslip",$data);
              $last_id = $this->db->insert_id();
               print_r($rowData[1] . " routing sukses.<br>");

              $data_history = array(
                "id_routing" => $last_id,
                "remark" => 'Membuat Routing Slip',
                "created_by"    => 'Admin',
                "status"       => 'INPUT'
              );
              $insert = $this->db->insert("tb_routingslip_history",$data_history);

              if(!empty($rowData[10])){
                $data_history = array(
                  "id_routing" => $last_id,
                  "remark" => 'Barang sudah dipickup',
                  "created_by"    => 'Admin',
                  "status"       => 'PICKUP'
                );
                $insert = $this->db->insert("tb_routingslip_history",$data_history);
              }
              if(!empty($rowData[15]) && !empty($rowData[16])) {
                $data_history = array(
                  "id_routing" => $last_id,
                  "remark" => 'Barang sudah diterima oleh ' .$rowData[16] ,
                  "created_by"    => 'Admin',
                  "status"       => 'DITERIMA'
                );
                $insert = $this->db->insert("tb_routingslip_history",$data_history);
              }
            }

            $barang = $this->admin->get_array('barang',array( 'UPPER(nama_barang)' => strtoupper(trim($rowData[11]))));
            // echo $this->db->last_query();
            if(empty($barang)){
              print_r($rowData[11] . " tidak terdaftar di master barang.<br>");
            }else{
              if($last_id > 0) {
                $data_detail = array(
                  "id_routing" => $last_id,
                  "no_routing"  => $rowData[1],
                  "id_barang" => $barang['id_barang'],
                  "satuan"    => 'PCS',
                  "qty"       => $rowData[12],
                  "kg"    => 0,
                );
                $insert = $this->db->insert("tb_routingslip_detail",$data_detail);
                // print_r($rowData[11] . " sukses.<br>");
              }
            }
            
 
              // print_r($rowData);
            skip:
            $routing = $rowData[1];
          }
          ++$i;
        }
    }

    echo "<br> Total Rows : ".$i." <br>";               
    $reader->close();
                   

    echo "Peak memory:", (memory_get_peak_usage(true) / 1024 / 1024), " MB" ,"<br>";
  }

}
