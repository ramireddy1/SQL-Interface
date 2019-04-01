<html>
<body style="margin:32px">

<head>

<?php include('header.php');

	include("mysqli_connect.php");
	$conn = mysqli_connect($host, $username, $password, "db_project")
	or die("MySQL database '".$db_name."' not accessible.<br>\n");

		echo "<br>";
	echo "<b>Database selected:</b> ". $db_name. "<br>";

 ?>
 <link rel="stylesheet" type="text/css" href="styles.css">
 
 </head>
 <body>
 
 <?php
 /*
 $sql2 = "LOAD DATA LOCAL INFILE 'temp.txt' INTO TABLE `test3` FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n'";
$loaddata = mysqli_query($conn,$sql2);

if (!$loaddata) {
	die('Could not load data from file into table: ' .mysqli_error());

}
*/

//create table in database
/*$sql1 = "
CREATE TABLE IF NOT EXISTS `test1` (
  `id` int(11) NOT NULL auto_increment,
  `type` text NOT NULL,
  `command` text NOT NULL,
  `value` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1";

$maketable = mysqli_query($conn,$sql1);
if (!$maketable) {
	die('Could not create table: ' .mysqli_error());
}
//load data into table
$sql2 = "LOAD DATA LOCAL INFILE 'temp.txt' INTO TABLE `test1` FIELDS TERMINATED BY ' ' ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' (`type` , `command` , `value`)";

$loaddata = mysqli_query($conn,$sql2);
if (!$loaddata) {
	die('Could not load data from file into table: ' .mysqli_error());

}
	*/
	
	

?>



     <!-- create a form interface to be read and insert data into database -->
		 <form action="command.php" name="readfile" method="post" enctype="multipart/form-data"> 
					
					<h3>
						Insert values into tables
					</h3>
					<h4>1. Bulk Loading </h4>
			
					<p> Select a table and upload a corresponding file (.txt) </p>
					<br>
					<b>Table : <b>
					<!--<select>
						<option value="games">Games</option>
						<option value="play">Play</option>
						<option value="players">Players</option>
						
					</select> -->
					
					
					<!-- PHP dynamic table select-->
					<?php 

					$sql = "SHOW TABLES FROM $db_name";
					$result = mysqli_query($conn,$sql);

					if (!$result) {
						echo "DB Error, could not list tables\n";
						echo 'MySQL Error: ' . mysql_error();
						exit;
					}
						echo "<select name='tableselect'>";
					while ($row = mysqli_fetch_row($result)) {
		
						echo "<option value=$row[0]>$row[0]</option>";
					}
						echo "</select>";
						mysqli_free_result($result);
	
	
					?>
					
					
					<label for="txt-file"><b>Open File(*.txt):</b></label>
					<input type="file" name="file1"><!--file to read-->
					 <input type="submit" id="myfile" name="reads" value="Insert"> <!--button to submit the form to read data from the file
			<!--	<input type="button" id="myfile" name="read" onclick="show()">Submit</button><!--button to submit the form to read data from the file--> 
				
		  </form> 
		  



















 </body>
 </html>
 
 
 
 
 