<?php
 session_start();

 header("Cache-Control: max-age=600");

 $Passwort=$_POST['Passwort'];
 $User=$_POST['User'];
 require("einstellungen.php");
 $Verbindung = mysqli_connect($ip, $myname, $geheim, $datenbank);

 mysql_real_escape_string($User);
 mysql_real_escape_string($Passwort);
 
 // Check connection
 if (!$Verbindung) 
 {
    die('Keine Verbindung möglich: ' . mysqli_connect_error());
 }


$SQLString = "SELECT GliederungNr, Passwort, email, ID FROM Person WHERE Passwort=\"".hash('sha256', $Passwort)."\" AND email=\"".$User."\"";
// echo $SQLString;
if ($Ergebnis = mysqli_query($Verbindung, $SQLString))
$Zeilen=mysqli_num_rows($Ergebnis);
 
if ($Zeilen>0) 
{	
  $_SESSION['Anmeldung']="OK";
  $_SESSION['User']=mysqli_result($Ergebnis,0,2);  
  $_SESSION['Myhash']=mysqli_result($Ergebnis,0,1);
  $_SESSION['EDV']=mysqli_result($Ergebnis,0,0);
  $_SESSION['PersonNr']=mysqli_result($Ergebnis,0,3);
//  $_SESSION['Person']="Einsatz";
//  echo "Sie sind angemeldet als: ".$_SESSION['User']." f&uuml;r die Gliederung ".$_SESSION['EDV'];
}  else { $_SESSION['Anmeldung']="FALSE";} 

 
 
 if ($_SESSION['Anmeldung'] != "OK") 
 { 
  echo "Es ist ein Fehler aufgetreten - die Anmeldung war nicht erfolgreich!"; 
  $_SESSION['Anmeldung']="FALSE";
 } else {
	 
	$SQLString="INSERT into logs (email, sql_befehl, Zeitstempel) VALUES (\"".$_SESSION['User']."\", \"LOGIN\", Now());";
//	echo $SQLString;
	$Ergebnis=mysqli_query($Verbindung, $SQLString);
	 
 }

mysqli_close($Verbindung);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
       "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>DLRG Bayern Apps</title>
 <LINK rel="stylesheet" type="text/css" href="schrift.css">
</head>
<body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">

 <p>
<?php
if ($_SESSION['Anmeldung'] == "OK") {
 echo "<table cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tr><td bgcolor=\"#DDDDDD\">Sie sind angemeldet als:</td><td bgcolor=\"#DDDDDD\">".$_SESSION['User']."</td><td><img src=logo.png width=100></td></tr><tr><td bgcolor=\"#DDDDDD\">f&uuml;r die Gliederung Nr.:</td><td bgcolor=\"#DDDDDD\">".$_SESSION['EDV']."</td><td>&nbsp;</td></tr></table>";	
 echo "<h1>Auswahl der vorhandenen Apps</h1>";
 echo "<a href=\"funkmeldung.php\"><img src=\"adler_app.jpg\" width=\"150\"></a><a href=\"haushaltsplan.aendern.php\"><img src=\"haushalt_app.jpg\" width=\"150\"></a><a href=\"sportfoerderung.antrag.php\"><img src=\"logo_sportfoerderung_klein.jpg\" width=\"150\"></a>";
 echo "<a href=\"beschaffung.info.php\"><img src=\"logo_bayrdg_beschaffung.jpg\" width=\"150\"></a>";
 echo "<a href=\"rechte.vergeben.php\"><img src=\"rechte_vergeben.jpg\" width=\"150\"></a>";
}
 else
{
 echo "<a href=\"index.php\">Zur&uuml;ck zur Anmeldeseite</a>";	
}

 
 ?>
</p>

<?php include("menue.html"); ?>
</body>
</html>

<?php

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
