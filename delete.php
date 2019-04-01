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
function fetch_select() {
	var str=document.getElementById("table_select").value;
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
  xhttp.open("GET", "command.php?q3="+str, true);
  xhttp.send();
}
</script>


<h4>Delete Records </h4>
			
<p> Select a table and delete all corresponding records </p>
<br>



	
		  <select name="table_select" id="table_select">
		  <option value="">Select table</option>
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
			<br>
			<p><button onclick="fetch_select()"/>Submit</button></p>
			
			
			
			
			
			
		      <div id="t1"></div>
	</body>
</html>