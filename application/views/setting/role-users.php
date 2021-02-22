<div class="row" id="app">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4><?= $title ?></h4>
                    <span>Halaman Utama ini menampilkan informasi Users</span>
                </div>
                <div class="col-xl-2">
                   
                </div>
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <div class="row">
                <div class="col-xl-3">
                    <div class="widget-box widget-color-blue2">
                        <div class="widget-header">
                            <h4 class="widget-title lighter smaller">Group User 
                            </h4>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-8">
                                <div class="col-sm-12" style="padding: 0" > 
                                    <input type="hidden" name="txtRecnumGroupUser" id="txtRecnumGroupUser" value="0" >
                                <?php 
                                foreach($group_role as $row)
                                { ?>
                                    <p>
                                        <button class="btn btn-out-dashed btn-inverse btn-square btn-block btnGroup" data-id="<?php echo $row->id ?>" ><?php echo $row->group ?></button>
                                    </p>
                                <?php }?>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="p-20 z-depth-0 waves-effect" > 
                        <div class="card-header" style="background-color: #404E67;color:#fff">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h4>User Terdaftar di {{ group_text }}</h4>
                                </div>
                                <div class="col-sm-2">
                                    <a href="javascrip:void(0)" class="btn btn-grd-success" id="btnAdd"><i class="icofont icofont-ui-add"></i> Tambah User</a>
                                </div>
                            </div>
                        </div>
                        <div class="dt-responsive table-responsive">
                            <table id="ViewTable" class="table table-striped">
                                <thead class="text-primary">
                                    <tr>
                                        <th>
                                          User Name
                                        </th>
                                        <th>
                                          Email
                                        </th>
                                        <th>
                                          Role
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
        </div>
    </div>
    
</div>
<?php
  $this->load->view($modal); 
?>
