<div class="row">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4>List DO/SPK</h4>
                    <span>Halaman ini menampilkan data SPK/DO yang tersimpan</span>
                </div>
                <div class="col-xl-2">
                    <a href="<?= base_url() ?>spk" class="btn btn-grd-success" ><i class="icofont icofont-ui-add"></i> Tambah baru</a>
                </div>
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <div class="dt-responsive table-responsive">
                <table id="ViewTable" class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                              No SPK 
                            </th>
                            <th>
                              Project
                            </th>
                            <th>
                              Tanggal
                            </th>
                            <th>
                              Pengirim
                            </th>
                            <th>
                              Kota Pengirim
                            </th>
                            <th>
                              Penerima
                            </th>
                            <th>
                              Kota Penerima
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
