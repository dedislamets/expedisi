<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <? 
        foreach (menu() as $key => $value) { 
                echo '<div class="pcoded-navigatio-lavel">'. $key .'</div>';
                foreach ($value as $key_parent => $value_parent) { 
                    echo '  <ul class="pcoded-item pcoded-left-item">';
                    if(count($value_parent['child']) > 0){
                        if($value_parent['data'][0]['aktif'] > 0){
                            echo '<li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" >
                                        <span class="pcoded-micon"><i class="feather '. $value_parent['data'][0]['icon'] .'"></i></span>
                                        <span class="pcoded-mtext">'. $key_parent .'</span>
                                    </a>';

                                    echo '  <ul class="pcoded-submenu">';
                                    foreach ($value_parent['child'] as $key_child => $value_child) { 

                                        echo '      <li class=" ">
                                                        <a href="'. base_url(). $value_child['link'] .'">
                                                            <span class="pcoded-mtext">'. $value_child['menu'] .'</span>
                                                        </a>
                                                    </li>';
                                                    
                                    }
                                    echo '  </ul>';

                            echo '</li>';
                        }
                    }else{
                        if($value_parent['data'][0]['aktif'] > 0){
                            echo '  <li>
                                        <a href="'. ($value_parent['data'][0]['link'] == "/" ? base_url() : base_url() . $value_parent['data'][0]['link']) .'" >
                                            <span class="pcoded-micon"><i class="feather '. $value_parent['data'][0]['icon'] .'"></i></span>
                                            <span class="pcoded-mtext">'. $key_parent .'</span>
                                        </a>
                                        
                                    </li>';
                        }
                        
                    }
                }
                echo '</ul>';
         } ?>
    </div>
    <!-- <div class="pcoded-inner-navbar main-menu">
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
            <li class="">
                <a href="<?= base_url() ?>trace">
                    <span class="pcoded-micon"><i class="feather icon-navigation-2"></i></span>
                    <span class="pcoded-mtext">Trace & Tracking</span>
                </a>  
            </li>
        </ul>

        <div class="pcoded-navigatio-lavel">Finance</div>
        <ul class="pcoded-item pcoded-left-item">
         
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                    <span class="pcoded-mtext">Invoice Customer</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="<?= base_url() ?>invoice">
                            <span class="pcoded-mtext">Input Invoice</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>listinvoice">
                            <span class="pcoded-mtext">List Invoice</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-file-minus"></i></span>
                    <span class="pcoded-mtext">Invoice Vendor</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="<?= base_url() ?>invoicevendor">
                            <span class="pcoded-mtext">Input Invoice</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>listinvoicevendor">
                            <span class="pcoded-mtext">List Invoice</span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="">
                <a href="<?= base_url() ?>listoutstanding">
                    <span class="pcoded-micon"><i class="feather icon-edit"></i></span>
                    <span class="pcoded-mtext">Outstanding</span>
                </a>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                    <span class="pcoded-mtext">Payment</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="<?= base_url() ?>payment">
                            <span class="pcoded-mtext">Input Payment</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>listpayment">
                            <span class="pcoded-mtext">List Payment</span>
                        </a>
                    </li>
                    
                </ul>
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
                        <a href="<?= base_url() ?>users">
                            <span class="pcoded-mtext">Users</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>moda">
                            <span class="pcoded-mtext">Moda</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="<?= base_url() ?>role">
                            <span class="pcoded-mtext">Role</span>
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
        </ul>  
    </div> -->
    <!-- <div class="sidebar-background" style="background-image: url(assets/images/sidebar-1.jpg);"></div> -->
</nav>
