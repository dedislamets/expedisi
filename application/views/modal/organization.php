<div class="hidden">
	<form id="Form" name ="Form" class="grab form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="parentID">Parent<span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<!-- <input type="hidden" id="parentID" name="parentID"  value='' class="form-control" /> -->
				<!-- <input type="text" id="parentText" name="parentText" placeholder="" value='' class="form-control" disabled /> -->
				<select id="parentID" name="parentID" class="form-control">
                    <?php 
                    foreach($org as $row_org)
                    { 
                      echo '<option value="'.$row_org->Recnum.'">'.$row_org->OrgName.'- '.$row_org->OrgId .'</option>';
                    }
                    ?>
                </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="code">Code Structure<span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<input type="text" id="code" name="code" placeholder="" class="form-control" value="" maxlength="30" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="OrgName">Organization Name<span style="color:red"> *</span></label>
			<div class="col-sm-9">
				<input type="text" id="OrgName" name="OrgName" class="form-control" maxlength="300" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Sort">Sort</label>
			<div class="col-sm-2">
				<input type="number" id="Sort" name="Sort" class="form-control" />
			</div>
			<label class="col-sm-4 control-label no-padding-right" for="Extention">Standart Employe. Required</label>
			<div class="col-sm-2">
				<input type="text" id="EmpReq" name="EmpReq" class="form-control dec" />
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
			<label class="col-sm-1 control-label ">S.d</label>
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
			<label class="col-sm-3 control-label no-padding-right" for="Official">Official</label>
			<div class="col-sm-3 no-padding-right">
				<input type="text" id="Official" name="Official" class="form-control"  />
			</div>
			<label class="col-sm-2 control-label no-padding-right" for="Extention">Extention</label>
			<div class="col-sm-4">
				<input type="text" id="Extention" name="Extention" class="form-control" maxlength="20" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="Official">Active</label>
			<div class="col-sm-4" style="padding-top: 9px;">
				<label>
					<input id="isActive" name="isActive" class="ace ace-switch" type="checkbox" checked />
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

	</form>
</div>