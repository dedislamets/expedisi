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
                    <span>Halaman ini mengupload data routing slip manual</span>
                </div>
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <div>
              
              <div class="card z-depth-0">
                <div class="card-header" style="padding: 10px 20px;">
                </div>
                <div class="card-block panels-wells">
                    <form method="POST" action="<?= base_url()?>listrs/import" accept-charset="UTF-8" enctype="multipart/form-data" target="_blank">
                         
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Upload Excel *</label>
                                        <input class="form-control" required="" name="file" type="file">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Template Excel</label>
                                        <a href="<?= base_url() ?>assets/file/sample upload routing.xlsx" class="btn btn-info btn-block btn-md"><i class="dripicons-download"></i>  Unduh</a>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
                        <input class="btn btn-primary" type="submit" value="Submit">
                        
                    </form>
                </div>
              </div>                        
            </div>

        </div>
    </div>
    
</div>