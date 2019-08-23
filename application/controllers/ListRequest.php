<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListRequest extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        $this->load->model('Datatabel');
        $this->load->database();
        
    }

    
    public function index()
    {
        $userid = $this->session->userdata('user_id');
        $form = $this->input->get('f');
        
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

    public function dailyattendance()
    {
        $data['organization'] = $this->admin->getmaster('Organization');
        $data['structural'] = $this->admin->getmaster('V_Position','Positiontype=1');
        $data['fungsional'] = $this->admin->getmaster('V_Position','Positiontype=2');
        $data['location'] = $this->admin->getmaster('Location');
        $data['class'] = $this->admin->getmaster('Class');
        $data['golongan'] = $this->admin->getmaster('Golongan');
        $data['coa'] = $this->admin->getmaster('COA');
        $data['grade'] = $this->admin->getmaster('Grade');
        $data['rank'] = $this->admin->getmaster('Rank');
        $data['blood'] = $this->admin->getmaster('Blood');
        $data['gender'] = $this->admin->getmaster('Gender');
        $data['religion'] = $this->admin->getmaster('Religion');
        $data['resign_type'] = $this->admin->getmaster('ResignType');
        $data['find_employee'] = $this->admin->getfindemployee('Vf_FindEmployeeActiveNow');
        
        $data['working_status'] = $this->admin->getmasterworking();

        $data['main'] = 'iframe/dailyattendance';
        $this->load->view('iframe',$data,FALSE); 
    }
    
}