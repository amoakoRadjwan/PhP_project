<?php
session_start();
require("einstellungen.php");
?>

<html>
<head>
<title>Informationsportal Beschaffung.</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset> 
<h2 align="center">Beschaffung BayRDG - Infoportal - Beschaffungen bis 2017</h2>
</fieldset>
<p>
<?php
echo "Sie sind angemeldet als: ".$_SESSION['User']." f&uuml;r die Gliederung ".$_SESSION['EDV'];
echo "<br>";



//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      
  if ($_SESSION["Anmeldung"]=="OK")
  {
    $Verbindung = mysqli_connect($ip, $myname, $geheim, $datenbank);
	if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysqli_connect_error());

 }
 	mysqli_set_charset($Verbindung, 'utf8'); 
	
	$SQLString = "SELECT AppNr FROM hatRechte WHERE AppNr=6 AND PersonNr=".$_SESSION['PersonNr'].";";
    // echo $SQLString;
    $Ergebnis = mysqli_query($Verbindung, $SQLString);
    if (mysqli_result($Ergebnis,0,0)==6) 
	{
	
      $SQLString = "SELECT ID, Beschaff_Jahr, Beschaffungsmenge, Geraete_Typ, Geraete_Art, Status, E_N, Anschaffungs_preis, Lieferant FROM tbl_Beschaffung WHERE Beschaff_Jahr<2018 AND GliederungsNr='".$_SESSION['EDV']."' ORDER BY Beschaff_Jahr DESC, ID;";
      // echo $SQLString;
	  echo "<fieldset>";
      $Ergebnis = mysqli_query($Verbindung, $SQLString);
	
      if ($Ergebnis) 
	  {
        $anzahl_zeilen=mysqli_num_rows($Ergebnis);
	    echo "<table border=1>";
	    echo "<tr><td>ID</td><td>Jahr</td><td>Menge</td><td>Art</td><td>Typ</td><td>Status</td><td>E/N</td><td>Preis</td><td>Lieferant</td></tr>";
	    for ($i1=0; $i1<$anzahl_zeilen; $i1++)
		{
          echo "<tr>";
          for ($i2=0; $i2<9; $i2++)
		  {
			 echo "<td>";
	//		if ($i2==0) echo "<a href='beschaffung.info.art.php?ID=".mysqli_result($Ergebnis, $i1, $i2)."'>";
		     echo mysqli_result($Ergebnis, $i1, $i2);
	//		if ($i2==0) echo "</a>";
			 echo "</td>";
	      }
          echo "</tr>";
	    }	
	    echo "</table><br>
        <p>Der Status bedeutet <br>(1) Beschaffung genehmigt<br>(2) Beschaffung nicht f&ouml;rderf&auml;hig <br>(3) bestellt <br>(4) teilbestellt <br>(5) beschafft <br>(6) Rechnung gestellt <br>(7) Antrag eingegangen <br>(8) Beschaffung abgelehnt <br>(9) Gliederung abgelehnt</p></fieldset>";
      } 
      else 
	  {
		  echo "Es ist ein Fehler aufgetreten! Bitte versuchen Sie es zu einem sp&auml;teren Zeitpunkt erneut. Vielen Dank f&uuml;r Ihr Verst&auml;ndnis!";
	  }
    } else 
    {
	  echo "Entschuldigung - Sie haben keine Rechte f&uuml;r diese App. Bitten wenden Sie sich an Ihren Vorsitzenden bzw. EDV-Beauftragten.";
    }
  } else 
  { echo "Es ist ein Fehler ausgetreten. Pr&uuml;fen Sie Ihre Eingaben."; 
  }

?>

</p>

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
