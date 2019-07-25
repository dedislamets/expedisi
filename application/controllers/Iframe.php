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
    public function find()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $RecnumOrganization = $this->input->get("RecnumOrganization");
        if(!empty($RecnumOrganization)){
            $RecnumOrganization = 'and RecnumOrganization in ('.implode (", ", $RecnumOrganization).')' ;
        }
        $RecnumOrganizationSecondary = $this->input->get("RecnumOrganizationSecondary");
        if(!empty($RecnumOrganizationSecondary)){
            $RecnumOrganizationSecondary = 'and RecnumOrganizationSecondary in ('.implode (", ", $RecnumOrganizationSecondary).')' ;
        }

      $books = $this->Datatabel->find_employee($RecnumOrganization,$RecnumOrganizationSecondary);

      $data = array();

      foreach($books->result() as $r) {
           $data[] = array(
                '<input type="checkbox" name="selected_courses[]" value="'.$r->EmployeeId .'">',
                $r->EmployeeId,
                $r->EmployeeName,
                $r->JoinDate,
                $r->Age,
                $r->NameGender,
                $r->NameOrganization,
           );
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
}