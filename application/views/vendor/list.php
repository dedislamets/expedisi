<div class="row">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4>Master Customer</h4>
                    <span>Halaman Utama ini menampilkan informasi customer</span>
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
                              Nama Customer
                            </th>
                            <th>
                              Region
                            </th>
                            <th class="text-center">
                              Phone 1
                            </th>
                            <th>
                              Phone 2
                            </th>
                            <th>
                              Attention
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
