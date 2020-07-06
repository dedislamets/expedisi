<?php defined('BASEPATH') OR die('No direct script access allowed');

class Export_model extends CI_Model {

     public function getAll($start = 'GETDATE()', $end = 'GETDATE()', $isadmin=0)
     {
          $this->db->select('*');
          $this->db->from("Fn_ExportPerformanceManagement (". $this->session->userdata('user_id') . ",'$start','$end',$isadmin)");

          return $this->db->get();
     }

}