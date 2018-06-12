<?php
session_start();

$von=$_POST['von'];
$bis=$_POST['bis'];
require("einstellungen.php");
 $Verbindung = mysql_connect($ip, $myname, $geheim);
if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysql_error());
 }
 if (!mysql_select_db('db2924x2659170')) {
    die('Konnte Schema nicht selektieren: ' . mysql_error());
 }
 
mysql_select_db($datenbank);

$SQLString = "SELECT betriebsfunk.EDV, email_einsatz, Landkreis_Stadt, DLRG_Bezirk, Funknetz, Anzahl_ortsfest, Anzahl_mobil, nord, ost, Adresse, Urkunde_gueltig_bis, LV, Bemerkung, Passwort FROM Gliederung, betriebsfunk WHERE Gliederung.EDV=betriebsfunk.EDV AND ID>=".$von." AND ID<=".$bis." AND Zeitstempel=\"0000-00-00\";";

echo $SQLString;

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
<h1>Mails versenden</h1>
<p>

<?php

if ($Zeilen>0) {
 for ($i=0; $i<$Zeilen; $i++) {	
  $EDV=mysql_result($Ergebnis,$i,0);
  $email_einsatz=mysql_result($Ergebnis,$i,1);
  $Landkreis_Stadt=mysql_result($Ergebnis,$i,2);
  $DLRG_Bezirk=mysql_result($Ergebnis,$i,3);
  $Funknetz=mysql_result($Ergebnis,$i,4);
  $Anzahl_ortsfest=mysql_result($Ergebnis,$i,5);
  $Anzahl_mobil=mysql_result($Ergebnis,$i,6);
  $nord=mysql_result($Ergebnis,$i,7);
  $ost=mysql_result($Ergebnis,$i,8);
  $Adresse=mysql_result($Ergebnis,$i,9);
  $Urkunde_gueltig_bis=mysql_result($Ergebnis,$i,10);
  $LV=mysql_result($Ergebnis,$i,11);
  $Bemerkung=mysql_result($Ergebnis,$i,12);
  $Passwort=mysql_result($Ergebnis,$i,13);
  
  $nachricht="Liebe Technische Leiter in den Gliederungen der DLRG in Bayern,\r\n \nWir haben euch vor einer Woche eine Mail für die jährlich notwendige Funkmeldung gesendet. Diese Meldung ist einmal pro Jahr notwendig, um die Gebührenbefreiung für diesen Bereich seitens der DLRG Bundesebene zu begründen. \r\n \nMit dieser Mail möchte ich euch freundlich an die Abgabe erinnern. Der Abgabe-Termin ist der 06.01.2018. \r\n \nVon eurer Gliederung liegen uns folgende Daten vor: \r\n\nEDV-Nummer: ".$EDV."\r\nLandkreis_Stadt: ".$Landkreis_Stadt."\r\nDLRG Bezirk: ".$DLRG_Bezirk."\r\nFunknetz: ".$Funknetz."\r\nAnzahl orstfester Stationen: ".$Anzahl_ortsfest."\r\nAnzahl mobile Geräte: ".$Anzahl_mobil."\r\nGeographische Lage Nord (feste Station): ".$nord."\r\nGeographische lage Ost (feste Station): ".$ost."\r\nAdressen (feste Station):".$Adresse."\r\nUrkunde gültig bis: ".$Urkunde_gueltig_bis."\r\nLV: ".$LV."\r\nBemerkung: ".$Bemerkung."\r\n\nSollte sich im Vergleich zum Vorjahr nichts geändert haben oder eure Gliederung keine Adler-Geräte besitzen, einfach die folgende URL aufrufen https://intranet-dlrg.net/apps/betriebsfunk.nichtsgeaendert.php?Passwort=".$Passwort."&EDV=".$EDV;
  $nachricht=$nachricht.".\r\n\nÄnderungen können online vorgenommen werden. Ruft dazu bitte die Seite https://intranet-dlrg.net/apps auf. \r\n\nIhr könnt euch mit eurer Funktionsemail: ".$email_einsatz." einloggen.\r\nEuer Passwort lautet: ".$Passwort."\r\n";
  $nachricht=$nachricht."\r\nNatürlich könnt ihr Meldungen auch direkt per Mail oder per Post senden, dann aber nur an mich direkt.\r\n\nDie Einsatzleiter der Bezirsverbände erhalten Zugriff auf alle Gliederungsdaten ihres Bezirkes und können auch einsehen, welche Orts- und Kreisverbände ihre Meldung erfolgreich abgeschickt haben. \r\n\nHinweis: Gliederungen, die keine oder fehlerhafte Meldungen senden, verlieren ggf. die Gebührenbefreiung ihrer Betriebsfunkgeräte.\r\n\n\nMit kameradschaftlichen Grüßen\r\n\nDr. Manuel Friedrich\r\nVizepräsident der DLRG Bayern e.V.\r\n\nAnschrift:\r\nOskar-Jünger-Str. 15\r\n95447 Bayreuth\r\neMail: manuel.friedrich@bayern.dlrg.de\r\n";
 //  $nachricht=wordwarp($nachricht, 70);
  $header='MIME-Version: 1.0'."\r\n".'Content-Type: text/plain; charset=utf-8'."\r\n".'From: manuel.friedrich@bayern.dlrg.de'."\r\n".'Reply-To: manuel.friedrich@bayern.dlrg.de'."\r\n".'X-Mailer: PHP/'.phpversion();
  
    mail($email_einsatz, 'DLRG LV Bayern - Funkmeldung Betriebsfunk', $nachricht, $header);
	echo ($i+1).".Mail an ".$EDV.": ".$email_einsatz." ist raus.<br>";
    
 }
}
 else 
 {echo "Es ist ein Fehler aufgetreten - bitte &uuml;berpr&uuml;fen Sie die E-Mail-Adresse oder versuchen Sie es zu einem späteren Zeitpunkt nochmals!";}

mysql_close($Verbindung);

?>


</p>
</body>
</html>
