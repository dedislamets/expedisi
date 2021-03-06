<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        $this->load->model('Datatabel');
        $this->load->model('Eform');
        $this->load->database();
        $this->load->model('M_menu','',TRUE);
        
    }

    
    public function index()
    {
        $recLogin = $this->session->userdata('user_id');
        $data['menu'] = $this->M_menu->getMenu($recLogin,0,"");
        $userid = $this->session->userdata('user_id');        
        
        $now = date('Y-m-d'); 
        
        $data_pattern = $this->Datatabel->generate_approval('2019-01-01','2019-12-31',0,0);
        
        
        $table = '<table id="tabel-request" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">';
        $myArray = $data_pattern;
        
        $table .="<thead><tr>";
        $table .='<td><input type="checkbox" name="selected_all" id="selected_all" value="all"></td>';
        $table .="<td>Status</td>";
        $table .="<td>Employee Name</td>";
        $table .="<td>Request Date</td>";
        $table .="<td>Type</td>";
        $table .="<td>Remark</td>";
        $table .="<td style='text-align:center;'>Action</td>";
        $table .="</tr></thead><tbody>";  

        foreach($myArray as $ky => $it) {
            $table .="<tr>";
            
            $color="";
            if($it->NameRequestStatus=="Open"){
                $color ="";
            }elseif ($it->NameRequestStatus=="Rejected") {
                $color ="danger";
            }elseif ($it->NameRequestStatus=="Approved") {
                $color ="primary";
            }
            $table .='<td>';
            if($color ==""){
                $table .='<input type="checkbox" name="selected_courses[]" value="'.$it->Recnum .'-'. $it->RecnumWorkflowMaster.'-'. $it->RecnumRequestStatus .'">';
            }
            $table .='</td>';
            $table .="<td><div class='label label-lg label-".$color." arrowed-in arrowed-in-right' style=''>". $it->NameRequestStatus ."</div></td>";
            $table .="<td>". $it->EmployeeName ."</td>";
            $table .="<td>". $it->RequestDate ."</td>";
            $table .="<td>". $it->NameWorkflowMaster ."</td>";
            $table .="<td>". $it->Remark ."</td>";
            $table .='<td style="text-align:center;width:200px">';
            if($color ==""){
                $table .='<button class="btn btn-xs btn-success" onclick="editList('.$it->Recnum.');">
                            <i class="ace-icon fa fa-check  bigger-110 icon-only"></i>Approval
                          </button> | <button class="btn btn-xs btn-danger" onclick="removeList('.$it->Recnum.');">
                            <i class="ace-icon fa fa-times  bigger-110 icon-only" ></i> Rejected
                          </button>';
            }
            $table .='</td>';
            $table .="</tr>"; 
        }
         
        $table .= "</tbody></table>";

        $data['workflow'] = $this->admin->getmaster('Vf_findWorkflowmaster','',1);
        $data['status'] = $this->admin->getmaster('Vf_findRequestStatus','',1);

        $data['main']  = 'setting/approval';
        $data['modal'] = 'modal/generateRequest';
        $data['tabel'] = $table;        
        $data['title'] = 'List Approval';
        $data['js'] = 'script/approval';

        $this->load->view('home',$data,FALSE); 

    }

    public function find()
    {        
        $start = date('Y-m-d'); 
        if(!empty($this->input->post('start')))
            $start= date("Y-m-d", strtotime($this->input->post('start')));
        
        $end = date('Y-m-d'); 
        if(!empty($this->input->post('end')))
            $end = date("Y-m-d", strtotime($this->input->post('end')));
        
        $data_pattern = $this->Datatabel->generate_approval($start,$end,$this->input->post('type'),$this->input->post('status'));
        
        
        $table = '<table id="tabel-request" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">';
        $myArray = $data_pattern;
        
        $table .="<thead><tr>";
        $table .='<td><input type="checkbox" name="selected_all" id="selected_all" value="all"></td>';
        $table .="<td>Status</td>";
        $table .="<td>Employee Name</td>";
        $table .="<td>Request Date</td>";
        $table .="<td>Type</td>";
        $table .="<td>Remark</td>";
        $table .="<td style='text-align:center;'>Action</td>";
        $table .="</tr></thead><tbody>";  

        foreach($myArray as $ky => $it) {
            $table .="<tr>";
            
            $color="";
            if($it->NameRequestStatus=="Open"){
                $color ="";
            }elseif ($it->NameRequestStatus=="Rejected") {
                $color ="danger";
            }elseif ($it->NameRequestStatus=="Approved") {
                $color ="primary";
            }
            $table .='<td>';
            if($color ==""){
                $table .='<input type="checkbox" name="selected_courses[]" value="'.$it->Recnum .'-'. $it->RecnumWorkflowMaster.'-'. $it->RecnumRequestStatus .'">';
            }
            $table .='</td>';
            $table .="<td><div class='label label-lg label-".$color." arrowed-in arrowed-in-right' style=''>". $it->NameRequestStatus ."</div></td>";
            $table .="<td>". $it->EmployeeName ."</td>";
            $table .="<td>". $it->RequestDate ."</td>";
            $table .="<td>". $it->NameWorkflowMaster ."</td>";
            $table .="<td>". $it->Remark ."</td>";
            $table .='<td style="text-align:center;width:200px">';
            if($color ==""){
                $table .='<button class="btn btn-xs btn-success" onclick="editList('.$it->Recnum.');">
                            <i class="ace-icon fa fa-check  bigger-110 icon-only"></i>Approval
                          </button> | <button class="btn btn-xs btn-danger" onclick="removeList('.$it->Recnum.');">
                            <i class="ace-icon fa fa-times  bigger-110 icon-only" ></i> Rejected
                          </button>';
            }
            $table .='</td>';
            $table .="</tr>"; 
        }
         
        $table .= "</tbody></table>";

        echo $table;
        exit();
    }

    public function approval()
    {
        $str = $this->input->post('str');
        $mode = $this->input->post('mode');
        if(!empty($str)){
            $str = substr($str, 0, -1);
            $str = explode(";",$str);            
        }
        foreach($str as $k => $value) {
            $value = explode("-",$value); 
            $recnum = $value[0];
            $recnumworkflow = $value[1];
            $recnumstatus = $value[2];            
            $query = $this->db->query("[Sp_ApprovalReject] ". $recnum ."," . $recnumworkflow .",'Test'," . $mode )->result();
        
        }
        echo "ok";
        exit();
    }
    
    
}