<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatabel extends CI_Model
{
    function getAllData(){
       	$this->load->library('datatables');
        
		$this->datatables->select('*');
        $this->datatables->from("[Fn_EmpBrowse] ('','2019-01-01','1')"); 
        //$this->datatables->where('email', $email);        
        return $this->datatables->generate();
    }
    public function get_personal()
    {
    	$query = $this->db->query("SELECT * FROM [Fn_EmpBrowse] ('','2019-01-01','1')");
        return $query;
    }
    public function get_personal_calendar($event)
    {
        $query = $this->db->query("select * from [Fn_EmpBrowse] ('','2019-01-01','1') A
                where Recnum not in (
                    select RecnumEmployee from CalenderParticipant where RecnumCalenderEvent=" .$event . " )");
        return $query;
    }

    public function get_partisipant($event)
    {
        $query = $this->db->query("select * from [Fn_EmpBrowse] ('','2019-01-01','1') A
            where Recnum in (
            select RecnumEmployee from CalenderParticipant where RecnumCalenderEvent=" .$event . ")");
        return $query;
    }
    public function get_shift_name($event)
    {
        $query = $this->db->query("select MasterShift.*,OTValidation.IsDesc as validasiname , DayType.IsDesc as DayNames, ShiftType.IsDesc as ShiftTypeNames
            from MasterShift 
            left join OTValidation ON OTValidation.Recnum=MasterShift.RecnumOTValidation
            left join DayType ON DayType.Recnum=MasterShift.RecnumDayType
            left join ShiftType ON ShiftType.Recnum=MasterShift.RecnumShiftType where MasterShift.RecnumGroupShift=" .$event );
        return $query;
    }
    public function get_standard_working($shift)
    {
        $query = $this->db->query("select A.Recnum,IsDay,convert(varchar, In1, 8) as In1,convert(varchar, Out1, 8) as Out1,convert(varchar, LateTolerance, 8) as LateTolerance,
            convert(varchar, EarlyOutTolerance, 8) as EarlyOutTolerance,WorkingHour,DayType.IsDesc as DayNames ,
            CASE
                      WHEN IsDay = 'Sunday' THEN 1
                      WHEN IsDay = 'Monday' THEN 2
                      WHEN IsDay = 'Tuesday' THEN 3
                      WHEN IsDay = 'Wednesday' THEN 4
                      WHEN IsDay = 'Thursday' THEN 5
                      WHEN IsDay = 'Friday' THEN 6
                      WHEN IsDay = 'Saturday' THEN 7
            END as sort_day
            from MasterTime A left join DayType ON DayType.Recnum=A.RecnumDayType where RecnumMasterShift=". $shift . " Order by 
            CASE
                      WHEN IsDay = 'Sunday' THEN 1
                      WHEN IsDay = 'Monday' THEN 2
                      WHEN IsDay = 'Tuesday' THEN 3
                      WHEN IsDay = 'Wednesday' THEN 4
                      WHEN IsDay = 'Thursday' THEN 5
                      WHEN IsDay = 'Friday' THEN 6
                      WHEN IsDay = 'Saturday' THEN 7
            END ASC");
        return $query;
    }
    public function get_rest($event)
    {
        $query = $this->db->query("select Recnum,convert(varchar, StartTime, 8) as StartTime,convert(varchar, EndTime, 8) as EndTime,Total,DeductWorkingHour,case when RestFor=1 then 'Early OT' when RestFor=2 then 'Return OT' when RestFor=3 then 'Holiday OT' else 'Permission' end as RestFor 
            from RestMaster where RecnumMasterTime=" .$event );
        return $query;
    }
    public function get_attendance_allowance($event)
    {
        $query = $this->db->query("select * from AttendancePerClass where RecnumClass=" .$event );
        return $query;
    }

    public function get_schedule_pattern()
    {
        $query = $this->db->query("select * from PatternSchedule order by Code");
        return $query;
    }
    public function view_schedule_pattern($recnum,$startdate,$enddate)
    {
        $query = $this->db->query("[Sp_ViewPatternSchedule] 0,". $recnum .",'" . $startdate ."','" . $enddate ."' ");
        return $query->result();
    }
    public function generate_schedule_pattern($recnum,$startdate,$enddate,$replace)
    {
        $recLogin = $this->session->userdata('user_id');
        $query = $this->db->query("[Sp_GenerateSchedule] '" . $recLogin . "',". $recnum .",'" . $startdate ."','" . $enddate ."',". $replace ." ");
        return $query->result();
    }
}