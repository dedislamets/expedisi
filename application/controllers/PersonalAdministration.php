<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PersonalAdministration extends CI_Controller {
  var $column_search = array('user_nama','user_email','user_alamat');
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('admin');
	    $this->load->model('Datatabel');
	   	$this->load->model('M_menu','',TRUE);
	   	$this->load->database();
	   	$this->load->library(array('cek_error'));  
     	ini_set('display_errors','on');  
     	error_reporting(E_ALL^E_NOTICE);
	}
	public function index()
	{		
		if($this->admin->logged_id())
    {
      $data['menu'] = $this->M_menu->getMenu($this->session->userdata('user_id'),0,"","Class");
			$data['title'] = 'Personal Administration';
			$data['main'] = 'personal/index';
			$data['js'] = 'script/personal';
			$data['modal'] = 'modal/personal';
			$data['org'] = $this->admin->getLocationParentOrg();
			$data['city'] = $this->admin->getcity();
			$data['agama'] = $this->admin->getagama();
			$data['darah'] = $this->admin->getdarah();		
			$data['country'] = $this->admin->getcountry();	
			$data['gender'] = $this->admin->getgender();
			$data['prov'] = $this->admin->getprov();
			$data['family_relation'] = $this->admin->getrelation();
			$data['family_status'] = $this->admin->getfamstatus();
			$data['family_marital'] = $this->admin->getfammarital();
			$data['family_tax'] = $this->admin->getfamtax();
			$data['education'] = $this->admin->getmastereducation();
			$data['major'] = $this->admin->getmastermajoring();
			//$data['training'] = $this->admin->getmastertraining();
			$data['emp'] = $this->admin->getmasterkaryawan();
			$data['punishment'] = $this->admin->getmasterpunishment();
			$data['inventaris'] = $this->admin->getmasterinventaris();
			$data['inventaris_status'] = $this->admin->getmasterinventarisstatus();
			$data['class'] = $this->admin->getmasterclass();
			$data['working_status'] = $this->admin->getmasterworking();
			$data['organization'] = $this->admin->getmaster('Organization');
			$data['structural'] = $this->admin->getmaster('V_Position','Positiontype=1');
			$data['fungsional'] = $this->admin->getmaster('V_Position','Positiontype=2');
			$data['tipemove'] = $this->admin->getmaster('TypeMoveOrganization');
			$data['kpp'] = $this->admin->getmaster('KPP');
			$data['location'] = $this->admin->getmaster('Location');
			$data['coa'] = $this->admin->getmaster('COA');
			$data['component'] = $this->admin->getmaster('ComponentSalary');
      $data['vehicle'] = $this->admin->getmaster('VehicleCode');
      $data['SIM'] = $this->admin->getmaster('SimCode');
      $data['membership'] = $this->admin->getmaster('MembershipType');

			$this->load->view('home',$data,FALSE); 

        }else{
            redirect("login");

        }				  
						
	}

  public function getdata()
  {
    $draw = intval($this->input->get("draw"));
    $start = intval($this->input->get("start"));
    $length = intval($this->input->get("length"));
    $order = $this->input->get("order");
    $search= $this->input->get("search");
    $search = $search['value'];
    $col = 10;
    $dir = "";
    if(!empty($order))
    {
        foreach($order as $o)
        {
            $col = $o['column'];
            $dir= $o['dir'];
        }
    }

    if($dir != "asc" && $dir != "desc")
    {
        $dir = "desc";
    }

    $valid_columns = array(
        0=>'Recnum',
        1=>'EmployeeId',
        2=>'EmployeeName',
        3=>'NameLocation',
        4=>'NameWorkingStatus',
        5=>'NameClass',
        6=>'NamePositionStructural',
        7=>'JoinDate',
    );
    if(!isset($valid_columns[$col]))
    {
        $order = null;
    }
    else
    {
        $order = $valid_columns[$col];
    }
    if($order !=null)
    {
        $this->db->order_by($order, $dir);
    }
    
    if(!empty($search))
    {
        $x=0;
        foreach($valid_columns as $sterm)
        {
            if($x==0)
            {
                $this->db->like($sterm,$search);
            }
            else
            {
                $this->db->or_like($sterm,$search);
            }
            $x++;
        }                 
    }
    $this->db->limit($length,$start);


    $employees = $this->db->get("[Fn_EmpBrowse] ('',GETDATE(),'1')");
    $data = array();
    $num = 0;
    foreach($employees->result() as $r)
    {

        $url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
        if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
          $url = base_url() .'assets/profile/noprofile.jpg' ; 
        }
         $data[] = array(
              $r->Recnum,
              "<a href='javascript:void(0)' class='js_popover' 
                data-img='". $url ."' data-id='". $r->EmployeeId ."' data-name='". $r->EmployeeName ."' data-org='". $r->NameOrganization ."' data-location='". $r->NamePositionStructural ."' data-class='". $r->NameClass ."' data-join='". $r->JoinDate ."' data-status='". $r->NameWorkingStatus ."'>".$r->EmployeeId.' </a>',
              $r->EmployeeName,
              $r->NameOrganization,
              $r->NameLocation,
              $r->NameWorkingStatus,
              $r->NameClass,
              $r->NamePositionStructural,
              $r->JoinDate
         ); 
    }
    
    $total_employees = $this->totalEmployees();

    $output = array(
        "draw" => $draw,
        "recordsTotal" => $total_employees,
        "recordsFiltered" =>$total_employees,
        "data" => $data
    );
    echo json_encode($output);
    exit();
  }

  public function totalEmployees()
  {
      $query = $this->db->select("COUNT(*) as num")->get("[Fn_EmpBrowse] ('',GETDATE(),'1')");
      $result = $query->row();
      if(isset($result)) return $result->num;
      return 0;
  }
 
	public function getdata_old()
	{

          $draw = intval($this->input->get("draw"));
          $start = intval($this->input->get("start"));
          $length = intval($this->input->get("length"));

          $advance = $this->input->get('advance');
          if(!empty($advance)){
            $advance = substr($advance, 0, -1);
            $advance = explode(";",$advance);
            $advance = "'" . implode("','", $advance) . "'";
          }
          
          //$books = $this->Datatabel->get_payroll_list($periode, $advance);

          $books = $this->admin->get_personal($advance);

          $data = array();

          foreach($books->result() as $r) {
          		$url = base_url() .'assets/profile/'. $r->EmployeeId .'.jpg' ; 
          		if(!$this->admin->checkRemoteFile($r->EmployeeId .'.jpg')){
          			$url = base_url() .'assets/profile/noprofile.jpg' ; 
          		}
               $data[] = array(
                    $r->Recnum,
                    "<a href='javascript:void(0)' class='js_popover' 
                    	data-img='". $url ."' data-id='". $r->EmployeeId ."' data-name='". $r->EmployeeName ."' data-org='". $r->NameOrganization ."' data-location='". $r->NamePositionStructural ."' data-class='". $r->NameClass ."' data-join='". $r->JoinDate ."' data-status='". $r->NameWorkingStatus ."'>".$r->EmployeeId.' </a>',
                    $r->EmployeeName,
                    $r->NameOrganization,
                    $r->NameLocation,
                    $r->NameWorkingStatus,
                    $r->NameClass,
                    $r->NamePositionStructural,
                    $r->JoinDate
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


	public function get_foto_profil()
    {
    	$id = $this->input->get('id'); 
      	$url = base_url() .'assets/profile/'. $id .'.jpg' ; 
  		if(!$this->admin->checkRemoteFile($id .'.jpg')){
  			$url = base_url() .'assets/profile/noprofile.jpg' ; 
  		}
  		echo $url;
    }
    public function get_biodata()
    {
    	$id = $this->input->get('id'); 
    	$recnum='';
  		$data['basic'] = $this->admin->getEmployee($id);
  		if(count($data['basic'])>0){
  			$recnum = $data['basic'][0]['Recnum']; 
  		}

  		$data['address'] = $this->admin->getAddress($recnum);
  		$data['family_detail'] = $this->admin->getFamilyDetail($recnum);
  		$data['family_status'] = $this->admin->getFamilyStatus($recnum);
  		$data['family_marital'] = $this->admin->getFamilyMarital($recnum);
  		$data['family_tax'] = $this->admin->getFamilyTax($recnum);
  		$data['education'] = $this->admin->getEducation($recnum);
  		$data['training'] = $this->admin->getTraining($recnum);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_employee_data()
    {
    	$id = $this->input->get('id'); 
    	$recnum='';
  		$data['basic'] = $this->admin->getEmployee($id);
  		if(count($data['basic'])>0){
  			$recnum = $data['basic'][0]['Recnum']; 
  		}

  		$data['reward'] = $this->admin->getReward($recnum);
  		$data['punish'] = $this->admin->getPunishment($recnum);
  		$data['inventaris'] = $this->admin->getInventaris($recnum);
  		$data['grade'] = $this->admin->getClass($recnum);
  		$data['org'] = $this->admin->getOrg($recnum);
  		$data['status'] = $this->admin->getStatue($recnum);
  		$data['salary'] = $this->admin->getSalary($recnum);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_additional()
    {
      $id = $this->input->get('id'); 
      $recnum='';
      $data['basic'] = $this->admin->getEmployee($id);
      if(count($data['basic'])>0){
        $recnum = $data['basic'][0]['Recnum']; 
      }

      $data['vehicle'] = $this->admin->getVehicle($recnum);
      $data['sim'] = $this->admin->getSIM($recnum);
      $data['experience'] = $this->admin->getExperience($recnum);
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function getCity()
    {
    	$id = $this->input->get('id'); 
  		$data = $this->admin->getKota($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function getState()
    {
    	$id = $this->input->get('id'); 
  		$data = $this->admin->getState($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function getKel()
    {
    	$id = $this->input->get('id'); 
  		$data = $this->admin->getKel($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_family()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getFamily($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_status()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getStatus($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_marital()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getMarital($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_tax()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTax($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_education()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getEdu($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_training()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTra($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_tabel_reward()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTabReward($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_tabel_punish()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTabPunish($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_tabel_inv()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTabInv($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_tabel_class()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTabClass($id);
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_tabel_working()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTabel($id,'EmployeeHisWorkingStatus');
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_tabel_org()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTabel($id,'EmployeeHisOrganization');
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_tabel_salary()
    {
    	$id = $this->input->get('recnum'); 
  		$data = $this->admin->getTabel($id,'EmployeeHisSalary');
  		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function foto_profil()
	{               

	    $nik = $this->input->post('id');  
	    $uploadPath = 'assets/profile/';
	    $config['upload_path'] = $uploadPath;
	    $config['allowed_types'] = 'jpg|png|jpeg';
	    $config['file_name']     = $nik.".jpg";
	    $config['overwrite']	= true;
	    $this->load->library('upload', $config);
	    $this->upload->initialize($config);
	    if($this->upload->do_upload('file')){
	      $fileData = $this->upload->data();   
	      $thumbnail = $this->resizeImage($fileData['file_name'], 'assets/profile/'.$fileData['file_name'],'assets/profile/thumbnail/',150,150);   
	    } 
	    $data = array(
	        'Photo' => $fileData['file_name'],                                         
	    );
	    $this->db->where('EmployeeId', $nik);
	    $this->db->update('Employee',$data);


	    $response = array(
	       'error' => false,
	       'foto'  => '<img id="profileimg" src="'.base_url() .'assets/profile/'. $nik .'.jpg?t='.time().'" class="img-responsive" alt="" style="width: 200px;margin-left: auto;margin-right: auto;">'                                    
	    );                         
	    $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
    public function getParent()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$sub = $this->input->get('sub')=='false' ? '0':'1'; 
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($this->admin->getLocationParentOrg()));
	}
    public function SaveEmp()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
		    'EmployeeId' 		=> $this->input->get('empid'),
		    'EmployeeName'		=> $this->input->get('empname'),
		    'FingerId'			=> $this->input->get('finger'),	
		    'DateOfBirth'		=> implode("-", array_reverse(explode("-", $this->input->get('dateBirth')))),
		    'PlaceOfBirth'		=> $this->input->get('empplace'),
		    'RecnumCountry'		=> $this->input->get('country'),
		    'RecnumReligion'	=> $this->input->get('religion'),
		    'RecnumBlood'		=> $this->input->get('blood'),
		    'RecnumGender'		=> $this->input->get('gender'),
		    'UseLens'			=> $this->input->get('isLens'),
		    'Alias'				=> $this->input->get('alias'),
		    'UniSizeShirt'		=> $this->input->get('shirt'),
		    'UniSizeShirtShort'	=> $this->input->get('shirt_short'),
		    'UniSizePants'		=> $this->input->get('pants'),
		    'UniSizeHelmet'		=> $this->input->get('helmet'),
		    'UniSizeShoes'		=> $this->input->get('shoes'),
		    'UniSizeShoesOffice' => $this->input->get('shoes_office'),
		    'UniSizeHat'		=> $this->input->get('hat'),
		    'FamilyCardNo'		=> $this->input->get('kk'),
		    'KtpNo'				=> $this->input->get('ktp'),
		    'PasporNo'			=> $this->input->get('passport'),
		    'NPWPNo'			=> $this->input->get('npwp'),
		    'OfficeMail'		=> $this->input->get('office_mail'),
		    'PersonalMail'		=> $this->input->get('personal_mail'),
		    'Handphone'			=> $this->input->get('phone'),
		    'Ext'				=> $this->input->get('ext'),
		    'ComputerName'		=> $this->input->get('comp_name'),
		    'IPAddress'			=> $this->input->get('ip'),
		    'CreateBy'			=> $recLogin,
		    'CreateDate'		=> date('Y-m-d'),	        		        
		);

		if(!empty($this->input->get('poh'))){
			$data['HomeBase'] = $this->input->get('poh');
		}
		if(!empty($this->input->get('height'))){
			$data['Height'] = $this->input->get('height');
		}
		if(!empty($this->input->get('weight'))){
			$data['Weight'] = $this->input->get('weight');
		}
		if(!empty($this->input->get('married'))){
			$data['MarriedDate'] = implode("-", array_reverse(explode("-", $this->input->get('married'))));
		}
		if(!empty($this->input->get('join'))){
			$data['JoinDate'] = implode("-", array_reverse(explode("-", $this->input->get('join'))));
		}
		if(!empty($this->input->get('isLens'))){
			$data['UseLens'] = TRUE;
		}

        $this->db->trans_begin();
        $result  = $this->db->insert('Employee', $data);
        //echo $this->db->last_query();
        if(!$result){
        	print("<pre>".print_r($this->db->error(),true)."</pre>");
        }
        $this->db->trans_complete();
       	$lastid = $this->db->insert_id();
	  	

	  	if($lastid !=null){
	  		$response['error']= FALSE;
	  		$response['id']= $lastid;
	  	}
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function UpdateEmp()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
		    'EmployeeId' 		=> $this->input->get('empid'),
		    'EmployeeName'		=> $this->input->get('empname'),
		    'FingerId'			=> $this->input->get('finger'),	
		    'DateOfBirth'		=> implode("-", array_reverse(explode("-", $this->input->get('dateBirth')))),
		    'PlaceOfBirth'		=> $this->input->get('empplace'),
		    'RecnumCountry'		=> $this->input->get('country'),
		    'RecnumReligion'	=> $this->input->get('religion'),
		    'RecnumBlood'		=> $this->input->get('blood'),
		    'RecnumGender'		=> $this->input->get('gender'),
		    'UseLens'			=> $this->input->get('isLens'),
		    'Alias'				=> $this->input->get('alias'),
		    'UniSizeShirt'		=> $this->input->get('shirt'),
		    'UniSizeShirtShort'	=> $this->input->get('shirt_short'),
		    'UniSizePants'		=> $this->input->get('pants'),
		    'UniSizeHelmet'		=> $this->input->get('helmet'),
		    'UniSizeShoes'		=> $this->input->get('shoes'),
		    'UniSizeShoesOffice' => $this->input->get('shoes_office'),
		    'UniSizeHat'		=> $this->input->get('hat'),
		    'FamilyCardNo'		=> $this->input->get('kk'),
		    'KtpNo'				=> $this->input->get('ktp'),
		    'PasporNo'			=> $this->input->get('passport'),
		    'NPWPNo'			=> $this->input->get('npwp'),
		    'OfficeMail'		=> $this->input->get('office_mail'),
		    'PersonalMail'		=> $this->input->get('personal_mail'),
		    'Handphone'			=> $this->input->get('phone'),
		    'Ext'				=> $this->input->get('ext'),
		    'ComputerName'		=> $this->input->get('comp_name'),
		    'IPAddress'			=> $this->input->get('ip'),
		    'EditBy'			=> $recLogin,
		    'EditDate'		=> date('Y-m-d'),	        		        
		);

		if(!empty($this->input->get('poh'))){
			$data['HomeBase'] = $this->input->get('poh');
		}
		if(!empty($this->input->get('height'))){
			$data['Height'] = $this->input->get('height');
		}
		if(!empty($this->input->get('weight'))){
			$data['Weight'] = $this->input->get('weight');
		}
		if(!empty($this->input->get('married'))){
			$data['MarriedDate'] = implode("-", array_reverse(explode("-", $this->input->get('married'))));
		}
		if(!empty($this->input->get('join'))){
			$data['JoinDate'] = implode("-", array_reverse(explode("-", $this->input->get('join'))));
		}
		if(!empty($this->input->get('isLens'))){
			$data['UseLens'] = TRUE;
		}

		$this->db->trans_begin();
       
		$this->db->where('EmployeeId', $this->input->get('empid'));
        $result  = $this->db->update('Employee',$data);
        //echo $this->db->last_query();
        if(!$result){
        	print("<pre>".print_r($this->db->error(),true)."</pre>");
        }else{
        	$response['error']= FALSE;
        }
        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveAddrs()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
		    'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'PAddress'		 	=> $this->input->get('address'),
		    'PRT'			 	=> $this->input->get('rt'),	
		    'PRW'			 	=> $this->input->get('rw'),	
		    'PPostCode'			=> $this->input->get('pos'),
        'PNo'           => $this->input->get('hp'),
        'CNo'           => $this->input->get('hp_current'),
		    'CAddress'			=> $this->input->get('address_current'),
		    'CRT'				    => $this->input->get('rt_current'),
		    'CRW'				    => $this->input->get('rw_current'),
		    'CPostCode'			=> $this->input->get('pos_current'),
		    'EC1Name'			=> $this->input->get('name_emergency_1'),
		    'EC1Relation'		=> $this->input->get('relation_emergency_1'),
		    'EC1Address'		=> $this->input->get('address_emergency_1'),
		    'EC1Handphone'		=> $this->input->get('phone2_emergency_1'),
		    'EC2Name'			=> $this->input->get('name_emergency_2'),
		    'EC2Relation'		=> $this->input->get('relation_emergency_2'),
		    'EC2Address'		=> $this->input->get('address_emergency_2'),
		    'EC2Handphone'		=> $this->input->get('phone2_emergency_2'),
		    'CreateBy'			=> $recLogin,
		    'CreateDate'		=> date('Y-m-d'),	        		        
		);

		if(!empty($this->input->get('countryAddress'))){
			$data['PRecnumCountry'] = $this->input->get('countryAddress');
		}
		if(!empty($this->input->get('prov'))){
			$data['PRecnumProvince'] = $this->input->get('prov');
		}
		if(!empty($this->input->get('city'))){
			$data['PRecnumCity'] = $this->input->get('city');
		}
		if(!empty($this->input->get('state'))){
			$data['PRecnumKecamatan'] = $this->input->get('state');
		}
		if(!empty($this->input->get('kel'))){
			$data['PRecnumKelurahan'] = $this->input->get('kel');
		}

		if(!empty($this->input->get('ccountryAddress'))){
			$data['CRecnumCountry'] = $this->input->get('ccountryAddress');
		}
		if(!empty($this->input->get('cprov'))){
			$data['CRecnumProvince'] = $this->input->get('cprov');
		}
		if(!empty($this->input->get('ccity'))){
			$data['CRecnumCity'] = $this->input->get('ccity');
		}
		if(!empty($this->input->get('cstate'))){
			$data['CRecnumKecamatan'] = $this->input->get('cstate');
		}
		if(!empty($this->input->get('ckel'))){
			$data['CRecnumKelurahan'] = $this->input->get('ckel');
		}

    $this->db->trans_begin();

    $this->db->from('EmployeeAddress');
    $ck_status = $this->db->where('RecnumEmployee', $this->input->get('recnumid'))->get();
    if($ck_status->num_rows()>0) {
    	$this->db->set($data);
   	$this->db->where('RecnumEmployee', $this->input->get('recnumid'));
   	$result  =  $this->db->update('EmployeeAddress');	

   	if(!$result){
      	print("<pre>".print_r($this->db->error(),true)."</pre>");
    }else{
      	$response['error']= FALSE;
      }
    }else{
    	$result  = $this->db->insert('EmployeeAddress', $data);
      
      if(!$result){
      	print("<pre>".print_r($this->db->error(),true)."</pre>");
      }else{
      	$response['error']= FALSE;
      }
    }
    //echo $this->db->last_query();
    $this->db->trans_complete();

	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveStatus()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'RecnumFamilyStatus' 	=> $this->input->get('fa_status'),
		    'ProrateLimitMedical' 	=> $this->input->get('fa_prorate'),
		    'StartDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_stat')))),
		    'CreateBy'			=> $recLogin,
		    'CreateDate'		=> date('Y-m-d'),	        		        
		);

		if(!empty($this->input->get('dateRangeEnd_stat'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_stat'))));
		}

		$this->db->trans_begin();

        $this->db->from('EmployeeHisFamilyStatus');
        $ck_status = $this->db->where('Recnum', (empty($this->input->get('RecnumFamilyStatus'))? 0 : $this->input->get('RecnumFamilyStatus')))->get();
        if($ck_status->num_rows()>0) {
        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumFamilyStatus'));
		   	$result  =  $this->db->update('EmployeeHisFamilyStatus');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$result  = $this->db->insert('EmployeeHisFamilyStatus', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveMarital()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'RecnumMaritalStatus' 	=> $this->input->get('fa_marital'),
		    'StartDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_marital')))),	        		        
		);

		if(!empty($this->input->get('dateRangeEnd_marital'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_marital'))));
		}


		$this->db->trans_begin();

        if($this->input->get('RecnumFamilyMarital') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumFamilyMarital'));
		   	$result  =  $this->db->update('EmployeeHisMaritalStatus');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeHisMaritalStatus', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveTax()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'RecnumTaxMethod' 	=> $this->input->get('fa_tax'),
		    'StartDate'			=> implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_tax')))),	        		        
		);

		$this->db->trans_begin();

        if($this->input->get('RecnumTax') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumTax'));
		   	$result  =  $this->db->update('EmployeeHisTaxMethod');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeHisTaxMethod', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveFamily()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
		    'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'KTPNo'		 		=> $this->input->get('fa_nik'),
		    'FamilyName'		=> $this->input->get('fa_name'),	
		    'RecnumFamilyRelationship'	=> $this->input->get('fa_relasi'),	
		    'RecnumGender'		=> $this->input->get('fa_gender'),
		    'PlaceOfBirth'		=> $this->input->get('fa_place'),
		    'RecnumBlood'		=> $this->input->get('fa_blood'),
		    'Job'				=> $this->input->get('fa_job'),
		    'CreateBy'			=> $recLogin,
		    'CreateDate'		=> date('Y-m-d'),	        		        
		);

		if(!empty($this->input->get('isMarried'))){
			$data['MarriedStatus'] = TRUE;
		}

		if(!empty($this->input->get('fa_birth_date'))){
			$data['BirthOfDate'] = implode("-", array_reverse(explode("-", $this->input->get('fa_birth_date'))));
		}

		$this->db->trans_begin();

        $this->db->from('EmployeeFamily');
        $ck_status = $this->db->where('Recnum', empty($this->input->get('RecnumFamily'))? 0 : $this->input->get('RecnumFamily'))->get();
        if($ck_status->num_rows()>0) {
        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumFamily'));
		   	$result  =  $this->db->update('EmployeeFamily');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$result  = $this->db->insert('EmployeeFamily', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }
        //echo $this->db->last_query();
        $this->db->trans_complete();				
	  	$this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveEdu()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'RecnumEducation' 	=> $this->input->get('edu_level'),
		    'Score' 			=> $this->input->get('edu_gpa'),
		    'NameSchool' 			=> $this->input->get('edu_school'),
		    'CertificateNo' 	=> $this->input->get('edu_certificate')	        		        
		);

		if($this->input->get('edu_major')>0){
			$data['RecnumMajoring'] = $this->input->get('edu_major');
		}
		if(!empty($this->input->get('dateRangeStart_edu'))){
			$data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_edu'))));
		}
		if(!empty($this->input->get('dateRangeEnd_edu'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_edu'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumEducation') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumEducation'));
		   	$result  =  $this->db->update('EmployeeHisEducation');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeHisEducation', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveTraining()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'RecnumMateriTraining' 	=> $this->input->get('training'),
		    'Score' 			=> $this->input->get('tra_score'),
		    'TrainerName' 			=> $this->input->get('tra_trainer'),
		    'CertificateNo' 	=> $this->input->get('tra_certificate')	        		        
		);

		if(!empty($this->input->get('isLicense'))){
			$data['License'] = TRUE;
		}

		if(!empty($this->input->get('dateRangeStart_tra'))){
			$data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_tra'))));
		}
		if(!empty($this->input->get('dateRangeEnd_tra'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_tra'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumTraining') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumTraining'));
		   	$result  =  $this->db->update('EmployeeTraining');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeTraining', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function SaveReward()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 	=> $this->input->get('recnumid'),
		    'RewardBy' 			=> $this->input->get('reward_by'),
		    'RewardDesc' 		=> $this->input->get('reward_desc'),
		    'Allowance' 		=> $this->input->get('allowance')	        		        
		);

		if(!empty($this->input->get('dateRangeStart_reward'))){
			$data['RewardDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_reward'))));
		}
		if(!empty($this->input->get('allowance_date'))){
			$data['AllwoanceDate'] = implode("-", array_reverse(explode("-", $this->input->get('allowance_date'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumReward') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumReward'));
		   	$result  =  $this->db->update('EmployeeReward');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeReward', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function SavePunish()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 	=> $this->input->get('recnumid'),
			'RecnumPunishmentType' 	=> $this->input->get('punish_type'),
		    'PunishmentBy' 			=> $this->input->get('punish_by'),
		    'PunishmentDesc' 		=> $this->input->get('punish_desc'),
		    'Deduction' 			=> $this->input->get('deduction'),    		        
		);

		if(!empty($this->input->get('deduction_date'))){
			$data['DeductionDate'] = implode("-", array_reverse(explode("-", $this->input->get('deduction_date'))));
		}

		if(!empty($this->input->get('dateRangeStart_punish'))){
			$data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_punish'))));
		}
		if(!empty($this->input->get('dateRangeEnd_punish'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_punish'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumPunish') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumPunish'));
		   	$result  =  $this->db->update('EmployeePunishment');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['PunishmentDate'] = date('Y-m-d');;
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeePunishment', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveInventaris()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 		=> $this->input->get('recnumid'),
			'RecnumStatusInventory' 	=> $this->input->get('item_status'),
			'RecnumInventory' 	=> $this->input->get('item'),
		    'Total' 			=> $this->input->get('qty'),		        
		);

		if(!empty($this->input->get('return_date'))){
			$data['ReturnDate'] = implode("-", array_reverse(explode("-", $this->input->get('return_date'))));
		}

		if(!empty($this->input->get('expired_date'))){
			$data['ExpiredDate'] = implode("-", array_reverse(explode("-", $this->input->get('expired_date'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumInventaris') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumInventaris'));
		   	$result  =  $this->db->update('EmployeeInventory');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeInventory', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function SaveGrade()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 		=> $this->input->get('recnumid'),
			'RecnumClass' 		=> $this->input->get('grade_class'),
			'SKNo' 				=> $this->input->get('SKNo'),
		    'Remark' 			=> $this->input->get('grade_remark'),		        
		);

		if(!empty($this->input->get('dateRangeStart_grade'))){
			$data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_grade'))));
		}

		if(!empty($this->input->get('dateRangeEnd_grade'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_grade'))));
		}
		if(!empty($this->input->get('SK_Date'))){
			$data['SkDate'] = implode("-", array_reverse(explode("-", $this->input->get('SK_Date'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumGrade') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumGrade'));
		   	$result  =  $this->db->update('EmployeeHisClass');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeHisClass', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function SaveWorkingStatus()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 		=> $this->input->get('recnumid'),
			'RecnumWorkingStatus' 		=> $this->input->get('work_status'),
			'SKNo' 				=> $this->input->get('SKNo2'),
		    'Remark' 			=> $this->input->get('status_remark'),		        
		);

		if(!empty($this->input->get('dateRangeStart_status'))){
			$data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_status'))));
		}

		if(!empty($this->input->get('dateRangeEnd_status'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_status'))));
		}
		if(!empty($this->input->get('SK_alert'))){
			$data['DateAlert'] = implode("-", array_reverse(explode("-", $this->input->get('SK_alert'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumStatus') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumStatus'));
		   	$result  =  $this->db->update('EmployeeHisWorkingStatus');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeHisWorkingStatus', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function SaveEmpOrg()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 			=> $this->input->get('recnumid'),
			'EmployeeId' 				=> $this->input->get('empid'),
			'RecnumOrganization' 		=> $this->input->get('orgz'),
			'RecnumPositionStructural' 	=> $this->input->get('structural'),
			'RecnumPositionFunctional' 	=> $this->input->get('fungsional'),
			'RecnumTypeMoveOrganization' 	=> $this->input->get('tipemove'),
			'RecnumLocation' 			=> $this->input->get('location'),
			'RecnumHead1' 				=> $this->input->get('head1'),
			'SkNo' 						=> $this->input->get('SKNo3'),
		    'Remark' 					=> $this->input->get('org_remark'),		        
		);

		if(!empty($this->input->get('dateRangeStart_org'))){
			$data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_org'))));
		}

		if(!empty($this->input->get('dateRangeEnd_org'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_org'))));
		}
		if($this->input->get('ss')> 0 ){
			$data['RecnumOrganizationSecondary'] = $this->input->get('ss');
		}
		if($this->input->get('sf')> 0 ){
			$data['RecnumPositionFunctionalSecondary'] = $this->input->get('sf');
		}
		if($this->input->get('sp')> 0 ){
			$data['RecnumPositionStructuralSecondary'] = $this->input->get('sp');
		}
		if($this->input->get('coa')> 0 ){
			$data['RecnumCOA'] = $this->input->get('coa');
		}
		if(!empty($this->input->get('SK_Date_Org'))){
			$data['SkDate'] = implode("-", array_reverse(explode("-", $this->input->get('SK_Date_Org'))));
		}

		if($this->input->get('mentor')> 0 ) $data['RecnumMentor'] = $this->input->get('mentor');
		if($this->input->get('secretary')> 0 ) $data['RecnumSecretary'] = $this->input->get('secretary');
		if($this->input->get('kpp')> 0 ) $data['RecnumKPP'] = $this->input->get('kpp');
		if($this->input->get('hr')> 0 ) $data['RecnumAdminHR'] = $this->input->get('hr');

		$this->db->trans_begin();

        if($this->input->get('RecnumOrg') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumOrg'));
		   	$result  =  $this->db->update('EmployeeHisOrganization');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeHisOrganization', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}
	public function SaveSalary()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$response['msg']= "Gagal menyimpan.. Terjadi kesalahan pada sistem";
	  	$recLogin = $this->session->userdata('user_id');
		$data = array(
			'RecnumEmployee' 		=> $this->input->get('recnumid'),
			'RecnumComponentSalary' => $this->input->get('component'),
			'SkNo' 				=> $this->input->get('SKNo4'),
		    'Remark' 			=> $this->input->get('salary_remark'),		
		    'Total' 			=> $this->input->get('salary_value'),        
		);

		if(!empty($this->input->get('dateRangeStart_salary'))){
			$data['StartDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeStart_salary'))));
		}

		if(!empty($this->input->get('dateRangeEnd_salary'))){
			$data['EndDate'] = implode("-", array_reverse(explode("-", $this->input->get('dateRangeEnd_salary'))));
		}
		if(!empty($this->input->get('SK_Date_Salary'))){
			$data['SkDate'] = implode("-", array_reverse(explode("-", $this->input->get('SK_Date_Salary'))));
		}

		$this->db->trans_begin();

        if($this->input->get('RecnumSalary') != "") {
        	$data['EditBy'] = $recLogin;
        	$data['EditDate'] = date('Y-m-d');

        	$this->db->set($data);
		   	$this->db->where('Recnum', $this->input->get('RecnumSalary'));
		   	$result  =  $this->db->update('EmployeeHisSalary');	

		   	if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }else{
        	$data['CreateBy'] = $recLogin;
        	$data['CreateDate'] = date('Y-m-d');

        	$result  = $this->db->insert('EmployeeHisSalary', $data);
	        
	        if(!$result){
	        	print("<pre>".print_r($this->db->error(),true)."</pre>");
	        }else{
	        	$response['error']= FALSE;
	        }
        }

        $this->db->trans_complete();
	  						
	  $this->output->set_content_type('application/json')->set_output(json_encode($response));
	}


	public function EditOrg()
	{		
	  	$response = [];
		$response['error'] = TRUE; 
		$data['data'] = $this->admin->getLocationEditOrg($this->input->get('id'));	
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function DelOrg(){
		$response = [];
		$response['error'] = TRUE; 
		if($this->admin->delLocationOrg($this->input->get('id'))){
			$response['error'] = FALSE;
		}	
	  						
	  	$this->output->set_content_type('application/json')->set_output(json_encode($response));
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
