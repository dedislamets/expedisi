<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eform extends CI_Model
{
	public function combobox($name,$id_name,$query)
    {
    	$row_data = $this->db->query($query)->result();
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                    <select class="chosen-select form-control" id="'.$id_name.'" name="'.$id_name.'">';
                     foreach($row_data as $row)
                        { 
                         $text .='<option value="'.$row->Id.'">'.$row->Name.'</option>';
                        }
        $text .='    </select>
                  </div>
                </div>';
        return $text;
    }
    public function Multiline($name,$id_name)
    {
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                   	<textarea class="form-control" id="'.$id_name.'" name="'.$id_name.'" placeholder=""></textarea>
                  </div>
                </div>';
        return $text;
    }
    public function Date($name,$id_name)
    {
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                   	<div class="input-group">
	                  <input id="'.$id_name.'" name="'.$id_name.'" type="text" class="form-control date-picker" />
	                  <span class="input-group-addon">
	                    <i class="fa fa-clock-o bigger-110"></i>
	                  </span>
	                </div>
                  </div>
                </div>';
        return $text;
    }
    public function Time($name,$id_name)
    {
    	$text = '<div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">'.$name.'</label>
                  <div class="col-sm-9">
                   	<div class="input-group bootstrap-timepicker">
                      <input id="'.$id_name.'" name="'.$id_name.'" type="text" class="form-control waktu" />
                      <span class="input-group-addon">
                        <i class="fa fa-clock-o bigger-110"></i>
                      </span>
                    </div>
                  </div>
                </div>';
        return $text;
    }
}