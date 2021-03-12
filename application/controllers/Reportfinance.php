<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportFinance extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
    $this->load->model('admin');
   	$this->load->model('M_menu','',TRUE);

    if($this->admin->logged_id())
    {
      if(CheckMenuRole('reportfinance')){
        redirect("errors");
      }
    }else{
        redirect("login");
    } 
	   	
	}
	public function index()
	{		
    $data['title'] = 'Report Finance';
    $data['main'] = 'report/finance';
    $data['js'] = 'script/report-finance';
    $data['customer'] = $this->admin->getmaster('master_customer');

    $this->load->view('home',$data,FALSE);			  
	}

  public function export()
  {
        $start = date("Y-m-d", strtotime($this->parse->anti_injection($this->input->get('from',TRUE))));
        $end = date("Y-m-d", strtotime($this->parse->anti_injection($this->input->get('to',TRUE))));
        $cust = $this->parse->anti_injection($this->input->get('c',TRUE));

         $data = $this->db->query("SELECT R.no_routing,R.createdDate,CASE WHEN site_name <>'' THEN site_name ELSE kota_pengirim END origin,kota_penerima
            ,`nama_project`,B.`nama_barang`,RD.`qty`,RD.`satuan`,moda_name
            ,CASE WHEN RD.kg>0 THEN RD.kg ELSE '' END KG
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori` IN ('PICKUP','VAN') THEN RD.qty ELSE '' END PICKUP_VAN
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori`='Colt Diesel Double (CDD)' THEN RD.qty ELSE '' END CDD
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori`='Colt Diesel Engkel (CDE)' THEN RD.qty ELSE '' END CDE
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori`='FUSO' THEN RD.qty ELSE '' END FUSO
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori`='TRONTON' THEN RD.qty ELSE '' END TRONTON
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori` IN ('FCL 20FT','LCL','FCL 40FT') THEN RD.qty ELSE '' END LCL_DLL_FCL
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori` IN ('CHARTERED LCL','CHARTERED TONGKANG','CHARTERED') THEN RD.qty ELSE '' END CHARTERED
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori` IN ('AIRLINES') THEN RD.qty ELSE '' END AIRLINES
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori`='TON/KUBIKASI' THEN RD.qty ELSE '' END TON
            ,CASE WHEN RD.kg=0 AND mk.`moda_kategori`='DLL' THEN RD.qty ELSE '' END OTHERS
            ,received_date AS MOS_DATE
            ,ivd.price AS rate_vendor,ivd.subtotal AS subtotal_vendor,
            agent,iv.id as id_invoice_vendor,iv.no_invoice AS invoice_vendor,tb_term.`term` term_vendor,
            iv.tgl_submit_invoice,iv.due_date due_date_vendor
            ,TIMESTAMPDIFF(DAY,CURDATE(),iv.due_date) outstanding_vendor
            ,CASE WHEN id.kg>0 THEN id.subtotal ELSE '' END KG_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori` IN ('PICKUP','VAN') THEN id.subtotal ELSE '' END PICKUP_VAN_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori`='Colt Diesel Double (CDD)' THEN id.subtotal ELSE '' END CDD_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori`='Colt Diesel Engkel (CDE)' THEN id.subtotal ELSE '' END CDE_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori`='FUSO' THEN id.subtotal ELSE '' END FUSO_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori`='TRONTON' THEN id.subtotal ELSE '' END TRONTON_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori` IN ('FCL 20FT','LCL','FCL 40FT') THEN id.subtotal ELSE '' END LCL_DLL_FCL_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori` IN ('CHARTERED LCL','CHARTERED TONGKANG','CHARTERED') THEN id.subtotal ELSE '' END CHARTERED_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori` IN ('AIRLINES') THEN id.subtotal ELSE '' END AIRLINES_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori`='TON/KUBIKASI' THEN id.subtotal ELSE '' END TON_I
            ,CASE WHEN id.kg=0 AND mk.`moda_kategori`='DLL' THEN id.subtotal ELSE '' END OTHERS_I
            ,id.subtotal
            ,i.no_invoice,
            i.tgl_submit_invoice,ti.term,i.due_date
            ,TIMESTAMPDIFF(DAY,CURDATE(),i.due_date) outstanding
            FROM tb_routingslip R
            JOIN tb_moda_kat mk ON mk.`id`=R.`id_moda_kat`
            JOIN tb_routingslip_detail RD ON RD.`id_routing`=R.`id`
            JOIN barang B ON B.`id_barang`=RD.`id_barang`
            LEFT JOIN tb_invoice_vendor iv ON iv.id_routing=R.id
            LEFT JOIN tb_term ON tb_term.`id`=iv.id_term
            LEFT JOIN tb_invoice_vendor_detail ivd ON ivd.id_invoice=iv.id AND ivd.id_barang=RD.id_barang

            LEFT JOIN tb_invoice_routing ir ON ir.id_routing=R.id AND void=0
            LEFT JOIN tb_invoice i ON i.id=ir.id_invoice
            LEFT JOIN tb_term ti ON ti.`id`=i.id_term
            LEFT JOIN tb_invoice_detail id ON id.id_invoice=i.id AND id.id_barang=RD.id_barang
            WHERE DATE(R.CreatedDate) BETWEEN '". $start ."' AND '". $end ."'")->result();
        // if($cust != "all"){
        //   $this->db->where("R.id_pengirim", $cust);
        // }
          // echo $this->db->last_query(); exit();

        $spreadsheet = new Spreadsheet;

        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $formatnumber = array(
           'numberFormat' => [
                'formatCode' => \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_EUR
            ]
        );
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'LAPORAN FINANCE ('. $start.' s/d '. $end .')');
        $spreadsheet->getActiveSheet()->mergeCells("A1:S1");

        $spreadsheet->getActiveSheet()->mergeCells("A2:S2");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'DELIVERY ORDER LIST');
        $spreadsheet->getActiveSheet()->getStyle('A2:S2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');

        $spreadsheet->getActiveSheet()->mergeCells("T2:AC2");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('T2', 'VENDOR');
        $spreadsheet->getActiveSheet()->getStyle('T2:AC2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

       

        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A3', 'No')
          ->setCellValue('B3', 'Code No')
          ->setCellValue('C3', 'Tgl Routing')
          ->setCellValue('D3', 'Pickup Adress')
          ->setCellValue('E3', 'Destination')
          ->setCellValue('F3', 'Project')
          ->setCellValue('G3', 'Nama Barang')
          ->setCellValue('H3', 'Qty')
          ->setCellValue('I3', 'Satuan')
          ->setCellValue('J3', 'Pengiriman')
          ->setCellValue('K3', 'Berat KG')
          ->setCellValue('L3', 'Pickup/Van')
          ->setCellValue('M3', 'CDD')
          ->setCellValue('N3', 'CDE')
          ->setCellValue('O3', 'FUSO')
          ->setCellValue('P3', 'Tronton')
          ->setCellValue('Q3', 'LCL/Container/FCL')
          ->setCellValue('R3', 'Chartered')
          ->setCellValue('S3', 'Mos Date')
          ->setCellValue('T3', 'Rate')
          ->setCellValue('U3', 'Subtotal')
          ->setCellValue('V3', 'Add Cost')
          ->setCellValue('W3', 'Total Invoice')
          ->setCellValue('X3', 'Vendor')
          ->setCellValue('Y3', 'Invoice No')
          ->setCellValue('Z3', 'Submit Date')
          ->setCellValue('AA3', 'Term')
          ->setCellValue('AB3', 'Due Date')
          ->setCellValue('AC3', 'Days Outstanding');

        $spreadsheet->getActiveSheet()->getStyle('A3:S3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');
        $spreadsheet->getActiveSheet()->getStyle('T3:AC3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');
        $spreadsheet->getActiveSheet()->getStyle('A3:AC3')->applyFromArray($styleArray);

        $spreadsheet->getActiveSheet()->setTitle('Recapitulation');

        $i=4; 
        $arr_inv_vend = array();

        foreach($data as $key=>$row) {
          $add_cost_vendor = "";
          $total_vendor = "";
          if (in_array($row->id_invoice_vendor,array_keys($arr_inv_vend))) {
            
          }else{
            if(!empty($row->invoice_vendor)){
              $arr_inv_vend[$row->id_invoice_vendor] = $row->invoice_vendor; 
              $tes = $this->db->query("select sum(biaya) add_cost_vendor 
                            from tb_invoice_vendor_opt_charge WHERE id_invoice='". $row->id_invoice_vendor."'
                            GROUP BY id_invoice")->row_array();
              $add_cost_vendor = $tes['add_cost_vendor'];

              $tes = $this->db->query("SELECT no_invoice,SUM(dibayar)dibayar 
                                      FROM tb_payment
                                      WHERE  type_payment='Vendor' and no_invoice='". $row->invoice_vendor."'
                                      GROUP BY no_invoice")->row_array();
              $total_vendor = $tes['dibayar'];
            }
              

          }

          $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $key+1)
            ->setCellValue('B'.$i, $row->no_routing)
            ->setCellValue('C'.$i, $row->createdDate)
            ->setCellValue('D'.$i, $row->origin)
            ->setCellValue('E'.$i, $row->kota_penerima)
            ->setCellValue('F'.$i, $row->nama_project)
            ->setCellValue('G'.$i, $row->nama_barang)
            ->setCellValue('H'.$i, $row->qty)
            ->setCellValue('I'.$i, $row->satuan)
            ->setCellValue('J'.$i, $row->moda_name)
            ->setCellValue('K'.$i, $row->KG)
            ->setCellValue('L'.$i, $row->PICKUP_VAN)
            ->setCellValue('M'.$i, $row->CDD)
            ->setCellValue('N'.$i, $row->CDE)
            ->setCellValue('O'.$i, $row->FUSO)
            ->setCellValue('P'.$i, $row->TRONTON)
            ->setCellValue('Q'.$i, $row->LCL_DLL_FCL)
            ->setCellValue('R'.$i, $row->CHARTERED)
            ->setCellValue('S'.$i, $row->MOS_DATE)
            ->setCellValue('T'.$i, $row->rate_vendor)
            ->setCellValue('U'.$i, $row->subtotal_vendor)
            ->setCellValue('V'.$i, $add_cost_vendor)
            ->setCellValue('W'.$i, $total_vendor)
            ->setCellValue('X'.$i, $row->agent)
            ->setCellValue('Y'.$i, $row->invoice_vendor)
            ->setCellValue('Z'.$i, $row->tgl_submit_invoice)
            ->setCellValue('AA'.$i, $row->term_vendor)
            ->setCellValue('AB'.$i, $row->due_date_vendor)
            ->setCellValue('AC'.$i, $row->outstanding_vendor);

            $spreadsheet->getActiveSheet()->getStyle('A4:AC'.$i)->applyFromArray($styleArray);
            //format number
            $spreadsheet->getActiveSheet()->getStyle('T'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('U'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('V'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
          $i++;
        }

        // print("<pre>".print_r($arr_inv_vend,true)."</pre>");exit();

        // foreach (range('A','Z') as $col) {
        //   $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);  
        // }

        foreach ($this->excelColumnRange('A', 'AC') as $value) {
            $spreadsheet->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);  
        }
        

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Report Finance.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
  }

  function excelColumnRange($lower, $upper) {
    ++$upper;
    for ($i = $lower; $i !== $upper; ++$i) {
        yield $i;
    }
  }
  

}


