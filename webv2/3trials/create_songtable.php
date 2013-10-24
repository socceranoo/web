<?php
// Make a MySQL Connection
mysql_connect("localhost", "root", "Orange") or die(mysql_error());
mysql_select_db("Main") or die(mysql_error());
$songtable = "song";
$tagtable = "songtag";
$maptable = "songtagmap";

mysql_query("DROP TABLE $songtable");
mysql_query("DROP TABLE $tagtable");
mysql_query("DROP TABLE $maptable");
// Create a MySQL table in the selected database
mysql_query("CREATE TABLE $songtable(
song_id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(song_id),
name VARCHAR(256), 
album VARCHAR(256), 
artist VARCHAR(256), 
path text)")
or die(mysql_error());  

mysql_query("CREATE TABLE $tagtable(
tag_id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(tag_id),
username VARCHAR(256), 
tagname VARCHAR(256))")
or die(mysql_error());  

mysql_query("CREATE TABLE $maptable(
map_id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(map_id),
song_id INT, 
tag_id INT, 
FOREIGN KEY (song_id) REFERENCES song(song_id),
FOREIGN KEY (tag_id) REFERENCES songtags(tag_id))")
or die(mysql_error());  

echo "Table Created!";
?>
