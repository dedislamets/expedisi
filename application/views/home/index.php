
<div class="card borderless-card">
    <div class="card-block inverse-breadcrumb">
        <div class="breadcrumb-header">
            <h5>Dashboard</h5>
            <span>Halaman Utama ini memuat sekilas rangkuman informasi</span>
        </div>
        <div class="page-header-breadcrumb">
            <!-- <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="#!">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                </li>

            </ul> -->
        </div>
    </div>
</div>

<div class="row" id="app">
    <!-- <div class="col-xl-6 col-md-12">
        <div class="card user-card-full">
            <div class="row m-l-0 m-r-0">
                <div class="col-sm-4 bg-c-lite-green user-profile">
                    <div class="card-block text-center text-white">
                        <div class="m-b-25">
                            <img src="<?= base_url(); ?>assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                        </div>
                        <h6 class="f-w-600">Jeny William</h6>
                        <p>Web Designer</p>
                        <i class="feather icon-edit m-t-10 f-16"></i>
                    </div>
                </div>
                <div class="col-sm-8" style="background: linear-gradient(to right, #546D77, #3F5159);;color: #fff;">
                    <div class="card-block">
                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Email</p>
                                <h6 class="text-muted f-w-400"><a href="..\..\..\cdn-cgi\l\email-protection.htm" class="__cf_email__" data-cfemail="3a505f54437a5d575b535614595557">[email&#160;protected]</a></h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Phone</p>
                                <h6 class="text-muted f-w-400">0023-333-526136</h6>
                            </div>
                        </div>
                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Projects</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Recent</p>
                                <h6 class="text-muted f-w-400">Guruable Admin</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="m-b-10 f-w-600">Most Viewed</p>
                                <h6 class="text-muted f-w-400">Able Pro Admin</h6>
                            </div>
                        </div>
                        <ul class="social-link list-unstyled m-t-40 m-b-10">
                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook"><i class="feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter"><i class="feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram"><i class="feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <?php if($this->session->userdata('role_id') ==  1 || $this->session->userdata('role_id') == 2): ?>
    <div class="col-xl-12 col-md-12">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card social-card bg-simple-c-pink">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">ROUTING LIST</p>
                                <h4 class="m-b-0"><?= $total_routing?></h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-layers f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                    <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card social-card bg-simple-c-green">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">DALAM PERJALANAN</p>
                                <h4 class="m-b-0"><?= $perjalanan ?></h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-navigation-2 f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                    <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card social-card bg-simple-c-blue" style="background-color: #3F5159;">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">PICKUP</p>
                                <h4 class="m-b-0"><?= $pickup ?></h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="feather icon-watch f-50 text-c-yellow"></i>
                            </div>
                        </div>

                    </div>
                    <a href="#!" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-12">
              <div class="card">
                <div class="card-block bg-c-green">
                  <div id="proj-earning" style="height: 230px"></div>
                </div>
                <div class="card-footer">
                  <h6 class="text-muted m-b-30 m-t-15">Total project and customer</h6>
                  <div class="row text-center">
                    <div class="col-6 b-r-default">
                      <h6 class="text-muted m-b-10">Projects</h6>
                      <h4 class="m-b-0 f-w-600 ">175</h4>
                    </div>
                    <div class="col-6">
                      <h6 class="text-muted m-b-10">Total Customer</h6>
                      <h4 class="m-b-0 f-w-600 ">76.6M</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-8 col-md-12">
                <div class="card table-card">
                    <div class="card-header btn-grd-danger">
                      <h5>Status Terakhir di update</h5>
                    </div>
                    <div class="card-block">
                      <div class="table-responsive">
                        <table class="table table-hover table-borderless">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Remark</th>
                              <th>Updated</th>
                              <th class="text-right">Updated By</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($history as $row): ?>
                            <tr>
                              <td><?= $row['no_routing']?></td>
                              <td><?= $row['remark']?></td>
                              <td><?= tgl_waktu_indo($row['created_date'])?></td>
                              <td><?= $row['created_by']?></td>
                              <td><?= $row['status']?></td>
                            </tr>
                            <?php endforeach ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="text-right  m-r-20">
                        <a href="#!" class="b-b-primary text-primary">View all Sales Locations </a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
     <?php endif ?>
    <?php if($this->session->userdata('role_id') ==  1 ): ?>
    <div class="col-xl-12 col-md-12 hidden">
        <div class="card">
            <div class="card-header">
                <h4>Update Terakhir Pengiriman</h4>
                <div id="maps" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if($this->session->userdata('role_id') ==  1 || $this->session->userdata('role_id') == 3): ?>
    <div class="col-xl-9 col-md-12">

        <div class="card">
            <div class="card-header">
              <h5>Grafik Payment 5 Bulan Terakhir</h5>
              <span>Chart transaksi pembayaran dari customer dan ke vendor</span>
            </div>
            <div class="card-block">
              <div id="chart_Combo" style="width: 100%; height: 300px;"></div>
            </div>
        </div>

    </div>
    <div class="col-xl-3 col-md-12">
        <div class="card user-card2">
            <div class="card-block text-center">
                <h6 class="m-b-15 f-w-700">Due Date Invoice</h6>
                <div class="risk-rate">
                    <span><b><?= $total_duedate ?></b></span>
                </div>
                <h6 class="m-b-10 m-t-10">Customer</h6>
                <a href="#!" class="text-c-yellow b-b-warning">Lihat Data</a>
                
            </div>
        </div>
        <div class="card user-card2">
            <div class="card-block text-center">
                <h6 class="m-b-15 f-w-700">Due Date Invoice</h6>
                <div class="risk-rate">
                    <span><b><?= $total_duedate_vendor ?></b></span>
                </div>
                <h6 class="m-b-10 m-t-10">Vendor</h6>
                <a href="#!" class="text-c-yellow b-b-warning">Lihat Data</a>
                
            </div>
        </div>
    </div>
    <?php endif ?>
    <?php if($this->session->userdata('role_id') ==  1 || $this->session->userdata('role_id') == 4): ?>
    <div class="col-xl-12 col-md-12">
        <div class="row">
            <?php foreach($list_kurir as $row): ?>
            <div class="col-sm-6 ">
                <div class="card z-depth-bottom-2">
                    <div class="card-block">
                        <div class="row b-b-default m-b-10 p-b-5">
                          <div class="col-sm-4 f-w-600">No Routing</div>         
                          <div class="col-sm-8">
                            <h3><?= $row['no_routing']?></h3>
                          </div>            
                        </div>
                        <div class="row b-b-default m-b-10 p-b-5">
                          <div class="col-sm-4 f-w-600">Project</div>
                          <div class="col-sm-8">
                            <?= $row['nama_project']?>
                          </div>
                        </div>
                        <div class="row b-b-default m-b-10 p-b-5">
                          <div class="col-sm-4 f-w-600">Tujuan</div>        
                          <div class="col-sm-8">
                            <h3 style="font-size: 12pt;"><?= $row['kota_penerima']?></h3>
                          </div>             
                        </div>
                        <div class="row b-b-default m-b-10 p-b-5">
                          <div class="col-sm-4 f-w-600">Armada</div>
                          <div class="col-sm-8">
                            <h3 style="font-size: 9pt;"><?= $row['armada']?></h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-4 f-w-600">Status</div>
                          <div class="col-sm-8">
                            <h3 style="font-size: 9pt;"><?= $row['status']?></h3>
                          </div>
                        </div>
                        <div class="row">
                            <a href="trace/view/<?= $row['id']?>" class="btn btn-block btn-inverse btn-round">Update Status</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
 
    </div>

    <?php endif ?>
</div>

