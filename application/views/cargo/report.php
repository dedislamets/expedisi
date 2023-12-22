<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 5px 30px 5px 20px;
    }
</style>
<div class="row">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4><?= $title ?></h4>
                    <span>Halaman ini mendowload data routing slip</span>
                </div>
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <div>
              <h4 class="info-text" style="margin-top: 30px;">Filter By
              </h4>
              <div class="card z-depth-0">
                <div class="card-header" style="padding: 10px 20px;">
                </div>
                <div class="card-block panels-wells">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label f-w-700">Project</label>
                        <div class="col-sm-3">
                            <select name="project" id="project" class="js-example-basic-single form-control">
                                <option value="all">Semua</option>
                                <?php 
                                  foreach($project as $row)
                                  { 
                                    echo '<option value="'.$row->nama_project.'">'.$row->nama_project.'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label f-w-700">Dari</label>
                        <div class="col-sm-3">
                            <input class="form-control form-bg-inverse" type="date" id="from_tanggal" name="from_tanggal"  />
                        </div>
                        <label class="col-sm-1 col-form-label f-w-700">Sampai</label>
                        <div class="col-sm-3">
                            <input class="form-control form-bg-inverse" type="date" id="to_tanggal" name="to_tanggal"  />
                        </div>
                        

                    </div>
                    <div class="form-group row m-b-0">
                        <label class="col-sm-1 col-form-label f-w-700">Requestor</label>
                        <div class="col-sm-3">
                            <select name="requestor" id="requestor" class="js-example-basic-single form-control">
                                <option value="all">Semua</option>
                                <?php 
                                  foreach($requestor as $row)
                                  { 
                                    echo '<option value="'.$row->requestor.'">'.$row->requestor.'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success btn-block btn-round" id="btnExport"><i class="icofont icofont-download"></i> Download</button>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-success btn-block btn-round" id="btnExportRingkas"><i class="icofont icofont-download"></i> Download Ringkas</button>
                        </div>
                    </div>
                </div>
              </div>                        
            </div>

        </div>
    </div>
    
</div>