<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="<?= base_url() ?>">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
                
            </li>
         
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">DO</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="<?= base_url() ?>spk">
                            <span class="pcoded-mtext">Input SPK/DO</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>listspk">
                            <span class="pcoded-mtext">List SPK/DO</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Routing Slip</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="<?= base_url() ?>cargo">
                            <span class="pcoded-mtext">Input Routing</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>listrs">
                            <span class="pcoded-mtext">List Routing</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <!-- <li class="">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                    <span class="pcoded-mtext">Tarif</span>
                </a>  
            </li> -->
            <li class="">
                <a href="<?= base_url() ?>trace">
                    <span class="pcoded-micon"><i class="feather icon-navigation-2"></i></span>
                    <span class="pcoded-mtext">Trace & Tracking</span>
                </a>  
            </li>
        </ul>

        <div class="pcoded-navigatio-lavel">Setup</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                    <span class="pcoded-mtext">Master</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="<?= base_url() ?>customer">
                            <span class="pcoded-mtext">Vendor</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>barang">
                            <span class="pcoded-mtext">Barang</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="form-elements-add-on.htm">
                            <span class="pcoded-mtext">Kota & Kecamatan</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>tarif">
                            <span class="pcoded-mtext">Tarif</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="form-validation.htm">
                            <span class="pcoded-mtext">Karyawan</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>cabang">
                            <span class="pcoded-mtext">Cabang</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>moda">
                            <span class="pcoded-mtext">Moda</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="form-validation.htm">
                            <span class="pcoded-mtext">Role</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-upload"></i></span>
                    <span class="pcoded-mtext">Import Data</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class=" ">
                        <a href="<?= base_url() ?>Import">
                            <span class="pcoded-mtext">Kota & Kecamatan</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Others</div>
        <ul class="pcoded-item pcoded-left-item">
         
            <li class=" ">
                <a href="<?= base_url() ?>login/keluar">
                    <span class="pcoded-micon"><i class="icofont icofont-logout"></i></span>
                    <span class="pcoded-mtext">Logout</span>
                </a>
            </li>
            <!-- <li class="">
                <a href="editable-table.htm">
                    <span class="pcoded-micon"><i class="feather icon-edit"></i></span>
                    <span class="pcoded-mtext">Editable Table</span>
                </a>
            </li> -->
        </ul>
        
    </div>
    <!-- <div class="sidebar-background" style="background-image: url(assets/images/sidebar-1.jpg);"></div> -->
</nav>