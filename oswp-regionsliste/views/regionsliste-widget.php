<!-- This file is used to markup the public-facing widget. -->

<?php
	global $wpdb;
	// Fehler anzeigen
	//$wpdb->show_errors();
	
	// Tabellenname erstellen
	$tablename = $wpdb->prefix . "osregionlist";
	
	// Auslesen der wp datenbank
	$CONF_db_server = $wpdb->get_var( "SELECT CONF_db_server FROM $tablename" );
	$CONF_db_user = $wpdb->get_var( "SELECT CONF_db_user FROM $tablename" );
	$CONF_db_pass = $wpdb->get_var( "SELECT CONF_db_pass FROM $tablename" );
	$CONF_db_database = $wpdb->get_var( "SELECT CONF_db_database FROM $tablename" );
	
	$con = mysqli_connect($CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database);
	$res = mysqli_query($con, "SELECT * FROM regions");
	
   // Überschrift
   echo "<h2>Regionsliste</h2>";
	
   // Tabellenbeginn
   echo "<table border='0' style='border-collapse:collapse'>";

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
	$wpdb->flush(); //Clearing the Cache
?>
