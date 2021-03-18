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

         $sql = "SELECT R.no_routing,R.createdDate,CASE WHEN site_name <>'' THEN site_name ELSE kota_pengirim END origin,kota_penerima
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
            WHERE DATE(R.CreatedDate) BETWEEN '". $start ."' AND '". $end ."'";
        if($cust != ""){
          $sql .= " and R.id_pengirim in (". $cust .") ";
        }

        $sql .= "ORDER BY R.no_routing";

        $data = $this->db->query($sql)->result();
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
        $spreadsheet->getActiveSheet()->mergeCells("A1:V1");

        $spreadsheet->getActiveSheet()->mergeCells("A2:V2");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', 'DELIVERY ORDER LIST');
        $spreadsheet->getActiveSheet()->getStyle('A2:V2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');

        // VENDOR
        $spreadsheet->getActiveSheet()->mergeCells("W2:AL2");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('W2', 'VENDOR');
        $spreadsheet->getActiveSheet()->getStyle('W2:AL2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

        // CUSTOMER
        $spreadsheet->getActiveSheet()->mergeCells("AM2:BC2");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('AM2', 'CUSTOMER');
        $spreadsheet->getActiveSheet()->getStyle('AM2:BC2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('05AE0E');
       

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
          ->setCellValue('S3', 'Airlines')
          ->setCellValue('T3', 'Ton')
          ->setCellValue('U3', 'Others')
          ->setCellValue('V3', 'Mos Date')
          ->setCellValue('W3', 'Rate')
          ->setCellValue('X3', 'Subtotal')
          ->setCellValue('Y3', 'Add Cost')
          ->setCellValue('Z3', 'Total Invoice')
          ->setCellValue('AA3', 'Vendor')
          ->setCellValue('AB3', 'Invoice No')
          ->setCellValue('AC3', 'Submit Date')
          ->setCellValue('AD3', 'Term')
          ->setCellValue('AE3', 'Due Date')
          ->setCellValue('AF3', 'Days Outstanding')
          ->setCellValue('AG3', 'DP Date')
          ->setCellValue('AH3', 'DP')
          ->setCellValue('AI3', 'FP Date')
          ->setCellValue('AJ3', 'FP')
          ->setCellValue('AK3', 'Real Payment Amount')
          ->setCellValue('AL3', 'OverDue')
          ->setCellValue('AM3', 'Kg Rate')
          ->setCellValue('AN3', 'Pickup/Van Rate')
          ->setCellValue('AO3', 'CDD Rate')
          ->setCellValue('AP3', 'CDE Rate')
          ->setCellValue('AQ3', 'Fuso Rate')
          ->setCellValue('AR3', 'Tronton Rate')
          ->setCellValue('AS3', 'Container Rate')
          ->setCellValue('AT3', 'Chartered Rate')
          ->setCellValue('AU3', 'Airlines Rate')
          ->setCellValue('AV3', 'Ton Rate')
          ->setCellValue('AW3', 'Others Rate')
          ->setCellValue('AX3', 'Amount')
          ->setCellValue('AY3', 'Add Cost')
          ->setCellValue('AZ3', 'Subtotal')
          ->setCellValue('BA3', 'VAT%')
          ->setCellValue('BB3', 'WHT 23')
          ->setCellValue('BC3', 'Total Amount');

        // Judul
        $spreadsheet->getActiveSheet()->getStyle('A3:V3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('f4f403');
        // Vendor
        $spreadsheet->getActiveSheet()->getStyle('T3:AL3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');
        $spreadsheet->getActiveSheet()->getStyle('A3:AL3')->applyFromArray($styleArray);
        // Customer
        $spreadsheet->getActiveSheet()->getStyle('AM3:BC3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('05AE0E');
        $spreadsheet->getActiveSheet()->getStyle('AM3:BC3')->applyFromArray($styleArray);

        $spreadsheet->getActiveSheet()->setTitle('Recapitulation');

        $i=4; 
        $arr_inv_vend = array();

        foreach($data as $key=>$row) {
          $add_cost_vendor = "";
          $total_vendor = $total_cust = "";
          $dp_date = $dp_dibayar = $fp_date = $fp_dibayar = $dibayar = $payment_status = ""; 
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

              $tes = $this->db->query("SELECT no_invoice,SUM(dibayar)dibayar_cust 
                                      FROM tb_payment
                                      WHERE  type_payment='Customer' and no_invoice='". $row->no_invoice."'
                                      GROUP BY no_invoice")->row_array();
              $total_cust = $tes['dibayar_cust'];

              $payment = $this->db->query("SELECT tiv.no_invoice,tiv.total,
                              CASE WHEN total > ( 
                                SELECT dibayar FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                                ORDER BY CreatedDate ASC LIMIT 1
                              ) 
                              THEN 
                              (
                                SELECT tgl_payment FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                                ORDER BY CreatedDate ASC LIMIT 1
                              ) ELSE '' END dp_date,
                              CASE WHEN total > ( 
                                SELECT dibayar FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                                ORDER BY CreatedDate ASC LIMIT 1
                              ) 
                              THEN (SELECT dibayar FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                                ORDER BY CreatedDate ASC LIMIT 1)
                              ELSE '' END dp_dibayar,
                              CASE WHEN total = ( 
                                SELECT SUM(dibayar) FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                              ) 
                              THEN 
                              (
                                SELECT tgl_payment FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                                ORDER BY CreatedDate DESC LIMIT 1
                              ) ELSE '' END fp_date,
                              CASE WHEN total = ( 
                                SELECT SUM(dibayar) FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                              ) 
                              THEN (
                                SELECT dibayar FROM tb_payment 
                                WHERE type_payment='Vendor' AND no_invoice=tiv.no_invoice
                                ORDER BY CreatedDate DESC LIMIT 1
                              ) ELSE '' END fp_dibayar,
                              SUM(tb_payment.`dibayar`) dibayar,tiv.status
                              FROM tb_invoice_vendor tiv
                              JOIN tb_payment ON tiv.no_invoice=tb_payment.`no_invoice`
                              WHERE  type_payment='Vendor' and tiv.no_invoice='". $row->invoice_vendor."'
                              GROUP BY no_invoice")->row_array();
              $dp_date    = $payment['dp_date'];
              $dp_dibayar = $payment['dp_dibayar'];
              $fp_date    = $payment['fp_date'];
              $fp_dibayar = $payment['fp_dibayar'];
              $dibayar    = $payment['dibayar'];
              $payment_status    = $payment['status'];
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
            ->setCellValue('S'.$i, $row->AIRLINES)
            ->setCellValue('T'.$i, $row->TON)
            ->setCellValue('U'.$i, $row->OTHERS)
            ->setCellValue('V'.$i, $row->MOS_DATE)
            ->setCellValue('W'.$i, $row->rate_vendor)
            ->setCellValue('X'.$i, $row->subtotal_vendor)
            ->setCellValue('Y'.$i, $add_cost_vendor)
            ->setCellValue('Z'.$i, $total_vendor)
            ->setCellValue('AA'.$i, $row->agent)
            ->setCellValue('AB'.$i, $row->invoice_vendor)
            ->setCellValue('AC'.$i, $row->tgl_submit_invoice)
            ->setCellValue('AD'.$i, $row->term_vendor)
            ->setCellValue('AE'.$i, $row->due_date_vendor)
            ->setCellValue('AF'.$i, $row->outstanding_vendor)
            ->setCellValue('AG'.$i, $dp_date)
            ->setCellValue('AH'.$i, $dp_dibayar)
            ->setCellValue('AI'.$i, $fp_date)
            ->setCellValue('AJ'.$i, $fp_dibayar)
            ->setCellValue('AK'.$i, $dibayar)
            ->setCellValue('AL'.$i, ( $payment_status != 'LUNAS' ? (intval($row->outstanding_vendor) <= 0 ? 'Yes' : 'No') : ''  ))
            ->setCellValue('AM'.$i, $row->KG_I)
            ->setCellValue('AN'.$i, $row->PICKUP_VAN_I)
            ->setCellValue('AO'.$i, $row->CDD_I)
            ->setCellValue('AP'.$i, $row->CDE_I)
            ->setCellValue('AQ'.$i, $row->FUSO_I)
            ->setCellValue('AR'.$i, $row->TRONTON_I)
            ->setCellValue('AS'.$i, $row->LCL_DLL_FCL_I)
            ->setCellValue('AT'.$i, $row->CHARTERED_I)
            ->setCellValue('AU'.$i, $row->AIRLINES_I)
            ->setCellValue('AV'.$i, $row->TON_I)
            ->setCellValue('AW'.$i, $row->OTHERS_I)
            ->setCellValue('AX'.$i, $row->subtotal)
            ->setCellValue('AY'.$i, 0)
            ->setCellValue('AZ'.$i, 0)
            ->setCellValue('BA'.$i, 0)
            ->setCellValue('BB'.$i, 0)
            ->setCellValue('BC'.$i, 0);


            $spreadsheet->getActiveSheet()->getStyle('A4:BC'.$i)->applyFromArray($styleArray);
            //format number
            $spreadsheet->getActiveSheet()->getStyle('W'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('X'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('Y'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('Z'.$i)->getNumberFormat()->setFormatCode('#,##0.00');

            $spreadsheet->getActiveSheet()->getStyle('AH'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AJ'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AK'.$i)->getNumberFormat()->setFormatCode('#,##0.00');

            $spreadsheet->getActiveSheet()->getStyle('AM'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AN'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AO'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AP'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AQ'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AR'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AS'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
            $spreadsheet->getActiveSheet()->getStyle('AT'.$i)->getNumberFormat()->setFormatCode('#,##0.00');
          $i++;
        }


        // foreach (range('A','Z') as $col) {
        //   $spreadsheet->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);  
        // }

        foreach ($this->excelColumnRange('A', 'BC') as $value) {
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


