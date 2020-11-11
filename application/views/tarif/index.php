<div class="row">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4>Master Tarif Layanan</h4>
                    <span>Halaman Utama ini menampilkan informasi layanan</span>
                </div>
                <div class="col-xl-2">
                    <button class="btn btn-grd-success" id="btnAdd"><i class="icofont icofont-ui-add"></i> Tambah baru</button>
                </div>
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <div class="dt-responsive table-responsive">
                <table id="ViewTable" class="table table-striped">
                    <thead class="text-primary">
                        <tr>
                            <th>
                              Asal
                            </th>
                            <th>
                              Tujuan
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
