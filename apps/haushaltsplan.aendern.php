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


<?php

//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      
$Verbindung = mysql_connect($ip, $myname, $geheim);
mysql_select_db($datenbank);
mysql_set_charset('utf8', $Verbindung);

if (($_SESSION["EDV"]=="0201000") OR ($_SESSION["EDV"]=="0202000") OR ($_SESSION["EDV"]=="0203000") OR ($_SESSION["EDV"]=="0204000") OR ($_SESSION["EDV"]=="0205000") OR ($_SESSION["EDV"]=="0206000") OR ($_SESSION["EDV"]=="0207000") OR ($_SESSION["EDV"]=="0208000") OR ($_SESSION["EDV"]=="0209000") OR ($_SESSION["EDV"]=="0200000"))
{
   if ($_SESSION["EDV"]=="0201000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0201%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0202000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0202%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0203000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0203%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0204000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0204%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0205000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0205%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0206000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0206%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0207000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0207%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0208000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0208%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0209000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"0209%\" ORDER BY EDV;"; else
   if ($_SESSION["EDV"]=="0200000") $SQLString = "Select meldetHH.EDV, Gliederung, melde_Datum FROM meldetHH, Gliederung WHERE Gliederung.EDV=meldetHH.EDV AND meldetHH.EDV LIKE \"02%\" ORDER BY EDV;"; 
   // echo $SQLString;
		
   $Ergebnis = mysql_query($SQLString, $Verbindung);

   if ($Ergebnis) 
   {
     $Zeilen  = mysql_num_rows($Ergebnis);
     $Spalten = mysql_num_fields($Ergebnis);
  
     echo "<table align=\"center\" width=\"600\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\">";
     $farbe=1;

     // $n sind die Zeilen, jede Zeile wird aufgebaut, soviele Spalten es gibt!
     echo "<tr bgcolor=\"#DDEEFF\"><td>EDV</td><td>Gliederung</td><td>Zeitstempel</td><td>Bearbeiten</td></tr>";
     for ($n= 0; $n < $Zeilen; $n++) 

     // bei jeder Zeile gibt es eine neue Farbe, die ständig wechselt
     {  
	   if ($farbe==1) 
       { echo "<tr bgcolor=\"#DDDDDD\">"; $farbe=2;} else {echo "<tr bgcolor=\"#BBBBBB\">"; $farbe=1;  }
       // $i sind die Spalten, die nun für jede Zeile zu füllen ist
       for ($i = 0; $i < $Spalten; $i++) 
       {  echo "<td width=\"200\">";
          if ((mysql_result($Ergebnis, $n, $i))=="") {echo "&nbsp";} else {echo mysql_result($Ergebnis, $n, $i);} 
          echo "</td>";
       }   
       $Eintrag=mysql_result($Ergebnis,$n,0);
       echo "<td><a href=\"haushalt.zentral.aendern.php?EDV=".mysql_result($Ergebnis,$n,0)."\">Bearbeiten</a></td></tr>";
     }
     echo "</table>";
	 echo "</fieldset>";
  } 
} 

else {
?>
 <form action="haushaltsmeldung.danke.php" method="POST">
 <table>
 <tr><td>Ger&auml;t</td><td>Preis (Plan)</td><td>Anzahl 2019</td><td>Anzahl2020</td></tr>
 <p>Bitte geben Sie nur die Anzahl der Ger&auml;te an, nicht die Preise.</p>
<?php
 $SQLString = "SELECT jahr1, jahr2 FROM meldetHH WHERE EDV=\"".$_SESSION["EDV"]."\"";
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
}
?>

</body>
</html>
