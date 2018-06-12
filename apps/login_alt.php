<?php
session_start();
 $Passwort=$_POST['Passwort'];
 $User=$_POST['User'];
require("einstellungen.php");
 $Verbindung = mysql_connect($ip, $myname, $geheim);
if (!$Verbindung) 
{
    die('Keine Verbindung möglich: ' . mysql_error());
}
if (!mysql_select_db('db2924x2659170')) {
    die('Konnte Schema nicht selektieren: ' . mysql_error());
}

$SQLString = "SELECT EDV, Passwort, email_einsatz FROM Gliederung WHERE Passwort=\"".$Passwort."\" AND email_einsatz=\"".$User."\"";
// echo $SQLString;
$Ergebnis=mysql_query($SQLString, $Verbindung);
$Zeilen=mysql_num_rows($Ergebnis);
 
if ($Zeilen>0) 
{	
  $_SESSION['Anmeldung']="OK";
  $_SESSION['User']=mysql_result($Ergebnis,0,2);  
  $_SESSION['Passwort']=mysql_result($Ergebnis,0,1);
  $_SESSION['EDV']=mysql_result($Ergebnis,0,0);
  $_SESSION['Person']="Einsatz";
  echo "Sie sind angemeldet als: ".$_SESSION['User']." f&uuml;r die Gliederung ".$_SESSION['EDV'];
} else 
{
  $SQLString = "SELECT EDV, Passwort2, email_vorsitz FROM Gliederung WHERE Passwort2=\"".$Passwort."\" AND email_vorsitz=\"".$User."\"";
   // echo $SQLString;
   $Ergebnis=mysql_query($SQLString, $Verbindung);
   $Zeilen2=mysql_num_rows($Ergebnis);
   if ($Zeilen2>0) 
   {	
     $_SESSION['Anmeldung']="OK";
     $_SESSION['User']=mysql_result($Ergebnis,0,2);  
     $_SESSION['Passwort']=mysql_result($Ergebnis,0,1);
     $_SESSION['EDV']=mysql_result($Ergebnis,0,0);
     $_SESSION['Person']="Vorsitz";	 
     echo "Sie sind angemeldet als: ".$_SESSION['User']." f&uuml;r die Gliederung ".$_SESSION['EDV'];	 
   } 
   else
	 
  {
  $SQLString = "SELECT EDV, Passwort3, email_finanzen FROM Gliederung WHERE Passwort3=\"".$Passwort."\" AND email_finanzen=\"".$User."\"";
   // echo $SQLString;
   $Ergebnis=mysql_query($SQLString, $Verbindung);
   $Zeilen2=mysql_num_rows($Ergebnis);
   if ($Zeilen2>0) 
   {	
     $_SESSION['Anmeldung']="OK";
     $_SESSION['User']=mysql_result($Ergebnis,0,2);  
     $_SESSION['Passwort']=mysql_result($Ergebnis,0,1);
     $_SESSION['EDV']=mysql_result($Ergebnis,0,0);
     $_SESSION['Person']="Schatzmeister";	 
     echo "Sie sind angemeldet als: ".$_SESSION['User']." f&uuml;r die Gliederung ".$_SESSION['EDV'];	 
   } 
 }
}
 
 
 if ($_SESSION['Anmeldung'] != "OK") 
 { 
  echo "Es ist ein Fehler aufgetreten - die Anmeldung war nicht erfolgreich!"; 
  $_SESSION['Anmeldung']="FALSE";
 }

mysql_close($Verbindung);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
       "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>DLRG Bayern Apps</title>
</head>
<body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<h1>Auswahl der vorhandenen Apps</h1>
<p><a href="funkmeldung.php"><img src="adler_app.jpg" width="150"></a> 

 <a href="haushaltsplan.aendern.php"><img src="haushalt_app.jpg" width="150"></a> 
 <a href="sportfoerderung.antrag.php"><img src="logo_sportfoerderung_klein.jpg" width="150"></a> 
</p>
<p>
<a href="passwort.aendern.php">Passwort ändern!</a>
</p>

</body>
</html>
