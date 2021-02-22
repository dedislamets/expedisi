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
                        <label class="col-sm-1 col-form-label f-w-700">Pilih Type</label>
                        <div class="col-sm-3">
                            <select name="status" id="status" class="form-control">
                                <option value="">Semua</option>
                                <option value="Customer">Customer</option>
                                <option value="Vendor">Vendor</option>
                               
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label f-w-700">Tanggal</label>
                        <div class="col-sm-3">
                            <input class="form-control form-bg-inverse" type="date" id="tanggal" name="tanggal"  />
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-inverse btn-block btn-round" id="btnCari"><i class="icofont icofont-search"></i> Cari</button>
                        </div>
                        <div class="col-sm-2">
                            <a href="payment" class="btn btn-success btn-block btn-round"><i class="icofont icofont-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
              </div>                        
            </div>
            <div class="dt-responsive table-responsive">
                <table id="ViewTable" class="table table-bordered">
                    <thead class="text-primary" style="color: #fff !important;">
                        <tr>
                            <th>
                              No Payment
                            </th>
                            <th>
                              Tanggal
                            </th>
                            <th>
                              No Invoice
                            </th>
                            <th>
                              Type 
                            </th>
                            <th>
                              Metode Payment
                            </th>
                            <th>
                              Total
                            </th>
                            <th>
                              DiBayar
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