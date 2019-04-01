<html>
<body style="margin:32px">

<head>

<?php include('header.php'); ?>



<script>
function showUser() {
var x=document.getElementById("mytextarea").value;

  
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
  xmlhttp.open("GET","command.php?q1="+x,true);
  xmlhttp.send();
}
</script>


</head>


<h1>SQL Interface</h1>

<fieldset>
<legend>Query</legend>


  <p><textarea id="mytextarea" rows="5" cols="160"></textarea></p>
  <p><button onclick="showUser()"/>Submit</button></p>



</fieldset>
<div id="txtHint"><b>Results</b></div>

</body>
</html>
