<?php

    //import.php
    require_once('../../../config/session.php');
    include_once("../../../config/database.php");
    if(isset($_POST["id_debitur"])){
        $sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
        $xsqldt = mysqli_fetch_row($sqldt);
        $now = $xsqldt[0];
        
        $id_debitur         = $_POST["id_debitur"];
        $nama_debitur       = $_POST["nama_debitur"];
        $apply_date         = $_POST["apply_date"];
        $product            = $_POST["product"];

        $tempat_lahir           = $_POST["tempat_lahir"];
        $tanggal_lahir          = $_POST["tanggal_lahir"];
        $jenis_kelamin          = $_POST["jenis_kelamin"];
        $status_perkawinan      = $_POST["status_perkawinan"];
        $agama                  = $_POST["agama"];
        $pendidikan_terakhir    = $_POST["pendidikan_terakhir"];
        $nik                    = $_POST["nik"];
        $npwp                   = $_POST["npwp"];
        $no_telepon             = $_POST["no_telepon"];
        $email                  = $_POST["email"];

        $nama_pasangan                  = $_POST["nama_pasangan"];
        $tempat_lahir_pasangan          = $_POST["tempat_lahir_pasangan"];
        $tanggal_lahir_pasangan         = $_POST["tanggal_lahir_pasangan"];
        $jenis_kelamin_pasangan         = $_POST["jenis_kelamin_pasangan"];
        $status_perkawinan_pasangan     = $_POST["status_perkawinan_pasangan"];
        $agama_pasangan                 = $_POST["agama_pasangan"];
        $pendidikan_terakhir_pasangan   = $_POST["pendidikan_terakhir_pasangan"];
        $nik_pasangan                   = $_POST["nik_pasangan"];
        $npwp_pasangan                  = $_POST["npwp_pasangan"];
        $no_telepon_pasangan            = $_POST["no_telepon_pasangan"];
        $email_pasangan                 = $_POST["email_pasangan"];

        $alamat                 = $_POST["alamat"];
        $provinsi               = $_POST["provinsi"];
        $kota                   = $_POST["kota"];
        $kecamatan              = $_POST["kecamatan"];
        $kelurahan              = $_POST["kelurahan"];
        $kode_pos               = $_POST["kode_pos"];
        $status_tempat_tinggal  = $_POST["status_tempat_tinggal"];
        $lama_menempati_tahun   = $_POST["lama_menempati_tahun"];
        $lama_menempati_bulan   = $_POST["lama_menempati_bulan"];

        $pekerjaan          = $_POST["pekerjaan"];
        $bidang             = $_POST["bidang"];
        $jabatan            = $_POST["jabatan"];
        $status_pekerjaan   = $_POST["status_pekerjaan"];
        $lama_bekerja_tahun = $_POST["lama_bekerja_tahun"];
        $lama_bekerja_bulan = $_POST["lama_bekerja_bulan"];
        $penghasilan        = $_POST["penghasilan"];
        $nama_kantor        = $_POST["nama_kantor"];
        $alamat_kantor      = $_POST["alamat_kantor"];
        $telepon_kantor     = $_POST["telepon_kantor"];
        $provinsi_kantor    = $_POST["provinsi_kantor"];
        $kota_kantor        = $_POST["kota_kantor"];
        $kecamatan_kantor   = $_POST["kecamatan_kantor"];
        $kelurahan_kantor   = $_POST["kelurahan_kantor"];

        $nama_kontak        = $_POST["nama_kontak"];
        $telepon_kontak     = $_POST["telepon_kontak"];
        $hubungan_kontak    = $_POST["hubungan_kontak"];
        
        $total_pembiayaan       = $_POST["total_pembiayaan"];
        $tenor                  = $_POST["tenor"];
        $uang_muka              = $_POST["uang_muka"];
        $cicilan_per_bulan      = $_POST["cicilan_per_bulan"];

        $total_pencairan        = $POST["total_pencairan"];

        $bank_tujuan            = $_POST["bank_tujuan"];
        $nama_rekening          = $_POST["nama_rekening"];
        $nomor_rekening         = $_POST["nomor_rekening"];

        $nama_penyelenggara     = $_POST["nama_penyelenggara"];
        $nama_program           = $_POST["nama_program"];
        $alamat_penyelenggara   = $_POST["alamat_penyelenggara"];
        $telepon_penyelenggara  = $_POST["telepon_penyelenggara"];
        $tanggal_pembayaran     = $_POST["tanggal_pembayaran"];

        $lampiran_ktp           = $_POST["lampiran_ktp"];
        $lampiran_npwp          = $_POST["lampiran_npwp"];
        $lampiran_gaji          = $_POST["lampiran_gaji"];
        $lampiran_kk            = $_POST["lampiran_kk"];
        $lampiran_ktp_pasangan  = $_POST["lampiran_ktp_pasangan"];
                
                
        for($count = 0; $count < count($id_debitur); $count++){

            $pic_name = $user_firstname.' '.$user_lastname;

            //Data Apply
            if (!empty($apply_date[$count])){
                $txt_apply_date = $apply_date[$count];
            }
            else{
                $txt_apply_date = '0000-00-00';
            }

            $sql = "INSERT INTO apply(ID, full_name, apply_date, 
                product, pic, data_status, 
                data_active, data_create, user_create, data_update, user_update) VALUES 
                ('$id_debitur[$count]', '$nama_debitur[$count]', '$txt_apply_date', 
                '$product[$count]', '$pic_name', 'New Loan',
                '1', '$now', '$user_id', '$now', '$user_id')";
            if(mysqli_query($koneksi, $sql)){
                $new_data_id = mysqli_insert_id($koneksi);                

                //Data Personal
                if (!empty($tanggal_lahir[$count])){
                    $txt_tanggal_lahir = $tanggal_lahir[$count];
                }
                else{
                    $txt_tanggal_lahir = '0000-00-00';
                }

                if (!empty($tanggal_lahir_pasangan[$count])){
                    $txt_tanggal_lahir_pasangan = $tanggal_lahir_pasangan[$count];
                }
                else{
                    $txt_tanggal_lahir_pasangan = '0000-00-00';
                }

                $sql_deb = "INSERT INTO apply_personal(data_id, tempat_lahir, tanggal_lahir, 
                    jenis_kelamin, status_perkawinan,
                    agama, pendidikan_terakhir, nik, npwp, 
                    no_telepon, email, nama_pasangan,
                    tempat_lahir_pasangan, tanggal_lahir_pasangan, 
                    agama_pasangan, jenis_kelamin_pasangan,
                    pendidikan_terakhir_pasangan, status_perkawinan_pasangan, 
                    nik_pasangan, npwp_pasangan,
                    no_telepon_pasangan, email_pasangan) VALUES 
                    ('$new_data_id', '$tempat_lahir[$count]', '$txt_tanggal_lahir', 
                    '$jenis_kelamin[$count]', '$status_perkawinan[$count]',
                    '$agama[$count]', '$pendidikan_terakhir[$count]', '$nik[$count]', '$npwp[$count]', 
                    '$no_telepon[$count]', '$email[$count]', '$nama_pasangan[$count]',
                    '$tempat_lahir_pasangan[$count]', '$txt_tanggal_lahir_pasangan', 
                    '$agama_pasangan[$count]', '$jenis_kelamin_pasangan[$count]',
                    '$pendidikan_terakhir_pasangan[$count]', '$status_perkawinan_pasangan[$count]', 
                    '$nik_pasangan[$count]', '$npwp_pasangan[$count]', 
                    '$no_telepon_pasangan[$count]', '$email_pasangan[$count]')";
                $xsql_deb = mysqli_query($koneksi, $sql_deb);
                
                //Data Address
                $sql_adr = "INSERT INTO apply_address(data_id, alamat, provinsi, kota, 
                    kecamatan, kelurahan, kode_pos, status_tinggal, 
                    lama_tinggal_tahun, lama_tinggal_bulan) VALUES 
                    ('$new_data_id', '$alamat[$count]', '$provinsi[$count]', '$kota[$count]', 
                    '$kecamatan[$count]', '$kelurahan[$count]', '$kode_pos[$count]', '$status_tempat_tinggal[$count]', 
                    '$lama_menempati_tahun[$count]', '$lama_menempati_bulan[$count]')";
                $xsql_adr = mysqli_query($koneksi, $sql_adr);
                
                //Data Pekerjaan
                if (!empty($penghasilan[$count])){
                    $txt_penghasilan = $penghasilan[$count];
                }
                else{
                    $txt_penghasilan = 0;
                }

                $sql_wrk = "INSERT INTO apply_profession(data_id, pekerjaan, bidang, jabatan, 
                    status, lama_bekerja_tahun, lama_bekerja_bulan, 
                    penghasilan, nama_kantor, 
                    alamat, telepon, provinsi, kota, 
                    kecamatan, kelurahan) VALUES 
                    ('$new_data_id', '$pekerjaan[$count]', '$bidang[$count]', '$jabatan[$count]', 
                    '$status_pekerjaan[$count]', '$lama_bekerja_tahun[$count]', '$lama_bekerja_bulan[$count]', 
                    '$txt_penghasilan', '$nama_kantor[$count]', 
                    '$alamat_kantor[$count]', '$telepon_kantor[$count]', '$provinsi_kantor[$count]', 
                    '$kota_kantor[$count]', '$kecamatan_kantor[$count]', '$kelurahan_kantor[$count]')";
                $xsql_wrk = mysqli_query($koneksi, $sql_wrk);

                //Data Kontak Darurat
                $sql_kon = "INSERT INTO apply_emergency(data_id, nama_lengkap, nomor_telepon, hubungan) VALUES 
                    ('$new_data_id', '$nama_kontak[$count]', '$telepon_kontak[$count]', '$hubungan_kontak[$count]')";
                $xsql_kon = mysqli_query($koneksi, $sql_kon);

                //Data Pengajuan
                if ($product[$count] == "Uang Kursus"){
                    if (!empty($tanggal_pembayaran[$count])){
                        $txt_tanggal_pembayaran = $tanggal_pembayaran[$count];
                    }
                    else{
                        $txt_tanggal_pembayaran = '0000-00-00';
                    }

                    if (!empty($total_pembiayaan[$count])){
                        $txt_total_pembiayaan = $total_pembiayaan[$count];
                    }
                    else{
                        $txt_total_pembiayaan = 0;
                    }

                    if (!empty($uang_muka[$count])){
                        $txt_uang_muka = $uang_muka[$count];
                    }
                    else{
                        $txt_uang_muka = 0;
                    }

                    if (!empty($cicilan_per_bulan[$count])){
                        $txt_cicilan_bulan = $cicilan_per_bulan[$count];
                    }
                    else{
                        $txt_cicilan_bulan = 0;
                    }

                    $sql_crs = "INSERT INTO apply_course(data_id, nama_penyelenggara, nama_program, 
                        alamat, telepon, 
                        tanggal_pembayaran, total_pembiayaan, uang_muka, 
                        tenor, cicilan_bulan, bank_tujuan, nama_rekening, nomor_rekening) VALUES 
                        ('$new_data_id', '$nama_penyelenggara[$count]', '$nama_program[$count]', 
                        '$alamat_penyelenggara[$count]', '$telepon_penyelenggara[$count]', 
                        '$txt_tanggal_pembayaran', '$txt_total_pembiayaan', '$txt_uang_muka', 
                        '$tenor[$count]', '$txt_cicilan_bulan', 
                        '$bank_tujuan[$count]', '$nama_rekening[$count]', '$nomor_rekening[$count]')";
                    $xsql_crs = mysqli_query($koneksi, $sql_crs);
                }
                else if ($product[$count] == "Kredit Tanpa Agunan"){
                    if (!empty($total_pembiayaan[$count])){
                        $txt_total_pembiayaan = $total_pembiayaan[$count];
                    }
                    else{
                        $txt_total_pembiayaan = 0;
                    }

                    if (!empty($uang_muka[$count])){
                        $txt_biaya_admin = $uang_muka[$count];
                    }
                    else{
                        $txt_biaya_admin = 0;
                    }

                    if (!empty($total_pencairan[$count])){
                        $txt_total_pencairan = $total_pencairan[$count];
                    }
                    else{
                        $txt_total_pencairan = 0;
                    }

                    if (!empty($cicilan_per_bulan[$count])){
                        $txt_cicilan_bulan = $cicilan_per_bulan[$count];
                    }
                    else{
                        $txt_cicilan_bulan = 0;
                    }

                    $sql_kta = "INSERT INTO apply_kta(data_id, total_pembiayaan, tenor, biaya_admin,
                        total_pencairan,cicilan_bulan,bank_tujuan,
                        nama_rekening,nomor_rekening) VALUES 
                        ('$new_data_id', '$txt_total_pembiayaan', '$tenor[$count]', '$txt_biaya_admin',
                        '$txt_total_pencairan', '$txt_cicilan_bulan', '$bank_tujuan[$count]',
                        '$nama_rekening[$count]', '$nomor_rekening[$count]')";
                    $xsql_kta = mysqli_query($koneksi, $sql_kta);
                }

                //Data Lampiran                
                if ($lampiran_ktp[$count] != ""){
                    $sql_atc_1 = "INSERT INTO apply_attach(data_id,description,attach_url,data_update,user_update) VALUES 
                        ('$new_data_id','KTP','$lampiran_ktp[$count]','$now','$user_id')";
                    $xsql_atc_1 = mysqli_query($koneksi, $sql_atc_1);
                }                
                if ($lampiran_npwp[$count] != ""){
                    $sql_atc_2 = "INSERT INTO apply_attach(data_id,description,attach_url,data_update,user_update) VALUES 
                        ('$new_data_id','NPWP','$lampiran_npwp[$count]','$now','$user_id')";
                    $xsql_atc_2 = mysqli_query($koneksi, $sql_atc_2);
                }                
                if ($lampiran_gaji[$count] != ""){
                    $sql_atc_3 = "INSERT INTO apply_attach(data_id,description,attach_url,data_update,user_update) VALUES 
                        ('$new_data_id','Slip Gaji','$lampiran_gaji[$count]','$now','$user_id')";
                    $xsql_atc_3 = mysqli_query($koneksi, $sql_atc_3);
                }
                if ($lampiran_kk[$count] != ""){
                    $sql_atc_4 = "INSERT INTO apply_attach(data_id,description,attach_url,data_update,user_update) VALUES 
                        ('$new_data_id','KK','$lampiran_kk[$count]','$now','$user_id')";
                    $xsql_atc_4 = mysqli_query($koneksi, $sql_atc_4);
                }
                if ($lampiran_ktp_pasangan[$count] != ""){
                    $sql_atc_5 = "INSERT INTO apply_attach(data_id,description,attach_url,data_update,user_update) VALUES 
                        ('$new_data_id','KTP Pasangan','$lampiran_ktp_pasangan[$count]','$now','$user_id')";
                    $xsql_atc_5 = mysqli_query($koneksi, $sql_atc_5);
                }
            }
        }
        //$statement = $connect->prepare($query);
        //$statement->execute();
    }

?>