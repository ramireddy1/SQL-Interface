<html>
<body style="margin:32px">
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<script>
function delete1() {
var x=document.getElementById("trdelete1").value;
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","command.php?q5="+x,true);
  xmlhttp.send();
}
</script>

<?php
include("mysqli_connect.php");
echo "<b>Database Name:</b> ". $db_name. "<br>";
//Creating Connection
$conn = mysqli_connect($host, $username, $password, "db_project")
or die("MySQL database '".$db_name."' not accessible.<br>\n");

//Query Interface Operations
if(isset($_GET['q1']))
{

$q = $_GET["q1"];

$startedtime = microtime(true);

$results = mysqli_query($conn, $q);

if(!$results)
{
	$res = mysqli_error($conn);
	echo "<font color='red'>Error: </font>".$res;
	exit;
}

$endtime = microtime(true);
$difference = $endtime-$startedtime;
$queryTime = number_format($difference, 10);

if($results == false) die("Some problem occured :<br>$q<br>");
  
echo "<b>Status:</b> Request Performed <br>\n";
echo "<br><b>Duration to exectue: </b>$queryTime seconds";

//if((strpos($q, 'select'))||(strpos($q,'SELECT')||)==0)
if(strpos(strtoupper($q),'SELECT')!==false)
{

if($results->num_rows > 0){
echo "<table class='tstyle'  >";
$index = 0;
$index1=0;

//while start
while($arr = mysqli_fetch_array($results))
{
	$index1++;
	//Table Heading
	if($index==0)
	{
	echo "<tr class='tstyle3'>";
	foreach($arr as $x => $x_value)
	{
	  
	if( intval($x)!== 0 || $x == '0') continue;
		
		echo "<th class='tstyle1' >".$x."</b></th>"; 
	}
	echo "</tr>";
	$index++;
	}
	
	
	//Table Content
	echo "<tr class='tstyle3'>";
  foreach($arr as $x => $x_value)
  {
	
    if( intval($x)!== 0 || $x == '0') continue;

    echo "<td class='tstyle1' >".$x_value."</b></td>"; 
  }
  echo "</tr>";
  
}
//while end
echo "</table>";
}

//echo "<br><b>Duration to exectue: </b>$queryTime seconds";
echo "<br><b>No. of rows returned:</b> $index1 ";
}

//if it update
if(strpos(strtoupper($q),'UPDATE')!==false)
{
	echo "Updated Successfully: $q";
}

//if it is insert
if(strpos(strtoupper($q),'INSERT')!==false)
{
	echo "New record inserted successfully: $q";

}

//if it is to alter
if(strpos(strtoupper($q),'ALTER')!==false)
if(strpos($q, 'alter')!== false)
{
	echo "Successfully altered";
}
}




 if(isset($_GET['q2']))
  {
	 $tablename=$_GET['q2'];
	 echo "<b>Table Name: ".$tablename;
	 
	 
	 //$query = "SELECT * FROM $tablename";
	 $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'db_project' AND TABLE_NAME = '$tablename'";
	 
	 $columnnames = mysqli_query($conn,$query)
	 or die("<br>$q<br>".mysqli_error($columnnames));
	 
	 
	 if($columnnames == false) die("Some problem occured :<br>$q<br>");
	  //echo "<b>Status:</b> Request Performed <br>\n";
	  
	   echo "<form action='command.php' name='readtable' method='post' enctype='multipart/form-data'>";
	  echo "<table class= 'tstyle' id='rams'>";
	  $index = 0;
		echo "<input type='hidden' id='custId' name='tablename' value='$tablename'>";
		//while($arr = mysqli_fetch_
		while($arr = mysqli_fetch_array($columnnames))
		{
			//if($index==0)
			//{
				
				$table = $tablename;
			foreach($arr as $x => $x_value)
			{
				
				if( intval($x)!== 0 || $x == '0') continue;
				echo "<tr class='tstyle3'>";
				//echo "<th class= 'tstyle1'>$x</th>";
				//echo "<td class= 'tstyle1'><input type='text' name='$x'></td>";
				
				echo "<th class= 'tstyle1'>$x_value</th>";
				echo "<td class= 'tstyle1'><input type='text' name='$x_value'></td>";
				
				
				echo "</tr>";
		 
			//}
			//$index++;
			
			
			echo "<br>";
			}
			
		}
		echo "</table>";
	
		echo "<input type='submit' id='myfile' name='reading' value='Insert'>";
		echo "</form>";
		
		
  }
  
  
   



if(isset($_POST['reading']))
{
	
	$tablename = $_POST['tablename'];
	echo "<br><h2>Single Insertion</h2>";
	echo "<b>Table Name:</b>".$tablename;
	

	
	$query = "SELECT * FROM $tablename";
	 
	 $columnnames = mysqli_query($conn,$query)
	 or die("<br>$q<br>".mysqli_error($columnnames));
	 
	 
	 if($columnnames == false) die("Some problem occured :<br>$q<br>");
	 
	  $str = "";
	  $index=0;
	  $index2=0;
	  
	  $query1 = "SELECT * FROM $tablename";
	 
	 $columnnames1 = mysqli_query($conn,$query)
	 or die("<br>$q<br>".mysqli_error($columnnames1));
	  
	  
	  
    while($arr = mysqli_fetch_array($columnnames))
		{
			
			
			if($index==0)
			{
					
				
				$table = $tablename;
			foreach($arr as $x => $x_value)
			{
				
				if( intval($x)!== 0 || $x == '0') continue;
				
				if($index2==0)
				{
				$str .= $_POST[$x];
				$index2++;
				}
				else{
					$str = $str.",".$_POST[$x];
				}
			}
		 
			
			$index++;
			
			
			echo "<br>";
			}
		
			
		} 
		//echo $str;
		
		
		$sql="insert into $tablename values($str)";//query string
	
		  
		  
			$start = microtime(true);
		 
			$inserts= mysqli_query($conn,$sql); //execute query insert data to database
		  //or die("<br>$sql<br>".mysqli_error($inserts));
			$end = microtime(true);
			$diff = $end-$start;
			$querytime = number_format($diff,10);
			echo "<br><b>Duration to execute: </b>$querytime seconds";
		     
			 echo "<table class='tstyle'>";
			 echo "<tr class='tstyle3'><th>Status</th><th>Query</th></tr>";
			 
		  if (!$inserts) {
			//echo "Error: $mysqli_error($inserts) ";
			$s = mysqli_error($conn);
			
			
			echo "<tr class='tstyle3'>";
		   echo "<td class='tstyle1' ><img src='fail.png' width='20' height='25' title='Logo of a company' /></td><td class='tstyle1' > $sql<br> <font color='red'>Error: $s </font> </td> ";
		   echo "</tr>";
			}
		  
		  
		  //if($inserts == false) die("The file is empty or unable to be read :<br>$sql<br>");
		  
		  
		  if($inserts)
		  {
		  
		  
		
		 echo "<tr class='tstyle3'>";
		  echo "<td class='tstyle1' ><img src='success.png' width='25' height='30' title='Logo of a company' /></td><td class='tstyle1' > $sql</td> ";
		 echo "</tr>";
		  
		  }
		  
	
		
		echo "</table>";
		
		
		
	
}






/*/*insert file operations*/

if(isset($_POST['read'])){//check if button have been click or not

		$start = microtime(true); //start time
		$tablenames = $_POST['tableselect']; //table selection
		
		$terminated=",";
		$file_type=$_FILES['file1']['type'];//get file type of selected file to read
		$allow_type=array('text/plain');//allow only file that have extesion with .txt
		$fieldall="";
		if(in_array($file_type,$allow_type)){//check if selected file type is match to the allow file type we have defined
		  move_uploaded_file($_FILES['file1']['tmp_name'],"files/".$_FILES['file1']['name']);//move file to specifice directory to be read 
		  $file=fopen("files/".$_FILES['file1']['name'],"r") or die ("Unable to open file!");//open file to read
		  
	
		  echo "<table class='tstyle'  cellspacing='5' cellpadding='8' >";
		  echo "<tr class='tstyle3'><th>Status</th><th>Query</th></tr>";
		  
		  while(!feof($file)){//check if not yet end of files while reading data
		  $line = fgets($file);//get data from selected file
		  
		  $values=str_replace($terminated,",",$line);//we use str_replace to replace the character we want to terminated to seperate the table columns
		  //$values = $line;
		  
		  
		  //creating table names
		  $query1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'db_project' AND TABLE_NAME = '$tablenames'";
	 
	 $columnnames = mysqli_query($conn,$query1)
	 or die("<br>$q<br>".mysqli_error($columnnames));
	 
	 if($columnnames == false) die("Some problem occured :<br>$q<br>");
	 $clnames="";
	 $i=0;
	 while($arr = mysqli_fetch_array($columnnames))
		{
	
				
			foreach($arr as $x => $x_value)
			{
				if( intval($x)!== 0 || $x == '0') continue;
				
				if($i==0)
				{
				$clnames.= "$x_value";
				$i++;
				}
				else
				{
				$clnames.= ",$x_value";
				}
			
			}
		}
		  
		  
		  //end of coloum name
		  
		  
		  $sql="insert into $tablenames($clnames) values($values)";//query string //i have added extra ($clnames) after some errors
	
			ini_set('max_execution_time', 10000); //maximum execution time
			$inserts= mysqli_query($conn,$sql); //execute query insert data to database
		  //or die("<br>$sql<br>".mysqli_error($inserts));
		     	 
		  if (!$inserts) {
			//echo "Error: $mysqli_error($inserts) ";
			$s = mysqli_error($conn);
			
			
			echo "<tr class='tstyle3'>";
		   echo "<td class='tstyle1' ><img src='fail.png' width='20' height='25' title='Logo of a company' /></td><td class='tstyle1' > $sql<br> <font color='red'> Error: $s </font> </td> ";
		   echo "</tr>";
			}
		  
		  
		  if($inserts)
		  {
		  
		  
		 echo "<tr class='tstyle3'>";
		  echo "<td class='tstyle1' ><img src='success.png' width='25' height='30' title='Logo of a company' /></td><td class='tstyle1' > $sql</td> ";
		 echo "</tr>";
		  
		  }
		
		  
		}
		
		echo "</table>";
		
		$end = microtime(true);
			$diff = $end-$start;
			$querytime = number_format($diff,10);
			echo "<br><b>Duration to execute: </b>$querytime seconds";
		
		fclose($file);//close the file after read
		unlink("files/".$_FILES['file1']['name']);//delete selected file after read to free up space
		//or you can move it to backup table is fine
		}else{
			echo "Please select only text file(.txt file is recomended)!";	
			//if file type doesn't allow we will return this message
		}
	}


	
	
	
	
	if(isset($_GET['q3']))
{
	//echo "rami<br>";
	$tablename = $_GET['q3'];
	//echo $tablename;
	$q1= "SELECT * FROM $tablename";
	$q = "DELETE FROM $tablename";
	ini_set('max_execution_time', 10000);
	$results1 = mysqli_query($conn, $q1);
	$row_cnt = mysqli_num_rows($results1);
	
	$startedtime = microtime(true);
	$results = mysqli_query($conn, $q);
	if(!$results)
	{
	$res = mysqli_error($conn);
	echo "<font color='red'>Error: </font>".$res;
	exit;
	}
	$endtime = microtime(true);
	$difference = $endtime-$startedtime;
	$queryTime = number_format($difference, 10);
	
	echo "<b>Results: </b>All rows of <b>$tablename</b> are deleted<br>";
	echo "<b>No of rows affected:<b> $row_cnt";
	echo "<br><b>Duration to exectue: </b>$queryTime seconds";
	
}



//bulk loading
if(isset($_POST['reads'])){//check if button have been click or not
		  echo "hello";
		$start = microtime(true); //start time
		$tablenames = $_POST['tableselect']; //table selection
		
		$terminated=",";
		$file_type=$_FILES['file1']['type'];//get file type of selected file to read
		$allow_type=array('text/plain');//allow only file that have extesion with .txt
		$fieldall="";
		if(in_array($file_type,$allow_type)){//check if selected file type is match to the allow file type we have defined
		  move_uploaded_file($_FILES['file1']['tmp_name'],"files/".$_FILES['file1']['name']);//move file to specifice directory to be read 
		//  $file=fopen("files/".$_FILES['file1']['name'],"r") or die ("Unable to open file!");//open file to read
		  echo "hello";
			$filename = "files/".$_FILES['file1']['name'];
			echo $filename;
		$sql2 = "LOAD DATA LOCAL INFILE '$filename' INTO TABLE `$tablenames` FIELDS TERMINATED BY ',' ENCLOSED BY '' LINES TERMINATED BY '\\r\\n'";
		$loaddata = mysqli_query($conn,$sql2);

		if (!$loaddata) {
		die('Could not load data from file into table: ' .mysqli_error($conn));

		}
		
		
		
		
		  
		
		$end = microtime(true);
			$diff = $end-$start;
			$querytime = number_format($diff,10);
			echo "<br><b>Duration to execute: </b>$querytime seconds";
		
		//fclose($file);//close the file after read
		unlink("files/".$_FILES['file1']['name']);//delete selected file after read to free up space
		//or you can move it to backup table is fine
		}else{
			echo "Please select only text file(.txt file is recomended)!";	
			//if file type doesn't allow we will return this message
		}
		
	}


	
	
	
	
	
	
	
	
	
	
	
	




















?>



<br />


</body>
</html>








