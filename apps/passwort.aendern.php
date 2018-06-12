<?php
session_start();
?>
<html>
  <head> 
    <LINK rel="stylesheet" type="text/css" href="schrift.css"></head>
    <body bgcolor="#2E81C5">

   
  <p> 
    <h2 align="center"> DLRG LV Bayern - Vereinsverwaltung </h2>

  



<form action="passwort.aendern.danke.php" method="post">
  <table border=0><tr><td width=33%>&nbsp;</td><td width=33%><img src='bild.jpg' border=2 width=100% align="middle" border=5px border-color=red></td><td width=33%>&nbsp;</td></tr>  
  
  <tr><td>&nbsp;</td>
    <td>
        <table align="center" border=0>
          <tr><td>  Benutzer:</td>    <td> <input type="text" name="User" size=35> </td>
             <td><font color="blue">Melden Sie sich mit Ihrer E-Mail-Adresse an.</font></td>
          </tr>
     
	      <tr><td>Altes Passwort:</td>
             <td> <input type="password" name="Passwort"> </td>
             <td><font color="blue">Sie haben Ihr Passwort per Mail erhalten.</font></td>
          </tr>
          <tr><td>Neues Passwort:</td>
             <td> <input type="password" name="PasswortN1"> </td>
             <td><font color="blue">Geben Sie hier Ihr neues Passwort ein.</font></td>
          </tr>		  
          <tr><td>Neues Passwort:</td>
             <td> <input type="password" name="PasswortN2"> </td>
             <td><font color="blue">Wiederholen Sie das neue Passwort.</font></td>
          </tr>		  
		  <tr><td> &nbsp;</td>
             <td> <input type="submit" name="Aendern" value='Passwort &auml;ndern'> </td>
             <td>&nbsp;</td>
          </tr>
	</td>
	<td>&nbsp;</td>
	</tr>
    </table>
  </td><td>&nbsp;</td></tr>
  
  </table>
  

</form>
</body>
  </html>
