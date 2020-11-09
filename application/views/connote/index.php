
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
                            <li><a href="#about" data-toggle="tab">Penerima</a></li>
                            <li><a href="#account" data-toggle="tab">Barang</a></li>
                            <li><a href="#address" data-toggle="tab">Layanan</a></li>
                        </ul>

                    </div>

                  <div class="tab-content">
                      <div class="tab-pane" id="about">
                        <div class="row">
                            <h4 class="info-text"> Informasi Penerima</h4>
                            <!-- <div class="col-sm-4 col-sm-offset-1">
                               <div class="picture-container">
                                    <div class="picture">
                                        <img src="assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                        <input type="file" id="wizard-picture">
                                    </div>
                                    <h6>Choose Picture</h6>
                                </div>
                            </div> -->
                            <div class="col-sm-10 col-sm-offset-1">
                                <div class="form-group">
                                  <label>Nama Penerima <small>(required)</small></label>
                                  <input name="nama_penerima" type="text" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label>Alamat Penerima <small>(required)</small></label>
                                  <textarea name="alamat" rows="4" class="form-control" placeholder=""> </textarea>
                                </div>
                                <div class="form-group">
                                  <label>Destinasi <small>(required)</small></label>
                                  <select class="js-example-basic-single col-sm-12">
                                      <option value="WY">Peter</option>
                                      <option value="WY">Hanry Die</option>
                                      <option value="WY">John Doe</option>
                                      <option value="AL">Alabama</option>
                                      <option value="WY">Wyoming</option>
                                      
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label>Zip Code <small>(required)</small></label>
                                    <input name="zip" type="text" class="form-control" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label>No Handphone <small>(required)</small></label>
                                  <input name="phone" type="text" class="form-control" placeholder="">
                                </div>
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
                              <div class="col-sm-12">
                                  <h4 class="info-text"> Are you living in a nice area? </h4>
                              </div>
                              <div class="col-sm-7 col-sm-offset-1">
                                   <div class="form-group">
                                      <label>Street Name</label>
                                      <input type="text" class="form-control" placeholder="5h Avenue">
                                    </div>
                              </div>
                              <div class="col-sm-3">
                                   <div class="form-group">
                                      <label>Street Number</label>
                                      <input type="text" class="form-control" placeholder="242">
                                    </div>
                              </div>
                              <div class="col-sm-5 col-sm-offset-1">
                                   <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control" placeholder="New York...">
                                    </div>
                              </div>
                              <div class="col-sm-5">
                                   <div class="form-group">
                                      <label>Country</label><br>
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

