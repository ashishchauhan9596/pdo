<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Creates a mysqldump and emails the resulting dump file
$dbhost = "localhost";

// Edit the following values
$dbuser = "root"; //the mysql user
$dbpass = "root"; //the mysql password
$date = @date("Y-m-d");
$path = "/var/www/html/backups/"; //the directory path to where you want to store your backups
//get the list of databases
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
$db_list = mysqli_query($link,"SHOW DATABASES");
//iterate over the list of databases
while ($row = mysqli_fetch_object($db_list)) {
 $dbname = $row->Database;
 $dir = $path.$date;

 //if the db directory doesn't exist yet, create it
 if (!is_dir($dir)):
 mkdir($dir);
 endif;
 //create the file name for the backup (if you want to run the update more frequently than once a day, add more specificity to the date
 $backupfile = $dir."/".$dbname.'_'.@date("Y-m-d").'.gz';

 //make the system call to mysqldump
 system("mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname | gzip > $backupfile");
}
//close the mysql connection
mysqli_close($link);
?>