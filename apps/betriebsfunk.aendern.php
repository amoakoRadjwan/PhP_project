<?php
session_start();
require("einstellungen.php");
$EDV=$_GET["EDV"];

?>

<html>
<head>
<title>Funkmeldung &auml;ndern</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset>
<br><br> 
<h2 align="center">&Auml;ndern der Funkmeldung Betriebsfunk</h2>
<form action="betriebsfunk.aendern.danke.php" method="POST">

 <br>
  <table border="0"> <tr> <td width="5%">
  &nbsp;
  </td><td> 
  <br><br>

<! DIE VARIABLEN ÜBERNHEMEN!!!  !>


<?php




//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      

 $Verbindung = mysql_connect($ip, $myname, $geheim);
  mysql_select_db($datenbank);
  mysql_set_charset('utf8', $Verbindung);

  $SQLString = "SELECT * FROM betriebsfunk WHERE EDV=\"".$EDV."\"";

  $Ergebnis = mysql_query($SQLString, $Verbindung);
  $Landkreis_Stadt=mysql_result($Ergebnis,0,1);
  $DLRG_Bezirk=mysql_result($Ergebnis,0,2); 
  $Funknetz=mysql_result($Ergebnis,0,3);
  $Funknetz_nr=mysql_result($Ergebnis,0,4);
  $Anzahl_ortsfest=mysql_result($Ergebnis,0,5);  
  $Anzahl_mobil=mysql_result($Ergebnis,0,6);    
  $nord=mysql_result($Ergebnis,0,7);
  $ost=mysql_result($Ergebnis,0,8);
  $Adresse=mysql_result($Ergebnis,0,9);  
  $Urkunde_gueltig_bis=mysql_result($Ergebnis,0,10);
  $LV=mysql_result($Ergebnis,0,11);
  $Bemerkung=mysql_result($Ergebnis,0,12); 

?>

<table border="0" width="800">
  <tr><td width="25">&nbsp</td>
    <td>
      <table border="0" width="400">
<?php
// IST EIN SCHALTER LÖSCHEN GEDRÜCKT DANN LÖSCHE EINTRAG



// ANSONSTEN ZEIGE DIE FORMULARFELDER AN - EIN VERSTECKTES FELD FÜR DIE Mitarbieter_ID LName

  echo "<tr><td>EDV</td><td><input size=35 name=\"EDV\" type=\"hidden\" value=\"".$EDV."\">".$EDV."</td></tr>"; 
  echo "<tr><td>Landkreis/Stadt</td><td>$Landkreis_Stadt</td></tr>"; 
  echo "<tr><td>DLRG-Bezirk:</td><td>$DLRG_Bezirk</td></tr>"; 
  echo "<tr><td>Funknetz</td><td><input size=35 name=\"Funknetz\" type=\"text\" value=\"".$Funknetz."\"></td></tr>";
  echo "<tr><td>Funknetz-Nr</td><td><input size=35 name=\"Funknetz_nr\" type=\"text\" value=\"".$Funknetz_nr."\"></td></tr>";  
  echo "<tr><td>Anzahl ortsfest</td><td><input size=35 name=\"Anzahl_ortsfest\" type=\"text\" value=\"".$Anzahl_ortsfest."\"></td></tr>";  
  echo "<tr><td>Anzahl mobil</td><td><input size=35 name=\"Anzahl_mobil\" type=\"text\" value=\"".$Anzahl_mobil."\"></td></tr>";  
  echo "<tr><td>nord</td><td><input size=35 name=\"nord\" type=\"text\" value=\"".$nord."\"></td></tr>";  
  echo "<tr><td>ort</td><td><input size=35 name=\"ost\" type=\"text\" value=\"".$ost."\"></td></tr>"; 
  echo "<tr><td>Adresse</td><td><input size=70 name=\"Adresse\" type=\"text\" value=\"".$Adresse."\"></td></tr>"; 
  echo "<tr><td>Urkunde gueltig bis</td><td><input size=35 name=\"Urkunde_gueltig_bis\" type=\"text\" value=\"".$Urkunde_gueltig_bis."\"></td></tr>";    
  echo "<tr><td>LV</td><td><input size=35 name=\"LV\" type=\"text\" value=\"".$LV."\"></td></tr>"; 
  echo "<tr><td>Bemerkung</td><td><input size=35 name=\"Bemerkung\" type=\"text\" value=\"".$Bemerkung."\"></td></tr>"; 
  


?>
      </table>
   </td>
   <td width="200">&nbsp</td>
   <td width="200"><img src="logo.png"><p>DLRG Bayern e.V.<br>
     Vereinsverwaltung</p></td>
 </tr>
 
</table>

<input name="Schalter" type="submit" value="Aendern">
</form>
</td></tr>
</table>


</fieldset>

</body>
</html>
