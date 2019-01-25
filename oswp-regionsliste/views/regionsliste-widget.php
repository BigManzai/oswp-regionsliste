<!-- This file is used to markup the public-facing widget. -->

<?php
// Konfig Anfang
  /* MySQL Database */
  $CONF_db_server   = "localhost";		     //Your Database-Server
  $CONF_db_user  = "databaseuser";       	             // login
  $CONF_db_pass    = "password";     	     // password
  $CONF_db_database   = "opensimdatabasename"; // Name of BDD
// Konfig Ende
  
  $dbort = $CONF_db_server;
  $dbuser = $CONF_db_user;
  $dbpw = $CONF_db_pass;
  $dbdb = $CONF_db_database;

   $con = mysqli_connect($dbort,$dbuser,$dbpw,$dbdb);
   $res = mysqli_query($con, "SELECT * FROM regions");

   echo "<h2>Regionsliste</h2>";

   // Tabellenbeginn
   echo "<table border='0' style='border-collapse:collapse'>";

    // Überschrift
   echo "<tr> <td> </td> </tr>";

   $lf = 1;
   while ($dsatz = mysqli_fetch_assoc($res))
   {
      echo "<tr>";
      echo "<td>$lf</td>";
      echo "<td>" . ". "  . $dsatz["regionName"] . "</td>";
      echo "</tr>";
      $lf = $lf + 1;
   }

   // Tabellenende
   echo "</table>";

   mysqli_close($con);
?>
