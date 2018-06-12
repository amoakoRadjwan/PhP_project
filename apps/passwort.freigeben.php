<?php
require("einstellungen.php");
$email=$_GET["email"];
$tan=$_GET["TAN"]
?>

<html>
<head>
<title>Passwort&auml;nderung best&auml;tigt.</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset>
<br><br> 
<h2 align="center">Best&auml;tigung der Passwort&auml;nderung</h2>


<?php

//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      

  $Verbindung = mysqli_connect($ip, $myname, $geheim, $datenbank);
 // mysql_select_db($datenbank);
  
  $SQLString = "SELECT id, email, hash, person, tan FROM neuePW WHERE email=\"".$email."\" AND tan=\"".$tan."\";";
  $Ergebnis = mysqli_query($Verbindung, $SQLString);
  $pruefung=0;
  if ($Ergebnis){
	  if ((mysqli_result($Ergebnis,0,1)==$email) && (mysqli_result($Ergebnis,0,4)==$tan)) $pruefung=1;
	  $person=mysqli_result($Ergebnis,0,3);
	  $hash=mysqli_result($Ergebnis,0,2);
	  $id=mysqli_result($Ergebnis,0,0);
  }
   
  if (($pruefung==1) && ($tan!=''))
  {
    $SQLString = "Update Person SET Passwort='".$hash."' WHERE email='".$email."';";
    //    echo $SQLString;
    $Ergebnis = mysqli_query($Verbindung, $SQLString);
	if ($Ergebnis){
		$SQLString = "Update neuePW SET tan='' WHERE ID=".$id.";";
		// echo '<br>'.$SQLString;
		$Ergebnis2 = mysqli_query($Verbindung, $SQLString);
	
   
	    if ($Ergebnis2) 
	    { echo "Vielen Dank f&uuml;r die &Auml;nderung des Passwortest! Sie k&ouml;nnen es ab sofort verwenden.<br><br>Zur Anmeldeseite: <a href=\"https://www.intranet-dlrg.net/apps\">https://www.intranet-dlrg.net/apps</a>";
        } 
        else 
	    {
          echo "Es ist ein Fehler aufgetreten! Ihr Eintrag wurde nicht gespeichert. Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut. Vielen Dank f&uuml;r Ihr Verst&auml;ndnis!";
        }
	}		
  } else 
  {
	  echo "Es ist ein Fehler aufgetreten! Ihr Eintrag wurde nicht gespeichert. Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut. Vielen Dank f&uuml;r Ihr Verst&auml;ndnis!";
  }
   

?>

</fieldset>

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
