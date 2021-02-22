<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model
{
    //fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('user_id');
    }

    //fungsi check login
    function check_login($table, $field1, $field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->group_start();
        $this->db->where($field1);
        // $this->db->or_where($field3);
        $this->db->group_end();
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        // echo $this->db->last_query();
        // exit();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function masterSetup()
    {
        $this->db->select('*');
        $this->db->from('Administrator');
        $query = $this->db->get();
        return $query->result();
    }
    function api_get_function($name,$id, $order ='')
    {        
        $this->db->from($name.' ('.$id.')');
        if($order<>"")   
            $this->db->order($order, 'DESC');

        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    function get($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->result();    
    }
    function get_array($tabel,$where='',$order=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->row_array();    
    }

    function get_result_array($tabel,$where='',$order='', $desc='desc', $limit=''){
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($order !=""){
            $this->db->order_by($order, $desc);
        }
        if($limit !=""){
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result_array();    
    }

    function api_getmaster($tabel,$where='',$noorder=0){
        $sql = "SELECT * FROM ". $tabel;
        if($where !=''){
            $sql.= " WHERE ". $where ;
        }
        if($noorder==0){
            $sql .= " order by Id Desc";
        }
        $query = $this->db->query($sql);
        return $query->result();    
    }

    function api_post($table,$array_data)
    {        
        $insert = $this->db->insert($table, $array_data);
        if($insert){
            $response['status']=200;
            $response['error']=false;
            $response['message']='Data berhasil ditambahkan.';
            return $response;
        }else{
            $response['status']=502;
            $response['error']=true;
            $response['message']='Data gagal ditambahkan.';
            return $response;
        }
    }
    function autocomplete($table, $orderby,$field_key,$keyword){
        $this->db->like($field_key, $keyword , 'both');
        $this->db->order_by($orderby, 'ASC');
        $this->db->limit(10);
        return $this->db->get($table)->result();
    }

    function getmaster($tabel,$where='',$order='',$groupby='',$select=''){
        if($select !=""){
            $this->db->select($select);
        }
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($groupby !=""){
            $this->db->group_by($groupby);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();exit();
        return $query->result();   
    }

    function get_num_rows($tabel,$where='',$order='',$groupby='',$select=''){
        if($select !=""){
            $this->db->select($select);
        }
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        if($groupby !=""){
            $this->db->group_by($groupby);
        }
        if($order !=""){
            $this->db->order_by($order);
        }
        $query = $this->db->get();
        return $query->num_rows();   
    }

    function get_row($tabel,$where='',$select=''){
        if($select !=""){
            $this->db->select($select);
        }
        $this->db->from($tabel);
        if($where !=""){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->row();   
    }
    function get_Function_id($func,$id, $order='')
    {
        $sql = "SELECT * from [$func] (". $id.")";
        if($order != ""){
            $sql .= " order by ". $order;
        }
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function deleteTable($recnum, $id, $table)
    {        
        $this->db->from($table);
        $this->db->where($recnum, $id)->delete();
        if ($this->db->affected_rows() > 0){
            return true;      
            
        }else{
            return false;
          
        }
    }
    

    function checkRemoteFile($url)
    {
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$url);
        // // don't download content
        // curl_setopt($ch, CURLOPT_NOBODY, 1);
        // curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //if(curl_exec($ch)!==FALSE)
        //var_dump(FCPATH);exit();
        if(file_exists(FCPATH."assets/profile/".$url))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
}