<?php
session_start();
require("einstellungen.php");
$passwort=$_POST["Passwort"];
$passwortn1=$_POST["PasswortN1"];
$passwortn2=$_POST["PasswortN2"];
?>

<html>
<head>
<title>Passwort&auml;nderung.</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset>
<br><br> 
<h2 align="center">Best&auml;tigung der Passwort&auml;nderung</h2>


<?php

//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      
  if (($passwortn1==$passwortn2) && (hash('sha256', $passwort)==$_SESSION['Myhash'])) {
  $Verbindung = mysqli_connect($ip, $myname, $geheim, $datenbank);
//  mysql_select_db($datenbank);
  
  
    $SQLString = "Update Person SET Passwort=\"".hash('sha256', $passwortn1)."\" WHERE email=\"".$_SESSION["User"]."\";";
   
//  echo $SQLString;
  $Ergebnis = mysqli_query($Verbindung, $SQLString);
  $_SESSION['Myhash']=''; $_SESSION['User']=''; $_SESSION['EDV']='';
  if ($Ergebnis) {echo "Vielen Dank, Ihr Passwort wurde erfolgreich ge&auml;ndert. <a href='index.php'>Zur&uuml;ck zur Anmeldung.</a>";} else {echo "Es ist ein Fehler aufgetreten! Ihr neues Passwort wurde nicht gespeichert. Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut. Vielen Dank f&uuml;r Ihr Verst&auml;ndnis!";}
  } else 
  { echo "Es ist ein Fehler ausgetreten. Pr&uuml;fen Sie Ihre Eingaben."; 

}

?>

</fieldset>

</body>
</html>