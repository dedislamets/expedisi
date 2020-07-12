<style type="text/css">
  .multi {
    .carousel-inner .active.left {
      left: -25%;
    }
    .carousel-inner .next {
      left:  25%;
    }
    .carousel-inner .prev {
      left: -25%;
    }
    .carousel-control {
      width:  4%;
    }
    .carousel-control.left, .carousel-control.right {
      margin-left:15px;
      background-image:none;
    }
  }

	.FormGrid .EditTable tr:first-child {
	    display: table-row;;
	}
	.modal.in .modal-dialog {
		width: 700px;
	}
  .sub-ordinat {
    background-color: cadetblue;
    padding-left: 10px;
    margin-left: 0;
    color: #fff;
    font-size: 18px;
  }

  .align-items-stretch {
      -ms-flex-align: stretch!important;
      align-items: stretch!important;
  }
  .d-flex, .info-box, .info-box .info-box-icon {
      display: -ms-flexbox!important;
      display: flex!important;
  }
  .bg-light {
    background-color: #f8f9fa!important;
  }
  .text-muted {
    color: #6c757d!important;
}
.pt-0, .py-0 {
    padding-top: 0!important;
}
.lead {
    font-size: 1.25rem;
    font-weight: 300;
    margin-bottom: 0;
}
.ml-4, .mx-4 {
    margin-left: 1.5rem!important;
}
.mb-0, .my-0 {
    margin-bottom: 0!important;
}
.fa-ul {
    list-style-type: none;
    margin-left: 2.5em;
    padding-left: 0;
}
.fa-ul>li {
    position: relative;
}
.fa-li {
    left: -2em;
    position: absolute;
    text-align: center;
    width: 2em;
    line-height: inherit;
}

.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card {
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
.card-footer {
    padding: .75rem 1.25rem;
    background-color: rgba(0,0,0,.03);
    border-top: 0 solid rgba(0,0,0,.125);
}

.card-header {
    background-color: transparent;
    border-bottom: 1px solid rgba(0,0,0,.125);
    position: relative;
    padding: .75rem 1.25rem;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
.rows {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -7.5px;
    margin-left: -7.5px;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}
.text-center {
    text-align: center!important;
}
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
  <ul class="breadcrumb">
    <li>
      <i class="ace-icon fa fa-home home-icon"></i>
      <a href="#">Home</a>
    </li>
    <li><a href="<?= base_url(); ?>EmployeePerformance"><?php echo $title ?></a></li>
    <li class="active">Detail</li>
  </ul><!-- /.breadcrumb -->

</div>
<div class="page-content">
	<div class="page-header">
		<h1>
			<?php echo $title ?> <?php echo $detail[0]->IsPeriod ?>
		</h1>
     <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
     <input type="hidden" name="txtID" id="txtID" value="<?php echo $id ?>">
     <input type="hidden" name="txtRole" id="txtRole" value="<?php echo $role[0]->LoginType ?>">
     <input type="hidden" name="RecnumPerformanceStatus" id="RecnumPerformanceStatus" value="<?php echo $last_ps[0]->RecnumPerformanceStatus ?>">
      
	</div>
  <div class="row">
    <div class="well">
      <div class="col-md-6 no-padding">
        <div class="col-md-4">
          <div class="image">
            <img src="<?php echo $detail[0]->url ?>" style="height: 190px"  alt="User Image">
          </div>
        </div>
        <div class="col-md-8" >
          <table class="table">
            <tr>
              <td width="100">Emp ID</td><td>:</td><td><?php echo $detail[0]->EmployeeId ?></td>
            </tr>
            <tr>
              <td width="100">Emp Name</td><td>:</td><td><?php echo $detail[0]->EmployeeName ?></td>
            </tr>
            <tr>
              <td width="100">Join Date</td><td>:</td><td><?php echo $detail[0]->JoinDate ?></td>
            </tr>
            <tr>
              <td width="100">Position</td><td>:</td><td><?php echo $detail[0]->PositionStructural ?></td>
            </tr>
            <tr>
              <td width="100">Section</td><td>:</td><td><?php echo $detail[0]->Organization ?></td>
            </tr>
            <tr>
              <td width="100">Class</td><td>:</td><td><?php echo $detail[0]->Class ?></td>
            </tr>
            <tr>
              <td width="100">Working Status</td><td>:</td><td><?php echo $detail[0]->WorkingStatus ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-md-3">
          <h3 class="sub-ordinat">Head 1</h3>
          <img src="<?php echo $detail[0]->url_head ?>" class="" style="height: 130px;width: 100%">
        </div>
        <div class="col-md-3">
          <h3 class="sub-ordinat">Head 2</h3>
          <img src="<?php echo $detail[0]->url_head_2 ?>" class="" style="height: 130px;width: 100%">
        </div>
        <div class="col-md-6">
          <h3 class="sub-ordinat">Sub Ordinate</h3>
          <div class="multi">
            <div class="row">
              <div class="carousel slide" id="myCarousel">
                <div class="carousel-inner">
                  <?php 
                  foreach($subordinat as $row)
                  { ?>
                    <div class="item">
                      <div class="col-xs-3"><a href="#"><img src="<?php echo $row->url ?>" style="height: 130px;width: 100%"></a>
                      </div>
                    </div>
                  <?php }?>  
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
	<div class="row">
		<div class="tabbable">
      <ul class="nav nav-tabs" id="myTab">
        <li class="active">
          <a data-toggle="tab" href="#home">
            Key Performance
          </a>
        </li>

        <li>
          <a data-toggle="tab" href="#messages">
            Competency
          </a>
        </li>
        <li class="dropdown">
          <a data-toggle="tab" href="#education">
            Summary
          </a>
        </li>
        <li class="dropdown">
          <a data-toggle="tab" href="#coaching">
            Coaching & Conseling
          </a>
        </li>
        <li class="dropdown">
          <a data-toggle="tab" href="#scheduler">
            Task Scheduler
          </a>
        </li>
        <li class="dropdown">
          <a data-toggle="tab" href="#documen">
            Status Dokumen
          </a>
        </li>
    	</ul>
    	<div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <div class="widget-box widget-color-blue2">
            <div class="widget-header">
              <h4 class="widget-title lighter smaller"> 
                Key Performance
              </h4>
              
              <div style="float: right;padding-top: 5px;padding-right: 5px">
                <?php 
                  $disabled = 'disabled';
                  
                  if ($last_ps[0]->RecnumPerformanceStatus == 1) {
                    $disabled = '';
                  }

                  if ($role[0]->LoginType == 3) {
                    $disabled = 'disabled';
                  }
                  
                  if( $detail[0]->IsLock == 0 ) {  
                ?>

                <button class='btn btn-sm btn-white btn-success' id="btnAdd" <?php echo $disabled; ?> ><i class='ace-icon fa fa-plus'></i>
                Create</button>
              <?php } ?>
              </div>
            </div>

            <div class="widget-body">
              <div class="widget-main padding-8">
                <div class="table-responsive">
                  <table id="ViewTable" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th rowspan="2" style="text-align: center;">Action</th>
                        <th colspan="7" style="font-weight: bold;text-align: center;">Rencana Kerja Karyawan (RKK)</th>
                        <th colspan="2" style="font-weight: bold;text-align: center;">Pencapaian Aspek Kinerja</th>
                        
                      </tr>
                      <tr>
                        <th>No</th>
                        <th>Perspektif</th>
                        <th>Key Performance Indicator (KPI)</th>
                        <th>Target</th> 
                        <th>Metode Perhitungan</th>
                        <th>Bobot %</th>
                        <th>Sumber Data</th>                
                        <th>Actual</th>
                        <th>Persentase Pencapaian</th>
                        
                      </tr>
                    </thead>
                    <tbody>    
                      <?php 
                        $i=0;
                        $IsNo = "";
                        $total_bobot = 0;
                        foreach($data_key as $row)
                        { 
                          $generic = ($row->IsGeneric ==1) ? "style='background-color: gold;'" : "";
                          $generic_no_style = ($row->IsGeneric ==1) ? "background-color: gold;" : "";

                          ?>
                          <tr>
                             <td width="150"><?php echo $row->Action ?></td>
                            <td><?php echo $i+1 ?></td>
                            <?php 

                              if ($row->AreaPerformance != $IsNo) { ?>
                                   <td rowspan="<?php echo $row->IsCount ?>" style="text-align: center;vertical-align: middle;"><?php echo $row->AreaPerformance ?></td>
                              <?php } 
                               $IsNo= $row->AreaPerformance; 
                            ?>
                            <!-- <td><?php echo $row->AreaPerformance ?></td> -->
                            <td <?php echo $generic ?> ><?php echo $row->IsDesc ?></td>
                            <td <?php echo $generic ?> ><?php echo number_format($row->IsTarget,2) ?></td>
                            <td <?php echo $generic ?> ><?php echo $row->CalculationMethod ?></td>
                            <td style="text-align: right;<?php echo $generic_no_style ?>"><?php echo number_format($row->WeightPercentage,2) ?></td>
                            <td <?php echo $generic ?> ><?php echo $row->DataSource ?></td>
                            <td style="text-align: right;<?php echo $generic_no_style ?>"><?php echo number_format($row->IsActual,2) ?></td>
                            <td style="text-align: right;<?php echo $generic_no_style ?>"><?php echo number_format($row->Score,2) ?></td>
                           
                          </tr>
                        <?php  

                        $total_bobot = $total_bobot + floatval($row->WeightPercentage);
                        $i++;

                        }
                      ?>     
                      <tr style="background-color: green;color: #fff">
                        <td colspan="6" style="text-align: left;"><b>Total Bobot</b></td>
                        <td style="text-align: right;">
                          <input type="hidden" name="total_bobot" id="total_bobot" value="<?php echo $total_bobot ?>">
                          <?php echo number_format($total_bobot,2) ?>
                            
                        </td>
                        <td colspan="2" style="text-align: right;"><b>Pencapaian Aspek Kinerja</b></td>
                        <td style="text-align: right;"><?php echo $penc_aspek_kinerja[0]->TotalScoreKPM ?></td>
                        
                      </tr>                                
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="messages" class="tab-pane fade">
          <div class="widget-box widget-color-blue2">
            <div class="widget-header">
              <h4 class="widget-title lighter smaller"> Competency
              </h4>
            </div>

            <div class="widget-body">
              <div class="widget-main padding-8">
                <div class="table-responsive">
                  <table style="width: 100%" id="ViewTable-Competency" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th rowspan="2">Action</th>
                        <th rowspan="2">Kompetensi</th>
                        <th rowspan="2">Bobot</th>
                        <th colspan="2">Penilai 1</th>
                        <th colspan="2">Penilai 2</th>
                        <th rowspan="2">Bobot x Nilai (Bobot dikali rata-rata dari penilai 1 & 2)</th> 
                        <!-- <th>Gap</th> -->
                        
                      </tr>
                      <tr>
                        <th>Nilai</th>
                        <th>Bukti Perilaku</th>
                        <th>Nilai</th>
                        <th>Bukti Perilaku</th>
                      </tr>
                    </thead>
                    <tbody>  
                      <?php 
                        $i=0;
                        $total_bobot_com = 0;
                        foreach($competency as $row)
                        { 
                          ?>
                          <tr>
                            <td><?php echo $row->Action ?></td> 
                            <td><?php echo $row->Competency ?></td>
                            <td><?php echo number_format($row->IsWeight,3) ?></td>
                            <td><?php echo number_format($row->ScoreHead1,3) ?></td>
                            <td><?php echo $row->ProofOfBehaviorHead1 ?></td>
                            <td><?php echo number_format($row->ScoreHead2,3) ?></td>
                            <td><?php echo $row->ProofOfBehaviorHead2 ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->AverageScore,3) ?></td>
                            
                          </tr>
                        <?php  
                        $total_bobot_com = $total_bobot_com + floatval($row->IsWeight);
                        $i++;
                        }
                      ?>   
                      <tr>
                        <td colspan="2" style="text-align: left;"><b>Total Bobot</b></td>
                        <td >
                          <input type="hidden" name="total_bobot_com" id="total_bobot_com" value="<?php echo $total_bobot_com ?>">
                          <?php echo number_format($total_bobot_com,3) ?>
                            
                        </td>
                        <td colspan="4" style="text-align: right;"><b>Pencapaian Aspek Kompetensi</b></td>
                        <td style="text-align: right;"><?php echo number_format($penc_aspek_komp[0]->TotalScoreCompetency,3) ?></td>
                      </tr>                               
                    </tbody>
                  </table>
                  
                </div>     
              </div>
            </div>
          </div>
        </div>
        <div id="education" class="tab-pane fade">
          <div class="table-responsive">
          
            <div class="widget-box widget-color-blue2">
              <div class="widget-header">
                <h4 class="widget-title lighter smaller"> 
                </h4>
                  Summary Performance
              </div>

              <div class="widget-body">
                <div class="widget-main padding-8">      
                  <table  style="width: 100%"  id="ViewTable_summary_1" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Aspek</th>
                        <th style="text-align: right;">Total Bulan</th>
                        <th style="text-align: center;">Bobot</th>
                        <th style="text-align: right;">Nilai</th>
                        <th style="text-align: right;">Total Nilai</th>
                      </tr>
                    </thead>
                    <tbody>     
                      <?php 
                        $i=0;
                        $IsNo = $IsBobot ="";
                        foreach($summary as $row)
                        { 
                         
                          ?>
                          <tr>
                            <?php 
                              if ($row->IsNo != $IsNo) { ?>
                                   <td rowspan="<?php echo $row->IsCount ?>"><?php echo $row->IsNo ?></td>
                              <?php } 
                               $IsNo= $row->IsNo; 
                            ?>
                           
                            <td><?php echo $row->Aspek ?></td>
                            <td style="text-align: right;"><?php echo $row->TotalBulan ?></td>
                             <?php 
                              if ($row->IsNo != $IsBobot) { ?>
                                   <td rowspan="<?php echo $row->IsCount ?>" style="text-align: center;vertical-align: middle;"><?php echo $row->Bobot ?></td>
                              <?php } 
                               $IsBobot= $row->IsNo; 
                            ?>
                              
                            <td style="text-align: right;"><?php echo number_format($row->Nilai,3) ?></td>
                            <td style="text-align: right;"><?php echo number_format($row->TotalNilai,3) ?></td>
                          </tr>
                        <?php  
                        $i++;
                        }
                      ?>     
                      <tr>
                        <td colspan="5" style="text-align: right;"><b>Rekapitulasi Nilai Akhir sebelum SP</b></td>
                        <td style="text-align: right;"><?php echo number_format($penc_summary[0]->RekapitulasiSblmSP,3) ?></td>
                      </tr> 
                      <tr>
                        <td colspan="5" style="text-align: right;"><b>Rekapitulasi Nilai Akhir setelah SP</b></td>
                        <td style="text-align: right;"><?php echo number_format($penc_summary[0]->RekapitulasiSesudahSP,3) ?></td>
                      </tr>                              
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            
          </div>
        </div>
        <div id="coaching" class="tab-pane fade">
          <div class="table-responsive">
            <div class="widget-box widget-color-blue2">
              <div class="widget-header">
                <h4 class="widget-title lighter smaller"> 
                </h4>
                  Coaching & Conseling
              </div>
              <div class="widget-body">
                <div class="widget-main padding-8">
                  <table  style="width: 100%"  class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Tanggal</th>
                        <th>Topik Pembahasan</th>
                        <th>Faktor yang perlu dipertahankan</th>
                        <th>Faktor yang perlu dikembangkan</th>
                        <th>Penyebab Utama</th>
                        <th>Rencana Aksi / Evaluasi</th>
                      </tr>
                    </thead>
                    <tbody>     
                      <?php 
                        $i=0;
                        foreach($conseling as $row)
                        { 
                          ?>
                          <tr>
                            <td><?php echo $row->Action ?></td>
                            <td><?php echo $i+1 ?></td>
                            <td><?php echo $row->IsPeriod ?></td>
                            <td><?php echo date("d M Y", strtotime($row->DateOfCoaching)) ?></td>
                            <td><?php echo $row->TopikPembahasan ?></td>
                            <td><?php echo $row->FaktorDipertahankan ?></td>
                            <td><?php echo $row->FaktorDikembangkan ?></td>
                            <td><?php echo $row->PenyebabUtama ?></td>
                            <td><?php echo $row->RencanaAksiEvaluasi ?></td>
                            
                          </tr>
                        <?php  
                        $i++;
                        }
                      ?>                       
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="scheduler" class="tab-pane fade">
          <div class="table-responsive">
            <div class="widget-box widget-color-blue2">
              <div class="widget-header">
                <h4 class="widget-title lighter smaller"> 
                  Task Scheduler
                </h4>
                  
                  <div style="float: right;padding-top: 5px;padding-right: 5px">
                    <button class='btn btn-sm btn-white btn-success' id="btnAddTask"><i class='ace-icon fa fa-plus'></i>
                    Create</button>
                  </div>
              </div>
              <div class="widget-body">
                <div class="widget-main padding-8">
                  <table  style="width: 100%"  class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>No</th>
                        <th>Task</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Priority</th>
                        <th>Completation Date</th>
                        <th>Task Status</th>
                        
                      </tr>
                    </thead>
                    <tbody>     
                      <?php 
                        $i=0;
                        foreach($scheduler as $row)
                        { 
                          ?>
                          <tr>
                            <td><?php echo $row->Action ?></td>
                            <td><?php echo $i+1 ?></td>
                            <td><?php echo cetak($row->Task) ?></td>
                            <td><?php echo date("d M Y", strtotime($row->StartDate)) ?></td>
                            <td><?php echo date("d M Y", strtotime($row->EndDate)) ?></td>
                            <td><?php echo cetak($row->Priority) ?></td>
                            <td><?php echo date("d M Y", strtotime($row->CompletationDate)) ?></td>
                            <td><?php echo $row->TaskStatus ?></td>
                            
                          </tr>
                        <?php  
                        $i++;
                        }
                      ?>                   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
        </div>
        <div id="documen" class="tab-pane fade">
          <div class="table-responsive">
            <div class="widget-box widget-color-blue2">
              <div class="widget-header">
                <h4 class="widget-title lighter smaller"> 
                  Status Dokumen
                </h4>
                  
                  <div style="float: right;padding-top: 5px;padding-right: 5px">
                    <button class='btn btn-sm btn-white btn-success' id="btnAddDoc"><i class='ace-icon fa fa-plus'></i>
                    Ubah Status</button>
                  </div>
              </div>
              <div class="widget-body">
                <div class="widget-main padding-8">
                  <table  style="width: 100%"  class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Edit By</th>
                        <th>Remark</th>
                        
                      </tr>
                    </thead>
                    <tbody>     
                      <?php 
                        $i=0;
                        foreach($dokumen as $row)
                        { 
                          ?>
                          <tr>
                            <td><?php echo date("d M Y", strtotime($row->Date)) ?></td>
                            <td><?php echo $row->Status ?></td>
                            <td><?php echo $row->EditBy ?></td>
                            <td><?php echo $row->Remark ?></td>
                            
                          </tr>
                        <?php  
                        $i++;
                        }
                      ?>                   
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
        </div>
      </div>
	</div>
</div>

<?php
  $this->load->view($modal); 
?>