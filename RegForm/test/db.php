<?PHP
	$moneytable ="money";
	// Make a MySQL Connection
	mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	mysql_select_db("Main") or die(mysql_error());
//	$qry ="Create Table $moneytable (id INT NOT NULL AUTO_INCREMENT, event VARCHAR( 40 ) NOT NULL ,date VARCHAR( 16 ) NOT NULL , paid VARCHAR( 16 ) NOT NULL ,participants VARCHAR( 1000 ) NOT NULL ,amount INT NOT NULL ,PRIMARY KEY ( id ))";
	$loaner ="socceranoo";
	$loanee ="arthisridhar";
	$amount =50;
	$qry = "UPDATE $loaner SET amount=amount-'$amount' WHERE user2='$loanee'";
	mysql_query($qry) or die(mysql_error());
	$qry = "UPDATE $loanee SET amount=amount+'$amount' WHERE user2='$loaner'";
	mysql_query($qry) or die(mysql_error());
?>
