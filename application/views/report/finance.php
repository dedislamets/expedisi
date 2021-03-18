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
                    <span>Halaman ini mendowload data invoice, payment dan outstanding</span>
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
                    <div class="form-group row m-b-0">
                        
                        <label class="col-sm-1 col-form-label f-w-700">Dari</label>
                        <div class="col-sm-2">
                            <input class="form-control form-bg-inverse" type="date" id="from_tanggal" name="from_tanggal"  />
                        </div>
                        <label class="col-sm-1 col-form-label f-w-700">Sampai</label>
                        <div class="col-sm-2">
                            <input class="form-control form-bg-inverse" type="date" id="to_tanggal" name="to_tanggal"  />
                        </div>
                        

                    </div>
                    <div class="form-group row m-t-10">
                        <label class="col-sm-1 col-form-label f-w-700">Customer</label>
                        <div class="col-sm-3">
                            <select name="cust" id="cust" class="chosen-select form-control" multiple="">
                                <?php 
                                  foreach($customer as $row)
                                  { 
                                    echo '<option value="'.$row->id.'">'.$row->cust_name.'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-t-10">
                        <label class="col-sm-1 col-form-label f-w-700">Vendor</label>
                        <div class="col-sm-3">
                            <select name="vend" id="vend" class="chosen-select form-control" multiple="">
                                <?php 
                                  foreach($customer as $row)
                                  { 
                                    echo '<option value="'.$row->id.'">'.$row->cust_name.'</option>';
                                  }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-t-10">
                        <div class="col-sm-4">
                            <button class="btn btn-success btn-block btn-round" id="btnExport"><i class="icofont icofont-download"></i> Download</button>
                        </div>
                    </div>
                </div>
              </div>                        
            </div>

        </div>
    </div>
    
</div>