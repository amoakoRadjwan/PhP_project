<?php
session_start();

  $_SESSION['Anmeldung']="false";
  $_SESSION['User']='niemand';  
  $_SESSION['Myhash']='null';
  $_SESSION['EDV']='0';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
       "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>DLRG Bayern Apps</title>
 <LINK rel="stylesheet" type="text/css" href="schrift.css">
</head>
<body bgcolor="#2E81C5" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">

 <p align="center">
Vielen Dank für Ihren Besuch. Sie haben sich erfolgreich abgemeldet.
<br><a href="index.php">Zur&uuml;ck zur Anmeldeseite</a>;	

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
