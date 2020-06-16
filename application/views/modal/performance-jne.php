<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Key Performance</label></h4>
	      	</div>
	      	<form id="Form" name="Form" class="grab form-horizontal" role="form">
	        <div class="modal-body">
	        	<div class="form-group" >
					<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Objective</label>
					<div class="col-sm-9" >
						<select id="area_kinerja" name="area_kinerja" class="form-control" >
							 <?php 
		                    foreach($area as $row)
		                    { 
		                      echo '<option value="'.$row->Id.'">'.$row->Name.'</option>';
		                    }
		                    ?>
		                </select>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Key Performance Indikator (KPI)</label>
					<div class="col-sm-9">
						<textarea class="form-control" id="IsDesc" name="IsDesc" placeholder="" rows="4" maxlength="300"></textarea>
						
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Target</label>
					<div class="col-sm-9">
						<input type="text" id="IsTarget" name="IsTarget" class="form-control dec" value="0" />
					</div>
				</div>
				
				<div class="form-group" >
					<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Calculation Method</label>
					<div class="col-sm-9" >
						<select id="calc" name="calc" class="form-control" >
							 <?php 
		                    foreach($calc as $row)
		                    { 
		                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
		                    }
		                    ?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Bobot</label>
					<div class="col-sm-9">
						<input type="number" id="WeightPercentage" name="WeightPercentage" value="0" class="form-control number" />
					</div>
				</div>
				
				<div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Sumber Data </label>

	              <div class="col-sm-9">
	                <input type="text" id="DataSource" name="DataSource" class="form-control" maxlength="200" />
	              </div>
	            </div>
	            <div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Actual</label>
					<div class="col-sm-9">
						<input type="text" id="IsActual" name="IsActual" class="form-control dec" value="0" />
					</div>
				</div>
				<div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Remark </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="remark_kpm" name="remark_kpm" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
				<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				
			</div>
	        <div class="modal-footer">
	        	<div class="pull-right">
		            <input type="hidden" id="txtRecnum" name="txtRecnum" />
		            <button type="button" id="btnSubmit" class="btn btn-primary btn-block">Submit</button>
		        </div>
	        </div>
	        </form>
	    </div>
	</div>
</div>

<div class="modal fade" id="ModalCoaching" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document" style="width: 1000px">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title-coaching"></label> <label> Coaching & Conseling</label></h4>
	      	</div>
	      	<form id="FormCoaching" name="FormCoaching" class="grab form-horizontal" role="form">
        	<div class="modal-body">
        		<div class="form-group">
		            <label class="col-sm-3 control-label no-padding-right" for="Official">Periode</label>
		            <div class="col-sm-4">
		            	<input type="hidden" id="RecnumPeriod" name="RecnumPeriod" style="text-align: center;" class="form-control" readonly />
		              <input type="text" id="IsPeriod" name="IsPeriod" style="text-align: center;" class="form-control" maxlength="200" readonly />
		            </div>
		            <label class="col-sm-2 control-label no-padding-right"> Tanggal Coaching</label>
		            <div class="col-sm-3">
		              <input type="text" id="DateOfCoaching" name="DateOfCoaching" style="text-align: center;" placeholder="" value="" class="form-control" readonly />
		            </div>
		        </div>
				<div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Topik Pembahasan </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="TopikPembahasan" name="TopikPembahasan" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Faktor yang perlu dipertahankan </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="FaktorDipertahankan" name="FaktorDipertahankan" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Faktor yang perlu dikembangkan </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="FaktorDikembangkan" name="FaktorDikembangkan" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Penyebab Utama </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="PenyebabUtama" name="PenyebabUtama" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
	            <div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Rencana Aksi & Evaluasi </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="RencanaAksiEvaluasi" name="RencanaAksiEvaluasi" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
				<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
			</div>

	        <div class="modal-footer">
	        	<div class="pull-right">
		            <input type="hidden" id="txtRecnumCoaching" name="txtRecnumCoaching" />
		            <button type="button" id="btnSubmitCoaching" class="btn btn-primary btn-block">Submit</button>
		        </div>
	        </div>
	        </form>
	    </div>
	</div>
</div>

<div class="modal fade" id="ModalCompetency" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document" style="width: 1000px">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title-competency"></label> <label> Competency</label></h4>
	      	</div>
	      	<form id="Form1" name ="Form1" class="grab form-horizontal" role="form">
	        <div class="modal-body">
	        	<div class="form-group" >
					<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Evaluator</label>
					<div class="col-sm-9" >
						<select id="evaluator" name="evaluator" class="form-control" >
							 <?php 
		                    foreach($evaluator as $row)
		                    { 
		                      echo '<option value="'.$row->Recnum.'">'.$row->IsDesc.'</option>';
		                    }
		                    ?>
		                </select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Kompetensi</label>
					<div class="col-sm-9">
						<input type="hidden" id="RecnumCompetency" name="RecnumCompetency" class="form-control"  />
						<input type="text" id="IsDescCompetency" name="IsDescCompetency" class="form-control" readonly />
					</div>
				</div>
				<div class="form-group" >
					<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Nilai</label>
					<div class="col-sm-9" >
						<select id="nilai" name="nilai" class="form-control" >
							 <?php 
		                    foreach($nilai as $row)
		                    { 
		                      echo '<option value="'.$row->Score.'">'.$row->IsDesc.'</option>';
		                    }
		                    ?>
		                </select>
					</div>
				</div>
				<div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Bukti Perilaku </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="bukti_perilaku" name="bukti_perilaku" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
	        </div>
	        <div class="modal-footer">
	        	<div class="pull-right">
		            <input type="hidden" id="txtRecnumCompetency" name="txtRecnumCompetency" />
		            <button type="button" id="btnSubmitCompetency" class="btn btn-primary btn-block">Submit</button>
		        </div>
	        </div>
	        </form>
	    </div>
	</div>
</div>

<div class="modal fade" id="ModalTaskScheduler" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title-task"></label> <label> Task Scheduler</label></h4>
	      	</div>
	      	<form id="FormTask" name="FormTask" class="grab form-horizontal" role="form">
	        <div class="modal-body" id="modal-body-task">
	        	<div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right" for="address"> Task </label>

	              <div class="col-sm-9">
	                <textarea class="form-control" id="task" name="task" placeholder="" rows="4" maxlength="300"></textarea>
	              </div>
	            </div>
	            <div class="form-group">
	              <label for="p-in" class="col-sm-3 control-label no-padding-right">Start Date</label>
	              <div class="col-sm-4">
	                  <div class="input-group">
	                    <input id="start_date" name="start_date" type="text" class="form-control date-picker" required />
	                    <span class="input-group-addon">
	                      <i class="fa fa-clock-o bigger-110"></i>
	                    </span>
	                  </div>
	              </div>
	              
	            </div> 
	            <div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right">End Date</label>
	              <div class="col-sm-4">
	                  <div class="input-group">
	                    <input id="end_date" name="end_date" type="text" class="form-control date-picker"  />
	                    <span class="input-group-addon">
	                      <i class="fa fa-clock-o bigger-110"></i>
	                    </span>
	                  </div>
	              </div>
	            </div> 
	        	<div class="form-group" >
					<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Priority</label>
					<div class="col-sm-9" >
						<select id="priority" name="priority" class="form-control" >
							 <?php 
		                    foreach($priority as $row)
		                    { 
		                      echo '<option value="'.$row->Id.'">'.$row->Name.'</option>';
		                    }
		                    ?>
		                </select>
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Report Type</label>
					<div class="col-sm-9">
						<input type="text" id="report_type" name="report_type" class="form-control" maxlength="200" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Submission Method</label>
					<div class="col-sm-9">
						<input type="text" id="sub_method" name="sub_method" class="form-control" value="" />
					</div>
				</div>
				
				<div class="form-group" >
					<label class="col-sm-3 control-label no-padding-right" style="padding-top: 6px" for="code">Task Status</label>
					<div class="col-sm-9" >
						<select id="task_status" name="task_status" class="form-control" >
							 <?php 
		                    foreach($task_status as $row)
		                    { 
		                      echo '<option value="'.$row->Id.'">'.$row->Name.'</option>';
		                    }
		                    ?>
		                </select>
					</div>
				</div>
				<div class="form-group">
	              <label class="col-sm-3 control-label no-padding-right">Completion Date</label>
	              <div class="col-sm-4">
	                  <div class="input-group">
	                    <input id="com_date" name="com_date" type="text" class="form-control date-picker"  />
	                    <span class="input-group-addon">
	                      <i class="fa fa-clock-o bigger-110"></i>
	                    </span>
	                  </div>
	              </div>
	            </div>
	            <div class="form-group">
	            	<label class="col-sm-3 control-label no-padding-right">Attach File</label>
					<div class="col-sm-9">
						<input type="file" id="attach_file" name="attach_file" />
					</div>
				</div>
				<input type="hidden" id="txtIdGet" name="txtIdGet" value="<?php echo $id ?>">
				<input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
				
			</div>
	        <div class="modal-footer">
	        	<div class="pull-right">
		            <input type="hidden" id="txtRecnumTask" name="txtRecnumTask" />
		            <button type="submit" id="btnSubmitTask" class="btn btn-primary btn-block">Submit</button>
		        </div>
	        </div>
	        </form>
	    </div>
	</div>
</div>
