<?php
require("einstellungen.php");
$EDV=$_GET["EDV"];
$Passwort=$_GET["Passwort"]
?>

<html>
<head>
<title>Haushaltsplanmeldung best&auml;tigen.</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset>
<br><br> 
<h2 align="center">Best&auml;tigung der Beschaffungsmeldung Haushaltsplanvoranfrage</h2>


<?php

//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      

  $Verbindung = mysql_connect($ip, $myname, $geheim);
  mysql_select_db($datenbank);
  
  $SQLString = "SELECT EDV, Passwort FROM Gliederung WHERE EDV=\"".$EDV."\" AND Passwort=\"".$Passwort."\";";
  $Ergebnis = mysql_query($SQLString, $Verbindung);
  $pruefung=0;
  if ($Ergebnis){
	  if ((mysql_result($Ergebnis,0,0)==$EDV) && (mysql_result($Ergebnis,0,1)==$Passwort)) $pruefung=1;
  }
  if ($pruefung==0)
  {
	$SQLString = "SELECT EDV, Passwort2 FROM Gliederung WHERE EDV=\"".$EDV."\" AND Passwort2=\"".$Passwort."\";";
    $Ergebnis = mysql_query($SQLString, $Verbindung);
    $pruefung=0;
    if ($Ergebnis){
	  if ((mysql_result($Ergebnis,0,0)==$EDV) && (mysql_result($Ergebnis,0,1)==$Passwort)) $pruefung=1;
    }  
  }
  
  if ($pruefung==1)
  {
    $SQLString = "Update meldetHH SET melde_Datum=NOW() WHERE EDV=\"".$EDV."\";";
 //   echo $SQLString;
    $Ergebnis = mysql_query($SQLString, $Verbindung);
    if ($Ergebnis) 
	{echo "Vielen Dank f&uuml;r die R&uuml;ckmeldung! Sie k&ouml;nnen Ihre Daten jederzeit einsehen und bis zum Stichtag &auml;ndern unter <a href=\"https://www.intranet-dlrg.net/apps\">https://www.intranet-dlrg.net/apps<a>";} else {echo "Es ist ein Fehler aufgetreten! Ihr Eintrag wurde nicht gespeichert. Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut. Vielen Dank f&uuml;r Ihr Verst&auml;ndnis!";
  } } else {
		echo "Es ist ein Fehler aufgetreten! Ihr Eintrag wurde nicht gespeichert. Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut. Vielen Dank f&uuml;r Ihr Verst&auml;ndnis!";
  }

?>

</fieldset>

</body>
</html>
