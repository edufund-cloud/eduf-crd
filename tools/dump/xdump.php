<?PHP
	require_once('../../config/session.php'); 
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'edufund_crd';
	$mysqldump=exec('which mysqldump');

	$command = "$mysqldump --opt -h $dbhost -u $dbuser -p $dbpass $dbname > $dbname.sql";
	exec($command);
?>