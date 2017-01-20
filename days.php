<html>
<body>
<?php
$month=$_REQUEST["month"];
$function=$_REQUEST["function"];
echo $function;
include('connect.php');
if($month==0)
{
$month_name=date("F");
$month=date("n");
}
else
{
$month_name=date("F",mktime(0,0,0,$month,1,$year));
}
$result=$conn->query("select * from months where month='$month'");
$row=$result->fetch_assoc();
$no_of_days=$row['days'];
$year=$row['year'];

?>
<table style="width:80%;" border="3">
<th colspan="7">
<?php echo $month_name;?>
</th>
<tr>
<td>SUN</td>
<td>MON</td>
<td>TUE</td>
<td>WED</td>
<td>THUR</td>
<td>FRI</td>
<td>SAT</td>
</tr>
<tr>
<?php
$day=1;
$count=0;
while($count!=date("w",mktime(0,0,0,$month,1,$year)))
{
echo "<td></td>";
$count++;
}
while($day<=$no_of_days)
{
while($count!=7)
{
echo "<td><input type='button' class='grey' value='$day' onclick='fetchHour($day)'></td>";
$day++;
$count++;
if($day>$no_of_days)
{
break;
}
}
echo "</tr><tr>";
$count=0;
}
?>
</tr>
</table>
</body>
</html>

