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
        $pic                = $_POST["pic"];

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

        $total_pembiayaan   = $_POST["total_pembiayaan"];
        $tenor              = $_POST["tenor"];
        $biaya_admin        = $_POST["biaya_admin"];
        $total_pencairan    = $_POST["total_pencairan"];
        $cicilan_per_bulan  = $_POST["cicilan_per_bulan"];
        $bank_tujuan        = $_POST["bank_tujuan"];
        $nama_rekening      = $_POST["nama_rekening"];
        $nomor_rekening     = $_POST["nomor_rekening"];
        
        for($count = 0; $count < count($id_debitur); $count++){
            $sql = "
                INSERT INTO apply(ID, full_name, apply_date, 
                    product, pic, data_status, 
                    data_active, data_create, user_create, data_update, user_update) 
                VALUES (
                    '".$id_debitur[$count]."', '".$nama_debitur[$count]."', '".$apply_date[$count]."',
                    '".$product[$count]."', '".$pic[$count]."', 'Borrower',
                    '1', '$now', '$user_id', '$now', '$user_id'
                );
            ";
            if(mysqli_query($koneksi, $sql)){
                $new_data_id = mysqli_insert_id($koneksi);

                //Data Personal                
                $sql_deb = "INSERT INTO apply_personal(data_id, tempat_lahir, tanggal_lahir, 
                    jenis_kelamin, status_perkawinan,
                    agama, pendidikan_terakhir, nik, npwp, 
                    no_telepon, email, nama_pasangan,
                    tempat_lahir_pasangan, tanggal_lahir_pasangan, 
                    agama_pasangan, jenis_kelamin_pasangan,
                    pendidikan_terakhir_pasangan, status_perkawinan_pasangan, 
                    nik_pasangan, npwp_pasangan,
                    no_telepon_pasangan, email_pasangan) VALUES 
                    ('$new_data_id', '$tempat_lahir[$count]', '$tanggal_lahir[$count]', 
                    '$jenis_kelamin[$count]', '$status_perkawinan[$count]',
                    '$agama[$count]', '$pendidikan_terakhir[$count]', '$nik[$count]', '$npwp[$count]', 
                    '$no_telepon[$count]', '$email[$count]', '$nama_pasangan[$count]',
                    '$tempat_lahir_pasangan[$count]', '$tanggal_lahir_pasangan[$count]', 
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
                    '$lama_tinggal_tahun[$count]', '$lama_tinggal_bulan[$count]')";
                $xsql_adr = mysqli_query($koneksi, $sql_adr);

                //Data Pekerjaan
                $sql_wrk = "INSERT INTO apply_profession(data_id, pekerjaan, bidang, jabatan, 
                    status, lama_bekerja_tahun, lama_bekerja_bulan, 
                    penghasilan, nama_kantor, 
                    alamat, telepon, provinsi, kota, 
                    kecamatan, kelurahan) VALUES 
                    ('$new_data_id', '$pekerjaan[$count]', '$bidang[$count]', '$jabatan[$count]', 
                    '$status_pekerjaan[$count]', '$lama_bekerja_tahun[$count]', '$lama_bekerja_bulan[$count]', 
                    '$penghasilan[$count]', '$nama_kantor[$count]', 
                    '$alamat_kantor[$count]', '$telepon_kantor[$count]', '$provinsi_kantor[$count]', 
                    '$kota_kantor[$count]', '$kecamatan_kantor[$count]', '$kelurahan_kantor[$count]')";
                $xsql_wrk = mysqli_query($koneksi, $sql_wrk);

                //Data Kontak Darurat
                $sql_kon = "INSERT INTO apply_emergency(data_id, nama_lengkap, nomor_telepon, hubungan) VALUES 
                    ('$new_data_id', '$nama_kontak[$count]', '$telepon_kontak[$count]', '$hubungan_kontak[$count]')";
                $xsql_kon = mysqli_query($koneksi, $sql_kon);

                //Data Pengajuan KTA
                $sql_crd = "INSERT INTO apply_kta(data_id, total_pembiayaan, tenor, 
                    biaya_admin, total_pencairan, cicilan_bulan, 
                    bank_tujuan, nama_rekening, nomor_rekening) VALUES 
                    ('$new_data_id', '$total_pembiayaan[$count]', '$tenor[$count]', 
                    '$biaya_admin[$count]', '$total_pencairan[$count]', '$cicilan_per_bulan[$count]', 
                    '$bank_tujuan[$count]', '$nama_rekening[$count]', '$nomor_rekening[$count]')";
                $xsql_crd = mysqli_query($koneksi, $sql_crd);
            }
        }
        //$statement = $connect->prepare($query);
        //$statement->execute();
    }

?>