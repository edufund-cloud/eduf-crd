<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('../../plugins/PHPMailer-master/src/Exception.php');
include('../../plugins/PHPMailer-master/src/PHPMailer.php');
include('../../plugins/PHPMailer-master/src/SMTP.php');

$sql_host = "SELECT go.ID,go.option_name,go.option_value,go.autoload 
	FROM gen_options go 
	WHERE go.option_category = 'admin_email' OR go.option_category = 'global'"; 
$xsql_host = mysqli_query($koneksi,$sql_host);
while($arsql_host = mysqli_fetch_array($xsql_host)){
	$option_name = $arsql_host['option_name'];
	switch ($option_name) {
	  case 'host_name':
	    $host_name = $arsql_host['option_value'];
	  break;
	  
	  case 'host_smtp':
	    $host_smtp = $arsql_host['option_value'];
	  break;

	  case 'port_smtp':
	    $port_smtp = $arsql_host['option_value'];
	  break;

	  case 'admin_email':
	    $exp_admin_email = explode("||", $arsql_host['option_value']);
	    $admin_email = $exp_admin_email[0];
	    $admin_email_pass = $exp_admin_email[1];
	  break;

	  case 'email_notes':
	    $email_notes = $arsql_host['option_value'];
	  break;

	  case 'site_title':
	    $site_title = $arsql_host['option_value'];
	  break;

	  case 'site_url':
	    $site_url = $arsql_host['option_value'];
	  break;
	}
}

$Host_SMTP 		= $host_smtp;
$Host_Port		= $port_smtp;
$Host_Account	= $admin_email;
$Host_Sys_Pass	= $admin_email_pass;
$Host_From		= $site_title;

$Site_Title		= $site_title;
$Site_Logo		= '';
$Site_Direct	= $site_url;

$mail = new PHPMailer;
$mail->isSMTP();

$mail->Host         = $Host_SMTP;
$mail->Username     = $Host_Account; // User GMAIL
$mail->Password     = $Host_Sys_Pass; // Password GMAIL
$mail->Port         = $Host_Port;
$mail->SMTPAuth     = true;
$mail->SMTPSecure   = 'ssl';
//$mail->SMTPAutoTLS 	= false;
//$mail->Hostname 	= 'localhost';
//$mail->SMTPDebug = 2; // untuk debug

$mail_from  = $Host_Account; // Email pengirim
$from_name  = $Host_From; // Nama pengirim
$mail_to    = $txtEmail; // Email penerima
$to_name    = $txtEmail; // Nama penerima
$subject    = 'Reset Password User - '.$Host_From; // Judul Email

$capture_data .= '<table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">';

$capture_data .= '<tr>';
$capture_data .= '<td>';
$capture_data .= '<img width="220" border="0" style="display: block; width: 220px;" src="'.$Site_Logo.'" alt="" />';
$capture_data .= '</td>';
$capture_data .= '</tr>';

$capture_data .= '<tr>';
$capture_data .= '<td style="font-size:22px;">';
$capture_data .= 'Konfirmasi Reset Password User';
$capture_data .= '</td>';
$capture_data .= '</tr>';

$capture_data .= '<tr>';
$capture_data .= '<td style="font-size:14px;">';
$capture_data .= 'Password anda telah direset oleh ';
$capture_data .= '<strong>'.$Host_From.'</strong>,<br> '; 
$capture_data .= 'Berikut adalah password user sementara anda, silahkan login Back dan ubah password setelahnya.';
$capture_data .= '</td>';
$capture_data .= '</tr>';

$capture_data .= '<tr>';
$capture_data .= '<td style="font-size:14px;">';
$capture_data .= '<br>'; 
$capture_data .= '<div style="border:solid; border-radius:15px; width:180px; border-width: thin; background-color: grey; color: #ffffff; padding-top: 15px; padding-bottom: 15px; font-size:18px; font-weight: bold;" align="center">';
$capture_data .= $SysPass_Ori.'</div><br>';
$capture_data .= 'atau klik link berikut : <br>';
$capture_data .= '<small>'.$Site_Direct.'</small><br>';
$capture_data .= 'Untuk keamanan jangan bagikan user/password anda kepada orang lain.';
$capture_data .= '</td>';
$capture_data .= '</tr>';

$capture_data .= '</table>';

$message    = $capture_data;

$mail->setFrom($mail_from, $from_name);
$mail->addAddress($mail_to, $to_name);
$mail->isHTML(true); // untuk format html

// Menambahkan cc atau bcc 
//$mail->addCC('email_si_cc@emailnya.com');
//$mail->addBCC('email_si_bcc@emailnya.com');

$mail->Subject  = $subject;
$mail->Body     = $message;

$send = $mail->send();

if($send){ // Email berhasil dikirim
    $Send = ', 1 (satu) Konfirmasi telah dikirim';
}else{ // Email gagal dikirim
    $Send = 0;
}
?>