<!-- This file is used to markup the public-facing widget. -->

<?php
	global $wpdb;
	// Fehler anzeigen
	//$wpdb->show_errors();
	
	// Tabellenname erstellen
	$tablename = $wpdb->prefix . "osregionlist";
	
	// Auslesen der wp datenbank
	$CONF_os_name = $wpdb->get_var( "SELECT CONF_os_name FROM $tablename" );
	$CONF_db_server = $wpdb->get_var( "SELECT CONF_db_server FROM $tablename" );
	$CONF_db_user = $wpdb->get_var( "SELECT CONF_db_user FROM $tablename" );
	$CONF_db_pass = $wpdb->get_var( "SELECT CONF_db_pass FROM $tablename" );
	$CONF_db_database = $wpdb->get_var( "SELECT CONF_db_database FROM $tablename" );
	
	$CONF_adress = $wpdb->get_var( "SELECT CONF_adress FROM $tablename" );
	$CONF_port = $wpdb->get_var( "SELECT CONF_port FROM $tablename" );
	
	$con = mysqli_connect($CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database);
	$res = mysqli_query($con, "SELECT * FROM regions");
	
   // Überschrift
   echo "<h1>$CONF_os_name</h1>";
	
   // Tabellenbeginn
   echo "<table border='0' style='border-collapse:collapse'>";
   
	// Infos
	// geht
	// V3HG = secondlife://http|!!openmanniland.de|8002+Begin
	// geht nicht
	// Hop = hop://openmanniland.de:8002/Begin/92/164/23
	// HG = secondlife://openmanniland.de:8002/Begin/92/164/23
	// Local Grid = secondlife://Begin/92/164/23

   $lf = 1;
   while ($dsatz = mysqli_fetch_assoc($res))
   {
	  //$regionslink = "secondlife://http|!!" .  $dsatz["serverIP"] . "|8002+"  . $dsatz["regionName"];
	  $regionslink = "secondlife://http|!!" .  $CONF_adress . "|" . $CONF_port . "+" . $dsatz["regionName"];
	  $regionen = $dsatz["regionName"];
	  echo "<a href='$regionslink' target='linkliste'>$regionen</a><br>";
   }
   

   // Tabellenende
   echo "</table>";

	mysqli_close($con);
	$wpdb->flush(); //Clearing the Cache
?>
