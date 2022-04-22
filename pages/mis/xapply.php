<?PHP 
	require_once('../../config/session.php'); 
	include_once("../../config/database.php");
	$sqldt = mysqli_query($koneksi,"SELECT now() AS tanggal");
	$xsqldt = mysqli_fetch_row($sqldt);
	$now = $xsqldt[0];

	$sql_grp = "SELECT gg.description AS group_name 
		FROM gen_users gu 
		LEFT JOIN gen_group gg ON gu.group_id = gg.group_id 
		WHERE gu.user_id = '$user_id'";
	$xsql_grp = mysqli_query($koneksi,$sql_grp);
	$arsql_grp = mysqli_fetch_array($xsql_grp);
	$group_name = $arsql_grp['description'];
	
	if ($_GET['act']=="add") {
		extract($_POST);
		if(!empty($txtID)){		
			$sql = "INSERT INTO apply(ID,apply_date,product,pic,data_status,
				data_active,data_create,user_create,data_update,user_update) VALUES
				('$txtID','$txtApplyDate','$cmbProduct','$txtPic','Borrower',
				'1','$now','$user_id','$now','$user_id')";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)){
				$new_data_id = mysqli_insert_id($koneksi);

				//Data Personal
				$sql_deb = "INSERT INTO apply_personal(data_id, tempat_lahir, tanggal_lahir, jenis_kelamin, status_perkawinan,
					agama, pendidikan_terakhir, nik, npwp, no_telepon, email, nama_pasangan,
					tempat_lahir_pasangan, tanggal_lahir_pasangan, agama_pasangan, jenis_kelamin_pasangan,
					pendidikan_terakhir_pasangan, status_perkawinan_pasangan, nik_pasangan, npwp_pasangan,
					no_telepon_pasangan, email_pasangan) VALUES 
					('$new_data_id', '$txtBornPlace', '$txtBornDate', '$cmbGender', '$cmbMartial',
					'$cmbReligion', '$cmbGraduate', '$txtNIK', '$txtNPWP', '$txtPhone', '$txtEmail', '$txtMartialName',
					'$txtMartialBornPlace', '$txtMartialBornDate', '$cmbMartialReligion', '$cmbMartialGender',
					'$cmbMartialGraduate', '$cmbMartialStatus', '$txtMartialNIK', '$txtMartialNPWP', 
					'$txtMartialPhone', '$txtMartialEmail')";
				$xsql_deb = mysqli_query($koneksi, $sql_deb);

				//Data Address
				$sql_adr = "INSERT INTO apply_address(data_id, alamat, provinsi, kota, kecamatan, kelurahan, 
					kode_pos, status_tinggal, lama_tinggal_tahun, lama_tinggal_bulan) VALUES 
					('$new_data_id', '$txtAlamat', '$txtProvinsi', '$txtKota', '$txtKecamatan', '$txtKelurahan', 
					'$txtKodePos', '$cmbStatusTinggal', '$txtLamaTinggalTahun', '$txtLamaTinggalBulan')";
				$xsql_adr = mysqli_query($koneksi, $sql_adr);

				//Data Pekerjaan
				$sql_wrk = "INSERT INTO apply_profession(data_id, pekerjaan, bidang, jabatan, status, 
					lama_bekerja_tahun, lama_bekerja_bulan, penghasilan, nama_kantor, 
					alamat, telepon, provinsi, kota, 
					kecamatan, kelurahan, kode_pos) VALUES 
					('$new_data_id', '$cmbPekerjaan', '$cmbBidang', '$cmbJabatan', '$cmbStatusKerja', 
					'$txtLamaBekerjaTahun', '$txtLamaBekerjaBulan', '$txtPenghasilan', '$txtNamaKantor', 
					'$txtAlamatKantor', '$txtTeleponKantor', '$txtProvinsiKantor', '$txtKotaKantor', 
					'$txtKecamatanKantor', '$txtKelurahanKantor', '$txtKodePosKantor')";
				$xsql_wrk = mysqli_query($koneksi, $sql_wrk);

				//Data Kontak Darurat
				$sql_kon = "INSERT INTO apply_emergency(data_id, nama_lengkap, nomor_telepon, hubungan) VALUES 
					('$new_data_id', '$txtNamaKontak', '$txtTeleponKontak', '$cmbHubunganKontak')";
				$xsql_kon = mysqli_query($koneksi, $sql_kon);

				//Data Pengajuan
				if ($cmbProduct == "Course Program"){
					$sql_crd = "INSERT INTO apply_course(data_id, nama_penyelenggara, nama_program, alamat, 
						telepon, tanggal_pembayaran, total_pembiayaan, uang_muka, 
						tenor, cicilan_bulan, bank_tujuan, nama_rekening, nomor_rekening) VALUES 
						('$new_data_id', '$cmbPenyelenggara', '$cmbProgram', '$txtAlamatPenyelenggara', 
						'$txtTeleponPenyelenggara', '$txtTanggalPembayaran', '$txtTotalPembiayaan', '$txtUangMuka', 
						'$txtTenor', '$txtCicilanBulan', '$txtBankTujuan', '$txtNamaRekening', '$txtNomorRekening')";
					$xsql_crd = mysqli_query($koneksi, $sql_crd);
				}
				else if ($cmbProduct == "KTA"){
					$sql_crd = "INSERT INTO apply_kta(data_id, total_pembiayaan, tenor, biaya_admin, 
						total_pencairan, cicilan_bulan, 
						bank_tujuan, nama_rekening, nomor_rekening) VALUES 
						('$new_data_id', '$txtKtaTotalPembiayaan', '$txtKtaTenor', '$txtKtaBiayaAdmin', 
						'$txtKtaTotalPencairan', '$txtKtaCicilan', 
						'$txtKtaBankTujuan', '$txtKtaNamaRekening', '$txtKtaNoRekeningTujuan')";
					$xsql_crd = mysqli_query($koneksi, $sql_crd);
				}


				$modul = 'Data Apply';
				$action = 'Add';
				//include("../../api/logs/xlogs.php");
				echo 'Success, Data has been added, ';
			}
			else{
				echo 'Failed Add Data';
			}
		}
		else{
			echo 'Please complete the data';
		}
	}
	else if ($_GET['act'] == "edt") {
		extract($_POST);
		if(!empty($txtID) && !empty($_GET['appid'])){			
			$sql ="UPDATE apply SET
				ID 			= '$txtID',
				apply_date 	= '$txtApplyDate',
				product 	= '$cmbProduct',
				pic 		= '$txtPic',
				data_update = '$now',
				user_update = '$user_id' 
				WHERE data_id = '$_GET[appid]'
			";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) {
				//Data Personal
				$sql_deb = "UPDATE apply_personal SET 
					tempat_lahir 				= '$txtBornPlace', 
					tanggal_lahir 				= '$txtBornDate', 
					jenis_kelamin 				= '$cmbGender', 
					status_perkawinan 			= '$cmbMartial',
					agama 						= '$cmbReligion', 
					pendidikan_terakhir 		= '$cmbGraduate', 
					nik 						= '$txtNIK', 
					npwp 						= '$txtNPWP', 
					no_telepon 					= '$txtPhone', 
					email 						= '$txtEmail', 
					nama_pasangan 				= '$txtMartialName',
					tempat_lahir_pasangan 		= '$txtMartialBornPlace', 
					tanggal_lahir_pasangan 		= '$txtMartialBornDate', 
					agama_pasangan 				= '$cmbMartialReligion', 
					jenis_kelamin_pasangan 		= '$cmbMartialGender',
					pendidikan_terakhir_pasangan = '$cmbMartialGraduate', 
					status_perkawinan_pasangan 	= '$cmbMartialStatus', 
					nik_pasangan 				= '$txtMartialNIK', 
					npwp_pasangan 				= '$txtMartialNPWP',
					no_telepon_pasangan 		= '$txtMartialPhone', 
					email_pasangan 				= '$txtMartialEmail'
					WHERE data_id = '$_GET[appid]'
				";
				$xsql_deb = mysqli_query($koneksi, $sql_deb);

				//Data Address
				$sql_adr = "UPDATE apply_address SET 
					alamat 				= '$txtAlamat', 
					provinsi 			= '$txtProvinsi', 
					kota 				= '$txtKota', 
					kecamatan 			= '$txtKecamatan', 
					kelurahan 			= '$txtKelurahan', 
					kode_pos 			= '$txtKodePos', 
					status_tinggal 		= '$cmbStatusTinggal', 
					lama_tinggal_tahun 	= '$txtLamaTinggalTahun', 
					lama_tinggal_bulan 	= '$txtLamaTinggalBulan'
					WHERE data_id = '$_GET[appid]'
				";
				$xsql_adr = mysqli_query($koneksi, $sql_adr);

				//Data Pekerjaan
				$sql_wrk = "UPDATE apply_profession SET 
					pekerjaan 			= '$cmbPekerjaan', 
					bidang  			= '$cmbBidang', 
					jabatan 			= '$cmbJabatan', 
					status 				= '$cmbStatusKerja', 
					lama_bekerja_tahun	= '$txtLamaBekerjaTahun', 
					lama_bekerja_bulan	= '$txtLamaBekerjaBulan', 
					penghasilan			= '$txtPenghasilan', 
					nama_kantor			= '$txtNamaKantor', 
					alamat 				= '$txtAlamatKantor', 
					telepon 			= '$txtTeleponKantor', 
					provinsi 			= '$txtProvinsiKantor', 
					kota 				= '$txtKotaKantor', 
					kecamatan 			= '$txtKecamatanKantor', 
					kelurahan 			= '$txtKelurahanKantor', 
					kode_pos 			= '$txtKodePosKantor' 
					WHERE data_id = '$_GET[appid]'
				";
				$xsql_wrk = mysqli_query($koneksi, $sql_wrk);

				//Data Kontak Darurat
				$sql_kon = "UPDATE apply_emergency SET 
					nama_lengkap 	= '$txtNamaKontak',  
					nomor_telepon 	= '$txtTeleponKontak',  
					hubungan 		= '$cmbHubunganKontak' 
					WHERE data_id 	= '$_GET[appid]'
				";
				$xsql_kon = mysqli_query($koneksi, $sql_kon);

				//Data Pengajuan
				if ($cmbProduct == "Course Program"){
					$sql_crd = "UPDATE apply_course SET 
						nama_penyelenggara 	= '$cmbPenyelenggara', 
						nama_program 		= '$cmbProgram', 
						alamat 				= '$txtAlamatPenyelenggara', 
						telepon 			= '$txtTeleponPenyelenggara', 
						tanggal_pembayaran 	= '$txtTanggalPembayaran', 
						total_pembiayaan 	= '$txtTotalPembiayaan', 
						uang_muka 			= '$txtUangMuka', 
						tenor 				= '$txtTenor', 
						cicilan_bulan 		= '$txtCicilanBulan', 
						bank_tujuan 		= '$txtBankTujuan', 
						nama_rekening 		= '$txtNamaRekening', 
						nomor_rekening 		= '$txtNomorRekening' 
						WHERE data_id 		= '$_GET[appid]'
					";
					$xsql_crd = mysqli_query($koneksi, $sql_crd);
				}
				else if ($cmbProduct == "KTA"){
					$sql_crd = "UPDATE apply_kta SET 
						total_pembiayaan	= '$txtKtaTotalPembiayaan', 
						tenor 				= '$txtKtaTenor', 
						biaya_admin 		= '$txtKtaBiayaAdmin', 
						total_pencairan 	= '$txtKtaTotalPencairan', 
						cicilan_bulan 		= '$txtKtaCicilan', 
						bank_tujuan 		= '$txtKtaBankTujuan', 
						nama_rekening 		= '$txtKtaNamaRekening', 
						nomor_rekening 		= '$txtKtaNoRekeningTujuan' 
						WHERE data_id 		= '$_GET[appid]'
					";
					$xsql_crd = mysqli_query($koneksi, $sql_crd);
				}

				//Data Note
				$note_status = "Update Data";
				$user_note_group = "$user_group_name";
				$sql_note = "INSERT INTO apply_note(data_id,status,note,data_update,user_update,user_group) VALUES 
					('$_GET[appid]','$note_status','$txtNote','$now','$user_id','$user_note_group')";
				$xsql_note = mysqli_query($koneksi, $sql_note);

				$modul = 'Data Apply';
				$action = 'Edit';
				//include("../../api/logs/xlogs.php");
				echo 'Success, Data has been updated';
			}
			else {
				echo 'Failed update data';
			}
		}
		else echo 'Please complete the data';
	}
	else if ($_GET['act'] == "delusr") {
		extract($_POST);
		if(!empty($_GET['appid'])){			
			$sql = "DELETE FROM apply 
				WHERE data_id = '$_GET[appid]'";
			//echo"$sql";
			if(mysqli_query($koneksi, $sql)) { 
				//Data Personal
				$sql = "DELETE FROM apply_personal 
					WHERE data_id = '$_GET[appid]'";
				$xsql = mysqli_query($koneksi, $sql);

				//Data Address
				$sql = "DELETE FROM apply_address 
					WHERE data_id = '$_GET[appid]'";
				$xsql = mysqli_query($koneksi, $sql);

				//Data Pekerjaan
				$sql = "DELETE FROM apply_profession 
					WHERE data_id = '$_GET[appid]'";
				$xsql = mysqli_query($koneksi, $sql);

				//Data Kontak Darurat
				$sql = "DELETE FROM apply_emergency 
					WHERE data_id = '$_GET[appid]'";
				$xsql = mysqli_query($koneksi, $sql);

				//Data Pengajuan
				if ($cmbProduct == "Course Program"){
					$sql = "DELETE FROM apply_course 
						WHERE data_id = '$_GET[appid]'";
					$xsql = mysqli_query($koneksi, $sql);
				}
				else if ($cmbProduct == "KTA"){
					$sql = "DELETE FROM apply_kta 
						WHERE data_id = '$_GET[appid]'";
					$xsql = mysqli_query($koneksi, $sql);
				}				

				//Data Note
				$sql = "DELETE FROM apply_note 
					WHERE data_id = '$_GET[appid]'";
				$xsql = mysqli_query($koneksi, $sql);

				$modul = 'Data Apply';
				$action = 'Delete';
				//include("../../api/logs/xlogs.php");
				echo 'Success, Data has been deleted';
			}
			else {
				echo 'Failed delete data';
			}
		}
		else echo 'Please complete the data';
	}

	else{
		echo 'Operation not found';
	}
?>