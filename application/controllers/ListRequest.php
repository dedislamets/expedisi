<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListRequest extends CI_Controller {

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
            $table .='<td style="text-align:center;width:300px"><button>
                        <i class="ace-icon fa fa-pencil-square-o  bigger-110 icon-only"></i>Edit
                      </button> | <button>
                        <i class="ace-icon fa fa-trash  bigger-110 icon-only"></i> Remove
                      </button> | <button>
                        <i class="ace-icon fa fa-exclamation-circle  bigger-110 icon-only"></i> History
                      </button></td>';
            foreach($myArray[$ky] as $key => $item) {
                
                $table .="<td class=". ($key=='Recnum' ? 'hidden':'').">". $item ."</td>";
                
            }
            $table .="</tr>"; 
        }
         
        $table .= "</tbody></table>";

        $data['main']  = 'setting/generateRequest';
        $data['modal'] = 'modal/generateRequest';
        $data['tabel'] = $table;
        $data['page'] = $form;
        $data['title'] = $row_data[0]['IsDesc'];
        $data['js'] = 'script/generateRequest';

        $this->load->view('home',$data,FALSE); 

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
            }elseif ($data_column[$k]['type_kolom'] == 'Text Multiline') {
               $output .= $this->Eform->Multiline($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Date') {
               $output .= $this->Eform->Date($value['IsCaption'],$value['IsField']);
            }elseif ($data_column[$k]['type_kolom'] == 'Time') {
               $output .= $this->Eform->Time($value['IsCaption'],$value['IsField']);
            }
        }
        echo $output;
        exit();
    }
    
}