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

        $EmpID = $this->input->get("EmployeeId");
        $EmpName = $this->input->get("EmployeeName");

        $RecnumOrganization = $this->input->get("RecnumOrganization");
        if(!empty($RecnumOrganization))
            $RecnumOrganization = 'and RecnumOrganization in ('.implode (", ", $RecnumOrganization).')' ;
        $RecnumOrganizationSecondary = $this->input->get("RecnumOrganizationSecondary");
        if(!empty($RecnumOrganizationSecondary))
            $RecnumOrganizationSecondary = 'and RecnumOrganizationSecondary in ('.implode (", ", $RecnumOrganizationSecondary).')';

        $RecnumPositionStructural = $this->input->get("RecnumPositionStructural");
        if(!empty($RecnumPositionStructural))
            $RecnumPositionStructural = 'and RecnumPositionStructural in ('.implode (", ", $RecnumPositionStructural).')';

        $RecnumPositionStructuralSecondary = $this->input->get("RecnumPositionStructuralSecondary");
        if(!empty($RecnumPositionStructuralSecondary))
            $RecnumPositionStructuralSecondary = 'and RecnumPositionStructuralSecondary in ('.implode (", ", $RecnumPositionStructuralSecondary).')';

        $RecnumPositionFunctional = $this->input->get("RecnumPositionFunctional");
        if(!empty($RecnumPositionFunctional))
            $RecnumPositionFunctional = 'and RecnumPositionFunctional in ('.implode (", ", $RecnumPositionFunctional).')';

        $RecnumPositionFunctionalSecondary = $this->input->get("RecnumPositionFunctionalSecondary");
        if(!empty($RecnumPositionFunctionalSecondary))
            $RecnumPositionFunctionalSecondary = 'and RecnumPositionFunctionalSecondary in ('.implode (", ", $RecnumPositionFunctionalSecondary).')';

        $RecnumHead1 = $this->input->get("RecnumHead1");
        if(!empty($RecnumHead1))
            $RecnumHead1 = 'and RecnumHead1 in ('.implode (", ", $RecnumHead1).')';

        $RecnumHead2 = $this->input->get("RecnumHead2");
        if(!empty($RecnumHead2))
            $RecnumHead2 = 'and RecnumHead2 in ('.implode (", ", $RecnumHead2).')';

        $RecnumMentor = $this->input->get("RecnumMentor");
        if(!empty($RecnumMentor))
            $RecnumMentor = 'and RecnumMentor in ('.implode (", ", $RecnumMentor).')';

        $RecnumAdminHR = $this->input->get("RecnumAdminHR");
        if(!empty($RecnumAdminHR))
            $RecnumAdminHR = 'and RecnumAdminHR in ('.implode (", ", $RecnumAdminHR).')';

        $RecnumSecretary = $this->input->get("RecnumSecretary");
        if(!empty($RecnumSecretary))
            $RecnumSecretary = 'and RecnumSecretary in ('.implode (", ", $RecnumSecretary).')';

        $RecnumLocation = $this->input->get("RecnumLocation");
        if(!empty($RecnumLocation))
            $RecnumLocation = 'and RecnumLocation in ('.implode (", ", $RecnumLocation).')';

        $RecnumCOA = $this->input->get("RecnumCOA");
        if(!empty($RecnumCOA))
            $RecnumCOA = 'and RecnumCOA in ('.implode (", ", $RecnumCOA).')';

        $RecnumClass = $this->input->get("RecnumClass");
        if(!empty($RecnumClass))
            $RecnumClass = 'and RecnumClass in ('.implode (", ", $RecnumClass).')';

        $RecnumGolongan = $this->input->get("RecnumGolongan");
        if(!empty($RecnumGolongan))
            $RecnumGolongan = 'and RecnumGolongan in ('.implode (", ", $RecnumGolongan).')';

        $RecnumGrade = $this->input->get("RecnumGrade");
        if(!empty($RecnumGrade))
            $RecnumGrade = 'and RecnumGrade in ('.implode (", ", $RecnumGrade).')';

        $RecnumRank = $this->input->get("RecnumRank");
        if(!empty($RecnumRank))
            $RecnumRank = 'and RecnumRank in ('.implode (", ", $RecnumRank).')';

        $RecnumWorkingStatus = $this->input->get("RecnumWorkingStatus");
        if(!empty($RecnumWorkingStatus))
            $RecnumWorkingStatus = 'and RecnumWorkingStatus in ('.implode (", ", $RecnumWorkingStatus).')';

        $RecnumBlood = $this->input->get("RecnumBlood");
        if(!empty($RecnumBlood))
            $RecnumBlood = 'and RecnumBlood in ('.implode (", ", $RecnumBlood).')';

        $RecnumGender = $this->input->get("RecnumGender");
        if(!empty($RecnumGender))
            $RecnumGender = 'and RecnumGender in ('.implode (", ", $RecnumGender).')';

        $RecnumReligion = $this->input->get("RecnumReligion");
        if(!empty($RecnumReligion))
            $RecnumReligion = 'and RecnumReligion in ('.implode (", ", $RecnumReligion).')';

        $RecnumResignType = $this->input->get("RecnumResignType");
        if(!empty($RecnumResignType))
            $RecnumResignType = 'and RecnumResignType in ('.implode (", ", $RecnumResignType).')';

      $books = $this->Datatabel->find_employee($EmpID,$EmpName,$RecnumOrganization,$RecnumOrganizationSecondary, $RecnumPositionStructural, $RecnumPositionStructuralSecondary, $RecnumPositionFunctional, $RecnumPositionFunctionalSecondary, $RecnumHead1, $RecnumHead2,$RecnumMentor, $RecnumAdminHR, $RecnumSecretary, $RecnumLocation, $RecnumCOA, $RecnumClass, $RecnumGolongan, $RecnumGrade, $RecnumRank, $RecnumWorkingStatus, $RecnumBlood, $RecnumGender, $RecnumReligion, $RecnumResignType);

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