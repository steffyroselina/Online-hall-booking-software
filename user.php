<html>
<head>
<title>HOME</title>
<link href='//fonts.googleapis.com/css?family=Berkshire Swash' rel='stylesheet'>
<link href='//fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
<link href='//fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
<style>
table{
border-width:6px;
border-spacing:1px;
border-style:solid;
border-color:DimGrey;
border-collapse:separate;
}

td,th{
border-width:5px;
padding:5px;
border-style:ridge;
border-color:DimGrey;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
 
 $.post(
  "events.php", 
  {hall:1}, 
  function(data){document.getElementById("h1").innerHTML=data;} 
  );
 
 $.post(
  "events.php", 
  {hall:2}, 
  function(data){document.getElementById("h2").innerHTML=data;} 
  );

});

</script>

<script>

function cancelEvent(id,hall)
{
 user_confirms_cancel=confirm("Are you sure you want to cancel");
 if(user_confirms_cancel==true)
 {
   $.post("cancel.php",
   {eventid:id,hall:hall},
   function(data){
      location.reload();
      alert(data);
      }
   );
 }
}


</script>
</head>
<body style="background-color:#FF9166;">
<?php
session_start();
$user=$_SESSION['user'];
include('connect.php');
$result=$conn->query("select * from users where staffid='$user'");
$row=$result->fetch_assoc();
?>
<div style='background-color:DimGrey;height:160px;font-size:40pt;font-family:Berkshire Swash;color:black'>
<?php
echo strtoupper($row['staffname'])."<br>";
echo strtoupper($row['department']);
?>
</div>
<br><br>
<br><br><br>
<div style='font-family:Audiowide;font-size:50px;'>Would you like to book an event today?
<input type='button' style="background-color:Grey;border:1px solid black;width:120px;height:50px;font-size:25px;color:black;font-family:Aclonica;" value='YES' onclick="document.location.href='calendar.php'">
</div>

<br><br><br>
<div id="h1" style="width:40%;float:left">hall1</div>
<div id="h2" style="width:40%;float:left">hall2</div>

</body>
</html>
