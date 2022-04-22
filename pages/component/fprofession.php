<?PHP
  require_once("../../config/session.php");
  require_once("../../config/database.php");

  $sql_home = "SELECT gm.menu_file 
    FROM gen_menu_access gma 
    LEFT JOIN gen_menu gm ON gma.menu_id = gm.menu_id  
    WHERE gma.user_id = '$user_id' AND gm.menu_home = '1' AND gma.data_active = '1'";
    //echo $sql_home;
  $xsql_home = mysqli_query($koneksi,$sql_home);
  $arsql_home = mysqli_fetch_array($xsql_home);

  $Home_Url = $arsql_home['menu_file'];
  $Table_Url = "pages/analyst/tapply.php";  

  if (!empty($_GET['appid'])){
    $sql = "SELECT ap.profession_id,ap.pekerjaan,ap.bidang,ap.jabatan,ap.status,ap.lama_bekerja_tahun,ap.lama_bekerja_bulan,
      ap.penghasilan,ap.nama_kantor,ap.alamat,ap.telepon,ap.provinsi,ap.kota,ap.kecamatan,ap.kelurahan,ap.kode_pos 
      FROM apply_profession ap 
      WHERE ap.data_id = '$_GET[appid]'";
    $xsql = mysqli_query($koneksi,$sql);
    $arsql = mysqli_fetch_array($xsql);
  }
?>

<div class="tab-pane" id="pekerjaan">
  <!-- Start Form -->
  <div class="card-body">

    <div class="row">
      <div class="col-12 col-lg-8">
        
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtPekerjaan">Pekerjaan</label>
              <input list="encodings" value="<?PHP echo $arsql['pekerjaan']; ?>" id="txtPekerjaan" name="txtPekerjaan" 
                class="form-control" style="background-color: #F6F6F6;" disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtBidang">Bidang</label>
              <input type="text" value="<?PHP echo $arsql['bidang']; ?>" id="txtBidang" name="txtBidang" 
                class="form-control" style="background-color: #F6F6F6;" disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtJabatan">Jabatan</label>
              <input type="text" value="<?PHP echo $arsql['jabatan']; ?>" id="txtJabatan" name="txtJabatan" 
                class="form-control" style="background-color: #F6F6F6;" disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtStatusKerja">Status</label>
              <input type="text" class="form-control" id="txtStatusKerja" name="txtStatusKerja" 
                style="background-color: #F6F6F6;" 
                placeholder="Status bekerja" value="<?PHP echo $arsql['status']; ?>" 
                disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label for="txtLamaBekerjaTahun">Lama Bekerja (Tahun)</label>
              <input type="text" class="form-control" id="txtLamaBekerjaTahun" name="txtLamaBekerjaTahun" 
                style="background-color: #F6F6F6;" 
                placeholder="Tahun bekerja" value="<?PHP echo $arsql['lama_bekerja_tahun']; ?>" 
                disabled>
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
              <label for="txtLamaBekerjaBulan">(Bulan)</label>
              <input type="text" class="form-control" id="txtLamaBekerjaBulan" name="txtLamaBekerjaBulan" 
                style="background-color: #F6F6F6;" 
                placeholder="Bulan bekerja" value="<?PHP echo $arsql['lama_bekerja_bulan']; ?>" 
                disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <?PHP
                $Penghasilan = number_format($arsql['penghasilan'],0,',','.');
              ?>
              <label for="txtPenghasilan">Penghasilan per Bulan (Rp)</label>
              <input type="text" class="form-control" id="txtPenghasilan" name="txtPenghasilan" 
                style="background-color: #F6F6F6;" 
                placeholder="Penghasilan per bulan" value="<?PHP echo $Penghasilan; ?>" 
                disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtNamaKantor">Nama Kantor/Usaha</label>
              <input type="text" class="form-control" id="txtNamaKantor" name="txtNamaKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Nama kantor/usaha" value="<?PHP echo $arsql['nama_kantor']; ?>" 
                disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="txtAlamatKantor">Alamat Kantor/Usaha</label>
              <input type="text" class="form-control" id="txtAlamatKantor" name="txtAlamatKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Alamat kantor/usaha" value="<?PHP echo $arsql['alamat']; ?>" 
                disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtProvinsiKantor">Provinsi</label>
              <input type="text" class="form-control" id="txtProvinsiKantor" name="txtProvinsiKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Provinsi alamat kantor" value="<?PHP echo $arsql['provinsi']; ?>" 
                disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKotaKantor">Kota</label>
              <input type="text" class="form-control" id="txtKotaKantor" name="txtKotaKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kota tempat tinggal" value="<?PHP echo $arsql['kota']; ?>" 
                disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKecamatanKantor">Kecamatan</label>
              <input type="text" class="form-control" id="txtKecamatanKantor" name="txtKecamatanKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kecamatan alamat kantor" value="<?PHP echo $arsql['kecamatan']; ?>" 
                disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKelurahanKantor">Kelurahan</label>
              <input type="text" class="form-control" id="txtKelurahanKantor" name="txtKelurahanKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kelurahan alamat kantor" value="<?PHP echo $arsql['kelurahan']; ?>" 
                disabled>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtKodePosKantor">Kode Pos</label>
              <input type="text" class="form-control" id="txtKodePosKantor" name="txtKodePosKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Kode Pos kantor" value="<?PHP echo $arsql['kode_pos']; ?>" 
                disabled>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group">
              <label for="txtTeleponKantor">Nomor Telepon Kantor</label>
              <input type="text" class="form-control" id="txtTeleponKantor" name="txtTeleponKantor" 
                style="background-color: #F6F6F6;" 
                placeholder="Nomor telepon kantor" value="<?PHP echo $arsql['telepon']; ?>" 
                disabled>
            </div>
          </div>
        </div>

      </div>

      <?PHP include('fattachment.php'); ?>
    </div>
  </div>

  <div class="card-body" style="margin-top:-20px;">
    <div class="alert <?PHP echo $Alert_bg; ?> alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h6><i class="fa <?PHP echo $Alert_icon ?>"></i> <?PHP echo $Alert_head; ?></h6>
      <small><?PHP echo $Alert; ?></small>
    </div>
  </div>
  <!-- End Form -->

  <div class="modal-footer justify-content-between">
    <div class="spinner" style="display: none;" align="center">
      <img id="img-spinner" src="spiner.gif" style="width: 30px; height: 30px;" title="Process" >
    </div>
  </div>
</div>