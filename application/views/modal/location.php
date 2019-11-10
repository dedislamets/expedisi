<div class="hidden">
	<form id="Form" name ="Form" class="grab form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="parentID">Parent <span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<select id="parentID" name="parentID" class="form-control">
                    <?php 
                    foreach($org as $row_org)
                    { 
                      echo '<option value="'.$row_org->Recnum.'">'.$row_org->LocationName.'</option>';
                    }
                    ?>
                </select>
			</div>
		</div>
		
		<div class="form-group" >
			<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">City<span style="color:red"> *</span></label>
			<div class="col-sm-9" >
				<select id="icity" name="icity" class="form-control" style="background-color: darkslategrey;color: #fff;">
					<option value="0" selected>--Choose a City--</option>
					 <?php 
                    foreach($city as $row_city)
                    { 
                      echo '<option value="'.$row_city->Recnum.'">'.$row_city->IsDesc.'</option>';
                    }
                    ?>
                </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="OrgName">Location Name<span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<input type="text" id="OrgName" name="OrgName" class="form-control" maxlength="200" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Sort">Sort</label>
			<div class="col-sm-2">
				<input type="number" id="Sort" name="Sort" class="form-control" />
			</div>
			
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Sort">Effective Date<span style="color:red"> *</span></label>
			<div class="col-sm-4 no-padding-right">
				<div class="input-group">
					<input class="form-control date-picker" id="dateRangeStart" name="dateRangeStart" type="text" data-date-format="dd-mm-yyyy" />
					<span class="input-group-addon">
						<i class="fa fa-calendar bigger-110"></i>
					</span>
				</div>
			</div>
			<label class="col-sm-1 control-label ">To</label>
			<div class="col-sm-4">
				<div class="input-group">
					<input class="form-control date-picker" id="dateRangeEnd" name="dateRangeEnd" type="text" data-date-format="dd-mm-yyyy" />
					<span class="input-group-addon">
						<i class="fa fa-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Official">Active</label>
			<div class="col-sm-1" style="padding-top: 9px;">
				<label>
					<input id="isActive" name="isActive" class="ace ace-switch" type="checkbox" checked />
					<span class="lbl"></span>
				</label>
			</div>
			
		</div>
		
		<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

	</form>
</div>