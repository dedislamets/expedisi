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
      $data['customer'] = $this->admin->getmaster('master_customer');

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

        $this->db->select("R.no_routing,createdDate,mc.`cust_name`,mcp.cust_name as cust_name_penerima,spk_no,`nama_project`,kota_pengirim,kota_penerima,B.`nama_barang`,moda_name,pickup_date,
          received_date,received_doc,STATUS,agent,RD.`qty`,RD.`satuan`");
        $this->db->from("tb_routingslip R");
        $this->db->join('tb_routingslip_detail RD', 'RD.`id_routing`=R.`id`');
        $this->db->join('barang B', 'B.`id_barang`=RD.`id_barang`');
        $this->db->join('master_customer mc', 'mc.`id`=R.`id_pengirim`');
        $this->db->join('master_customer mcp', 'mcp.`id`=R.`id_penerima`');
        $this->db->where("DATE(CreatedDate) BETWEEN '". $start ."' AND '". $end ."'");
        if($cust != "all"){
          $this->db->where("id_pengirim", $cust);
        }
        $data = $this->db->get()->result();

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
          ->setCellValue('C1', 'Tgl Routing')
          ->setCellValue('D1', 'SPK No')
          ->setCellValue('E1', 'Project')
          ->setCellValue('F1', 'Nama Customer')
          ->setCellValue('G1', 'Origin')
          ->setCellValue('H1', 'Nama Penerima')
          ->setCellValue('I1', 'Destination')
          ->setCellValue('J1', 'Nama Barang')
          ->setCellValue('K1', 'Transport')
          ->setCellValue('L1', 'Pickup Date')
          ->setCellValue('M1', 'MOS Date')
          ->setCellValue('N1', 'Tgl Terima Doc')
          ->setCellValue('O1', 'Status')
          ->setCellValue('P1', 'Vendor')
          ->setCellValue('Q1', 'Qty')
          ->setCellValue('R1', 'Satuan');

        $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');

        $spreadsheet->getActiveSheet()->setTitle('Recapitulation');

        $i=2; 
        foreach($data as $key=>$row) {

          $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $key+1)
            ->setCellValue('B'.$i, $row->no_routing)
            ->setCellValue('C'.$i, $row->createdDate)
            ->setCellValue('D'.$i, $row->spk_no)
            ->setCellValue('E'.$i, $row->nama_project)
            ->setCellValue('F'.$i, $row->cust_name)
            ->setCellValue('G'.$i, $row->kota_pengirim)
            ->setCellValue('H'.$i, $row->cust_name_penerima)
            ->setCellValue('I'.$i, $row->kota_penerima)
            ->setCellValue('J'.$i, $row->nama_barang)
            ->setCellValue('K'.$i, $row->moda_name)
            ->setCellValue('L'.$i, $row->pickup_date)
            ->setCellValue('M'.$i, $row->received_date)
            ->setCellValue('N'.$i, $row->received_doc)
            ->setCellValue('O'.$i, $row->STATUS)
            ->setCellValue('P'.$i, $row->agent)
            ->setCellValue('Q'.$i, $row->qty)
            ->setCellValue('R'.$i, $row->satuan);

            $spreadsheet->getActiveSheet()->getStyle('A2:R'.$i)->applyFromArray($styleArray);
          $i++;
        }


        foreach (range('A','Q') as $col) {
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
