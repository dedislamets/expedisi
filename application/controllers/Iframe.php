<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iframe extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        $this->load->model('Datatabel');
        $this->load->database();
        
    }

    
    public function index()
    {
        $userid = 0;
        $RecnumPatternSchedule = $this->input->get('group');
        $action = $this->input->get('action');
        $start= date("Y-m-d", strtotime($this->input->get('start')));
        
        $end = date("Y-m-d", strtotime($this->input->get('end')));
        $replace = ($this->input->get('replace')=='true' ? 1 : 0);

        if($action==1) $this->Datatabel->generate_schedule_pattern($RecnumPatternSchedule,$start,$end,$replace);
        
        $data_pattern = $this->Datatabel->view_schedule_pattern($RecnumPatternSchedule,$start,$end);
        
        $table = '<table id="tabel-schedule" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">';
        $myArray = json_decode(json_encode($data_pattern), true);
        //print("<pre>".print_r($myArray,true)."</pre>");
        $table .="<thead><tr>";
       
        foreach($myArray[0] as $key => $item) {
            $table .="<td>". $key ."</td>";
        }
        $table .="</tr></thead><tbody style='overflow-y: scroll;height: 300px;'>";  
        foreach($myArray as $ky => $it) {
            $table .="<tr>";
            foreach($myArray[$ky] as $key => $item) {
                
                $table .="<td>". $item ."</td>";
                
            }
            $table .="</tr>"; 
        }
         
        $table .= "</tbody></table>";

        $data['main'] = 'iframe/schedulegroup';
        $data['tabel'] = $table;

        $this->load->view('iframe',$data,FALSE); 

    }
}