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
                'pic'  => $row[4],

                'tempat_lahir'  => $row[5],
                'tanggal_lahir'  => $row[6],
                'jenis_kelamin'  => $row[7],
                'status_perkawinan'  => $row[8],
                'agama'  => $row[9],
                'pendidikan_terakhir'  => $row[10],
                'nik'  => $row[11],
                'npwp'  => $row[12],
                'no_telepon'  => $row[13],
                'email'  => $row[14],                
                'nama_pasangan'  => $row[15],
                'tempat_lahir_pasangan'  => $row[16],
                'tanggal_lahir_pasangan'  => $row[17],
                'jenis_kelamin_pasangan'  => $row[18],
                'status_perkawinan_pasangan'  => $row[19],
                'agama_pasangan'  => $row[20],
                'pendidikan_terakhir_pasangan'  => $row[21],
                'nik_pasangan'  => $row[22],
                'npwp_pasangan'  => $row[23],
                'no_telepon_pasangan'  => $row[24],
                'email_pasangan'  => $row[25],

                'alamat'  => $row[26],
                'provinsi'  => $row[27],
                'kota'  => $row[28],
                'kecamatan'  => $row[29],
                'kelurahan'  => $row[30],
                'kode_pos'  => $row[31],
                'status_tempat_tinggal'  => $row[32],
                'lama_menempati_tahun'  => $row[33],
                'lama_menempati_bulan'  => $row[34],

                'pekerjaan'  => $row[35],
                'bidang'  => $row[36],
                'jabatan'  => $row[37],
                'status_pekerjaan'  => $row[38],
                'lama_bekerja_tahun'  => $row[39],
                'lama_bekerja_bulan'  => $row[40],
                'penghasilan'  => $row[41],
                'nama_kantor'  => $row[42],
                'alamat_kantor'  => $row[43],
                'telepon_kantor'  => $row[44],
                'provinsi_kantor'  => $row[45],
                'kota_kantor'  => $row[46],
                'kecamatan_kantor'  => $row[47],
                'kelurahan_kantor'  => $row[48],

                'nama_kontak'  => $row[49],
                'telepon_kontak'  => $row[50],
                'hubungan_kontak'  => $row[51],

                'total_pembiayaan'  => $row[52],
                'tenor'  => $row[53],
                'biaya_admin'  => $row[54],
                'total_pencairan'  => $row[55],
                'cicilan_per_bulan'  => $row[56],
                'bank_tujuan'  => $row[57],
                'nama_rekening'  => $row[58],
                'nomor_rekening'  => $row[59]
            );
        }
        $output = array(
            'column'  => $column,
            'row_data'  => $row_data
        );

        echo json_encode($output);

    }

?>