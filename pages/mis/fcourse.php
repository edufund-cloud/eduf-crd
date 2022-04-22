<div class="row">          
  <div class="card col-sm-12 elevation-0">
    <div class="card-header bg-lightgray" style="margin-top:-12px;" data-card-widget="collapse" >
      <h3 class="card-title font-weight-bold text-lightblue" style="cursor:pointer;">
        <i class="far fa-circle mr-1"></i>Pengajuan Program Kursus
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
            <label for="cmbPenyelenggara">Nama Penyelenggara</label>
            <input list="encodings" value="<?PHP echo $arsql['nama_penyelenggara']; ?>" 
              id="cmbPenyelenggara" name="cmbPenyelenggara" 
              class="form-control" style="background-color: #F6F6F6;" >
            <datalist id="encodings">
              <?PHP 
                $sql_data = "SELECT ac.nama_penyelenggara FROM apply_course ac  
                  GROUP BY ac.nama_penyelenggara ORDER BY ac.nama_penyelenggara ASC";
                $xsql_data = mysqli_query($koneksi,$sql_data);
                while($arsql_data = mysqli_fetch_array($xsql_data)){
                  ?>
                  <option value="<?PHP echo $arsql_data['nama_penyelenggara']; ?>">
                    <?PHP echo $arsql_data['nama_penyelenggara']; ?>
                  </option>
                  <?PHP
                }
              ?>
            </datalist>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="cmbProgram">Nama Program</label>
            <input list="encodings" value="<?PHP echo $arsql['nama_program']; ?>" 
              id="cmbProgram" name="cmbProgram" 
              class="form-control" style="background-color: #F6F6F6;" >
            <datalist id="encodings">
              <?PHP 
                $sql_data = "SELECT ac.nama_program FROM apply_course ac  
                  GROUP BY ac.nama_program ORDER BY ac.nama_program ASC";
                $xsql_data = mysqli_query($koneksi,$sql_data);
                while($arsql_data = mysqli_fetch_array($xsql_data)){
                  ?>
                  <option value="<?PHP echo $arsql_data['nama_program']; ?>">
                    <?PHP echo $arsql_data['nama_program']; ?>
                  </option>
                  <?PHP
                }
              ?>
            </datalist>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="txtAlamatPenyelenggara">Alamat Penyelenggara</label>
            <input type="text" value="<?PHP echo $arsql['alamat']; ?>" 
              id="txtAlamatPenyelenggara" name="txtAlamatPenyelenggara" placeholder="Alamat lengkap penyelenggara" 
              class="form-control" style="background-color: #F6F6F6;" >
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtTeleponPenyelenggara">Nomor Telepon</label>
            <input type="text" class="form-control" id="txtTeleponPenyelenggara" name="txtTeleponPenyelenggara" 
              style="background-color: #F6F6F6;" 
              placeholder="Nomor telepon penyelenggara" value="<?PHP echo $arsql['telepon']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtTanggalPembayaran">Tanggal Pembayaran</label>
            <input type="date" class="form-control" id="txtTanggalPembayaran" name="txtTanggalPembayaran" 
              style="background-color: #F6F6F6;" 
              placeholder="Tanggal pembayaran" value="<?PHP echo $arsql['tanggal_pembayaran']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtTotalPembiayaan">Total Pembiayaan</label>
            <input type="text" class="form-control" id="txtTotalPembiayaan" name="txtTotalPembiayaan" 
              style="background-color: #F6F6F6;" 
              placeholder="Total pembiayaan" value="<?PHP echo $arsql['total_pembiayaan']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtUangMuka">Uang Muka</label>
            <input type="text" class="form-control" id="txtUangMuka" name="txtUangMuka" 
              style="background-color: #F6F6F6;" 
              placeholder="Uang muka" value="<?PHP echo $arsql['uang_muka']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtTenor">Tenor per Bulan</label>
            <input type="text" class="form-control" id="txtTenor" name="txtTenor" 
              style="background-color: #F6F6F6;" 
              placeholder="Tenor pembiayaan" value="<?PHP echo $arsql['tenor']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtCicilanBulan">Cicilan per Bulan</label>
            <input type="text" class="form-control" id="txtCicilanBulan" name="txtCicilanBulan" 
              style="background-color: #F6F6F6;" 
              placeholder="Tenor pembiayaan" value="<?PHP echo $arsql['cicilan_bulan']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtBankTujuan">Bank Rekening Tujuan</label>
            <input type="text" class="form-control" id="txtBankTujuan" name="txtBankTujuan" 
              style="background-color: #F6F6F6;" 
              placeholder="Bank rekening tujuan" value="<?PHP echo $arsql['bank_tujuan']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtNamaRekening">Nama Rekening Tujuan</label>
            <input type="text" class="form-control" id="txtNamaRekening" name="txtNamaRekening" 
              style="background-color: #F6F6F6;" 
              placeholder="Nama rekening tujuan" value="<?PHP echo $arsql['nama_rekening']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label for="txtNomorRekening">Nomor Rekening</label>
            <input type="text" class="form-control" id="txtNomorRekening" name="txtNomorRekening" 
              style="background-color: #F6F6F6;" 
              placeholder="Nomor rekening tujuan" value="<?PHP echo $arsql['nomor_rekening']; ?>" 
              <?PHP echo $Disabled; ?>>
          </div>
        </div>
      </div>

    </div>            
  </div>
</div>