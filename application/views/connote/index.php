
<div class="row">
    <div class="col-xl-10 col-sm-offset-1">
        <div class="wizard-container">

            <div class="card wizard-card" data-color="red" id="wizardProfile">
                <form action="" method="">
                    <div class="wizard-header">
                        <h3>
                           <b style="font-weight: bold;">Connote</b> Entry <br>
                           <small>Halaman untuk memasukkan data Connote </small>
                        </h3>
                    </div>

                    <div class="wizard-navigation">
                        <ul>
                            <li style="border-right: 1px solid #fff;"><a href="#about" data-toggle="tab">Moda</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#pengirim" data-toggle="tab">Pengirim</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#penerima" data-toggle="tab">Penerima</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#account" data-toggle="tab">Barang</a></li>
                            <li style="border-right: 1px solid #fff;"><a href="#address" data-toggle="tab">Layanan</a></li>
                            <li><a href="#preview" data-toggle="tab">Preview</a></li>
                        </ul>

                    </div>

                  <div class="tab-content">
                      <div class="tab-pane" id="about">
                        <div class="row">
                            <h4 class="info-text">Pilih Moda & Tujuan</h4>
                            <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 10px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="row">
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Destinasi </label>
                                      <select class="js-example-basic-single col-sm-12">
                                          <option value="WY">Peter</option>
                                          <option value="WY">Hanry Die</option>
                                          <option value="WY">John Doe</option>
                                          <option value="AL">Alabama</option>
                                          <option value="WY">Wyoming</option>
                                          
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label>Tujuan </label>
                                      <select class="js-example-basic-single col-sm-12">
                                          <option value="WY">Peter</option>
                                          <option value="WY">Hanry Die</option>
                                          <option value="WY">John Doe</option>
                                          <option value="AL">Alabama</option>
                                          <option value="WY">Wyoming</option>
                                          
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Moda </label>
                                      <select class="js-example-basic-single col-sm-12">
                                          <option value="WY">Peter</option>
                                          <option value="WY">Hanry Die</option>
                                          <option value="WY">John Doe</option>
                                          <option value="AL">Alabama</option>
                                          <option value="WY">Wyoming</option>
                                          
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          
                        </div>
                      </div>
                      <div class="tab-pane" id="pengirim">
                          <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 10px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Asal</label>
                                    <div class="col-sm-10">
                                        <input name="origin1" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tujuan</label>
                                    <div class="col-sm-10">
                                        <input name="destinasi1" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Moda</label>
                                    <div class="col-sm-10">
                                        <input name="moda1" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                              
                              </div>
                          </div>
                          <hr style="width: 81%;border-top: 2px dotted rgba(0,0,0,.3);">
                          <h4 class="info-text"> Informasi Pengirim</h4>
                          <div class="col-sm-10 col-sm-offset-1">
                              <div class="form-group">
                                <label>Nama Pengirim <small>(required)</small></label>
                                <input name="nama_pengirim" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>Alamat Pengirim <small>(required)</small></label>
                                <textarea name="alamat_pengirim" rows="4" class="form-control" placeholder="" style="height: 100px;"> </textarea>
                              </div>
                              <div class="form-group">
                                <label>Origin </label>
                                <select class="js-example-basic-single col-sm-12" disabled="">
                                    <option value="WY">Peter</option>
                                    <option value="WY">Hanry Die</option>
                                    <option value="WY">John Doe</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    
                                </select>
                              </div>
                              <div class="form-group">
                                  <label>Zip Code <small>(required)</small></label>
                                  <input name="zip_pengirim" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>No Handphone <small>(required)</small></label>
                                <input name="phone_pengirim" type="text" class="form-control" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="penerima">
                          <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 10px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Asal</label>
                                    <div class="col-sm-10">
                                        <input name="origin2" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tujuan</label>
                                    <div class="col-sm-10">
                                        <input name="destinasi2" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Moda</label>
                                    <div class="col-sm-10">
                                        <input name="moda2" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                              
                              </div>
                          </div>
                          <hr style="width: 81%;border-top: 2px dotted rgba(0,0,0,.3);">
                          <h4 class="info-text"> Informasi Penerima</h4>
                          <div class="col-sm-10 col-sm-offset-1">
                              <div class="form-group">
                                <label>Nama Penerima <small>(required)</small></label>
                                <input name="nama_penerima" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>Alamat Penerima <small>(required)</small></label>
                                <textarea name="alamat_penerima" rows="4" class="form-control" placeholder="" style="height: 100px;"> </textarea>
                              </div>
                              <div class="form-group">
                                <label>Destinasi </label>
                                <select class="js-example-basic-single col-sm-12" disabled="">
                                    <option value="WY">Peter</option>
                                    <option value="WY">Hanry Die</option>
                                    <option value="WY">John Doe</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                    
                                </select>
                              </div>
                              <div class="form-group">
                                  <label>Zip Code <small>(required)</small></label>
                                  <input name="zip_penerima" type="text" class="form-control" placeholder="">
                              </div>
                              <div class="form-group">
                                <label>No Handphone <small>(required)</small></label>
                                <input name="phone_penerima" type="text" class="form-control" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="account">
                          <h4 class="info-text"> What are you doing? (checkboxes) </h4>
                          <div class="row">

                              <div class="col-sm-10 col-sm-offset-1">
                                <div class="row">
                                      <div class="col-sm-4">
                                          <div class="choice" data-toggle="wizard-checkbox">
                                              <input type="checkbox" name="jobb" value="Design">
                                              <div class="icon">
                                                  <i class="fa fa-pencil"></i>
                                              </div>
                                              <h6>Design</h6>
                                          </div>
                                      </div>
                                      <div class="col-sm-4">
                                          <div class="choice" data-toggle="wizard-checkbox">
                                              <input type="checkbox" name="jobb" value="Code">
                                              <div class="icon">
                                                  <i class="fa fa-terminal"></i>
                                              </div>
                                              <h6>Code</h6>
                                          </div>

                                      </div>
                                      <div class="col-sm-4">
                                          <div class="choice" data-toggle="wizard-checkbox">
                                              <input type="checkbox" name="jobb" value="Develop">
                                              <div class="icon">
                                                  <i class="fa fa-laptop"></i>
                                              </div>
                                              <h6>Develop</h6>
                                          </div>

                                      </div>
                                </div>
                              </div>

                          </div>
                      </div>
                      <div class="tab-pane" id="address">
                          <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                              <div style="padding: 10px;background-color: #404E67;color:#fff;width: 100%;border-radius: 10px;margin-bottom: 35px;">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Asal</label>
                                    <div class="col-sm-10">
                                        <input name="origin3" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Tujuan</label>
                                    <div class="col-sm-10">
                                        <input name="destinasi3" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Moda</label>
                                    <div class="col-sm-10">
                                        <input name="moda3" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                              
                              </div>
                          </div>
                          <hr style="width: 81%;border-top: 2px dotted rgba(0,0,0,.3);">
                              <div class="col-sm-12">
                                  <h4 class="info-text"> Pilih layanan yang diinginkan </h4>
                              </div>
                            
                              <div class="col-sm-10 col-sm-offset-1">
                                   <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Paket</label>
                                      <div class="col-sm-10">
                                        <select name="country" class="form-control">
                                            <option value="Afghanistan"> Afghanistan </option>
                                            <option value="Albania"> Albania </option>
                                            <option value="Algeria"> Algeria </option>
                                            <option value="American Samoa"> American Samoa </option>
                                            <option value="Andorra"> Andorra </option>
                                            <option value="Angola"> Angola </option>
                                            <option value="Anguilla"> Anguilla </option>
                                            <option value="Antarctica"> Antarctica </option>
                                            <option value="...">...</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Estimasi</label>
                                      <div class="col-sm-10">
                                          <input name="estimasi" type="text" class="form-control" disabled="">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">Biaya</label>
                                      <div class="col-sm-10">
                                          <input name="biaya" type="text" class="form-control" disabled="">
                                      </div>
                                    </div>
                              </div>
                          </div>
                      </div>
                      <div class="tab-pane" id="preview">
                        <div class="row">
                          <div class="col-sm-10 col-sm-offset-1" style="border: 1px dotted;border-radius: 10px;padding: 10px;">
                            <div class="row">
                              <div class="col-sm-6" style="border-right: 2px dotted;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                          <div class="col-sm-4">
                                            <img style="height: 38px;margin-top: 10px;" src="assets\images\logo.png" >
                                          </div>
                                          <div class="col-sm-8">
                                            <div>Wilayah Pusat</div>
                                            <div>Jl. Raya Kalimalang KM 108, Bekasi</div>
                                            <div>Telp. 08656787878</div>
                                          </div>
                                        </div>
                                        <hr style="width: 100%;border-top: 2px dotted rgba(0,0,0,.3);">
                                        <div class="row" style="margin-bottom: 10px;">
                                          <div class="col-sm-3">
                                            <div>Pengirim:</div>
                                          </div>
                                          <div class="col-sm-9">
                                            <div>Dedi Slamet</div>
                                            <div>Perum Graha Prima Blok ID NO 111. Bekasi</div>
                                            <div>Telp. 08656787878</div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <div>Penerima:</div>
                                          </div>
                                          <div class="col-sm-9">
                                            <div>Dedi Slamet</div>
                                            <div>Perum Graha Prima Blok ID NO 111. Bekasi</div>
                                            <div>Telp. 08656787878</div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="row">
                                  <div class="col-sm-12"><img src="<? echo $barcode; ?>" class="img-fluid" style="width: 100%"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="wizard-footer height-wizard">
                      <div class="pull-right">
                          <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
                          <input type='button' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />

                      </div>

                      <div class="pull-left">
                          <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                      </div>
                      <div class="clearfix"></div>
                  </div>

                </form>
            </div>
        </div> <!-- wizard container -->
    </div>
</div>

