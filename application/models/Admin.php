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
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    function api_get_function($name,$id)
    {        
        $query = $this->db->from($name.' ('.$id.')')->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

    function api_post($table,$array_data)
    {        
        $insert = $this->db->insert($table, $data);
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

    function getParentOrg()
    {        
        $query = $this->db->query('SELECT Recnum,OrgName,OrgId FROM Organization order by Recnum ASC');
        return $query->result();        
    }
    function getClassParentOrg()
    {        
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Class order by Recnum ASC');
        return $query->result();        
    }
    function getLocationParentOrg()
    {        
        $query = $this->db->query('SELECT Recnum,LocationName FROM Location order by Recnum ASC');
        return $query->result();        
    }
    function getcity()
    {        
        $query = $this->db->query('SELECT Recnum,IsDesc FROM City order by Recnum ASC');
        return $query->result();        
    }
    function getagama()
    {        
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Religion order by Recnum ASC');
        return $query->result();        
    }
    function getcountry()
    {        
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Country order by Recnum ASC');
        return $query->result();        
    }
    function getprov()
    {        
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Province order by Recnum ASC');
        return $query->result();        
    }
    function getrelation(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM FamilyRelationship order by Recnum ASC');
        return $query->result();    
    }
    function getfamstatus(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM FamilyStatus order by Recnum ASC');
        return $query->result();    
    }
    function getfammarital(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM MaritalStatus order by Recnum ASC');
        return $query->result();    
    }
    function getfamtax(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM TaxMethod order by Recnum ASC');
        return $query->result();    
    }
    function getmastereducation(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Education order by Recnum ASC');
        return $query->result();    
    }
    function getmastermajoring(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Majoring order by Recnum ASC');
        return $query->result();    
    }
    function getmastertraining(){
        $query = $this->db->query('SELECT Recnum,IsName as IsDesc FROM TrnTheme order by Recnum ASC');
        return $query->result();    
    }
    function getmasterkaryawan(){
        $query = $this->db->query('SELECT Recnum,EmployeeName as IsDesc FROM Employee order by Recnum ASC');
        return $query->result();    
    }
    function getmasterpunishment(){
        $query = $this->db->query('SELECT Recnum,IsName as IsDesc FROM PunishmentType order by Recnum ASC');
        return $query->result();    
    }
    function getmasterinventaris(){
        $query = $this->db->query('SELECT Recnum,IsName as IsDesc FROM Inventory order by Recnum ASC');
        return $query->result();    
    }
    function getmasterinventarisstatus(){
        $query = $this->db->query('SELECT Recnum,IsName as IsDesc FROM StatusInventory order by Recnum ASC');
        return $query->result();    
    }

    function getmasterclass(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Class order by Recnum ASC');
        return $query->result();    
    }
    function getmasterworking(){
        $query = $this->db->query('SELECT Recnum,IsName FROM WorkingStatus order by Recnum ASC');
        return $query->result();    
    }
    function getperiode(){
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Period where RecnumTypePeriod=1');
        return $query->result();    
    }

    function getfindemployee(){
        $query = $this->db->query('SELECT Id,Name FROM Vf_FindEmployeeActiveNow order by Id ASC');
        return $query->result();    
    }

    function getmaster($tabel,$where='',$noorder=0){
        $sql = "SELECT * FROM ". $tabel;
        if($where !=''){
            $sql.= " WHERE ". $where ;
        }
        if($noorder==0){
            $sql .= " order by Recnum ASC";
        }
        $query = $this->db->query($sql);
        return $query->result();    
    }
    function getHRPolicies(){
        $query = $this->db->query("select * from [Fn_DashboardHRPolicies] ('','2019-07-08')");
        return $query->result(); 
    }
    function getLoker($EmployeeId){
        $query = $this->db->query("select * from [Fn_ListRequestVacancyInternal] ('". $EmployeeId."')");
        return $query->result(); 
    }
    function getEmpAdmin(){
        $query = $this->db->query("select * from  [Fn_EmpAdmin] ('',GETDATE(),1)");
        return $query->result();
    }
    function getNewEmployee(){
        $query = $this->db->query("select * from [Fn_DashboardNewEmployee] ('','2019-07-08')");
        return $query->result(); 
    }
    function getLeaveEmployee(){
        $query = $this->db->query("select * from [Fn_DashboardLeaveEmployees] ('','2019-07-08')");
        return $query->result(); 
    }
    function getDetailPersonPerformance($EmployeeId){
        $query = $this->db->query("select * from Fn_ListEmpPerformance (". $EmployeeId.",GETDATE(),GETDATE())");
        return $query->result(); 
    }
    function getSubOrdinat($EmployeeId){
        $query = $this->db->query("select * from Fn_ListSubOrdinat (". $EmployeeId.",GETDATE())");
        return $query->result(); 
    }
    function getgender()
    {        
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Gender order by Recnum ASC');
        return $query->result();        
    }
    function getdarah()
    {        
        $query = $this->db->query('SELECT Recnum,IsDesc FROM Blood order by Recnum ASC');
        return $query->result();        
    }
    function getgolongan()
    {        
        $query = $this->db->query('SELECT Recnum,IsName FROM Golongan order by Recnum ASC');
        return $query->result();        
    }
    function getrank()
    {        
        $query = $this->db->query('SELECT Recnum,IsName FROM Rank order by Recnum ASC');
        return $query->result();        
    }
    function execEmpProcessDaily($tgl)
    {        
        $query = $this->db->query("SELECT * FROM [Fn_EmpProcessDaily] ('','". $tgl ."') ");
        return $query->result();        
    }
    function getgrade()
    {        
        $query = $this->db->query('SELECT Recnum,IsName FROM Grade order by Recnum ASC');
        return $query->result();        
    }
     function getPosParentOrg($jenis,$sub)
    {        
        $query = $this->db->query("select Recnum,PositionId,PositionName,ParentId,Positiontype,total from V_Position org
            cross apply (
                select count(*) as total from [Fn_EmpPositionTree] ('1','2019-01-01',recnum,".$sub.") 
            )x where Positiontype='".$jenis."' or Recnum=23");
        return $query->result();        
    }
    function getEditOrg($id)
    {        
        $query = $this->db->query("SELECT *,case when StartDate is null then '' else convert(varchar(12),StartDate,105) end as fStartDate ,case when EndDate is null then '' else convert(varchar(12),EndDate,105) end as fEndDate 
            FROM Organization WHERE Recnum=".$id);
        return $query->result();        
    }
    function getPosEditOrg($id)
    {        
        $query = $this->db->query("SELECT *,case when StartDate is null then '' else convert(varchar(12),StartDate,105) end as fStartDate ,case when EndDate is null then '' else convert(varchar(12),EndDate,105) end as fEndDate 
            FROM Position WHERE Recnum=".$id);
        return $query->result();        
    }
    function getClassEditOrg($id)
    {        
        $query = $this->db->query("SELECT *,case when StartDate is null then '' else convert(varchar(12),StartDate,105) end as fStartDate ,case when EndDate is null then '' else convert(varchar(12),EndDate,105) end as fEndDate 
            FROM Class WHERE Recnum=".$id);
        return $query->result();        
    }
    function getLocationEditOrg($id)
    {        
        $query = $this->db->query("SELECT *,case when StartDate is null then '' else convert(varchar(12),StartDate,105) end as fStartDate ,case when EndDate is null then '' else convert(varchar(12),EndDate,105) end as fEndDate 
            FROM Location WHERE Recnum=".$id);
        return $query->result();        
    }
    function delOrg($id)
    {        
        $this->db->from('Organization');
        $this->db->where('Recnum', $id)->delete();
        if ($this->db->affected_rows() > 0){
            $this->db->from('Organization');
            $this->db->where('ParentId', $id)->delete();
            return true;      
            
        }else{
            return false;
          
        }
    }
    function delPattern($id)
    {        
        $this->db->from('PatternSchedule');
        $this->db->where('Recnum', $id)->delete();
        if ($this->db->affected_rows() > 0){
            return true;      
            
        }else{
            return false;
          
        }
    }
    function delShift($id)
    {        
        $this->db->from('MasterShift');
        $this->db->where('Recnum', $id)->delete();
        if ($this->db->affected_rows() > 0){
            return true;      
            
        }else{
            return false;
          
        }
    }
    function deleteTable($id, $table)
    {        
        $this->db->from($table);
        $this->db->where('Recnum', $id)->delete();
        if ($this->db->affected_rows() > 0){
            return true;      
            
        }else{
            return false;
          
        }
    }
    function delPosOrg($id)
    {        
        $this->db->from('Position');
        $this->db->where('Recnum', $id)->delete();
        if ($this->db->affected_rows() > 0){
            $this->db->from('Position');
            $this->db->where('ParentId', $id)->delete();
            return true;      
            
        }else{
            return false;
          
        }
    }
    function delClassOrg($id)
    {        
        $this->db->from('Class');
        $this->db->where('Recnum', $id)->delete();
        if ($this->db->affected_rows() > 0){
            $this->db->from('Class');
            $this->db->where('ParentId', $id)->delete();
            return true;      
            
        }else{
            return false;
          
        }
    }
    function delLocationOrg($id)
    {        
        $this->db->from('Location');
        $this->db->where('Recnum', $id)->delete();
        if ($this->db->affected_rows() > 0){
            $this->db->from('Location');
            $this->db->where('ParentId', $id)->delete();
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
    function getPattern($id) {
        $query = $this->db->query("SELECT * FROM PatternSchedule where Recnum='".$id."'");
        return $query->result_array();
    }
    function getShift($id) {
        $query = $this->db->query("SELECT * FROM MasterShift where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTable($id, $table) {
        $query = $this->db->query("SELECT * FROM $table where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTime($id) {
        $query = $this->db->query("select a.*,b.IsDesc as shiftname, b.Code,convert(varchar, In1, 8) as time_in, convert(varchar, Out1, 8) as time_out, convert(varchar, LateTolerance, 8) as late, convert(varchar, EarlyOutTolerance, 8) as early,ISNULL(ReturnOtAuto,0) as ReturnOtAuto from MasterTime a,MasterShift b where a.RecnumMasterShift=b.Recnum and a.Recnum='".$id."'");
        return $query->result_array();
    }
    function getEmployee($EmployeeId) {
        $query = $this->db->query("SELECT * FROM Employee where EmployeeId='".$EmployeeId."'");
        return $query->result_array();
    }
    function getKota($id) {
        $query = $this->db->query("SELECT * FROM City where Recnum_Province='".$id."'");
        return $query->result_array();
    }
    function getState($id) {
        $query = $this->db->query("SELECT * FROM Kecamatan where Recnum_City='".$id."'");
        return $query->result_array();
    }
    function getKel($id) {
        $query = $this->db->query("SELECT * FROM Kelurahan where Recnum_Kecamatan='".$id."'");
        return $query->result_array();
    }
    function getFamily($id) {
        $query = $this->db->query("SELECT * FROM EmployeeFamily where Recnum='".$id."'");
        return $query->result_array();
    }
    function getStatus($id) {
        $query = $this->db->query("SELECT * FROM EmployeeHisFamilyStatus where Recnum='".$id."'");
        return $query->result_array();
    }
    function getMarital($id) {
        $query = $this->db->query("SELECT * FROM EmployeeHisMaritalStatus where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTax($id) {
        $query = $this->db->query("SELECT * FROM EmployeeHisTaxMethod where Recnum='".$id."'");
        return $query->result_array();
    }
    function getEdu($id) {
        $query = $this->db->query("SELECT * FROM EmployeeHisEducation where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTra($id) {
        $query = $this->db->query("SELECT * FROM EmployeeTraining where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTabReward($id) {
        $query = $this->db->query("SELECT * FROM EmployeeReward where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTabPunish($id) {
        $query = $this->db->query("SELECT * FROM EmployeePunishment where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTabInv($id) {
        $query = $this->db->query("SELECT * FROM EmployeeInventory where Recnum='".$id."'");
        return $query->result_array();
    }
    function getTabClass($id) {
        $query = $this->db->query("SELECT * FROM EmployeeHisClass where Recnum='".$id."'");
        return $query->result_array();
    }

    function getTabel($id, $tabel) {
        $query = $this->db->query("SELECT * FROM ". $tabel ." where Recnum='".$id."'");
        return $query->result_array();
    }
    function getAddress($EmployeeId){
        $query = $this->db->query("SELECT * FROM EmployeeAddress where RecnumEmployee='".$EmployeeId."'");
        return $query->result_array();
    }
    function getFamilyDetail($EmployeeId){
        $query = $this->db->query("SELECT A.*,B.IsDesc as relasi,C.IsDesc as gender,
                --convert(varchar(05),cast(datediff(DAY, BirthOfDate, getDate() -1) / (365.23076923074) as int))+' tahun '+convert(varchar(05),cast(datediff(MONTH, BirthOfDate, getDate() -1) % (12) as int))+' bulan' as Age
                dbo.Fn_Age (BirthOfDate) as Age
                FROM EmployeeFamily A
                left join FamilyRelationship B on B.Recnum=A.RecnumFamilyRelationship 
                left join Gender C on C.Recnum=A.RecnumGender where RecnumEmployee='".$EmployeeId."' order by BirthOfDate asc");
        return $query->result_array();
    }
    function getReward($EmployeeId){
        $query = $this->db->query("select B.*,A.EmployeeName from EmployeeReward B left join Employee A ON A.Recnum=B.RecnumEmployee where RecnumEmployee='".$EmployeeId."' order by CreateDate asc");
        return $query->result_array();
    }
    function getVehicle($EmployeeId){
        $query = $this->db->query("select B.*,A.IsName from EmployeeHisVehicle B left join VehicleCode A ON A.Recnum=B.RecnumVehicleCode where RecnumEmployee='".$EmployeeId."' order by CreateDate asc");
        return $query->result_array();
    }
    function getSIM($EmployeeId){
        $query = $this->db->query("select B.*,A.IsName from EmployeeHisSim B left join SimCode A ON A.Recnum=B.RecnumSimCode where RecnumEmployee='".$EmployeeId."' order by CreateDate asc");
        return $query->result_array();
    }
    function getExperience($EmployeeId){
        $query = $this->db->query("select * from EmployeeHisExperience where RecnumEmployee='".$EmployeeId."' order by CreateDate asc");
        return $query->result_array();
    }
    function getPunishment($EmployeeId){
        $query = $this->db->query("select B.*,A.IsName as IsDesc from EmployeePunishment B left join PunishmentType A ON A.Recnum=B.RecnumPunishmentType where RecnumEmployee='".$EmployeeId."' order by CreateDate asc");
        return $query->result_array();
    }
    function getFamilyStatus($EmployeeId){
        $query = $this->db->query("SELECT A.*,B.IsDesc as family_status from EmployeeHisFamilyStatus A left join FamilyStatus B on A.RecnumFamilyStatus=B.Recnum  where RecnumEmployee='".$EmployeeId."' order by StartDate asc");
        return $query->result_array();
    }
    function getFamilyMarital($EmployeeId){
        $query = $this->db->query("select A.*,B.IsDesc as marital from EmployeeHisMaritalStatus A left join MaritalStatus B ON A.RecnumMaritalStatus=B.Recnum where RecnumEmployee='".$EmployeeId."'");
        return $query->result_array();
    }
    function getFamilyTax($EmployeeId){
        $query = $this->db->query("select A.*,B.IsDesc as tax from EmployeeHisTaxMethod A left join TaxMethod B ON A.RecnumTaxMethod=B.Recnum where RecnumEmployee='".$EmployeeId."'");
        return $query->result_array();
    }
    function getEducation($EmployeeId){
        $query = $this->db->query("select A.*,B.IsDesc as level_school,C.IsDesc as Majoring from EmployeeHisEducation A 
                left join Education B ON A.RecnumEducation=B.Recnum  
                left join Majoring C ON A.RecnumMajoring=C.Recnum  
                 where RecnumEmployee='".$EmployeeId."'  order by StartDate asc");
        return $query->result_array();
    }
    function getTraining($EmployeeId){
        $query = $this->db->query("SELECT A.*,B.IsDesc as materi from EmployeeTraining A left join TrnTheme B on A.RecnumMateriTraining=B.Recnum where RecnumEmployee='".$EmployeeId."'");
        return $query->result_array();
    }
    function getInventaris($EmployeeId){
        $query = $this->db->query("select B.*,A.IsName as InventoryName,C.IsName as StatusInventory from EmployeeInventory B 
            left join Inventory A ON A.Recnum=B.RecnumInventory
            left join StatusInventory C ON C.Recnum=B.RecnumStatusInventory where RecnumEmployee='".$EmployeeId."' order by CreateDate asc");
        return $query->result_array();
    }
    function getClass($EmployeeId){
        $query = $this->db->query("select B.*,A.IsDesc as ClassName from EmployeeHisClass B 
                left join Class A ON A.Recnum=B.RecnumClass where RecnumEmployee='".$EmployeeId."' 
                order by CreateDate asc");
        return $query->result_array();
    }
    function getOrg($EmployeeId){
        $query = $this->db->query("select A.OrgName,C.PositionName as Fungsional,D.PositionName as Struktural ,B.*
            from EmployeeHisOrganization B 
            left join Organization A ON A.Recnum=B.RecnumOrganization 
            left join Position C ON C.Recnum=B.RecnumPositionFunctional
            left join Position D ON D.Recnum=B.RecnumPositionStructural where RecnumEmployee='".$EmployeeId."' 
                order by CreateDate asc");
        return $query->result_array();
    }
    function getStatue($EmployeeId){
        $query = $this->db->query("select A.IsName,B.*
                from EmployeeHisWorkingStatus B 
                left join WorkingStatus A ON A.Recnum=B.RecnumWorkingStatus where RecnumEmployee='".$EmployeeId."' 
                order by CreateDate asc");
        return $query->result_array();
    }
    function getSalary($EmployeeId){
        $query = $this->db->query("select A.*,B.IsDesc from EmployeeHisSalary A,ComponentSalary B where A.RecnumComponentSalary=B.Recnum and RecnumEmployee='".$EmployeeId."' 
                order by StartDate asc");
        return $query->result_array();
    }

    public function get_events($start, $end)
    { 
        $this->db->select('CalenderEvent.*,DayType.IsDesc as tipe,DayType.Colour');
         $this->db->from('CalenderEvent');
         $this->db->join('DayType', 'DayType.Recnum=CalenderEvent.RecnumDayType');        
         $this->db->where("StartDate >=", $start);
         $this->db->where("EndDate <=", $end);    
         $query = $this->db->get();
        return $query;
    }

    public function add_event($data)
    {
        $this->db->insert("CalenderEvent", $data);
    }

}