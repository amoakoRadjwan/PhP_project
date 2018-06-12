<?php
session_start();
require("einstellungen.php");
?>
<html>
<head>
<!-- Start Formoid form-->
<link rel="stylesheet" type="text/css" />
</head>
<body>
<div class="title"><h2>Seminarverwaltung DLRG LV Bayern</h2></div>

<form href="seminar.einzelplanung.php" method="POST">

<?php




//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      
  if ($_SESSION["Anmeldung"]=="OK")
  {
    $Verbindung = mysqli_connect($ip, $myname, $geheim, $datenbank);
	if (!$Verbindung) {
      die('Keine Verbindung möglich: ' . mysqli_connect_error());
    }
 	mysqli_set_charset($Verbindung, 'utf8'); 
    $SQLString = "SELECT ID, Titel, von FROM sem_Seminar ORDER BY von, Titel;";
   // echo $SQLString;
	echo "<fieldset>";
	
    $Ergebnis = mysqli_query($Verbindung, $SQLString);
	
    if ($Ergebnis) 
	{
      $anzahl_zeilen=mysqli_num_rows($Ergebnis);
	  echo "<select name=\"select\">";
	  for ($i1=0; $i1<$anzahl_zeilen; $i1++){
        echo "<option value=\"".mysqli_result($Ergebnis, $i1, 0)."\">".mysqli_result($Ergebnis, $i1,1)."</option>";
      }
      echo "</select>";
  
 ?>   
      <input type="submit" value="Aktualisieren">
	  </form>
	  </fieldset>
	  
<?php

     if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['select'])){
	
       $select=$_POST["select"];
       // echo $select;	
       seminardaten_lesen($select);                                  
     
  }





	  
    } 
  else {echo "Es ist ein Fehler aufgetreten! Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut. Vielen Dank f&uuml;r Ihr Verst&auml;ndnis!";}
  } else 
  { echo "Es ist ein Fehler ausgetreten. Pr&uuml;fen Sie Ihre Eingaben."; 

}






?>




	
	
		
	<form style="background-color:#FFFFFF;font-size:14px;font-family:'Roboto',Arial,Helvetica,sans-serif;color:#34495E;max-width:1024;min-width:150px" method="post">
	<fieldset>
	

	
	<p>Raumplanung</p>
	<span><select name="select" >

		<option value="Großer Lehrsaal (2. OG)">Gro&szlig;er Lehrsaal (2. OG)</option>
		<option value="Seminarraum (1. OG)">Seminarraum (1. OG)</option>
		<option value="Seminarraum (2. OG)">Seminarraum (2. OG)</option>
		<option value="Sonstiges">Sonstiges</option></select>
		
		<p>Verpflegung</p>
	<table>	
	<div>
	<tr><td><label><input type="checkbox" value="vor Beginn"><span>vor Beginn</span></label></td><td> Uhrzeit:<input type="text" name="anfang1"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox[]" value="Frühstück"><span>Fr&uuml;hst&uuml;ck</span></label></td><td> Uhrzeit:<input type="text" name="anfang2"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox[]" value="Kaffeepause Vormittag"><span>Kaffeepause Vormittag</span></label></td><td> Uhrzeit:<input type="text" name="anfang3"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox[]" value="Mittagessen"><span>Mittagessen</span></label></td><td> Uhrzeit:<input type="text" name="anfang4"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox[]" value="Kaffeepause Nachmittag"><span>Kaffeepause Nachmittag</span></label></td><td> Uhrzeit:<input type="text" name="anfang5"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox[]" value="Abendessen"><span>Abendessen</span></label></td><td> Uhrzeit:<input type="text" name="anfang6"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox[]" value="Nachtimbiss"><span>Nachtimbiss</span></label></td><td>Uhrzeit:<input type="text" name="anfang7"></td></tr>
	</table>
</div>
<p>Material</p>
	<table>
	
	<tr><td><label><input type="checkbox" name="checkbox1[]" value="Schreibbl&ouml;cke f&uuml;r TN"><span>Schreibbl&ouml;cke f&uuml;r TN</span></label></td><td>Anzahl:<input type="text" name="anzahl"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox1[]" value="Kugelschreiber f&uuml;r TN"/ ><span>Kugelschreiber f&uuml;r TN</span></label></td><td>Anzahl:<input type="text" name="anzahl"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox1[]" value="Beamer"/ ><span>Beamer</span></label></td><td>Anzahl:<input type="text" name="anzahl"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox1[]" value="Flipchart"/ ><span>Flipchart</span></label></td><td>Anzahl:<input type="text" name="anzahl"></td></tr>
	<tr><td><label><input type="checkbox" name="checkbox1[]" value="Pinnwand"/ ><span>Pinnwand</span></label></td><td>Anzahl:<input type="text" name="anzahl"></td></tr>
	</div>
	</table>

	
	<p>Bestuhlung</p>
	<label><input type="radio" name="radio" value="Seminar (Standard)" /><span>Seminar (Standard)</span></label>
	<label><input type="radio" name="radio" value="O-Form" /><span>O-Form</span></label>
	<label><input type="radio" name="radio" value="U-Form" /><span>U-Form</span></label>
	<label><input type="radio" name="radio" value="Nur St&uuml;hle (Kreis)" /><span>Nur St&uuml;hle (Kreis)</span></label>
	<label><input type="radio" name="radio" value="Nur St&uuml;hle (Konferenz)" /><span>Nur St&uuml;hle (Konferenz)</span></label>
	

<p>Bemerkungen</p>
	<div class="element-textarea">
     	<label class="title"></label><div class="item-cont"><textarea class="medium" name="textarea" cols="100" rows="5"></textarea><span class="icon-place"></span></div></div>
<div class="submit"><input type="submit" value="Submit"/></div></form>
</fieldset>



<?php
     function seminardaten_lesen($Select)

	{ 
      require("einstellungen.php");
      $Verbindung = mysqli_connect($ip, $myname, $geheim, $datenbank);
	  mysqli_set_charset($Verbindung, 'utf8'); 
      $SQLString = "SELECT * FROM sem_Seminar WHERE ID=".$Select.";";
     // echo $SQLString;
      $Ergebnis = mysqli_query($Verbindung, $SQLString);
	if ($Ergebnis) 
	{ 
?><fieldset><p>Name des Seminars:<?php echo mysqli_result($Ergebnis,0,1);?><br>Ort:<?php echo mysqli_result($Ergebnis,0,2);?><br>Datum von:<?php echo mysqli_result($Ergebnis,0,3);?><br>Datum bis:<?php echo mysqli_result($Ergebnis,0,4);?><br>
Anzahl min:<?php echo mysqli_result($Ergebnis,0,5);?><br>
Anzahl max:<?php echo mysqli_result($Ergebnis,0,6);?><br>
Anmeldungen:<?php echo mysqli_result($Ergebnis,0,7);?><br>
Verpflegungssatz:<?php echo mysqli_result($Ergebnis,0,8);?> Euro pro Tag<br>
</p>
</textarea>
<?php


	}
      mysqli_close($Verbindung);  
	
      
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