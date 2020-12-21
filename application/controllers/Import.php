<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/third_party/spout/Autoloader/autoload.php';
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

class Import extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	   	$this->load->model('M_menu','',TRUE);
      $this->load->library('Excel'); //load librari excel
	   	
	}
	public function index()
	{		
		if($this->admin->logged_id())
        {
			$data['title'] = 'Import Excel';
			$data['main'] = 'import/index';
			$data['js'] = 'script/barang';
			$data['modal'] = 'modal/barang';

			$this->load->view('home',$data,FALSE); 

        }else{
            redirect("login");

        }				  
						
	}

  public function importExcel(){
    $fileName = $_FILES['file']['name'];
      
    $config['upload_path'] = './upload/'; //path upload
    $config['file_name'] = $fileName;  // nama file
    $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
    $config['max_size'] = 10000; // maksimal sizze


    $this->load->library('upload'); //meload librari upload
    $this->upload->overwrite = true;
    $this->upload->initialize($config);
      
    if(! $this->upload->do_upload('file') ){
        echo $this->upload->display_errors();exit();
    }
            
    $inputFileName = './upload/'.$fileName;

    // try {
    //         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    //         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    //         $objPHPExcel = $objReader->load($inputFileName);
    // } 
    // catch(Exception $e) {
    //         die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    // }

    // $sheet = $objPHPExcel->getSheet(0);
    // $highestRow = $sheet->getHighestRow();
    // $highestColumn = $sheet->getHighestColumn();

    // for ($row = 2; $row <= $highestRow; $row++){                 
    //     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);   

    //      // Sesuaikan key array dengan nama kolom di database                                                         
    //      $data = array(
    //         "province"=> $rowData[0][0],
    //         "kota"=> $rowData[0][1] . $rowData[0][2],
    //         "kecamatan"=> $rowData[0][3],
    //         "kelurahan"=> $rowData[0][4],
    //         "kodepos"=> $rowData[0][5],
    //     );

    //     $insert = $this->db->insert("master_city",$data);
              
    // }
    // redirect('Home');

    $reader = ReaderFactory::create(Type::XLSX); //set Type file xlsx
    $reader->open($inputFileName); //open the file           

    echo "<pre>";           
    $i = 0; 

    foreach ($reader->getSheetIterator() as $sheet) {             
        foreach ($sheet->getRowIterator() as $rowData) {
          if($i>0){
            $data = array(
                "province"=> $rowData[0],
                "kota"=> $rowData[1] . " " . $rowData[2],
                "kecamatan"=> $rowData[3],
                "kelurahan"=> $rowData[4],
                "kodepos"=> $rowData[5],
            );

            $insert = $this->db->insert("master_city",$data);
            print_r($rowData); 
          }
          ++$i;
        }
    }

    echo "<br> Total Rows : ".$i." <br>";               
    $reader->close();
                   

    echo "Peak memory:", (memory_get_peak_usage(true) / 1024 / 1024), " MB" ,"<br>";
  }
    

  public function readExcelFile() {

          try {
            
              //Lokasi file excel        
                $file_path = "C:\file_excel.xlsx";                     
                $reader = ReaderFactory::create(Type::XLSX); //set Type file xlsx
                $reader->open($file_path); //open the file           

                echo "<pre>";           
                $i = 0; 
          
                foreach ($reader->getSheetIterator() as $sheet) {             
                    foreach ($sheet->getRowIterator() as $row) {

                         print_r($row); 
                   
                           ++$i;
                    }
                }

                echo "<br> Total Rows : ".$i." <br>";               
                $reader->close();
                               

                echo "Peak memory:", (memory_get_peak_usage(true) / 1024 / 1024), " MB" ,"<br>";

          } catch (Exception $e) {

                  echo $e->getMessage();
                  exit;   
          }

  }//end of function 



  
}
