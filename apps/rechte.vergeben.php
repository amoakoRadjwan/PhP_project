<?php  
 session_start();
  $EDV=$_SESSION["EDV"];
 
require("einstellungen.php"); 

 // Check connection
// if ($_SESSION["Anmeldung"]!="OK") 
// {
 //   die("Sie m&uuml;ssen sich neu anmelden! <a href=\"https://intranet-dlrg.net/apps\">https://intranet-dlrg.net/apps</a>");
// }



  if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['Schalter'])){
	
    $Schalter=$_POST["Schalter"]; 
    if($Schalter == "Eintragen") 
    {  
       write_eintrag($datenbank, $EDV);                                  
    } 
  }
  
  if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['Schalter2'])){
	
    $Schalter2=$_POST["Schalter2"]; 
    if($Schalter2 == "Eintragen") 
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
 $Verbindung = mysqli_connect($ip,$myname,$geheim, $datenbank);  
 // Check connection
 if (!$Verbindung) 
 {
    die('Keine Verbindung möglich: ' . mysqli_connect_error());
 }

 mysqli_set_charset($Verbindung, 'utf8'); 
 
 $SQLString = "SELECT AppNr FROM hatRechte WHERE AppNr=4 AND PersonNr=".$_SESSION['PersonNr'].";";
  // echo $SQLString;
  $Ergebnis = mysqli_query($Verbindung, $SQLString);
    if (mysqli_result($Ergebnis,0,0)==4) 
	{
 // mysql_select_db($datenbank);       
  // $SQLString = "SELECT Gliederung FROM Gliederung WHERE EDV=\"".$EDV."\";";  
 // echo $SQLString; 
 // $Ergebnis = mysqli_query($Verbindung, $SQLString);   
 // $Gliederung=mysqli_result($Ergebnis,0,0);
 // $SQLString = "SELECT Verantwortlich, Email, Einnahmen, eV, mitAnderen, Jugendliche, Erwachsene FROM sportfoerderung WHERE EDV=\"".$EDV."\";";  
 // echo $SQLString; 
 // $Ergebnis = mysqli_query($Verbindung, $SQLString);               
 // if ($Ergebnis)
 // {
    // $verantwortlicher=mysqli_result($Ergebnis, 0, 0);               
    // $email=mysqli_result($Ergebnis, 0, 1);                 
    // $einnahmen=mysqli_result($Ergebnis, 0, 2);                 
    // $eV=mysqli_result($Ergebnis, 0, 3);                 
    // $geteilt=mysqli_result($Ergebnis, 0, 4);                 
    //  $jugendliche=mysqli_result($Ergebnis, 0, 5);                 
    // $erwachsene=mysqli_result($Ergebnis, 0, 6);                 	  

 // }


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
<legend>
  <B>Diese Mitarbeiter sind im System vorhanden.</B>
</legend> 
<?php     
// die tabelle mitarbeiter erhält alle namen, werden einfach in die Auswahl kopiert       
 $Verbindung = mysqli_connect($ip,$myname,$geheim, $datenbank);     
 mysqli_set_charset($Verbindung, 'utf8'); 
// $SQLString = "SELECT distinct Person.EMail FROM App, Person, hatRechte WHERE App.ID=hatRechte.AppNr AND Person.ID=hatRechte.PersonNr AND Person.GliederungNr=\"".$EDV."\" ORDER BY Person.Email;";  
$SQLString = "SELECT Person.EMail, Person.ID FROM Person WHERE Person.GliederungNr=\"".$EDV."\" ORDER BY Person.Email;";  
 $Ergebnis1 = mysqli_query($Verbindung, $SQLString);               
 $Zeilen=mysqli_num_rows($Ergebnis1);
 
 for ($n2=0; $n2 < $Zeilen; $n2++){ 
  
   $SQLString = "SELECT App.Name, von, bis FROM App, Person, hatRechte WHERE App.ID=hatRechte.AppNr AND Person.ID=hatRechte.PersonNr AND Person.GliederungNr=\"".$EDV."\" AND Person.EMail='".mysqli_result($Ergebnis1,$n2,0)."'ORDER BY App.Name;";  
   // echo $SQLString; 
   $Ergebnis = mysqli_query($Verbindung, $SQLString);               
   if ($Ergebnis) 
   {   $Zeilen2  = mysqli_num_rows($Ergebnis);           
       echo "<aside>";
	 
	   echo "<details><summary>".mysqli_result($Ergebnis1,$n2,0)." ID:".mysqli_result($Ergebnis1,$n2,1)."</summary>";
	   echo "<table>";
       echo "<tr><th>App</th><th>erhalten am</th><th>gueltig bis</th><th></th></tr>";
	   for ($n=0; $n< $Zeilen2; $n++){
	     echo "<tr><td>".mysqli_result($Ergebnis, $n, 0)."</td><td>".mysqli_result($Ergebnis, $n, 1)."</td><td>".mysqli_result($Ergebnis, $n, 2)."</td><td> <a href=rolle.entziehen.php?ID=100>Rolle entziehen</a></td></tr>";
	   }
	     echo "</table> </details>";
	     echo "</aside>";
	   
    // { $n3=$n2+1; echo "<tr><td>$n3</td>";
    //   for ($n= 0; $n < $Spalten; $n++) 
    //   {                
    //      echo "<td>"; 
    //      echo mysqli_result($Ergebnis, $n2, $n);                 
	//	  if ($n==4) $ID=mysqli_result($Ergebnis, $n2, $n);
	//	  echo "</td>";
     //  }        
	 // echo "<td><A href='sportfoerderung.antrag.php?ID=$ID&EDV="."$EDV"."&loeschen=1'><img src='loeschen.jpg' width=15></a></td></tr>";
	
	
}
   }
   mysqli_close($Verbindung);  
	 
   
	 
	 
echo "</fieldset>";
 

?>     



<font color="blue"></font>
<form action="rechte.vergeben.php" method="post">
<fieldset><legend>
  <B>Neuen Benutzer hinzuf&uuml;gen</B>
</legend> <table border=0>
<tr>  <td>  EMail:</td>  <td>EMail wiederholen:</td>  <td> Passwort:</td>  <td>Passwort wiederholen:</td>  <td>&nbsp;</td></tr>
<tr><td>  <input type="text" name="EMail"> </td>   <td><input type="text" name="EMail2"></td>  <td> <input type="text" name="Passwort"></td>  <td><input type="text" name="Passwort2"></td>
<td> <input type="submit" name="Schalter" value="Eintragen"> </td> </tr>       
</table>   
</fieldset> 

<form action="rechte.vergeben.php" method="post">
<fieldset><legend>
  <B>Einem Benutzer ein neues Recht hinzuf&uuml;gen</B>
</legend> <table border=0>
<tr>  <td>  ID:</td>  <td>App-Nr:</td> <td>&nbsp;</td> </tr>
<tr><td>  <input type="text" name="PersonNr"> </td>   <td><input type="text" name="AppNr"></td>  
<td> <input type="submit" name="Schalter2" value="Eintragen"> </td> </tr>       
</table>   
</fieldset> 



</form>

<?php

 } else {
	 
	  echo "Entschuldigung - Sie haben keine Rechte f&uuml;r diese App. Bitten wenden Sie sich an Ihren Vorsitzenden bzw. EDV-Beauftragten.";
 }

?>
 
<?php include("menue.html"); ?>
</body>
</html>
<?php  
function write_eintrag($Datenbankname, $EDV)
{
  $EMail=$_POST["EMail"]; 
  $Passwort=$_POST["Passwort"];
  $EMail2=$_POST["EMail2"]; 
  $Passwort2=$_POST["Passwort2"];
  if (($EMail==$EMail2) AND ($Passwort==$Passwort2)){
    require("einstellungen.php");
    $Verbindung = mysqli_connect($ip, $myname, $geheim, $Datenbankname);
    mysqli_set_charset($Verbindung, 'utf8');
    mysql_real_escape_string($EMail);
    mysql_real_escape_string($Passwort);
    $SQLString = "INSERT INTO Person (EMail,  Login, Passwort, GliederungNr, Person, Zeitstempel) VALUES ('$EMail','$EMail', '".hash('sha256', $Passwort)."','$EDV', 'Individuell', NOW() );";
    //   echo $SQLString;
    $Ergebnis = mysqli_query($Verbindung, $SQLString);
    if ($Ergebnis) 
    { 
      echo "<fieldset><font color=\"green\"><p align=center><b>Vielen Dank - der neue Mitarbeiter wurden gespeichert.</b></font></p></fieldset>";   
      $sql="INSERT into logs (email, sql_befehl, Zeitstempel) VALUES (\"".$_SESSION['User']."\", \"".$SQLString."\", Now());";
      //	echo $sql;
	  $Ergebnis=mysqli_query($Verbindung, $sql);
    }  
	else echo "<fieldset><font color=\"red\"><p align=center><b>Es ist ein Fehler aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal.</b></font></p></fieldset>";
	mysqli_close($Verbindung);  
    $Schalter="";
  } else
  {
	  echo "<fieldset><font color=\"red\"><p align=center><b>Es ist ein Fehler aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal.</b></font></p></fieldset>";
  }
}

function write_grunddaten($Datenbankname, $EDV)
{
  
  $PersonNr=$_POST["PersonNr"];
  $AppNr=$_POST["AppNr"];
  
  require("einstellungen.php");
  $Verbindung = mysqli_connect($ip, $myname, $geheim, $Datenbankname);
   mysqli_set_charset($Verbindung, 'utf8');

  mysql_real_escape_string($PersonNr);
  mysql_real_escape_string($AppNr);
 
  $SQLString = "INSERT INTO hatRechte (PersonNr, AppNr, Zeitstempel) VALUES (".$PersonNr.", ".$AppNr.", NOW());";
 // echo $SQLString;
  $Ergebnis = mysqli_query($Verbindung, $SQLString);
  
  if ($Ergebnis) {
	  echo "<fieldset><font color=\"green\"><p align=center><b>Vielen Dank - das Recht wurde erfolgreich hinzugef&uuml;gt. </b></font></p></fieldset>"; 
      $sql="INSERT into logs (email, sql_befehl, Zeitstempel) VALUES (\"".$_SESSION['User']."\", \"".$SQLString."\", Now());";
	//  echo $sql;
	  $Ergebnis=mysqli_query($Verbindung, $sql);  
  } else echo "<fieldset><font color=\"red\"><p align=center><b>Es ist ein Fehler aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal.</b></font></p></fieldset>";  
  
  mysqli_close($Verbindung);  
  $Schalter2="";
}


function delete_eintrag($Datenbankname, $id_loeschen, $EDV)
{  if (($EDV==$_SESSION["EDV"]) || ($_SESSION["EDV"]=="0200000"))
	{ 
      require("einstellungen.php");
      $Verbindung = mysqli_connect($ip, $myname, $geheim, $Datenbankname);
	  mysqli_set_charset($Verbindung, 'utf8');
 //     mysql_select_db($Datenbankname); 
      $SQLString = "DELETE FROM fuel WHERE ID=$id_loeschen AND GliederungNr='$EDV';";
     // echo $SQLString;
      $Ergebnis = mysqli_query($Verbindung, $SQLString);
	if ($Ergebnis) 
	{ echo "<fieldset><font color=\"green\"><p align=center><b>Vielen Dank - der Fach&uuml;bungsleiter wurde erfolgreich gel&ouml;scht.</font></b></p></fieldset>"; 
         $sql="INSERT into logs (email, sql_befehl, Zeitstempel) VALUES (\"".$_SESSION['User']."\", \"".$SQLString."\", Now());";
	//     echo $sql;
	     $Ergebnis=mysqli_query($Verbindung, $sql);
    }  else echo "<fieldset><font color=\"red\"><p align=center><b>Es ist ein Fehler aufgetreten. Bitte versuchen Sie es sp&auml;ter noch einmal.</b></font></p></fieldset>";  
      mysqli_close($Verbindung);  
	}
      $id_loeschen="";
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
