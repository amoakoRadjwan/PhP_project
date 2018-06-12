<?php
session_start();
require("einstellungen.php");

?>

<html>
<head>
<title>Betriebsfunk verwalten</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
  <fieldset><br><br>
<h2 align="center">&Uuml;bersicht Betriebsfunk</h2>
   <br>


  <table border="0"> <tr> <td width="5%">
  &nbsp;
  </td><td> 
  <br>
 
    
  <?php 
    if ($_SESSION['Anmeldung']=="OK") {
      $Verbindung = mysql_connect($ip,$myname,$geheim);
	   mysql_set_charset('utf8', $Verbindung);
    if (!$Verbindung) {
      die('Keine Verbindung möglich: ' . mysql_error());
    }
     if (!mysql_select_db('db2924x2659170')) {
      die('Konnte Schema nicht selektieren: ' . mysql_error());
    }

    mysql_select_db($datenbank);
	
	if ($_SESSION['EDV']=="0200000") {
      $SQLString = "Select count(*) FROM betriebsfunk WHERE Zeitstempel>0;";
	  $Ergebnis = mysql_query($SQLString, $Verbindung);
	  echo "Es liegen ".mysql_result($Ergebnis,0,0)." Meldungen vor.<br>";
 
    }
	
	if ($_SESSION['EDV']=="0201000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Oberfranken\" ORDER BY EDV";
	} else
		
	if ($_SESSION['EDV']=="0202000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Mittelfranken\" ORDER BY EDV";
	} else
	if ($_SESSION['EDV']=="0203000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Unterfranken\" ORDER BY EDV";
	} else
	if ($_SESSION['EDV']=="0204000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Niederbayern\" ORDER BY EDV";
	} else
	if ($_SESSION['EDV']=="0205000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Oberpfalz\" ORDER BY EDV";
	} else
	if ($_SESSION['EDV']=="0206000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Alpenland\" ORDER BY EDV";
	} else
	if ($_SESSION['EDV']=="0208000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Oberbayern\" ORDER BY EDV";
	} else
	if ($_SESSION['EDV']=="0209000") {
		  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE DLRG_Bezirk=\"Schwaben\" ORDER BY EDV";
	} else
	
	if ($_SESSION['EDV']!="0200000") {
      $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk WHERE EDV=\"".$_SESSION['EDV']."\";";
 //   echo $SQLString;
    } else 

	{
	  $SQLString = "Select betriebsfunk.EDV, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Funknetz_nr, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Zeitstempel FROM betriebsfunk ORDER BY EDV;";
//	  echo $SQLString;
		}
    $Ergebnis = mysql_query($SQLString, $Verbindung);


   if ($Ergebnis) {
  $Zeilen  = mysql_num_rows($Ergebnis);
  $Spalten = mysql_num_fields($Ergebnis);
  
  echo "<table align=\"center\" width=\"600\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\">";
  $farbe=1;

  // $n sind die Zeilen, jede Zeile wird aufgebaut, soviele Spalten es gibt!
  echo "<tr bgcolor=\"#DDEEFF\"><td>EDV</td><td>Landkreis_Stadt</td><td>DLRG-Bezirks</td><td>Funknetz</td><td>Funknetz-Nr</td><td>ortsfest</td><td>mobil</td><td>Nord</td>
   <td>Ost</td><td>Adresse</td><td>Urkunde g&uuml;ltig bis</td><td>LV</td><td>Bemerkung</td><td>Letzte &Auml;nderung<td>Bearbeiten</td></tr>";
  for ($n= 0; $n < $Zeilen; $n++) 

  // bei jeder Zeile gibt es eine neue Farbe, die ständig wechselt
  {  if ($farbe==1) 
     {echo "<tr bgcolor=\"#DDDDDD\">"; $farbe=2;} else {echo "<tr bgcolor=\"#BBBBBB\">"; $farbe=1; }

     // $i sind die Spalten, die nun für jede Zeile zu füllen ist
     for ($i = 0; $i < $Spalten; $i++) 
     {  echo "<td width=\"200\">";
          if ((mysql_result($Ergebnis, $n, $i))=="") {echo "&nbsp";} else {echo mysql_result($Ergebnis, $n, $i);} 
          echo "</td>";
     }   
     $Eintrag=mysql_result($Ergebnis,$n,0);
     echo "<td><a href=\"betriebsfunk.aendern.php?EDV=".mysql_result($Ergebnis,$n,0)."\">Bearbeiten</a></td></tr>";
  }
  
  echo "</table>";
} else 
{ echo "Fehler"; 
}
mysql_close($Verbindung);
  }
?>

<td></tr>
<tr><td>&nbsp</td><td>
  <br>
 

</td></tr></table>
  </fieldset>
   <?php 
   
   // require("menue.php"); 
   
  
  if ($_SESSION['EDV']=="0200000")
	  
  {   $Verbindung = mysql_connect($ip,$myname,$geheim);
       mysql_select_db($datenbank);
      $SQLString="SELECT Mail FROM termine WHERE ID=1;";
	  $Ergebnis = mysql_query($SQLString, $Verbindung);
	  $mail=mysql_result($Ergebnis, 0,0);
      
      echo "<fieldset> <legend>Mail an alle versenden</legend>";
	  echo "<form action='betriebsfunk.mail.php' method='POST'>" ;
	  echo "Gliederung Nr von: <input type='text' name='von'> bis: <input tpye='text' name='bis'>";
	  echo "<br>E-Mail-Nachricht:<textarea name=\"mail\" cols=\"50\" rows=\"10\">".$mail." </textarea>";
	  echo "&nbsp;<input type='submit' value='Mails versenden' name='schalter'><br>";
	  echo "</form>";
	  echo "</fieldset>";
	  
	  echo "<fieldset> <legend>Erinnerung versenden</legend>";
	  echo "<form action='betriebsfunk.erinnerung_mail.php' method='POST'>" ;
	  echo "Gliederung Nr von: <input type='text' name='von'> bis: <input tpye='text' name='bis'>";
	  echo "<br>E-Mail-Nachricht:<textarea name=\"mail\" cols=\"50\" rows=\"10\">".$mail." </textarea>";
	  echo "&nbsp;<input type='submit' value='Mails versenden' name='schalter'><br>";
	  echo "</form>";
	  echo "</fieldset>";
	  
	  
	  
	  mysql_close($Verbindung);
   }

   
   ?>
  </body>
  </html>


  
