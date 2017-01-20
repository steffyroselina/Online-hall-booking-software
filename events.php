<?php
session_start();
include("connect.php");

$user=$_SESSION["user"];
$hall=$_REQUEST["hall"];

$event_query="select eventid,date_format(date,'%W') as day,date_format(date,'%D %M') as date_month,hour(date) as hour,speaker,audience from events where staffid='$user' and hall='$hall' and date(date) >= curdate() order by date";

$user_events=$conn->query($event_query);
echo "<h3>HALL ".$hall."</h3>";
$num_of_events=mysqli_num_rows($user_events);
if($num_of_events==0)
{
echo "(no events)";
}
else
{
echo $num_of_events;
if($num_of_events==1)
{
echo " event booked";
}
else
{
echo " events booked";
}
echo "<br><br>";
echo "<table border='3'>
<thead>
<th>DATE</th>
<th>DAY</th>
<th>HOUR</th>
<th>SPEAKER</th>
<th>AUDIENCE</th>
<th></th></thead>
<tbody>";

while($event=$user_events->fetch_assoc())
{
$eventid=$event["eventid"];
$date=$event["day"];
$day=$event["date_month"];
$hour= $event["hour"];
echo "<tr><td>".$date;
echo "</td><td>".$day;
echo "</td><td>".$hour;
echo "</td><td>".$event["speaker"];
echo "</td><td>".$event["audience"];
echo "</td><td>";
echo "<input type='button' style='border:2px solid red;color:red;' value='CANCEL' onclick=cancelEvent("."'".$eventid."'".",$hall)>";
echo "</td></tr>";
}

echo "</tbody></table>";
}
?>
