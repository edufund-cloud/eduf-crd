<?php

    //fetch.php

    if(!empty($_FILES['csv_file']['name'])){
        $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
        $column = fgetcsv($file_data);
        while($row = fgetcsv($file_data)){
            $row_data[] = array(
                'id_debitur'  => $row[0],
                'nama_debitur'  => $row[1],
                'apply_date'  => $row[2],
                'product'  => $row[3],                
                'tempat_lahir'  => $row[4],
                'tanggal_lahir'  => $row[5],
                'jenis_kelamin'  => $row[6],
                'status_perkawinan'  => $row[7],
                'agama'  => $row[8],
                'pendidikan_terakhir'  => $row[9],
                'nik'  => $row[10],
                'npwp'  => $row[11],
                'no_telepon'  => $row[12],
                'email'  => $row[13],                
                'nama_pasangan'  => $row[14],
                'tempat_lahir_pasangan'  => $row[15],
                'tanggal_lahir_pasangan'  => $row[16],
                'jenis_kelamin_pasangan'  => $row[17],
                'status_perkawinan_pasangan'  => $row[18],
                'agama_pasangan'  => $row[19],
                'pendidikan_terakhir_pasangan'  => $row[20],
                'nik_pasangan'  => $row[21],
                'npwp_pasangan'  => $row[22],
                'no_telepon_pasangan'  => $row[23],
                'email_pasangan'  => $row[24],
                'alamat'  => $row[25],
                'provinsi'  => $row[26],
                'kota'  => $row[27],
                'kecamatan'  => $row[28],
                'kelurahan'  => $row[29],
                'kode_pos'  => $row[30],
                'status_tempat_tinggal'  => $row[31],
                'lama_menempati_tahun'  => $row[32],
                'lama_menempati_bulan'  => $row[33],
                'pekerjaan'  => $row[34],
                'bidang'  => $row[35],
                'jabatan'  => $row[36],
                'status_pekerjaan'  => $row[37],
                'lama_bekerja_tahun'  => $row[38],
                'lama_bekerja_bulan'  => $row[39],
                'penghasilan'  => $row[40],
                'nama_kantor'  => $row[41],
                'alamat_kantor'  => $row[42],
                'telepon_kantor'  => $row[43],
                'provinsi_kantor'  => $row[44],
                'kota_kantor'  => $row[45],
                'kecamatan_kantor'  => $row[46],
                'kelurahan_kantor'  => $row[47],
                'nama_kontak'  => $row[48],
                'telepon_kontak'  => $row[49],
                'hubungan_kontak'  => $row[50],
                
                'total_pembiayaan'  => $row[51],
                'tenor'  => $row[52],
                'uang_muka'  => $row[53],
                'cicilan_per_bulan'  => $row[54],
                'total_pencairan'  => $row[55],
                'bank_tujuan'  => $row[56],
                'nama_rekening'  => $row[57],
                'nomor_rekening'  => $row[58],
                'nama_penyelenggara'  => $row[59],
                'nama_program'  => $row[60],
                'alamat_penyelenggara'  => $row[61],
                'telepon_penyelenggara'  => $row[62],
                'tanggal_pembayaran'  => $row[63],
                
                'lampiran_ktp'  => $row[64],
                'lampiran_npwp' => $row[65],
                'lampiran_gaji' => $row[66],
                'lampiran_kk'   => $row[67],
                'lampiran_ktp_pasangan'   => $row[68]
            );
        }
        $output = array(
            'column'  => $column,
            'row_data'  => $row_data
        );

        echo json_encode($output);

    }

?>