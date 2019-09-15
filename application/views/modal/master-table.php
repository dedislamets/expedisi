<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add Table</h4>
	      </div>
	      <?php echo form_open(site_url("GenerateTable/alter"), array("class" => "form-horizontal", "id" => "form1", "method" => "POST")) ?>
	        <div class="modal-body">
	        	<div class="form-group">
	              	<label class="col-sm-1 control-label no-padding-right">Parent</label>
	              	<div class="col-sm-10">
		                <select class="chosen-select form-control" id="parent_table" name="parent_table">
		                  <option value="0">--</option>
		                  <?php 
		                  foreach($parent as $row)
		                  { 
		                    echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
		                  }?>
		                </select>
	              	</div>
	          	</div>
				<div class="form-group" style="border-bottom: dotted 1px grey;padding-bottom: 10px">
					<label class="col-sm-1 control-label no-padding-right" for="code">Table</label>
					<div class="col-sm-10">
						<input type="text" id="tabel_name" name="tabel_name" placeholder="" class="form-control" value="" maxlength="30" />
					</div>
				</div>

				<div class="baris cl" style="border-bottom: dotted 1px grey;margin-top: 10px">
					<div class="form-group" style="margin-bottom: 0">
						<label class="col-sm-1 control-label no-padding-right label-name" id="label1">Field 1</label>
						<div class="col-sm-3">
							<input type="text" id="field" name="field" class="form-control" maxlength="300" />
						</div>
						<div class="col-sm-2">
							<select id="type_data" name="type_data" class="form-control">
								<option value="varchar">Varchar</option>
								<option value="nvarchar">Nvarchar</option>
			                    <option value="datetime">Datetime</option>
								<option value="text">Text</option>
								<option value="decimal">Decimal</option>
								<option value="float">Float</option>
								<option value="bit">Boolean</option>
								<option value="int">Integer</option>
								<option value="numeric">Numeric</option>
			                </select>
						</div>
						<div class="col-sm-1 no-padding">
							<input type="text" id="val_limit" name="val_limit" class="form-control" maxlength="300" />
						</div>
						<div class="col-sm-1" style="margin-left: 10px;padding-top: 5px;">
							<label>
								<input id="isNull" name="isNull" class="ace ace-switch" type="checkbox" checked />
								<span class="lbl"></span>
							</label>
						</div>
						<div class="col-sm-1" style="margin-left: 10px;padding-top: 5px;">
							<label>
								<input id="isPK" name="isPK" class="ace ace-switch" type="checkbox" />
								<span class="lbl"></span>
							</label>
						</div>
						<div class="col-sm-2 pull-right">
							<button type="button" class="btn btn-danger btn-xs" onclick="delRow(this)">
								<i class="ace-icon fa fa-trash-o fa-2x icon-only"></i>
							</button>
							<button type="button" class="btn btn-info btn-xs" onclick="addRow()">
								<i class="ace-icon fa fa-plus fa-2x icon-only"></i>
							</button>
						</div>						
					</div>

					<div class="form-group">
						<label class="col-sm-1 control-label no-padding-right" for="parentID"></label>
						<label class="col-sm-3">Column Name</label>
						<label class="col-sm-2">Type Data</label>
						<label class="col-sm-1 no-padding">Length</label>
						<label class="col-sm-1 col-sm-1 no-padding text-right" >Null</label>
						<label class="col-sm-1 col-sm-1 no-padding text-right">PK</label>
					</div>
					<div class="form-group">
						<div class="col-sm-8 pull-right">
							<input type="text" id="comment" name="comment" class="form-control" placeholder="Comment" />
						</div>
					</div>
				</div>
				
				<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >

	        </div>
	        <div class="modal-footer">
	        	<button type="submit" id="submit_button" class="btn btn-primary">Submit</button>
	      </div>
	        <?php echo form_close() ?>
	    </div>
	</div>
</div>
