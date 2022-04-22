<div class="row">          
  <div class="card col-sm-12 elevation-0">
    <div class="card-header bg-lightgray" style="margin-top:-12px;" data-card-widget="collapse">
      <h3 class="card-title font-weight-bold text-lightblue" style="cursor:pointer;">
        <i class="far fa-circle mr-1"></i>Pengajuan KTA
      </h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus text-lightblue"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
                    
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaTotalPembiayaan">Total Pembiayaan</label>
            <input type="text" class="form-control" id="txtKtaTotalPembiayaan" name="txtKtaTotalPembiayaan" 
              style="background-color: #F6F6F6;" 
              placeholder="Total pembiayaan" value="<?PHP echo $arsql['total_pembiayaan']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaTenor">Tenor per Bulan</label>
            <input type="text" class="form-control" id="txtKtaTenor" name="txtKtaTenor" 
              style="background-color: #F6F6F6;" 
              placeholder="Tenor pembiayaan" value="<?PHP echo $arsql['tenor']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaBiayaAdmin">Admin</label>
            <input type="text" class="form-control" id="txtKtaBiayaAdmin" name="txtKtaBiayaAdmin" 
              style="background-color: #F6F6F6;" 
              placeholder="Biaya Admin" value="<?PHP echo $arsql['biaya_admin']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaTotalPencairan">Total Pencairan</label>
            <input type="text" class="form-control" id="txtKtaTotalPencairan" name="txtKtaTotalPencairan" 
              style="background-color: #F6F6F6;" 
              placeholder="Tenor pembiayaan" value="<?PHP echo $arsql['total_pencairan']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaCicilan">Cicilan per Bulan</label>
            <input type="text" class="form-control" id="txtKtaCicilan" name="txtKtaCicilan" 
              style="background-color: #F6F6F6;" 
              placeholder="Tenor pembiayaan" value="<?PHP echo $arsql['cicilan_bulan']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaBankTujuan">Bank Rekening Tujuan</label>
            <input type="text" class="form-control" id="txtKtaBankTujuan" name="txtKtaBankTujuan" 
              style="background-color: #F6F6F6;" 
              placeholder="Bank rekening tujuan" value="<?PHP echo $arsql['bank_tujuan']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaNamaRekening">Nama Rekening Tujuan</label>
            <input type="text" class="form-control" id="txtKtaNamaRekening" name="txtKtaNamaRekening" 
              style="background-color: #F6F6F6;" 
              placeholder="Nama rekening tujuan" value="<?PHP echo $arsql['nama_rekening']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtKtaNoRekeningTujuan">Nomor Rekening Tujuan</label>
            <input type="text" class="form-control" id="txtKtaNoRekeningTujuan" name="txtKtaNoRekeningTujuan" 
              style="background-color: #F6F6F6;" 
              placeholder="Nomor rekening tujuan" value="<?PHP echo $arsql['nomor_rekening']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

    </div>            
  </div>
</div>