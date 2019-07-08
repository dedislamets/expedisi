<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payroll extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	    $this->load->model('Datatabel');
	   	$this->load->model('M_menu','',TRUE);
	   	$this->load->database();
	   	$this->load->library(array('cek_error'));  
     	ini_set('display_errors','on');  
     	ini_set("memory_limit","512M"); 
     	ini_set('sqlsrv.ClientBufferMaxKBSize','524288'); // Setting to 512M
		ini_set('pdo_sqlsrv.client_buffer_max_kb_size','524288');
     	error_reporting(E_ALL^E_NOTICE);
	}
	public function index()
	{		
		if($this->admin->logged_id())
    {
        	$data['menu'] = $this->M_menu->getMenu(147,0,"","Class");
    			$data['title'] = 'Payroll';
    			$data['main'] = 'payroll/index';
    			$data['js'] = 'script/payroll';
    			$data['modal'] = 'modal/payroll';
		      $data['periode'] = $this->admin->getperiode();
			   $this->load->view('home',$data,FALSE); 

    }else{
        redirect("login");

    }				  
						
	}
	public function datatabel()
	{

          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));

          $periode = (!empty($this->input->get('periode')) ? $this->input->get('periode') : 0);
          
          $books = $this->Datatabel->get_payroll_list($periode);

          $data = array();
          $x=1;
          foreach($books->result() as $r) {
               $data[] = array(
                    $x,
                    $r->EmployeeId,
                    $r->EmployeeName,
                    $r->IsDesc,
                    number_format($r->Total),
                    $r->NetSalary,
               );
               $x++;
          }

          $output = array(
               "draw" => $draw,
                 "recordsTotal" => $books->num_rows(),
                 "recordsFiltered" => $books->num_rows(),
                 "data" => $data
            );
          echo json_encode($output);
          exit();
	}


	public function resizeImage($filename, $source_path, $target_path, $width, $height)
	{
	    //$source_path = 'uploads/profile/' . $filename;
	    //$target_path = 'uploads/profile/thumbnail/';
	    $config_manip = array(
	          'image_library' => 'gd2',
	          'source_image' => $source_path,
	          'new_image' => $target_path,
	          'maintain_ratio' => TRUE,
	          'create_thumb' => TRUE,
	          'thumb_marker' => '_thumb',
	          'width' => $width,
	          'height' => $height
	    );


	    $this->load->library('image_lib', $config_manip);
	    if(!$this->image_lib->resize()) {
	      echo $this->image_lib->display_errors();
	      return false;
	    }

	    $this->image_lib->clear();
	    preg_match('/(?<extension>\.\w+)$/im', $filename, $matches);
	    $extension = $matches['extension'];
	    $thumbnail = preg_replace('/(\.\w+)$/im', '', $filename) . '_thumb' . $extension;
	    return $thumbnail;
	}
}
