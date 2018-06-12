<?php
require("einstellungen.php");
$pass=$_POST['pass'];// dieses Passwort muss eingegeben werden, damit neue Passwörter erzeugt werden
if (!isset($pass)) show_form(); else if ($pass="st1vk") erzeugen($ip,$myname,$geheim,$datenbank);

function show_form(){
?>
<html><head></head><body>

<form action="erzeugen.php" method="post">
Kurs:<input type="text" name="kurs">
Passwort<input type="text" name="pass">
<input type="submit" value="Liste erzeugen">

</body>
</html>
<?php
}
?>

<?php
function erzeugen($ip,$myname,$geheim,$datenbank){
  	  $Verbindung = mysql_connect($ip,$myname,$geheim);  
  	   mysql_select_db($datenbank);
  if (!$Verbindung) {
    die('Keine Verbindung möglich: ' . mysql_error());
 }
 if (!mysql_select_db($datenbank)) {
    die('Konnte Schema nicht selektieren: ' . mysql_error());
 }	   
	   

  for ($i=1;$i<=113;$i++){
      $mycode='';      
	  for ($i2=0;$i2<7;$i2++){
         $zahl=mt_rand(49,122);        
		 if ($zahl==94) $zahl=93;  
		 if ($zahl==95) $zahl=92;          
		 if ($zahl==96) $zahl=91;        if ($zahl==60) $zahl=90;         if ($zahl==92) $zahl=65; 		        
		 $mycode=$mycode.(chr($zahl));

  	  }
  	  echo $mycode." - ";

     
      $SQLString = "UPDATE Gliederung SET Passwort2='".$mycode."' WHERE ID=$i;";      
	  $Ergebnis = mysql_query($SQLString, $Verbindung);	 
       echo $SQLString;      	  
      
	  
  	  
  	  
  }
}

 // mysql_close($Verbindung);
?>


