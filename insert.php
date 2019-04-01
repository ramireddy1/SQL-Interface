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
 




<script>
function fetch_select(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("t1").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("t1").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "command.php?q2="+str, true);
  xhttp.send();
}
</script>













</head>




<body>
    <!-- create a form interface to be read and insert data into database -->
		 <form action="command.php" name="readfile" method="post" enctype="multipart/form-data"> 
					
					<i>
						Insert values into tables
					</i>
					<h3>1. Sinlgle insertion </h3>
						<h4>a. Insertion by file</h4>
			
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
					 <input type="submit" id="myfile" name="read" value="Insert"> <!--button to submit the form to read data from the file
			<!--	<input type="button" id="myfile" name="read" onclick="show()">Submit</button><!--button to submit the form to read data from the file--> 
				
		  </form> 
		  
		  
		  
		  
 
		  <h4>b. Single row insertion </h4>
		  
		  
		  
		  <form action="">
		  <select name="table_select" onchange="fetch_select(this.value)">
		  <option>Select table</option>
		  <?php 

					$sql = "SHOW TABLES FROM $db_name";
					$result = mysqli_query($conn,$sql);

					if (!$result) {
						echo "DB Error, could not list tables\n";
						echo 'MySQL Error: ' . mysql_error();
						exit;
					}
						
					while ($row = mysqli_fetch_row($result)) {
		
						echo "<option value=$row[0]>".$row[0]."</option>";
					}
						
	
			?>
			
			</select>
			</form>
			
		
		 <div id="t1"></div>
		 
		 
		 <!-- Bulk Loading -->
		 <form action="command.php" name="readfile" method="post" enctype="multipart/form-data"> 
					
					
					<h3>2. Bulk Loading </h3>
			
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