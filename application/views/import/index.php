<div class="row">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4>Import Excel</h4>
                    <span>Halaman Utama ini menampilkan informasi barang</span>
                </div>
               
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <form method="post" action="<?php echo base_url('Import/importExcel') ?>" enctype="multipart/form-data">
                <div class="form-group row">
                     <label class="col-sm-2 col-form-label">Upload File</label>
                    <div class="col-sm-8">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-sm-2"><button type="submit">Submit</button></div>
                </div>
                <input type="hidden" id="csrf_token" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" >
            </form>
        </div>
    </div>
    
</div>

