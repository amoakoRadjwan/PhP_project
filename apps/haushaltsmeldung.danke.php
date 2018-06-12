<?php

 session_start();
 require("einstellungen.php");

// $EDV=$_GET["EDV"];
// $v = vars();
$v=$_POST;
// $string1='j1_1';
// echo $v[$string1];
// echo "hallo welt";
 $jahr1=''; $jahr2='';
 for ($i=0;$i<62;$i++){
  $s1='j1_'.$i; $s2='j2_'.$i;
  $jahr1=$jahr1.$v[$s1].";";	
  $jahr2=$jahr2.$v[$s2].";";
 }
// echo $jahr1; echo "<br>";
//  echo $jahr2;
 writeEintrag($jahr1, $jahr2, $_SESSION['EDV']);
?>

<html>
<head>
<title>Haushaltsplameldung</title>
<LINK rel="stylesheet" type="text/css" href="/db/schrift.css">

</head><body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
<fieldset>
<br><br> 
<h2 align="center">Meldung Haushaltsplan BayRDG</h2>



<?php

//   VERBINDUNG ZU MYSQL AUFNEHMEN UND DATEN LESEN      
// $Verbindung = mysql_connect($ip, $myname, $geheim);
//  mysql_select_db($datenbank);

// $SQLString = "SELECT * FROM geraet ORDER BY Geraet";       
// ANSONSTEN ZEIGE DIE FORMULARFELDER AN - EIN VERSTECKTE




// FUNKTIONEN FÜR DAS ÄNDERN EINES EINTRAGES{writeEintrag($_GET["Landkreis_Stadt"], $_GET["DLRGBezirk"],$_GET["Funknetz"], $_GET["Funknetz_nr"], $_GET["Anzahl_ortsfest"], $_GET["Anzahl_mobil"],   $_GET["nord"], $_GET["ost"], $_GET["Adresse"],$_GET["Urkunde_gueltig_bis"],$_GET["Bemerkung"]);} 
function writeEintrag($jahr1, $jahr2, $edv)
{  require("einstellungen.php");
   // $mysqltime = date ("Y-m-d H:i:s", $phptime);
   $Verbindung = mysql_connect($ip,$myname,$geheim);
   mysql_select_db($datenbank);
   $SQLString="UPDATE meldetHH SET jahr1=\"".$jahr1."\" , jahr2=\"".$jahr2."\" , melde_Datum=Now() WHERE EDV=\"".$edv."\";";
  //  echo $SQLString;
  
   $Ergebnis = mysql_query($SQLString, $Verbindung);
   if ($Ergebnis) {echo "Eintrag ge&auml;ndert!";} else {echo "Fehler! Eintrag nicht ge&auml;nder";}

}


function vars($type='REQUEST')
{
    if($type == 'REQUEST')
        $ay = $_REQUEST;
    elseif($type == 'POST')
        $ay = $_POST;
    elseif($type == 'GET')
        $ay = $_GET;
        
    $rtn = array();
    foreach($ay as $a1 => $a2)
        $rtn[sicher($a1)] = sicher($a2);
        
    return $rtn;   
}

function sicher($string) { 
    return trim(strip_tags(mysql_real_escape_string($string))); 
}

?>

</fieldset>

</body>
</html>
