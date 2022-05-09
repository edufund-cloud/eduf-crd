<?PHP
	require_once("../config/session.php");
  	require_once("../config/database.php");
	// Fetch records from database 
	$sql = "SELECT a.data_id,a.ID,a.full_name,DATE_FORMAT(a.apply_date,'%d %M %Y') AS apply_date,
        a.product,a.pic,a.data_status, ap.nik,ap.email,ap.no_telepon 
        FROM apply a 
        LEFT JOIN apply_personal ap ON a.data_id = ap.data_id 
        WHERE a.data_status = 'Approved' AND a.data_update BETWEEN '$_GET[start_date]' AND '$_GET[end_date]' 
        ORDER BY a.apply_date,a.data_update ASC";
    //echo $sql;
    $xsql = mysqli_query($koneksi, $sql);
    $nmsql = mysqli_num_rows($xsql);
 
	if($nmsql > 0){ 
	    $delimiter = ","; 
	    $filename = "approved_data_" . date('Y-m-d') . ".csv"; 
	     
	    // Create a file pointer 
	    $f = fopen('php://memory', 'w'); 
	     
	    // Set column headers 
	    $fields = array('ID', 'NIK', 'NAMA LENGKAP', 'EMAIL', 'TELEPON', 'APPLY DATE', 'PRODUCT', 'STATUS', 'TOTAL PEMBIAYAAN', 'TENOR', 'BIAYA ADMIN', 'TOTAL PENCAIRAN', 'NAMA BANK', 'NOMOR REKENING', 'NAMA REKENING'); 
	    fputcsv($f, $fields, $delimiter); 
	     
	    // Output each row of the data, format line as csv and write to file pointer 
	    while($arsql = mysqli_fetch_array($xsql)){
	        if ($arsql["product"] == "Kredit Tanpa Agunan"){
	          $sql_loan = "SELECT ak.total_pembiayaan,ak.tenor,ak.biaya_admin,ak.total_pencairan,
	            ak.bank_tujuan,ak.nama_rekening,ak.nomor_rekening  
	            FROM apply_kta ak 
	            WHERE ak.data_id = '$arsql[data_id]'";
	        }
	        else{
	          $sql_loan = "SELECT ac.total_pembiayaan,ac.tenor,ac.uang_muka AS biaya_admin,
	            ac.bank_tujuan,ac.nama_rekening,ac.nomor_rekening  
	            FROM apply_course ac 
	            WHERE ac.data_id = '$arsql[data_id]'";          
	        }
	        //echo $sql_loan;
	        $xsql_loan = mysqli_query($koneksi, $sql_loan);
	        $arsql_loan = mysqli_fetch_array($xsql_loan);

	        $lineData = array($arsql['ID'], $arsql['nik'], $arsql['full_name'], $arsql['email'], $arsql['no_telepon'], $arsql['apply_date'], $arsql['product'], $arsql['data_status'], $arsql_loan['total_pembiayaan'], $arsql_loan['tenor'], $arsql_loan['biaya_admin'], $arsql_loan['total_pencairan'], $arsql_loan['bank_tujuan'], $arsql_loan['nomor_rekening'], $arsql_loan['nama_rekening']);

	        fputcsv($f, $lineData, $delimiter); 
	    } 
	     
	    // Move back to beginning of file 
	    fseek($f, 0); 
	     
	    // Set headers to download file rather than displayed 
	    header('Content-Type: text/csv'); 
	    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
	     
	    //output all remaining data on a file pointer 
	    fpassthru($f); 
	} 
?>