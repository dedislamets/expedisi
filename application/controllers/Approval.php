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
        
        
        $data_pattern = $this->Datatabel->generate_approval(0);
        
        
        $table = '<table id="tabel-request" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">';
        $myArray = $data_pattern;
        //print("<pre>".print_r($data_pattern,true)."</pre>");
        $table .="<thead><tr>";
        $table .="<td style='text-align:center;'>Action</td>";
        $table .="<td>Status</td>";
        $table .="<td>Employee Name</td>";
        $table .="<td>Request Date</td>";
        $table .="<td>Type</td>";
        $table .="<td>Remark</td>";
       
        $table .="</tr></thead><tbody>";  

        foreach($myArray as $ky => $it) {
            $table .="<tr>";
            $table .='<td style="text-align:center;width:300px"><button onclick="editList('.$it->Recnum.');">
                        <i class="ace-icon fa fa-pencil-square-o  bigger-110 icon-only"></i>Edit
                      </button> | <button onclick="removeList('.$it->Recnum.');">
                        <i class="ace-icon fa fa-trash  bigger-110 icon-only" ></i> Remove
                      </button></td>';
            if($it->NameRequestStatus=="Open"){
                $color ="green";
            }elseif ($it->NameRequestStatus=="Rejected") {
                $color ="red";
            }
            $table .="<td><div style='color:#fff;padding:5px;background-color:".$color."'>". $it->NameRequestStatus ."</div></td>";
            $table .="<td>". $it->EmployeeName ."</td>";
            $table .="<td>". $it->RequestDate ."</td>";
            $table .="<td>". $it->NameWorkflowMaster ."</td>";
            $table .="<td>". $it->Remark ."</td>";
            $table .="</tr>"; 
        }
         
        $table .= "</tbody></table>";

        $data['main']  = 'setting/approval';
        $data['modal'] = 'modal/generateRequest';
        $data['tabel'] = $table;        
        $data['title'] = 'List Approval';
        $data['js'] = 'script/generateRequest';

        $this->load->view('home',$data,FALSE); 

    }

    public function refresh()
    {
        $recLogin = $this->session->userdata('user_id');
        $data['menu'] = $this->M_menu->getMenu($recLogin,0,"");
        $userid = $this->session->userdata('user_id');
        $form = $this->input->get('f');
        
        $row_data = $this->db->query("SELECT * from WorkflowMaster WHERE IsTable='".$form."'")->result_array();
        $data_pattern = $this->Datatabel->generate_list($row_data[0]['GridQuery']);
        $data_column = $this->db->query("SELECT * from WorkflowMasterColumn WHERE RecnumWorkflowMaster=".$row_data[0]['Recnum'])->result_array();
        
        $table = '<table id="tabel-request" class="table table-striped table-bordered table-hover" style="margin-bottom: 0" style="width: 100%">';
        $myArray = $data_pattern;
        
        $table .="<thead><tr>";
        $table .="<td style='text-align:center;'>Action</td>";
        foreach($myArray[0] as $key => $item) {
            $found = $key;
            foreach($data_column as $k => $value) {
                if($data_column[$k]['IsField'] == $key) {
                    $found = $value['IsCaption'];
                    break;
                }
            }
            $table .="<td class=". ($found=='Recnum' ? 'hidden':'').">". $found ."</td>";
        }
        $table .="</tr></thead><tbody>";  

        foreach($myArray as $ky => $it) {
            $table .="<tr>";
            $table .='<td style="text-align:center;width:300px"><button onclick="editList('.$it->Recnum.');">
                        <i class="ace-icon fa fa-pencil-square-o  bigger-110 icon-only"></i>Edit
                      </button> | <button onclick="removeList('.$it->Recnum.');">
                        <i class="ace-icon fa fa-trash  bigger-110 icon-only" ></i> Remove
                      </button> | <button>
                        <i class="ace-icon fa fa-exclamation-circle  bigger-110 icon-only"></i> History
                      </button></td>';
            foreach($myArray[$ky] as $key => $item) {
                
                $table .="<td class=". ($key=='Recnum' ? 'hidden':'').">". $item ."</td>";
                
            }
            $table .="</tr>"; 
        }
         
        $table .= "</tbody></table>";

        echo $table;
        exit();
    }

    public function create()
    {
        $output = '';
        $form = $this->input->get('f');
        $row_data = $this->db->query("SELECT * from WorkflowMaster WHERE IsTable='".$form."'")->result_array();
        $data_column = $this->db->query("SELECT a.*,b.IsDesc as type_kolom,c.IsQuery  FROM WorkflowMasterColumn a 
                        INNER JOIN TypeColumn b on a.RecnumTypeColumn=b.Recnum 
                        LEFT JOIN BindingData c on c.Recnum=a.RecnumBindingData
                        where  RecnumWorkflowMaster=".$row_data[0]['Recnum'])->result_array();
        //print("<pre>".print_r($data_column,true)."</pre>");
        foreach($data_column as $k => $value) {
            if($data_column[$k]['type_kolom'] == 'ComboBox') {
               $output .= $this->Eform->combobox($value['IsCaption'],$value['IsField'], $value['IsQuery']);
            }elseif ($data_column[$k]['type_kolom'] == 'Text') {
               $output .= $this->Eform->Text($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Text Multiline') {
               $output .= $this->Eform->Multiline($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Date') {
               $output .= $this->Eform->Date($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Time') {
               $output .= $this->Eform->Time($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Upload Photo') {
               $output .= $this->Eform->Uploadfile($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Number (Int)') {
               $output .= $this->Eform->numberInt($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Number (Decimal)') {
               $output .= $this->Eform->number($value['IsCaption'],$value['IsField']);
            }
        }
        echo $output;
        exit();
    }

    public function edit()
    {
        $output = '';
        $form = $this->input->get('f');
        $row_data = $this->db->query("SELECT * from WorkflowMaster WHERE IsTable='".$form."'")->result_array();
        $data_column = $this->db->query("SELECT a.*,b.IsDesc as type_kolom,c.IsQuery  FROM WorkflowMasterColumn a 
                        INNER JOIN TypeColumn b on a.RecnumTypeColumn=b.Recnum 
                        LEFT JOIN BindingData c on c.Recnum=a.RecnumBindingData
                        where  RecnumWorkflowMaster=".$row_data[0]['Recnum'])->result_array();

        $row_value = $this->db->query("SELECT * from ".$row_data[0]['IsTable']." WHERE Recnum='".$this->input->get('Recnum')."'")->result_array();

        foreach($data_column as $k => $value) {
            if($data_column[$k]['type_kolom'] == 'ComboBox') {
               $output .= $this->Eform->combobox($value['IsCaption'],$value['IsField'], $value['IsQuery'],$row_value[0][$value['IsField']]);
            }elseif ($data_column[$k]['type_kolom'] == 'Text Multiline') {
               $output .= $this->Eform->Multiline($value['IsCaption'],$value['IsField'],$row_value[0][$value['IsField']]);
            }elseif ($data_column[$k]['type_kolom'] == 'Date') {
               $output .= $this->Eform->Date($value['IsCaption'],$value['IsField'],$row_value[0][$value['IsField']]);
            }elseif ($data_column[$k]['type_kolom'] == 'Time') {
               $output .= $this->Eform->Time($value['IsCaption'],$value['IsField'],$row_value[0][$value['IsField']]);
            }elseif ($data_column[$k]['type_kolom'] == 'Upload Photo') {
               $output .= $this->Eform->Uploadfile($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Number (Int)') {
               $output .= $this->Eform->numberInt($value['IsCaption'],$value['IsField'],$row_value[0][$value['IsField']]);
            }elseif ($data_column[$k]['type_kolom'] == 'Number (Decimal)') {
               $output .= $this->Eform->number($value['IsCaption'],$value['IsField'],$row_value[0][$value['IsField']]);
            }
        }
        echo $output;
        exit();
    }

    public function save()
    {
        $userid = $this->session->userdata('user_id');
        $row_data = $this->db->query("SELECT * from WorkflowMaster WHERE IsTable='". $this->input->post('recnum_page') ."'")->result_array();

        $exec_qry = $row_data[0]['IsSP'];
        $text = explode("@",$exec_qry);
        for ($i=0; $i < count($text) ;$i++) { 
            $pos = strpos($text[$i], 'Exec');
            if(!$pos){
                if(trim($text[$i]) == 'Status,'){
                    
                    if($this->input->post('Recnumid') !="" ){
                        $exec_qry = str_replace('@'.$text[$i], "'Edit'," ,$exec_qry);
                    }else{
                        $exec_qry = str_replace('@'.$text[$i], "'Input'," ,$exec_qry);
                    }
                    
                }
                foreach ($this->input->post() as $k => $value)
                {
                    if(strtolower($k).',' == strtolower($text[$i])){
                        $exec_qry = str_replace('@'.$text[$i], "'". $value."'," ,$exec_qry);
                    }
                    if($text[$i] == 'UserId'){
                        $exec_qry = str_replace('@'.$text[$i], "'". $userid."'" ,$exec_qry);
                    }
                    if($text[$i] == 'Recnum,'){                        
                        $exec_qry = str_replace('@'.$text[$i], ($this->input->post('Recnumid') !='' ? $this->input->post('Recnumid') : 0) ."," ,$exec_qry);
                    }
                    if($text[$i] == 'AttachFile,'){
                        $exec_qry = str_replace('@'.$text[$i], "''," ,$exec_qry);
                    }

                }
                
            }
        }

        //echo $exec_qry;
        $query = $this->db->query($exec_qry);
        $result = $query->result();

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
        
    }

    public function delete()
    {
        $userid = $this->session->userdata('user_id');
        $row_data = $this->db->query("SELECT * from WorkflowMaster WHERE IsTable='". $this->input->post('recnum_page') ."'")->result_array();

        $exec_qry = $row_data[0]['IsSP'];
        $text = explode("@",$exec_qry);
        for ($i=0; $i < count($text) ;$i++) { 
            $pos = strpos($text[$i], 'Exec');
            if(!$pos){
                if(trim($text[$i]) == 'Status,'){

                    $exec_qry = str_replace('@'.$text[$i], "'Delete'," ,$exec_qry);
                }
                foreach ($this->input->post() as $k => $value)
                {
                    if(strtolower($k).',' == strtolower($text[$i])){
                        $exec_qry = str_replace('@'.$text[$i], "'". $value."'," ,$exec_qry);
                    }
                    if($text[$i] == 'UserId'){
                        $exec_qry = str_replace('@'.$text[$i], "'". $userid."'" ,$exec_qry);
                    }
                    if($text[$i] == 'Recnum,'){
                        $exec_qry = str_replace('@'.$text[$i], $this->input->post('Recnumid')."," ,$exec_qry);
                    }
                    if($text[$i] == 'AttachFile,'){
                        $exec_qry = str_replace('@'.$text[$i], "''," ,$exec_qry);
                    }

                }
                
            }
        }

        $query = $this->db->query($exec_qry);
        $result = $query->result();

        $this->output->set_content_type('application/json')->set_output(json_encode($result));
        
    }
    
}