<?php

    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
    header('Content-Type: application/json');

// Default
// $users = [
//     ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
//     ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
// ];

// $id = $this->get( 'id' );

// if ( $id === null )
// {
//     if ( $users )
//     {
//         $this->response( $users, 200 );
//     }
//     else
//     {
//         $this->response( [
//             'status' => false,
//             'message' => 'No users were found'
//         ], 404 );
//     }
// }
// else
// {
//     if ( array_key_exists( $id, $users ) )
//     {
//         $this->response( $users[$id], 200 );
//     }
//     else
//     {
//         $this->response( [
//             'status' => false,
//             'message' => 'No such user found'
//         ], 404 );
//     }
// }
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController  {

    public function __construct()
    {
        parent::__construct();
        //load model admin
        $this->load->model('admin');
    }

    public function login_get()
    {
        //get data dari FORM
        $username = $this->input->get("username");
        $password = $this->input->get('password');

        //checking data via model
        $checking = $this->admin->check_login('V_SecAccessGroup', array('PersonalMail' => $username), array('IsPassword' => $password));

        if ($checking != FALSE) {
            foreach ($checking as $apps) {
                $session_data = array(
                    'user_id'   => $apps->RecnumEmployee,
                    'user_nik'  => $apps->EmployeeId,
                    'user_name' => $apps->EmployeeName,
                    'user_mail' => $apps->PersonalMail,
                    'PositionStructural' => $apps->PositionStructural,
                );

                $this->response($session_data, 200 );

            }
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
        
    }
    public function shift_get()
    {
        $id = $this->input->get("id");
        $shift = $this->admin->api_get_function('fn_schshift',$id );

        if ($shift != FALSE) {
            $this->response($shift, 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
        
    }

    public function list_attendance_get()
    {
        $id = $this->input->get("id");
        $periode = $this->input->get("periode");
        $shift = $this->admin->api_get_function('Fn_appattendancelist',$id."," .$periode );

        if ($shift != FALSE) {
            $this->response($shift, 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
        
    }

    public function periode_get()
    {
        $shift = $this->admin->api_getmaster('vf_periodpayroll');

        if ($shift != FALSE) {
            $this->response($shift, 200 );
        }else{

            $this->response( [
                'status' => false,
                'message' => 'No users were found'
            ], 404 );
        }
        
    }

    public function absen_post()
    {
        $data =array(
            "RecnumEmployee"=>$this->post('id'),
            "FingerId"=>$this->post('fid'),
            "FingerDate"=>$this->post('tgl_absen'),
            "FingerTime"=>$this->post('jam'),
            "FingerCode"=>$this->post('fc'),
            "Type"=> 2,
            "Latitude"=>$this->post('lat'),
            "Longitude"=>$this->post('lng'),
            "Photo"=>$this->post('foto'),
            "LocationDistance"=>$this->post('jarak')
        );

        $response = $this->admin->api_post("DataSlide", $data);

        $query = $this->db->query("[Sp_ProcessDailyPerEmployee] ". $this->post('id') .",'" . $this->post('tgl_absen') ."',0," . $this->post('id') )->result();

        $this->response($response);
    }
}