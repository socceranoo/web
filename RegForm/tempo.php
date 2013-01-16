<?PHP
	$name_max=128;
	$sum_max=1000;
	$skill_max=500;
	$edu_max=1000;
	$exp_max=65535;
	$proj_max=65535;
	$award_max=2000;
	$act_max=2000;
	$table ="resume";
	// Make a MySQL Connection
	$link = mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	mysql_select_db("Main") or die(mysql_error());
	$qry = "Create Table $table (".
		"id INT NOT NULL AUTO_INCREMENT ,".
		"fkey_regusers INT NOT NULL,".
		"name VARCHAR($name_max) ,".
		"summary TEXT($sum_max) ,".
		"skills TEXT($skill_max) ,".
		"education TEXT($edu_max) ,".
		"experience TEXT($exp_max) ,".
		"projects TEXT($proj_max) ,".
		"awards TEXT($award_max) ,".
		"activities TEXT($act_max) ,".
		"PRIMARY KEY (id)".
		")";
	$qry="select column_name from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='resume'";
	$qry="select * from $table where fkey_regusers='4'";
	if(!$result =mysql_query($qry))
        {
            print "Error creating the table \nquery was\n $qry";
		print mysql_error($link);
            return false;
        }
        $row=mysql_fetch_array($result);
        if ($row['tagline'] != "")
                $role=$row['tagline'];
	echo $role."\n";
	$str = '</li> abcd </li> </li> efgh';
	echo preg_replace('~</li>(?!.*</li>)~', '</li></ul>', $str),"\n";
/*
	while($contents=mysql_fetch_array($result))
	{
		echo "Key: Value: $contents[0]\n";
	}
*/


?>
