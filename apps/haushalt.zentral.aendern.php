<?php
  session_start();
  $EDV=$_GET["EDV"];
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


<?php

//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      
$Verbindung = mysql_connect($ip, $myname, $geheim);
mysql_select_db($datenbank);
mysql_set_charset('utf8', $Verbindung);

?>
 <form action="haushalt.zentral.danke.php" method="POST">
 <p>Sie &auml;ndern die Daten für die Gliederung-EDV-Nr: <?php echo $EDV;?><input size=10 name="EDV" value="<?php echo $EDV;?>" type="hidden">.</p>
 <table>
 <tr><td>Ger&auml;t</td><td>Preis (Plan)</td><td>Anzahl 2019</td><td>Anzahl2020</td></tr>
 <p>Bitte geben Sie nur die Anzahl der Ger&auml;te an, nicht die Preise.</p>
<?php
 $SQLString = "SELECT jahr1, jahr2 FROM meldetHH WHERE EDV=\"".$EDV."\"";
 $Ergebnis = mysql_query($SQLString, $Verbindung);               

 if ($Ergebnis){
	 $a_jahr1=explode(";", mysql_result($Ergebnis,0,0));
     $a_jahr2=explode(";", mysql_result($Ergebnis,0,1));	 
 
  
 $SQLString = "SELECT Geraet, Preis FROM geraet ORDER BY Reihenfolge";       
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
        echo "<td><input size=5 name=\"j1_".$n."\" value=\"$a_jahr1[$n]\" type=\"text\"></td>";
	echo "<td><input size=5 name=\"j2_".$n."\" value=\"$a_jahr2[$n]\" type=\"text\"></td></tr>";
      }        
	  
   }
 }
?>
<tr><td>
<input name="Schalter" type="submit" value="Haushaltsplanmitteilung abschicken"></td></tr>
</table>
</form>
<p>Hinweis: Sie k&ouml;nnen die Meldung bis zum Meldestichtag jederzeit erneut ausf&uuml;llen und &auml;ndern!</p>



</fieldset>
<?php

?>

</body>
</html>
