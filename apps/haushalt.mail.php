﻿<?php
session_start();

$von=$_POST['von'];
$bis=$_POST['bis'];
require("einstellungen.php");
 $Verbindung = mysql_connect($ip, $myname, $geheim);
if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysql_error());
 }
 if (!mysql_select_db($datenbank)) {
    die('Konnte Schema nicht selektieren: ' . mysql_error());
 }
 
mysql_select_db($datenbank);

$SQLString = "SELECT meldetHH.EDV, email_einsatz, Passwort FROM Gliederung, meldetHH WHERE Gliederung.EDV=meldetHH.EDV AND ID>=".$von." AND ID<=".$bis." AND OeRV=1;";

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
  $Passwort=mysql_result($Ergebnis,$i,2);
  
  $nachricht="Liebe Vorsitzende, liebe Technische Leiter Einsatz in den Gliederungen der DLRG in Bayern,\r\n \nalle zwei Jahre erwartet das Staatsministerium des Innern die detaillierten Planungen der DLRG Bayern für die Anschaffungen aus Mitteln des Bayerischen Rettungsdienstgesetzes (BayRDG) für den kommenden Doppelhaushalt.\r\n\n";
$nachricht=$nachricht."Alle Gliederungen, die über einen öffentlichen-rechtlichen Vertrag verfügen, können Mittel beantragen.\r\n 
Zunächst geht es um die Haushaltsvoranfrage. Bitte meldet uns bis zum 31.01.2018, welche Anschaffungen ihr in eurer Gliederung für die Jahre 2019 und 2020 plant.\r\n\nDie Meldungen können nur online vorgenommen werden. Ruft dazu bitte die Seite https://intranet-dlrg.net/apps auf. Dort findet ihr die App Haushaltsplanvoranfrage. \r\nIhr könnt euch mit eurer Funktionsemail: ".$email_einsatz." einloggen.\r\nEuer Passwort lautet:".$Passwort."\r\n\nSolltet ihr in den Jahren 2019 und 2020 keine Anschaffungen aus Mitteln des BayRDG planen, so könnt ihr einfach den folgenden LINK aufrufen https://intranet-dlrg.net/apps/haushalt.nichtsgeplant.php?Passwort=".$Passwort."&EDV=".$EDV;

$nachricht=$nachricht."\r\n\nNatürlich stehen wir euch jederzeit zur Verfügung, falls ihr Hilfe bei der Meldung benötigt.\r\n\nDie Technischen Leiter - Einsatz der Bezirksverbände erhalten Zugriff auf alle Gliederungsdaten ihres Bezirks und können auch einsehen, welche Orts- und Kreisverbände ihre Meldung erfolgreich abgeschickt haben. \r\n\nHinweis: Gliederungen, die nicht oder nicht rechtzeitig ihre Meldung absenden, werden bei den Beschaffungen nicht mit höchster Priorität berücksichtigt werden können.\r\n\nMit kameradschaftlichen Grüßen\r\n\nSven Slovacek\r\nTechnischer Leiter Einsatz der DLRG Bayern e.V.\r\neMail: einsatz@bayern.dlrg.de\r\n\nDr. Manuel Friedrich\r\nVizepräsident der DLRG Bayern e.V.\r\n\nAnschrift:\r\nOskar-Jünger-Str. 15\r\n95447 Bayreuth\r\neMail: manuel.friedrich@bayern.dlrg.de\r\n";

// echo $nachricht;

 //  $nachricht=wordwarp($nachricht, 70);
  $header='MIME-Version: 1.0'."\r\n".'Content-Type: text/plain; charset=utf-8'."\r\n".'From: manuel.friedrich@bayern.dlrg.de'."\r\n".'Reply-To: manuel.friedrich@bayern.dlrg.de'."\r\n".'X-Mailer: PHP/'.phpversion();

if ($_SESSION['EDV'] == "0200000") {
    mail($email_einsatz, 'DLRG LV Bayern - Beschaffungen BayRDG - Haushaltsplanvoranfrage', $nachricht, $header);
}
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
