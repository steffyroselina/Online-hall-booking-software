<?php
session_start();
$user=$_SESSION["user"];
$audience=$_POST["audience"];
$speaker=$_POST["speaker"];
$month=$_POST["month"];
$day=$_POST["day"];
if($month==0)
{
$month=date("n");
}
if($day==0)
{
$day=date("j");
}
$selected_hours=$_POST["hours"];
include('connect.php');
for($hour=0;$hour<sizeof($selected_hours);$hour++)
{
$time=$selected_hours[$hour];
$day_code=date("dm",mktime(0,0,0,$month,$day,2000));
if($time<10)
{
$hall=1;
$query="update hall1 ";
}
else
{
$hall=2;
$time=$time-10;
$query="update hall2 ";
}
$event_id=$day_code.$time;
$hall_query=$query."set booked='y',staffid='$user' where eventid='$event_id';";
$conn->query($hall_query);
$query="select * from months where month='$month'";
$result=$conn->query($query);
$row=$result->fetch_assoc();
$year=$row["year"];
$date=date("Y-m-d H:0:0",mktime($time,0,0,$month,$day,$year));
$event_query="insert into events(eventid,staffid,hall,date,speaker,audience) values('$event_id','$user','$hall','$date','$speaker','$audience');";
$conn->query($event_query);
echo "<br>".$hall_query."<br>".$event_query;
}
?>                    
