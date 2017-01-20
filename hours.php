<html>
<?php
$mm=$_REQUEST["mm"];
$dd=$_REQUEST["dd"];

if($mm==0)
{
$mm=date("n");
}
if($dd==0)
{
$dd=date("j");
}
include('connect.php');
$result=$conn->query("select * from months where month='$mm'");
$row=$result->fetch_assoc();
$yy=$row['year'];
$code=date("dm",mktime(0,0,0,$mm,$dd,$yy));
echo "<body><div>".$dd."-".$mm."-".$yy."<br><br>HALL 1<br>";
echo "<br>";
for($hour=0;$hour<10;$hour++)
{
$event=$code.$hour;
$result=$conn->query("select booked from hall1 where eventid='$event'");
$row=$result->fetch_assoc();
echo "<form>";
if($row['booked']=='y')
{
echo "<input type='button' class='long' value='booked' style='background-color:white;'>";
continue;
}
echo "<input type='button'  id='$hour' value='$hour' style='background-color:Green;' onclick='setColor(this)'>";
}

echo "<br><br>HALL 2<br><br>";
for($hour=0;$hour<10;$hour++)
{
$event=$code.$hour;
$result=$conn->query("select booked from hall2 where eventid='$event'");
$row=$result->fetch_assoc();
if($row['booked']=='y')
{
echo "<input type='button' class='long' value='booked' style='background-color:white;'>";
continue;
}
$button_id=$hour+10;
echo "<input type='button' id='$button_id' value='$hour' style='background-color:Green;' onclick='setColor(this)'>";
}
echo "<br><br>";
echo "<input type='button' class='long' value='BOOK' onclick='bookEvent()'>";
echo "</form>";
?>
</div>
</body>
