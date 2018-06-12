<?php
session_start();
require("einstellungen.php");
$EDV=$_POST["EDV"];

?>

<html>
<head>
<title>Funkmeldung &auml;ndern</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset>
<br><br> 
<h2 align="center">&Auml;ndern der Funkmeldung Betriebsfunk</h2>
<form action="betriebsfunk.aendern.php" method="POST">

 <br>
 
<?php



writeEintrag($EDV, $_POST["Funknetz"], $_POST["Funknetz_nr"], $_POST["Anzahl_ortsfest"], $_POST["Anzahl_mobil"], 
  $_POST["nord"], $_POST["ost"], $_POST["Adresse"],$_POST["Urkunde_gueltig_bis"], $_POST["LV"], $_POST["Bemerkung"]); 

      

function writeEintrag($EDV, $Funknetz, $Funknetz_nr, $Anzahl_ortsfest, $Anzahl_mobil, $nord, $ost, $Adresse, $Urkunde_gueltig_bis, $LV, $Bemerkung)
{  require("einstellungen.php");

   $Verbindung = mysql_connect($ip,$myname,$geheim);
   mysql_select_db($datenbank);
   mysql_set_charset('utf8', $Verbindung);
   $SQLString="UPDATE betriebsfunk SET Funknetz=\"".$Funknetz."\" , Funknetz_nr=\"".$Funknetz_nr."\", Anzahl_ortsfest=\"".$Anzahl_ortsfest."\",
								   Anzahl_mobil=\"".$Anzahl_mobil."\", nord=\"".$nord."\",
    							    ost=\"".$ost."\",
                                    Adresse=\"".$Adresse."\" , Urkunde_gueltig_bis=\"".$Urkunde_gueltig_bis."\",
                                   LV=\"".$LV."\",
                                   Bemerkung=\"".$Bemerkung."\", Zeitstempel = NOW() WHERE EDV=\"".$EDV."\";";
  // echo $SQLString;
  
   $Ergebnis = mysql_query($SQLString, $Verbindung);
   if ($Ergebnis) {echo "Vielen Dank, Ihr Eintrag wurde ge&auml;ndert!";} else {echo "Entschuldigung, das h&auml;tte nicht passieren d&uuml;rfen. Es ist ein Fehler aufgetreten! Ihr Eintrag wurde nicht ge&auml;nder. Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt nochmal.";}

}




?>
</fieldset>
</body>
</html>
