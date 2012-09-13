<?PHP
	$moneytable ="money";
	// Make a MySQL Connection
	mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	mysql_select_db("Main") or die(mysql_error());
	$qry = "Create Table $moneytable (".
                                        "id INT NOT NULL AUTO_INCREMENT ,".
                                        "event VARCHAR( 40 ) NOT NULL ,".
				        "d VARCHAR( 250 ) NOT NULL ,".
                                        "date VARCHAR( 16 ) NOT NULL ,".
                                        "paid VARCHAR( 16 ) NOT NULL ,".
                                        "participants VARCHAR( 1000 ) NOT NULL ,".
                                        "amount INT NOT NULL ,".
                                        "PRIMARY KEY ( id )".
                                        ")";

//	$qry ="Create Table $moneytable (id INT NOT NULL AUTO_INCREMENT, event VARCHAR( 40 ) NOT NULL ,date VARCHAR( 16 ) NOT NULL , paid VARCHAR( 16 ) NOT NULL ,participants VARCHAR( 1000 ) NOT NULL ,amount INT NOT NULL ,PRIMARY KEY ( id ))";
	mysql_query($qry) or die(mysql_error());
?>


