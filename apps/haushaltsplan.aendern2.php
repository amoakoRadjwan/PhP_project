<?php
  session_start();
  require("einstellungen.php");
 
 
?>
<html>
<head>
<title>Haushaltsplameldung</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head>

<body bgcolor="#dfdfdf" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset bgcolor="white">
<br><br> 
<p>Sie sind angemeldet als: <?php echo $_SESSION['User'];?>.</p>
<p>Ihre Gliederung-EDV-Nr: <?php echo $_SESSION['EDV'];?>.</p>
<h2 align="center">Meldung Haushaltsplan BayRDG</h2>
<p>Bitte geben Sie nur die Anzahl der Ger&auml;te an, nicht die Preise.</p>
<form action="haushaltsmeldung.danke.php" method="POST">
<table>
<tr><td>Ger&auml;t</td><td>Preis (Plan)</td><td>Anzahl 2019</td><td>Anzahl2020</td></tr>
<?php

//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      
 $Verbindung = mysql_connect($ip, $myname, $geheim);
 mysql_select_db($datenbank);
 mysql_set_charset('utf8', $Verbindung);

 $SQLString = "SELECT * FROM geraet ORDER BY Geraet";       
 $Ergebnis = mysql_query($SQLString, $Verbindung);               
 if ($Ergebnis) 
 {   $Zeilen  = mysql_num_rows($Ergebnis);           
     $Spalten = mysql_num_fields($Ergebnis);             
     for ($n= 0; $n < $Zeilen; $n++) 
     {  echo "<tr>";              
        for ($n1=0; $n1<$Spalten; $n1++)
        {  echo "<td>";
           echo mysql_result($Ergebnis, $n, $n1);
	   echo "</td>"; 
        }		 
        echo "<td><input size=5 name=\"j1_".$n."\" type=\"text\"></td>";
	echo "<td><input size=5 name=\"j2_".$n."\" type=\"text\"></td></tr>";
      }        
	  
   }

?>
<tr><td>
<input name="Schalter" type="submit" value="Haushaltsplanmitteilung abschicken"></td></tr>
</table>
</form>
<p>Hinweis: Sie k&ouml;nnen die Meldung bis zum Meldestichtag jederzeit erneut ausf&uuml;llen und &auml;ndern!</p>


</fieldset>

</body>
</html>
