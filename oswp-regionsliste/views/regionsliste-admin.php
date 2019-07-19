<!-- This file is used to markup the administration form of the widget. -->



<!-- Ab hier die Ausgabe im Control-Fenster des Adminbereiches -->

<?php
// Gettext einfügen
/* Make theme available for translation */
	load_plugin_textdomain( 'oswp-regionsliste', false, basename( dirname( __FILE__ ) ) . '/lang' );
 ?>
 
 <?php
	// Standardwerte setzen
	$CONF_os_name_rl = "Regionsliste";
	$CONF_db_server_rl = "127.0.0.1";
	$CONF_port_rl = "8002";
	//$CONF_callparameter = "secondlife://http|!!";
?>

<?php if (!isset($_POST['rlconfig'])): ?>

<!-- Start Abfrage Nutzer -->
<form class="container" action="" method="post">
    <input type="hidden" name="rlconfig" value="1" />
		
<!-- OpenSim Einstellung --> 
<!-- $CONF_os_name, $CONF_db_server, $CONF_db_user, $CONF_db_pass, $CONF_db_database -->
	<div class="row section">


    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  Heading Widget Name:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="Sim List" name="CONF_os_name_rl"/></p>
        </div>
    </div>
	
	<?php echo esc_html__( '  Database setting', 'oswp-regionsliste' ) ; ?>
	
	<div class="row section">	
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Server IP:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="127.0.0.1" name="CONF_db_server_rl"/></p>
        </div>
    </div>
 
	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Database:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_database_rl"/></p>
        </div>
    </div>

 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL User:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="opensim" name="CONF_db_user_rl"/></p>
        </div>
    </div>

	
 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  MySQL Password:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="password" placeholder="password" name="CONF_db_pass_rl"/></p>
        </div>
    </div>
	
	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  IP or adress HG Link:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" placeholder="myGrid.com" name="CONF_adress_rl"/></p>
        </div>
    </div>

 	<div class="row section">
    <p><label for="base" class="label control-label"><i class="dashicons dashicons-book" style="font-size:24px"></i><?php echo esc_html__( '  Port HG Link:', 'oswp-regionsliste' ) ; ?></b></label></p>
        <div class="row">
            <p><input class="input border" type="text" value="8002" name="CONF_port_rl"/></p>
        </div>
    </div>
	
<?php endif ?>

<?php
//print_r($_POST);
	if (isset($_POST['rlconfig']) AND $_POST['rlconfig'] == 1)
	{
		// wir schaffen unsere Variablen
		$CONF_os_name_rl  = $_POST['CONF_os_name_rl']; //variable name, string value use: %s
		$CONF_db_server_rl  = $_POST['CONF_db_server_rl']; //server http or IP, string value use: %s
		
		//Neu mit einer einfachen Verschlüsselngsmethode
		$CONF_db_user_crypt_rl = $_POST['CONF_db_user_rl']; //database user name, string value use: %s
		$CONF_db_pass_crypt_rl = $_POST['CONF_db_pass_rl']; //database password, string value use: %s
		$CONF_db_database_crypt_rl = $_POST['CONF_db_database_rl']; //database name, string value use: %s
		
		//Einfache Verschlüsselngsmethode
 
		if (function_exists('Encrypt')) {
			echo "- class geladen -";
		} else {
			include("oswp.class.php.class.php");
		} 

		//include("regionsliste.class.php.class.php");
		$blowfish_rl = new regionlistBlowfish("WJF8CJc22fECXvm2D4Yja7HH");
		
		$CONF_db_user_rl = $blowfish_rl->Encrypt( $CONF_db_user_crypt_rl );
		$CONF_db_pass_rl = $blowfish_rl->Encrypt( $CONF_db_pass_crypt_rl );
		$CONF_db_database_rl = $blowfish_rl->Encrypt( $CONF_db_database_crypt_rl );
		//Neu mit einer einfachen Verschlüsselngsmethode		
		
		$CONF_adress_rl = $_POST['CONF_adress']; //database name, string value use: %s
		$CONF_port_rl = $_POST['CONF_port']; //database name, string value use: %s
		//$CONF_callparameter = "secondlife://http|!!";
		
		global $wpdb;
		// Fehler anzeigen
		//$wpdb->show_errors();
		
		// Tabellen Name
		$tablename = $wpdb->prefix . "osregionlist";
		
		//Tabelle erstellen
		$charset_collate = $wpdb->get_charset_collate();
		
		// Neue Tabelleneinträge eintragen NEU: os_id mediumint (9) NOT NULL,
		$sqlx = "CREATE TABLE $tablename (
		  os_id mediumint (9) NOT NULL,
		  CONF_os_name_rl text NOT NULL,
		  CONF_db_server_rl text NOT NULL,
		  CONF_db_user_rl text NOT NULL,
		  CONF_db_pass_rl text NOT NULL,
		  CONF_db_database_rl text NOT NULL,
		  CONF_adress_rl text NOT NULL,
		  CONF_port_rl text NOT NULL,
		  PRIMARY KEY  (os_id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sqlx );

		// Erst Tabellen löschen dann schreiben os_id nicht vergessen.
		$wpdb->delete( $tablename, array( 'os_id' => 0 ) );
		
		// Eigentliche Daten speichern
		$sqlx2 = $wpdb->prepare("INSERT INTO $tablename (CONF_os_name_rl, CONF_db_server_rl, CONF_db_user_rl, CONF_db_pass_rl, CONF_db_database_rl, CONF_adress_rl, CONF_port_rl) values (%s, %s, %s, %s, %s, %s, %s)", $CONF_os_name_rl, $CONF_db_server_rl, $CONF_db_user_rl, $CONF_db_pass_rl, $CONF_db_database_rl, $CONF_adress_rl, $CONF_port_rl);
		dbDelta( $sqlx2 );
	}
?>