<?php
$eventid=$_POST["eventid"];
$hall=$_POST["hall"];
include('connect.php');
if($hall==1)
{
$query="update hall1 ";
}
else
{
$query="update hall2 ";
}
$hall_query=$query."set booked='n',staffid=NULL where eventid='$eventid'";
$conn->query($hall_query);
$event_query="delete from events where eventid='$eventid' and hall='$hall'";
$conn->query($event_query);
echo "Event has been cancelled";
?>
