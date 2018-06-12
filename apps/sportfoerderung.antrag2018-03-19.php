<?php  
session_start();
$EDV=$_SESSION["EDV"];
require("einstellungen.php"); 


  if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['Schalter'])){
	
    $Schalter=$_POST["Schalter"]; 
    if($Schalter == "Eintragen") 
    {  
       write_eintrag($datenbank);                                  
    } 
  }
  
  if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['Schalter2'])){
	
    $Schalter2=$_POST["Schalter2"]; 
    if($Schalter2 == "Absenden") 
    { 
       write_grunddaten($datenbank, $EDV);      
       
    } 
  }

  
   if($_SERVER['REQUEST_METHOD']=='GET'&&isset($_GET['loeschen'])){
	
    $loeschen=$_GET["loeschen"]; 
	$id_loeschen=$_GET["ID"];
	$EDV=$_GET["EDV"];
	if($loeschen == 1) 
    {  
       delete_eintrag($datenbank, $id_loeschen, $EDV);                                  
    } 
  }
 


// die tabelle mitarbeiter erhält alle namen, werden einfach in die Auswahl kopiert       
 $Verbindung = mysql_connect($ip,$myname,$geheim);  
 mysql_set_charset('utf8', $Verbindung); 
 mysql_select_db($datenbank);       
  $SQLString = "SELECT Gliederung FROM Gliederung WHERE EDV=\"".$EDV."\";";  
 // echo $SQLString; 
 $Ergebnis = mysql_query($SQLString, $Verbindung);   
 $Gliederung=mysql_result($Ergebnis,0,0);
 $SQLString = "SELECT Verantwortlich, Email, Einnahmen, eV, mitAnderen, Jugendliche, Erwachsene FROM sportfoerderung WHERE EDV=\"".$EDV."\";";  
 // echo $SQLString; 
 $Ergebnis = mysql_query($SQLString, $Verbindung);               
 if ($Ergebnis)
 {
     $verantwortlicher=mysql_result($Ergebnis, 0, 0);               
     $email=mysql_result($Ergebnis, 0, 1);                 
     $einnahmen=mysql_result($Ergebnis, 0, 2);                 
     $eV=mysql_result($Ergebnis, 0, 3);                 
     $geteilt=mysql_result($Ergebnis, 0, 4);                 
     $jugendliche=mysql_result($Ergebnis, 0, 5);                 
     $erwachsene=mysql_result($Ergebnis, 0, 6);                 	  

 }


 ?>

<html><head> 
  <LINK rel="stylesheet" type="text/css" href="schrift.css">
</head>

<body bgcolor="#DDDDFF" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
  <fieldset>         
  <h2 align="center"> DLRG Landesverband Bayern e.V. - Sportf&ouml;rderung Antrag 2018 </h2>
    <p>
	<?php
	echo "Sie sind angemeldet als: ".$_SESSION['User']." f&uuml;r die Gliederung ".$_SESSION['EDV'];
	?>
	</p>
  </fieldset>          
  
    <fieldset>         
  <h2 align="center"> Antragsteller </h2>
    <p>
	<?php
	echo "<form action=\"sportfoerderung.antrag.php\" method=\"POST\">";
	echo "<table border=0>";
	echo "<tr><td>Gliederung:".$_SESSION['EDV']."</td><td width=200>$Gliederung</td></tr>";
	echo "<tr><td>Verantwortlicher (vertretungsberechtigter Unterzeichner):</td><td><input type='text' name=\"verantwortlicher\" size='35' value='$verantwortlicher'></td></tr>";
	echo "<tr><td>Email (alle weiteren Unterlagen werden an diese Mail geschickt):</td><td><input type='text' name=\"email\" size='35' value='$email'></td></tr>";
	if ($einnahmen==1) echo "<tr><td>Die o.g. Gliederung erzielte im Vorjahr die geforderten zweckgebundenen Einnahmen (siehe Hinweis unten).</td><td><input type='checkbox' name='einnahmen' value=1 checked='checked'></tr>"; else
	  echo "<tr><td>Die o.g. Gliederung erzielte im Vorjahr die geforderten zweckgebundenen Einnahmen (siehe Hinweis unten).</td><td><input type='checkbox' name='einnahmen' value=1></tr>";
    if ($eV==1) echo "<tr><td>Die o.g. Gliederung ist ein eingetragener Verein (e.V.).</td><td><input type='checkbox' name='eV' value=1 checked='checked'></tr>";	else
	  echo "<tr><td>Die o.g. Gliederung ist ein eingetragener Verein (e.V.).</td><td><input type='checkbox' name='eV' value=1></tr>";
	if ($geteilt==1) echo "<tr><td>Es werden F&Uuml;-Lizenzen mit einer anderen Gliederung geteilt.</td><td><input type='checkbox' name='geteilt' value=1 checked='checked'></tr>"; else
	  echo "<tr><td>Es werden F&Uuml;-Lizenzen mit einer anderen Gliederung geteilt.</td><td><input type='checkbox' name='geteilt' value=1></tr>";
	echo "<tr><td>Mitglieder bis einschlie&szlig;lich 26 Jahre (Stichtag 01.01.2018):</td><td><input type='text' name='jugendliche' size='35' value='$jugendliche'></td></tr>";	
	echo "<tr><td>Mitglieder ab einschlie&szlig;lich 27 Jahre (Stichtag 01.01.2018):</td><td><input type='text' name='erwachsene' size='35' value='$erwachsene'></td></tr>";	
	echo "<tr><td>Bitte best&auml;tigen Sie die Eingabe durch Dr&uuml;cken des Buttons \"Absenden\"!<td><input type='submit' name='Schalter2' value='Absenden'></td></tr>";
	echo "</table></form>"
	?>
	</p>
  </fieldset>     

 
<form action="sportfoerderung.antrag.php" method="post">
<fieldset>
<legend>
  <B>Diese Fach&uuml;bungsleiter sind uns schon bekannt (ggf. &auml;ndern)</B>
</legend> 
<?php     
// die tabelle mitarbeiter erhält alle namen, werden einfach in die Auswahl kopiert       
 $Verbindung = mysql_connect($ip,$myname,$geheim);     
 mysql_set_charset('utf8', $Verbindung); 
 mysql_select_db($datenbank);       
 $SQLString = "SELECT Vorname, Nachname, RegNr, gueltig_bis, ID FROM fuel WHERE GliederungNr=\"".$EDV."\" ORDER BY Nachname, Vorname;";  
// echo $SQLString; 
 $Ergebnis = mysql_query($SQLString, $Verbindung);               
 if ($Ergebnis) 
 {   $Zeilen  = mysql_num_rows($Ergebnis);           
     $Spalten = mysql_num_fields($Ergebnis);             
	 echo "<table border=0>";
	 echo "<tr><td>Nr.</td><td width=100>Vorname</td><td width=100>Nachname</td><td width=100>Reg-Nr.</td><td width=100>g&uuml;ltig bis</td><td>ID</td><td>L&ouml;schen</td></tr>";
	 for ($n2=0; $n2< $Zeilen; $n2++)
     { $n3=$n2+1; echo "<tr><td>$n3</td>";
       for ($n= 0; $n < $Spalten; $n++) 
       {                
          echo "<td>"; 
          echo mysql_result($Ergebnis, $n2, $n);                 
		  if ($n==4) $ID=mysql_result($Ergebnis, $n2, $n);
		  echo "</td>";
       }        
	  echo "<td><A href='sportfoerderung.antrag.php?ID=$ID&EDV="."$EDV"."&loeschen=1'><img src='loeschen.jpg' width=15></a></td></tr>";
     }
  echo "</table></fieldset>";
 }

?>     



<font color="blue"></font>
<fieldset><legend>
  <B>Neue Fach&uuml;bungsleiter hinzuf&uuml;gen</B>
</legend> <table border=0>
<tr>  <td>  Vorname:</td>  <td>Nachname:</td>  <td> Reg-Nr.:</td>  <td>g&uuml;ltig bis:</td>  <td>&nbsp;</td></tr>
<tr><td>  <input type="text" name="Vorname"> </td>   <td><input type="text" name="Nachname"></td>  <td> <input type="text" name="RegNr"></td>  <td><input type="text" name="gueltig_bis"></td>
<td> <input type="submit" name="Schalter" value="Eintragen"> </td> </tr>       
</table>   
</fieldset> 


<fieldset><legend>
  <B>Auszug aus den F&ouml;rderrichtlinien</B>
</legend> <p> <font size="1"> 
5.2 Beitragsaufkommen
Das tats&auml;chliche Beitragsaufkommen (Ist-Aufkommen) des Vereins muss im Jahr vor der Bewilligung der Zuwendung grunds&auml;tzlich so hoch sein, dass es insgesamt folgenden Jahresbeitragss&auml;tzen (Soll-Aufkommen) entspricht:<br>
je Mitglied bis einschlie&szlig;lich 13 Jahre (Sch&uuml;ler): 12 &euro;,<br>
je Mitglied bis einschlie&szlig;lich 17 Jahre (Jugendliche): 25 &euro;,<br>
je Mitglied ab 18 Jahre (Erwachsene): 50 &euro;.<br>
<br>
In das Ist-Aufkommen k&ouml;nnen sowohl nicht zweckgebundene als auch solche Spenden eingerechnet werden, die speziell f&uuml;r die Ma&szlig;nahme gegeben werden, deren F&ouml;rderung beantragt wird, sowie Einnahmen aus dem laufenden Gesch&auml;ftsbetrieb, die durch ehrenamtliche (unentgeltliche)T&auml;tigkeit von Mitgliedern erzielt werden (z. B. Erl&ouml;se aus Vereinsfesten, Tombolas u. &Auml;.).<br>
Spenden oder Beitrags&uml;bernahmen durch Stammvereine (z.B. bei Junioren-F&ouml;rder-Gemeinschaften) k&ouml;nnen nicht in das Ist-Aufkommen eingerechnet werden. Erreicht das Ist-Aufkommen nicht das vorausgesetzte Soll-Aufkommen, so gen&uml;gt ein Ist-Aufkommen von wenigstens 70 Prozent des Soll-Aufkommens dann, wenn der Antragsteller besondere Gr&uuml;nde f&uuml;r das Zur&uuml;ckbleiben des Ist-Aufkommens gegen&uuml;ber dem Soll-Aufkommen glaubhaft machen kann. Als besondere Gr&uuml;nde in diesem Sinne gelten ein Mitgliederzuwachs zu Beginn des laufenden F&ouml;rderjahres, auf Sonderumst&auml;nden beruhende Begleitumst&auml;nde, nicht aber Beitragserm&auml;&szlig;igungen (au&szlig;er bei Arbeitslosen, Asylbewerbern und Menschen mit Aufenthaltsstatus nach &sect; 60a des Aufenthaltsgesetzes &ndash; Duldung) oder Beitragsfreistellungen.
</font></p> 
</fieldset> 


</form>
</body>
</html>
<?php  
function write_eintrag($Datenbankname)
{
  $Vorname=$_POST["Vorname"];
  $Nachname=$_POST["Nachname"];
  $RegNr=$_POST["RegNr"];
  $gueltig_bis=$_POST["gueltig_bis"];
  $EDV=$_SESSION["EDV"];
  require("einstellungen.php");
  $Verbindung = mysql_connect($ip, $myname, $geheim);
   mysql_set_charset('utf8', $Verbindung);
  mysql_select_db($Datenbankname); 
  $SQLString = "INSERT INTO fuel (Vorname,  Nachname, RegNr, gueltig_bis, GliederungNr, Zeitstempel) VALUES ('$Vorname','$Nachname', '$RegNr','$gueltig_bis', '$EDV', NOW() );";
  // echo $SQLString;
  $Ergebnis = mysql_query($SQLString, $Verbindung);
  if ($Ergebnis) 
  { echo "<fieldset><font color=\"green\"><p align=center><b>Vielen Dank - der neue Fach&uuml;bungsleiter wurden gespeichert.</b></font></p></fieldset>";   
    $sql="INSERT into logs (email, sql_befehl, Zeitstempel) VALUES (\"".$_SESSION['User']."\", \"".$SQLString."\", Now());";
//	echo $sql;
	$Ergebnis=mysql_query($sql, $Verbindung);
  }  else echo "<fieldset><font color=\"red\"><p align=center><b>Es ist ein Fehler aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal.</b></font></p></fieldset>";
	
  mysql_close($Verbindung);  
  $Schalter="";
}

function write_grunddaten($Datenbankname, $EDV)
{
  $verantwortlicher=$_POST["verantwortlicher"];
  $email=$_POST["email"];
  if (isset($_POST["geteilt"])) $geteilt=$_POST["geteilt"]; else $geteilt=0;
  if (isset($_POST["eV"])) $eV=$_POST["eV"]; else $eV=0;
  if (isset($_POST["einnahmen"])) $einnahmen=$_POST["einnahmen"]; else $einnahmen=0;
  $jugendliche=$_POST["jugendliche"];
  $erwachsene=$_POST["erwachsene"];  
  require("einstellungen.php");
  $Verbindung = mysql_connect($ip, $myname, $geheim);
   mysql_set_charset('utf8', $Verbindung);
  mysql_select_db($Datenbankname); 
  $SQLString = "UPDATE sportfoerderung SET Verantwortlich='".$verantwortlicher."' , Erwachsene=".$erwachsene.", Email='".$email."', Einnahmen=".$einnahmen.", eV=".$eV.", mitAnderen=".$geteilt.", Jugendliche=".$jugendliche." , Zeitstempel = NOW() WHERE EDV='".$EDV."';";
  $Ergebnis = mysql_query($SQLString, $Verbindung);
  
  if ($Ergebnis) {
	  echo "<fieldset><font color=\"green\"><p align=center><b>Vielen Dank - der Antrag wurde erfolgreich gespeichert. Bis zum Antragsschluss k&ouml;nnen die Daten jederzeit erneut gespeichert weden.</b></font></p></fieldset>"; 
      $sql="INSERT into logs (email, sql_befehl, Zeitstempel) VALUES (\"".$_SESSION['User']."\", \"".$SQLString."\", Now());";
//	  echo $sql;
	  $Ergebnis=mysql_query($sql, $Verbindung);  
  } else echo "<fieldset><font color=\"red\"><p align=center><b>Es ist ein Fehler aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal.</b></font></p></fieldset>";  
  
  mysql_close($Verbindung);  
  $Schalter2="";
}


function delete_eintrag($Datenbankname, $id_loeschen, $EDV)
{  if (($EDV==$_SESSION["EDV"]) || ($_SESSION["EDV"]=="0200000"))
	{ 
      require("einstellungen.php");
      $Verbindung = mysql_connect($ip, $myname, $geheim);
	   mysql_set_charset('utf8', $Verbindung);
      mysql_select_db($Datenbankname); 
      $SQLString = "DELETE FROM fuel WHERE ID=$id_loeschen AND GliederungNr='$EDV';";
     // echo $SQLString;
      $Ergebnis = mysql_query($SQLString, $Verbindung);
	if ($Ergebnis) 
	{ echo "<fieldset><font color=\"green\"><p align=center><b>Vielen Dank - der Fach&uuml;bungsleiter wurde erfolgreich gel&ouml;scht.</font></b></p></fieldset>"; 
         $sql="INSERT into logs (email, sql_befehl, Zeitstempel) VALUES (\"".$_SESSION['User']."\", \"".$SQLString."\", Now());";
	//     echo $sql;
	     $Ergebnis=mysql_query($sql, $Verbindung);
    }  else echo "<fieldset><font color=\"red\"><p align=center><b>Es ist ein Fehler aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal.</b></font></p></fieldset>";  
      mysql_close($Verbindung);  
	}
      $id_loeschen="";
}
?>
