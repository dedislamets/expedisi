<div class="row">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4><?= $title ?></h4>
                    <span>Halaman Utama ini menampilkan informasi <?= $title ?></span>
                </div>
                <div class="col-xl-2">
                    <button class="btn btn-grd-success" id="btnAdd"><i class="icofont icofont-ui-add"></i> Tambah baru</button>
                </div>
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <div class="dt-responsive">
                <table id="ViewTable" class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                              ID
                            </th>
                            <th>
                              Prefix
                            </th>
                            <th>
                              Nama Project
                            </th>
                            <th>
                              Aktif
                            </th>
                            <th class="text-left">
                              Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<?php
  $this->load->view($modal); 
?>
