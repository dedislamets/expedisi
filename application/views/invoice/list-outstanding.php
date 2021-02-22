<style type="text/css">
    .note-warning {
        padding: 5px;
        background-color: yellow;
        color: black;
        font-weight: bold;
    }
    .note-danger {
        padding: 5px;
        background-color: red;
        color: black;
        font-weight: bold;
    }
    thead {
        background: linear-gradient(to right, #3f535a, #212425);
        color: #fff !important;
    }
</style>
<div class="row">
    <div class="card z-depth-0">
        <div class="card-header" style="background-color: #404E67;color:#fff">
            <div class="row">
                <div class="col-xl-10">
                    <h4><?= $title ?></h4>
                    <span>Halaman ini menampilkan data invoice yang jatuh tempo</span>
                </div>
            </div>
        </div>
        <div class="card-block" style="padding-top: 10px;">
            <div>
              <h4 class="info-text" style="margin-top: 30px;">Filter
              </h4>
              <div class="card z-depth-0">
                <div class="card-header" style="padding: 10px 20px;">
                </div>
                <div class="card-block panels-wells">
                    <div class="form-group row m-b-0">
                        <label class="col-sm-2 col-form-label f-w-700">Pilih Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control">
                                <option value="0">Semua Status</option>
                                <option value="1">Hampir Jatuh Tempo</option>
                                <option value="2">Melewati Jatuh Tempo</option>
                                <option value="3">Jatuh Tempo</option>
                                <option value="4">Belum Jatuh Tempo</option>
                            </select>
                        </div>
                    </div>
                </div>
              </div>                        
            </div>
            <h4 class="info-text" style="margin-top: 30px;">Outstanding Customer</h4>
            <hr>
            <div class="dt-responsive table-responsive">
                <table id="ViewTable" class="table table-bordered">
                    <thead class="text-primary" style="color: #fff !important;">
                        <tr>
                            <th>
                              No Invoice
                            </th>
                            <th>
                              Routing
                            </th>
                            <th>
                              Due Date
                            </th>
                            <th>
                              Term
                            </th>
                            <th>
                              Age Days
                            </th>
                            <th>
                              Total
                            </th>
                            <th>
                              Status
                            </th>
                           
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
            <h4 class="info-text" style="margin-top: 30px;">Outstanding Vendor</h4>
            <hr>
            <div class="dt-responsive table-responsive">
                <table id="ViewTable2" class="table table-bordered">
                    <thead class="text-primary" style="color: #fff !important;">
                        <tr>
                            <th>
                              No Invoice
                            </th>
                            <th>
                              Routing
                            </th>
                            <th>
                              Due Date
                            </th>
                            <th>
                              Term
                            </th>
                            <th>
                              Age Days
                            </th>
                            <th>
                              Total
                            </th>
                            <th>
                              Status
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