<?php
    //fetch.php
    if(!empty($_FILES['csv_file']['name'])){
        $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
        $column = fgetcsv($file_data);
        while($row = fgetcsv($file_data)){
            $row_data[] = array(
                'id_debitur'  => $row[10],
                'nik'  => $row[44],
                'nama_debitur'  => $row[39],
                'apply_date'  => $row[30],
                'product'  => $row[13],
                'total_pembiayaan'  => $row[17], 
                'tempat_lahir'  => $row[40],                
                'jenis_kelamin'  => $row[41],
                'status_perkawinan'  => $row[47],                
                'pendidikan_terakhir'  => $row[42],
                'no_telepon'  => $row[3],
                'email'  => $row[2],
                'nama_pasangan'  => $row[48],
                'tempat_lahir_pasangan'  => $row[49],                
                'jenis_kelamin_pasangan'  => $row[50],
                'status_perkawinan_pasangan'  => $row[56],                
                'pendidikan_terakhir_pasangan'  => $row[51],
                'nik_pasangan'  => $row[53],                
                'domisili' => $row[66],
                'domisili_no' => $row[67],
                'domisili_rt' => $row[68],
                'domisili_rw' => $row[69],
                'domisili_kelurahan' => $row[70],
                'domisili_kecamatan' => $row[71],
                'domisili_kota' => $row[72],
                'domisili_provinsi' => $row[73],
                'domisili_zipcode' => $row[74],                
                'status_tempat_tinggal'  => $row[75],
                'lama_menempati_hari'  => $row[76],
                'pekerjaan'  => $row[77],
                'bidang'  => $row[78],
                'jabatan'  => $row[79],                
                'lama_bekerja_hari'  => $row[80],
                'penghasilan'  => $row[81],
                'nama_kantor'  => $row[86],
                'alamat_kantor' => $row[87],
                'alamat_kantor_kelurahan' => $row[88],
                'alamat_kantor_kecamatan' => $row[89],
                'alamat_kantor_kota' => $row[90],
                'alamat_kantor_provinsi' => $row[91],
                'telepon_kantor'  => $row[93],
                'nama_kontak_darurat'  => $row[94],
                'telepon_kontak_darurat'  => $row[95],
                'hubungan_kontak_darurat'  => $row[96],
                'tenor'  => $row[21],
                'uang_muka'  => $row[18],
                'cicilan_per_bulan'  => $row[20],
                'total_pencairan'  => $row[19],
                'bank_tujuan'  => $row[23],
                'nama_rekening'  => $row[25],
                'nomor_rekening'  => $row[24],
                'nama_penyelenggara'  => $row[14],
                'nama_program'  => $row[15],
                'alamat_penyelenggara'  => $row[60],
                'telepon_penyelenggara'  => $row[61],
                'tanggal_pembayaran_awal'  => $row[35],
                'tanggal_pembayaran_akhir' => $row[36],                
                'lampiran_ktp'      => $row[45],
                'lampiran_selfie'   => $row[46],
                'lampiran_npwp'     => $row[82],
                'lampiran_gaji'     => $row[65],
                'lampiran_ktp_pasangan'   => $row[54],
                'lampiran_selfie_pasangan' => $row[55]
            );
        }
        $output = array(
            'column'  => $column,
            'row_data'  => $row_data
        );

        echo json_encode($output);

    }

?>