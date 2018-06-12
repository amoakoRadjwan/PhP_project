<?php
session_start();
//$von=$_POST["von"]; 
//$bis=$_POST["bis"];
if(($_SERVER['REQUEST_METHOD']=='POST') && (isset($_POST['von']))){
	
    $von=$_POST["von"]; 
	$bis=$_POST["bis"];
    
                                        
     
  } else {$von=0; $bis=0;}

echo "von: ".$von;
echo "<br>bis: ".$bis;
 echo "<fieldset> <legend>Mail Sportförderung an alle Schatzmeister versenden</legend>";
 echo "<form action='sportfoerderung.mail.f.php' method='POST'>" ;
	  echo "Gliederung Nr von: <input type='text' name='von'> bis: <input tpye='text' name='bis'>";
	  // echo "<br>E-Mail-Nachricht:<textarea name=\"mail\" cols=\"50\" rows=\"10\">".$mail." </textarea>";
	  echo "&nbsp;<input type='submit' value='Mails versenden' name='schalter'><br>";
	  echo "</form>";
	  echo "</fieldset>";	  


require("einstellungen.php");
 $Verbindung = mysql_connect($ip, $myname, $geheim);
if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysql_error());
 }
 if (!mysql_select_db('db2924x2659170')) {
    die('Konnte Schema nicht selektieren: ' . mysql_error());
 }
 
mysql_select_db($datenbank);

$SQLString = "SELECT EDV, email_finanzen, Passwort3 FROM Gliederung WHERE ID>=".$von." AND ID<=".$bis.";";

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

if ($Zeilen>0) 
{
  for ($i=0; $i<$Zeilen; $i++) 
  {	
    $EDV=mysql_result($Ergebnis,$i,0);
    $email_finanzen=mysql_result($Ergebnis,$i,1);
    $Passwort=mysql_result($Ergebnis,$i,2);
  
  $nachricht="Liebe Kameradinnen und Kameraden in den Gliederungen der DLRG in Bayern,\r\n \n(Schatzmeister der Bezirke zur Kenntnis)\r\n \nin der vergangenen Woche haben wir das Rundschreiben zur Sportförderung an alle Gliederungen in Bayern verschickt. Darin haben wir angekündigt, auch allen Schatzmeistern einen Zugang zur Intranet-Plattform zu geben, damit diese den Antrag genauso wie die Vorsitzenden einsehen und bearbeiten können.\r\n\n";

  
  $nachricht=$nachricht."Ihr könnt auf der Seite https://intranet-dlrg.net/apps das Formular einsehen und ändern.\r\n\nDie Fachübungsleiter, die dem LV mit einer gültigen Lizenz bekannt sind, wurden bereits im Formular hinterlegt.\r\n\nWie den Vorsitzenden bereits mitgeteilt, endet die Frist für das Ausfüllen des Formulars am 31.03.2018.\r\n\nDie Meldungen können nur online vorgenommen werden. Ruft dazu bitte die Seite https://intranet-dlrg.net/apps auf. Dort findet ihr die App Sportförderung. \r\nIhr könnt euch mit eurer Funktionsemail: ".$email_finanzen." einloggen.\r\nEuer Passwort lautet:".$Passwort."\r\n";

$nachricht=$nachricht."\r\n\nNatürlich stehen wir euch jederzeit zur Verfügung, falls ihr Hilfe bei der Meldung benötigt.\r\n\nMit kameradschaftlichen Grüßen\r\n\nPartrick Sinzinger\r\nTechnischer Leiter Ausbildung der DLRG Bayern e.V.\r\neMail: ausbildung@bayern.dlrg.de\r\n\nDr. Manuel Friedrich\r\nVizepräsident der DLRG Bayern e.V.\r\n\nAnschrift:\r\nOskar-Jünger-Str. 15\r\n95447 Bayreuth\r\neMail: manuel.friedrich@bayern.dlrg.de\r\n";

// echo $nachricht;

 //  $nachricht=wordwarp($nachricht, 70);
  $header='MIME-Version: 1.0'."\r\n".'Content-Type: text/plain; charset=utf-8'."\r\n".'From: manuel.friedrich@bayern.dlrg.de'."\r\n".'Reply-To: manuel.friedrich@bayern.dlrg.de'."\r\n".'X-Mailer: PHP/'.phpversion();

if ($_SESSION['EDV'] == "0200000") {
    mail($email_finanzen, 'DLRG LV Bayern - Sportförderung - Antragsformular', $nachricht, $header);
}
	echo ($i+1).".Mail an ".$EDV.": ".$email_finanzen." ist raus.<br>";
  
 }
}
 else 
 {echo "Es ist ein Fehler aufgetreten - bitte &uuml;berpr&uuml;fen Sie die E-Mail-Adresse oder versuchen Sie es zu einem späteren Zeitpunkt nochmals!";}

mysql_close($Verbindung);

?>


</p>
</body>
</html>
