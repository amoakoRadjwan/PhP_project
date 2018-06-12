<?php
require("einstellungen.php");
$pass=$_POST['pass'];// dieses Passwort muss eingegeben werden, damit neue Passwörter erzeugt werden
if (!isset($pass)) show_form(); else if ($pass="st1vk") erzeugen($ip,$myname,$geheim,$datenbank);

function show_form(){
?>

<html><head></head><body>

<form action="hash.erzeugen.php" method="post">
Kurs:<input type="text" name="kurs">
Passwort<input type="text" name="pass">
<input type="submit" value="Liste erzeugen">

</body>
</html>
<?php
}

function erzeugen($ip,$myname,$geheim,$datenbank){
  $Verbindung = mysql_connect($ip,$myname,$geheim);  
  mysql_select_db($datenbank);
  if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysql_error());
  }
  if (!mysql_select_db('db2924x2659170')) {
    die('Konnte Schema nicht selektieren: ' . mysql_error());
  }	   
	
//?php

// Erzeugung von Passwort-Hash
// $password = "geheim";
// $hash = hash('sha256', $password);
// echo $password . ' : ' . $hash;

// Prüfung (beispielhaft)
// $hash = get_user_hash($_POST['username']); // Fiktive Funktion um Hash aus der Datenbank zu laden
// if ($hash == hash('sha256', $_POST['password'])) // Prüfung ob Passwort stimmt
// {
//     echo "Passwort stimmt überein";
// }

	

    $myhash='';      
    $myhash2='';
	$myhash3='';
    $SQLString= "SELECT ID, Passwort, Passwort2, Passwort3 FROM Gliederung";
    $Ergebnis = mysql_query($SQLString, $Verbindung);	 
	  
	for ($i=0;$i<=114;$i++){  
	  $myhash=hash('sha256', mysql_result($Ergebnis, $i, 1));
	  echo mysql_result($Ergebnis, $i, 1) . $myhash. "<br>";
	  $myhash2=hash('sha256', mysql_result($Ergebnis, $i, 2));
      echo mysql_result($Ergebnis, $i, 2) . $myhash2. "<br>";	  
      $myhash3=hash('sha256', mysql_result($Ergebnis, $i, 3));
      echo mysql_result($Ergebnis, $i, 3) . $myhash3. "<br>";	  	  
      $SQLString2 = "UPDATE Gliederung SET hash3='".$myhash3."', hash2='".$myhash2."', hash='".$myhash."' WHERE ID=$i;";      
	  $Ergebnis2 = mysql_query($SQLString2, $Verbindung);	 
      echo $SQLString;      	  
   }


  mysql_close($Verbindung);
}
?>


