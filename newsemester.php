<html>
<head>
<title>NEW SEMESTER</title>
<body>
<?php
$start_month=$_GET["start"];
$end_month=$_GET["end"];
$conn=new mysqli("localhost","root","steffy","avhall");
$conn->query("delete from hall1");
$conn->query("delete from hall2");
$conn->query("delete from months");
$conn->query("delete from events");
$start=date("n",strtotime($start_month));
$end=date("n",strtotime($end_month));
$year=date("Y");
$change_year=0;
if($start>$end)
{
$no_of_months =(13-$start)+$end;
echo $no_of_months;
}
if($start<$end)
{
$no_of_months=$end-$start+1;
echo $no_of_months;
}
$month=$start;
for($m=1;$m<=$no_of_months;$m++)
{
$no_of_days=date("t",mktime(0,0,0,$month,1,$year));
for($day=1;$day<=$no_of_days;$day++)
{
if(date("w",mktime(0,0,0,$month,$day,$year))==0)
{
continue;
}
$code=date("dm",mktime(0,0,0,$month,$day,$year));
for($hour=0;$hour<=9;$hour++)
{
$hourcode=$code.$hour;
$conn->query("insert into hall1(eventid,booked) values('$hourcode','n')");
$conn->query("insert into hall2(eventid,booked) values('$hourcode','n')");
}
}
$conn->query("insert into months(month,days,year) values('$month','$no_of_days','$year')");
$month=$month+1;
if($month==13)
{
$month=1;
$year++;
}
}
?>
<h1><center>Database Reset</center></h1>
</body>
</html>
