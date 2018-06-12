<?php
session_start();
$Person="niemand";
$User=$_POST['User'];
$neuesPW1=$_POST['neuesPW1'];
$neuesPW2=$_POST['neuesPW2'];


require("einstellungen.php");
 $Verbindung = mysqli_connect($ip, $myname, $geheim, $datenbank);
if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysqli_connect_error());
 }
// if (!mysql_select_db($datenbank)) {
//    die('Konnte Schema nicht selektieren: ' . mysql_error());
// }

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


 $SQLString = "SELECT email, Passwort FROM Person WHERE email=\"".$User."\"";
 $Ergebnis=mysqli_query($Verbindung, $SQLString);
 $Zeilen=mysqli_num_rows($Ergebnis);
 
 if ($Zeilen>0) 
 {	
  
   $passwort=mysqli_result($Ergebnis,0,1);
   $email=mysqli_result($Ergebnis,0,0); 
  
   $tan=getTAN(6);
   // hier werden die neuen DAten in die TAbelle eingetragen

   $SQLString="Insert into neuePW (email, hash, person, tan) VALUES ('".$User."', '".hash('sha256', $neuesPW1)."','Person','".$tan."');";  
   $Ergebnis=mysqli_query($Verbindung, $SQLString);
   // echo $SQLString;
  
   $nachricht="Vielen Dank für die Anforderung Ihres Passwortes für die DLRG LV Bayern Apps. \r\nIhr Passowort lautet:\r\n".$neuesPW1."\r\n";
   $nachricht=$nachricht."Bevor Sie das neue Passwort verwenden können, müssen Sie es durch Klicken auf den folgenden Link freischalten.";
   $nachricht=$nachricht."\r\nhttps://intranet-dlrg.net/apps/passwort.freigeben.php?email=".$email."&TAN=".$tan;
   $nachricht=$nachricht."\r\nBei Fragen wenden Sie sich bitte an manuel.friedrich@bayern.dlrg.de";
   //  $nachricht=wordwarp($nachricht, 70);
   $header='From: noreply@intranet-dlrg.net'."\r\n".'Reply-To: manuel.friedrich@bayern.dlrg.de'."\r\n".'X-Mailer: PHP/'.phpversion();
   // echo $nachricht;
   mail($email, 'Ihre Passwortanfrage DLRG LV Bayern Apps', $nachricht, $header);
   echo "Vielen Dank für die &Auml;nderung Ihres Passwortes. Wir haben Ihnen einen Link zum Freischalten per Mail zugesendet.<br>";
   echo "<br>Bitte &ouml;ffnen Sie die Mail und klicken Sie auf den Link, um den Vorgang abzuschlie&szlig;en!<br><br>";
   echo "Zur&uuml;ck zur <a href=\"index.php\">Startseite</a>.";
 }
 else 
 {echo "Es ist ein Fehler aufgetreten - bitte &uuml;berpr&uuml;fen Sie die E-Mail-Adresse oder versuchen Sie es zu einem späteren Zeitpunkt nochmals!";}

  mysqli_close($Verbindung);

?>

</p>
</body>
</html>

<?php

function getTAN($anzahl){
	$mycode='';      
	  for ($i2=0;$i2<$anzahl;$i2++){
         $zahl=mt_rand(49,122);        
		 if ($zahl==94) $zahl=66;  if ($zahl==91) $zahl=70; if ($zahl==93) $zahl=71;
         if ($zahl==59) $zahl=72; if ($zahl==58) $zahl=73; 		 
		 if ($zahl==95) $zahl=67;          
		 if ($zahl==96) $zahl=68;        if ($zahl==60) $zahl=69;         if ($zahl==92) $zahl=65; 		        
		 $mycode=$mycode.(chr($zahl));
  	  }
	  return $mycode;
}

function mysqli_result($result, $iRow, $field = 0)
{
    if(!mysqli_data_seek($result, $iRow))
        return false;
    if(!($row = mysqli_fetch_array($result)))
        return false;
    if(!array_key_exists($field, $row))
        return false;
    return $row[$field];
}


?>