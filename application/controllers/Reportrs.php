<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require('./vendor/autoload.php');

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

        $spreadsheet = new Spreadsheet;

        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A1', 'NO')
          ->setCellValue('B1', 'Routing Slip')
          ->setCellValue('C1', 'DO/SPK')
          ->setCellValue('D1', 'Project')
          ->setCellValue('E1', 'Routing Date')
          ->setCellValue('F1', 'Site Pengirim')
          ->setCellValue('G1', 'Site Penerima')
          ->setCellValue('H1', 'Pickup Date')
          ->setCellValue('I1', 'Items')
          ->setCellValue('J1', 'Qty')
          ->setCellValue('K1', 'Satuan')
          ->setCellValue('L1', 'Status')
          ->setCellValue('M1', 'Receive Date')
          ->setCellValue('N1', 'Receiver')
          ->setCellValue('O1', 'Doc Receive Date')
          ->setCellValue('P1', 'Vendor')
          ->setCellValue('Q1', 'Transport')
          ->setCellValue('R1', 'Requestor')
          ->setCellValue('S1', 'Created By')
          ->setCellValue('T1', 'Created Date');

        $spreadsheet->getActiveSheet()->getStyle('A1:T1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');

        $spreadsheet->getActiveSheet()->setTitle('Recapitulation');

        $i=2; 
        foreach($data as $key=>$row) {

          $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $key+1)
            ->setCellValue('B'.$i, $row->no_routing)
            ->setCellValue('C'.$i, $row->spk_no)
            ->setCellValue('D'.$i, $row->nama_project)
            ->setCellValue('E'.$i, $row->createdDate)
            ->setCellValue('F'.$i, $row->cust_name)
            ->setCellValue('G'.$i, $row->cust_name_penerima)
            ->setCellValue('H'.$i, $row->pickup_date)
            ->setCellValue('I'.$i, $row->nama_barang)
            ->setCellValue('J'.$i, $row->qty)
            ->setCellValue('K'.$i, $row->satuan)
            ->setCellValue('L'.$i, $row->STATUS)
            ->setCellValue('M'.$i, $row->received_date)
            ->setCellValue('N'.$i, $row->received_by)
            ->setCellValue('O'.$i, $row->received_doc)
            ->setCellValue('P'.$i, $row->agent)
            ->setCellValue('Q'.$i, $row->moda_name)
            ->setCellValue('R'.$i, $row->requestor)
            ->setCellValue('S'.$i, $row->nama_user)
            ->setCellValue('T'.$i, $row->createdDate);

            $spreadsheet->getActiveSheet()->getStyle('A2:T'.$i)->applyFromArray($styleArray);
          $i++;
        }


        foreach (range('A','T') as $col) {
          $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);  
        }

       
        // exit();
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Report Routing Slip.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
  }

  

}
