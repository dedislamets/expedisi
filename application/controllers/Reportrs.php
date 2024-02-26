<?php

ini_set('max_execution_time', 0); 
ini_set('memory_limit','4096M');

defined('BASEPATH') OR exit('No direct script access allowed');

// require('../../tmp/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Reportrs extends CI_Controller {
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
      if(CheckMenuRole('reportrs')){
        redirect("errors");
      }
      $data['title'] = 'Report Routing Slip';
      $data['main'] = 'cargo/report';
      $data['js'] = 'script/report-rs';
      // $data['customer'] = $this->admin->getmaster('master_customer');

      $data['project'] = $this->db->query("SELECT distinct nama_project FROM `tb_routingslip` ")->result();
      $data['requestor'] = $this->db->query("SELECT distinct requestor FROM `tb_routingslip` ")->result();

      $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");

    }         
            
  }

  public function export()
  {
        $start = date("Y-m-d", strtotime($this->parse->anti_injection($this->input->get('from',TRUE))));
        $end = date("Y-m-d", strtotime($this->parse->anti_injection($this->input->get('to',TRUE))));
        $cust = $this->parse->anti_injection($this->input->get('c',TRUE));
        $requestor = $this->parse->anti_injection($this->input->get('req',TRUE));

        $this->db->select("R.no_routing,R.createdDate,
            CASE WHEN R.nama_penerima IS NULL THEN mcp.cust_name ELSE R.nama_penerima END cust_name_penerima, 
            CASE WHEN R.nama_pengirim IS NULL THEN mc.cust_name ELSE R.nama_pengirim END cust_name,
            spk_no,`nama_project`,kota_pengirim,kota_penerima,B.`nama_barang`,moda_name,pickup_date,
          received_date,received_doc,R.STATUS,agent,RD.`qty`,RD.`satuan`,origin,destination,received_by,requestor,u.nama_user", FALSE);
        $this->db->from("tb_routingslip R");
        $this->db->join('tb_routingslip_detail RD', 'RD.`id_routing`=R.`id`');
        $this->db->join('barang B', 'B.`id_barang`=RD.`id_barang`');
        $this->db->join('master_customer mc', 'mc.`id`=R.`id_pengirim`','LEFT');
        $this->db->join('master_customer mcp', 'mcp.`id`=R.`id_penerima`','LEFT');
        $this->db->join('tb_user u', 'u.`id_user`=R.`CreatedBy`','LEFT');
        $this->db->where("DATE(R.CreatedDate) BETWEEN '". $start ."' AND '". $end ."'");
        if($cust != "all"){
          $this->db->where("nama_project", $cust);
        }
        if($requestor != "all"){
          $this->db->where("requestor", $requestor);
        }
        $data = $this->db->get()->result();
        // echo $this->db->last_query();exit();

      $headers = array(
          'NO' => 'integer', 
          'Routing Slip' => 'string', 
          'DO/SPK' => 'string', 
          'Project' => 'string', 
          'Routing Date' => 'string',
          'Site Pengirim' => 'string',
          'Site Penerima' => 'string',
          'Pickup Date' => 'string',
          'Items' => 'string',
          'Qty' => 'integer',
          'Satuan' => 'string',
          'Status' => 'string',
          'Receive Date' => 'string',
          'Receiver' => 'string',
          'Doc Receive Date' => 'string',
          'Vendor' => 'string',
          'Transport' => 'string',
          'Requestor' => 'string',
          'Created By' => 'string',
          'Created Date' => 'string',
      );
      
      $writer = new XLSXWriter();
  
      $keywords = array('xlsx','MySQL','Codeigniter');
      $writer->setTitle('Routing Slip');
      $writer->setSubject('Report generated using Codeigniter and XLSXWriter');
      $writer->setAuthor('Dedi Slamet Supatman');
      $writer->setCompany('Dedi Slamet Supatman');
      $writer->setKeywords($keywords);
      $writer->setDescription('Routing Slip');
      $writer->setTempDir(sys_get_temp_dir());
      
      //write headers
      $writer->writeSheetHeader('Sheet1', $headers);
        
        $i=2; 
      foreach($data as $key=>$row) :
       $writer->writeSheetRow('Sheet1',array(
            $key+1, 
            $row->no_routing, 
            $row->spk_no, 
            $row->nama_project, 
            $row->createdDate,
            $row->cust_name,
            $row->cust_name_penerima,
            $row->pickup_date,
            $row->nama_barang,
            $row->qty,
            $row->satuan,
            $row->STATUS,
            $row->received_date,
            $row->received_by,
            $row->received_doc,
            $row->agent,
            $row->moda_name,
            $row->requestor,
            $row->nama_user,
            $row->createdDate,
            )
      );
      $i++;
      endforeach;
  
      $fileLocation = 'Report Routing Slip ('. $start .' sd '. $end .').xlsx';
      
      $writer->writeToFile($fileLocation);
      
      //force download
      header('Content-Description: File Transfer');
      header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
      header("Content-Disposition: attachment; filename=".basename($fileLocation));
      header("Content-Transfer-Encoding: binary");
      header("Expires: 0");
      header("Pragma: public");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header('Content-Length: ' . filesize($fileLocation)); //Remove
    
      ob_clean();
      flush();
    
      readfile($fileLocation);
      unlink($fileLocation);
      exit(0);
  }

  public function exportringkas()
  {
        $start = date("Y-m-d", strtotime($this->parse->anti_injection($this->input->get('from',TRUE))));
        $end = date("Y-m-d", strtotime($this->parse->anti_injection($this->input->get('to',TRUE))));
        $cust = $this->parse->anti_injection($this->input->get('c',TRUE));
        $requestor = $this->parse->anti_injection($this->input->get('req',TRUE));

        $this->db->select("R.no_routing,R.createdDate,
            R.nama_penerima as cust_name_penerima, 
            R.nama_pengirim as cust_name,
            spk_no,`nama_project`,kota_pengirim,kota_penerima,moda_name,pickup_date,
          received_date,received_doc,R.STATUS,agent,origin,destination,received_by,requestor,u.nama_user", FALSE);
        $this->db->from("tb_routingslip R");
        //$this->db->join('master_customer mc', 'mc.`id`=R.`id_pengirim`','LEFT');
        //$this->db->join('master_customer mcp', 'mcp.`id`=R.`id_penerima`','LEFT');
        $this->db->join('tb_user u', 'u.`id_user`=R.`CreatedBy`','LEFT');
        $this->db->where("DATE(R.CreatedDate) BETWEEN '". $start ."' AND '". $end ."'");
        if($cust != "all"){
          $this->db->where("nama_project", $cust);
        }
        if($requestor != "all"){
          $this->db->where("requestor", $requestor);
        }
        $data = $this->db->get()->result();
        
        $headers = array(
          'NO' => 'integer', 
          'Routing Slip' => 'string', 
          'DO/SPK' => 'string', 
          'Project' => 'string', 
          'Routing Date' => 'string',
          'Site Pengirim' => 'string',
          'Site Penerima' => 'string',
          'Pickup Date' => 'string',
          'Status' => 'string',
          'Receive Date' => 'string',
          'Receiver' => 'string',
          'Doc Receive Date' => 'string',
          'Vendor' => 'string',
          'Transport' => 'string',
          'Requestor' => 'string',
          'Created By' => 'string',
          'Created Date' => 'string',
      );
      
      $writer = new XLSXWriter();
  
      $keywords = array('xlsx','MySQL','Codeigniter');
      $writer->setTitle('Routing Slip');
      $writer->setSubject('Report generated using Codeigniter and XLSXWriter');
      $writer->setAuthor('Dedi Slamet Supatman');
      $writer->setCompany('Dedi Slamet Supatman');
      $writer->setKeywords($keywords);
      $writer->setDescription('Routing Slip');
      $writer->setTempDir(sys_get_temp_dir());
      
      //write headers
      $writer->writeSheetHeader('Sheet1', $headers);
        
        $i=2; 
      foreach($data as $key=>$row) :
       $writer->writeSheetRow('Sheet1',array(
            $key+1, 
            $row->no_routing, 
            $row->spk_no, 
            $row->nama_project, 
            $row->createdDate,
            $row->cust_name,
            $row->cust_name_penerima,
            $row->pickup_date,
            $row->STATUS,
            $row->received_date,
            $row->received_by,
            $row->received_doc,
            $row->agent,
            $row->moda_name,
            $row->requestor,
            $row->nama_user,
            $row->createdDate,
            )
      );
      $i++;
      endforeach;
  
      $fileLocation = 'Report Ringkas Routing Slip ('. $start .' sd '. $end .').xlsx';
      
      $writer->writeToFile($fileLocation);
      
      //force download
      header('Content-Description: File Transfer');
      header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
      header("Content-Disposition: attachment; filename=".basename($fileLocation));
      header("Content-Transfer-Encoding: binary");
      header("Expires: 0");
      header("Pragma: public");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header('Content-Length: ' . filesize($fileLocation)); //Remove
    
      ob_clean();
      flush();
    
      readfile($fileLocation);
      unlink($fileLocation);
      exit(0);
      
  }

}
