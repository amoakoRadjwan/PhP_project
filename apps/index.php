<?php
session_start();
?>
<html>
  <head> 
    <LINK rel="stylesheet" type="text/css" href="schrift.css"></head>
    <body bgcolor="#2E81C5">

   
  <p> 
    <h2 align="center"> DLRG LV Bayern - Vereinsverwaltung </h2>

  <?php

showForm($User="");

?>


  </body>
  </html>

  <?php  



function showForm($User="")



 {
// if($meldung != "") {
//   echo("<font color=\"#FF0000\"><b>".$meldung."</b></font>");

 } 
?>
<form action="login.php" method="post">
  <table border=0><tr><td width=33%>&nbsp;</td><td width=33%><img src='bild.jpg' border=2 width=100% align="middle" border=5px border-color=red></td><td width=33%>&nbsp;</td></tr>  
  
  <tr><td>&nbsp;</td>
    <td>
        <table align="center" border=0>
          <tr><td>  Benutzer:</td>    <td> <input type="text" name="User"> </td>
             <td><font color="blue">Melden Sie sich mit Ihrer E-Mail-Adresse an.</font></td>
          </tr>
     
	      <tr><td> Passwort:</td>
             <td> <input type="password" name="Passwort"> </td>
             <td><font color="blue">Sie haben Ihr Passwort per Mail erhalten.</font></td>
          </tr>
		  <tr><td> &nbsp;</td>
             <td> <input type="submit" name="Anmeldung" value='anmelden'> </td>
             <td><font color="blue"><a href='passwort.zusenden.php'>Passwort vergessen? Hier klicken!</a></font></td>
          </tr>
	</td>
	<td>&nbsp;</td>
	</tr>
    </table>
  </td><td>&nbsp;</td></tr>
  
  </table>
  

</form>
