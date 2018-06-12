<?php
session_start();
$Person="niemand";
$User=$_POST['User'];
require("einstellungen.php");
 $Verbindung = mysql_connect($ip, $myname, $geheim);
if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysql_error());
 }
 if (!mysql_select_db('db2924x2659170')) {
    die('Konnte Schema nicht selektieren: ' . mysql_error());
 }

$SQLString = "SELECT email_einsatz, Passwort FROM Gliederung WHERE email_einsatz=\"".$User."\"";
$Ergebnis=mysql_query($SQLString, $Verbindung);
$Zeilen=mysql_num_rows($Ergebnis);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
       "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>DLRG Bayern Apps</title>
</head>
<body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<h1>Passwort zusenden</h1>
<p>

<?php


 if ($Zeilen>0) 
 {	
  $Person="Einsatz"; 
  $passwort=mysql_result($Ergebnis,0,1);
  $email=mysql_result($Ergebnis,0,0); 
 } else
	  
 {
	$SQLString = "SELECT email_vorsitz, Passwort2 FROM Gliederung WHERE email_vorsitz=\"".$User."\"";
    $Ergebnis=mysql_query($SQLString, $Verbindung);
    $Zeilen2=mysql_num_rows($Ergebnis);
	if ($Zeilen2>0) 
	{
		$Person="Vorsitz";
		$passwort=mysql_result($Ergebnis,0,1);
        $email=mysql_result($Ergebnis,0,0); 
	} 
		
}


if (($Person == "Einsatz") or $Person=="Vorsitz")
{
  
  $nachricht="Vielen Dank für die Anforderung Ihres Passwortes für die DLRG LV Bayern Apps. \ Ihr Passowort lautet:\"".$passwort;
  $nachricht=$nachricht."\" \ Bei fragen wenden Sie sich bitte an manuel.friedrich@bayern.dlrg.de";
//  $nachricht=wordwarp($nachricht, 70);
  $header='From: manuel.friedrich@bayern.dlrg.de'."\r\n".'Reply-To: manuel.friedrich@bayern.dlrg.de'."\r\n".'X-Mailer: PHP/'.phpversion();
  mail($email, 'Ihre Passwortanfrage DLRG LV Bayern Apps', $nachricht, $header);
  echo "Vielen Dank für die Anmeldung. Wir haben Ihnen das Passwort per Mail zugesendet.<br>";
  echo "Zurück zur <a href=\"index.php\">Startseite</a>.";
}
 else 
{echo "Es ist ein Fehler aufgetreten - bitte &uuml;berpr&uuml;fen Sie die E-Mail-Adresse oder versuchen Sie es zu einem späteren Zeitpunkt nochmals!";}









mysql_close($Verbindung);

?>


</p>
</body>
</html>
