<html>
<head>
<title>AVHALL</title>
<link href='//fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
<link href='//fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>

<style>

table{
border-width:6px;
border-spacing:1px;
border-style:solid;
border-color:DimGrey;
border-collapse:separate;
font-size:25px;
}

td,th{
border-width:5px;
padding:5px;
border-style:ridge;
border-color:DimGrey;
}

td{
width:30px;
}

th{
height:20px;
}

input[type=button]{
border:1px solid black;
width:80px;
height:40px;
font-size:25px;
color:black;
font-family:Aclonica;
}

input[type=button].grey{
background-color:Grey;
}

input[type=button].long{
width:120px;
}

input[type=button].longer{
width:150px;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
</script>
<script>
var button_color=new Array();
var no_of_hours=0;
var selected_hours=new Array();
for(i=0;i<=19;i++)
{
var index=i.toString();
button_color[index]=0;
}
var month;
var day;
var reqObj=false;
if(window.XMLHttpRequest)
{
reqObj=new XMLHttpRequest();
}

function fetchMonth(select_month)
{
month=select_month;
if(reqObj)
{
reqObj.open("POST","days.php");
reqObj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
}
reqObj.onreadystatechange=function()
{
if(reqObj.readyState==4 && reqObj.status==200)
{
document.getElementById("month").innerHTML=reqObj.responseText;
}
}
reqObj.send("month="+month);
}

function fetchHour(date)
{
day=date;
selected_hours=[];
if(reqObj)
{
reqObj.open("POST","hours.php");
reqObj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
}
reqObj.onreadystatechange=function()
{
if(reqObj.readyState==4 && reqObj.status==200)
{
document.getElementById("hour").innerHTML=reqObj.responseText;
}
}
reqObj.send("mm="+month+"&dd="+date);
}

function setColor(btn)
{
var id=btn.id;
var property=document.getElementById(id);
if(button_color[id]==0)
{
selected_hours.push(id);
button_color[id]=1;
property.style.backgroundColor='red';
}
else
{
for(i=0;i<selected_hours.length;i++)
{
if(selected_hours[i]==id)
{
selected_hours.splice(i,1);
break;
}
}
button_color[id]=0;
property.style.backgroundColor='green';
}
}

function bookEvent()
{
var audi=document.getElementById("audience").value;
var spkr=document.getElementById("speaker").value;
$.post("book.php",
      {audience:audi,speaker:spkr,month:month,day:day,hours:selected_hours},
      function(data){window.location.replace("user.php");}
     );
}

$(document).ready(function(){
  month=0;
  $.post("days.php",
         {month:0}, 
         function(data){document.getElementById("month").innerHTML=data; } 
  );
  day=0;
  $.post("hours.php",
         {mm:0,dd:0}, 
         function(data){document.getElementById("hour").innerHTML=data;} 
  );
});

</script>
</head>
<body style="background-color:#FF9166;font-family:Audiowide;font-size:25px;">
<div>
Enter the details of the event<br><br>
AUDIENCE
<input type='text' id='audience' width='20px'>
<br><br>
SPEAKER
<input type='text' id='speaker' width='30px'>
<br><br>
Please select the month
<?php
include("connect.php");
$sql="select * from months";
$result=$conn->query($sql);
while($row=$result->fetch_assoc())
{
$month=$row['month'];
$year=$row['year'];
$month_name=date("F",mktime(0,0,0,$month,1,$year));
echo "<input type='button' class='grey longer' value='$month_name' onclick='fetchMonth($month)'>";
}
echo "<br><br>";
?>
</div>
<div id="month"></div><br><br>
<div id="hour"></div>
<br><br>
<br><br>
<div id="response"></div>
</body>
</html>              
