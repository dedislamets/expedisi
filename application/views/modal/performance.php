<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title"></label> <label> Key Performance</label></h4>
	      	</div>
	      	<form id="Form" name ="Form" class="grab form-horizontal" role="form">
	        <div class="modal-body">	
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Key Performance</label>
					<div class="col-sm-9">
						<input type="text" id="IsDesc" name="IsDesc" class="form-control" maxlength="200" />
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right">Weight</label>
					<div class="col-sm-9">
						<input type="number" id="WeightPercentage" name="WeightPercentage" value="0" class="form-control number" />
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
					<label class="col-sm-3 control-label no-padding-right">Target</label>
					<div class="col-sm-9">
						<input type="text" id="IsTarget" name="IsTarget" class="form-control dec" value="0" />
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
	                <textarea class="form-control" id="remark" name="remark" placeholder="" rows="4" maxlength="300"></textarea>
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

<div class="modal fade" id="ModalCompetency" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document" style="width: 1000px">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel"><label id="lbl-title-competency"></label> <label> Key Performance</label></h4>
	      	</div>
	      	<form id="Form" name ="Form" class="grab form-horizontal" role="form">
	        <div class="modal-body">
	        	<div class="alert alert-info">
					Kemampuan untuk mengelola (manajemen) kelompok dan atau anggota tim dengan prinsip - prinsip manajemen (PCDCA) dimana seorang atasan berperan sebagai Planner, Coordinator, Instructor,  Evaluator dan Problem Solver. Manajemen mengarahkan perilaku dalam faktor teknis pekerjaan dengan 10 PCDCA Key Management Process yaitu :  1. Merencanakan Pekerjaan  2. Menetapkan sasaran dan standar individu  3. Menetapkan sasaran dan standar tim  4. Memonitor kinerja tim  5. Melaksanakan aktivitas yang terkoordinir  6. Memonitor kinerja individu  7. Mengevaluasi kinerja individu  8. Memberikan penghargan kepada individu  9. Memberikan pelatihan  10. Memecahkan masalah
				</div>
	        	<div class="card card-solid">
	        		<h3 style="padding-left: 15px">Tingkat Kemahiran</h3>
			        <div class="card-body pb-0">
			          <div class="row d-flex align-items-stretch">
			            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
			              <div class="card bg-light">
			                <div class="card-header text-muted border-bottom-0">
			                  Digital Strategist
			                </div>
			                <div class="card-body pt-0">
			                  <div class="rows">
			                    <div class="col-sm-7">
			                      <h2 class="lead"><b>Nicole Pearson</b></h2>
			                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
			                      <ul class="ml-4 mb-0 fa-ul text-muted">
			                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
			                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
			                      </ul>
			                    </div>
			                    <div class="col-sm-5 text-center">
			                      <img src="../assets/images/user2-160x160.jpg" alt="" class="img-circle img-fluid">
			                    </div>
			                  </div>
			                </div>
			                <div class="card-footer">
			                  <div class="text-right">
			                    <a href="#" class="btn btn-sm bg-teal">
			                      <i class="fa fa-comments"></i>
			                    </a>
			                    <a href="#" class="btn btn-sm btn-primary">
			                      <i class="fa fa-user"></i> View Profile
			                    </a>
			                  </div>
			                </div>
			              </div>
			            </div>
			            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
			              <div class="card bg-light">
			                <div class="card-header text-muted border-bottom-0">
			                  Digital Strategist
			                </div>
			                <div class="card-body pt-0">
			                  <div class="rows">
			                    <div class="col-sm-7">
			                      <h2 class="lead"><b>Nicole Pearson</b></h2>
			                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
			                      <ul class="ml-4 mb-0 fa-ul text-muted">
			                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
			                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
			                      </ul>
			                    </div>
			                    <div class="col-sm-5 text-center">
			                      <img src="../assets/images/user2-160x160.jpg" alt="" class="img-circle img-fluid">
			                    </div>
			                  </div>
			                </div>
			                <div class="card-footer">
			                  <div class="text-right">
			                    <a href="#" class="btn btn-sm bg-teal">
			                      <i class="fa fa-comments"></i>
			                    </a>
			                    <a href="#" class="btn btn-sm btn-primary">
			                      <i class="fa fa-user"></i> View Profile
			                    </a>
			                  </div>
			                </div>
			              </div>
			            </div>
			            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
			              <div class="card bg-light">
			                <div class="card-header text-muted border-bottom-0">
			                  Digital Strategist
			                </div>
			                <div class="card-body pt-0">
			                  <div class="rows">
			                    <div class="col-sm-7">
			                      <h2 class="lead"><b>Nicole Pearson</b></h2>
			                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
			                      <ul class="ml-4 mb-0 fa-ul text-muted">
			                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
			                        <li class="small"><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
			                      </ul>
			                    </div>
			                    <div class="col-sm-5 text-center">
			                      <img src="../assets/images/user2-160x160.jpg" alt="" class="img-circle img-fluid">
			                    </div>
			                  </div>
			                </div>
			                <div class="card-footer">
			                  <div class="text-right">
			                    <a href="#" class="btn btn-sm bg-teal">
			                      <i class="fa fa-comments"></i>
			                    </a>
			                    <a href="#" class="btn btn-sm btn-primary">
			                      <i class="fa fa-user"></i> View Profile
			                    </a>
			                  </div>
			                </div>
			              </div>
			            </div>
			        </div>
			    </div>
	        </div>
	        </form>
	    </div>
	</div>
</div>