# oswp-regionsliste

Das Plugin ist noch nicht fertig, es funktioniert aber schon.

Oswp was bedeutet das? OpenSimulator Wordpress um es kurz zu sagen.

Diese Plugin Reihe ist dafür gedacht den OpenSimulator mit Wordpress zu kombinieren, zu erweitern oder zu ergänzen.

Plugin Widgets stehen nach dem aktivieren im Plugin Bereich  unter „Design“ „Widgets“ zur Verfügung.

### Setup

Die Plugins haben noch keine echte einstellmöglichkeit, sobald ich begriffen habe wie das geht werde ich diese hinzufügen.

Unter „Plugins“ „Editor“ können die Plugins geändert werden.

Hierzu muss erst rechts das „zu bearbeitende Plugin“ ausgewählt werden.

Unter „Plugin Dateien“ das Widget Plugin auswählen und die Zeile „// Konfig Anfang“ suchen.

Hier die Daten die in der Robust.ini oder in der GridCommon.ini stehen eintragen.

„localhost“ kann meist nur geändert werden wenn man auf dem Zielserver Externen mySQL zugriff erlaubt.

Dort folgende Datenbank Einträge laut eurer OpenSim Konfiguration anpassen:

      /* MySQL Database */
      $CONF_db_server   = "localhost";		     //Your Database-Server
      $CONF_db_user  = "databaseuser";       	             // login
      $CONF_db_pass    = "password";     	     // password
      $CONF_db_database   = "opensimdatabasename"; // Name of BDD


## TODO: 

Einstellungen über Wordpress funktionieren nicht.

Automatischer Link muss noch rein.
