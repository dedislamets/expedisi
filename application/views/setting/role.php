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
                <div class="col-xl-6">
                    <div class="p-20 z-depth-0 waves-effect" > 
                        <div class="row">
                            <div class="col-xl-6">
                                <button class="btn btn-out-dashed btn-inverse btn-square btn-block" id="btnMenu" >Group {{ group_text }}</button> 
                                <input type="hidden" id="txtRecnumGroup" name="txtRecnumGroup" :value="group_id">
                                <div class="card">
                                    <div class="card-header" style="padding: 15px 20px;">
                                      <h5>Pilih Menu</h5>
                                    </div>
                                    <div class="card-block">
                                      <div class="card-block tree-view p-t-0">
                                        Search : <input type="text" name="search_field" id="search_field" value="" />  
                                        <div id="basicTree">
                                          
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-xl-6">
                                <h5>Menu Terpilih</h5> 
                                <hr>
                                <template v-for="menus in menu_selected">
                                    <button class="btn btn-mini btn-inverse btn-square btn-block btnMenuPilih" :data-id="menus.id_group_menu"  @click="loadPermission(menus.id_group_menu, menus.menu)" >{{ menus.menu }}</button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3">
                    <div class="p-20 z-depth-0 waves-effect" >  
                        <button class="btn btn-out-dashed btn-inverse btn-square btn-block" >Menu {{ menu_text }}</button> 
                        <div class="control-group p-l-10" id="panel-access-menu" >
                            <label class="control-label bolder blue f-w-700 p-t-10">Permission</label>
                            <input type="hidden" id="txtRecnumMenu" name="txtRecnumMenu" :value="menu_id">
                            <div v-if="permission.permit==1">
                                <div class="checkbox">
                                    <label class="block">
                                        <input name="form-field-checkbox" type="checkbox" class="ace ace-checkbox-2" id="chkPrint" :checked="permission.print=='0' ? false:true" @change="checkedChange($event)">
                                        <span class="lbl"> Cetak / Print</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace ace-checkbox-2" id="chkInput" :checked="permission.create=='0' ? false:true"  @change="checkedChange($event)">
                                        <span class="lbl"> Input / Create</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" type="checkbox" class="ace ace-checkbox-2" id="chkEdit" :checked="permission.edit=='0' ? false:true"  @change="checkedChange($event)">
                                        <span class="lbl"> Edit / Update</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="form-field-checkbox" class="ace ace-checkbox-2" type="checkbox" id="chkDelete" :checked="permission.delete=='0' ? false:true"  @change="checkedChange($event)">
                                        <span class="lbl"> Delete</span>
                                    </label>
                                </div>
                            </div>
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
