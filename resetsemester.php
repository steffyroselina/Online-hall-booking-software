<html>
<head>
<title>NEW SEMESTER</title>
</head>
<body>
<br><br>
<form method="get" action="newsemester.php">
START MONTH<select name="start">
<?php
echo "<br><br><br>";
for($month=1;$month<=12;$month++)
{
echo "<option>".date("F",mktime(0,0,0,$month,1,2016))."</option>";
}
?>
</select>
<br><br><br>
END MONTH<select name="end">
<?php
for($month=1;$month<=12;$month++)
{
echo "<option>".date("F",mktime(0,0,0,$month,1,2016))."</option>";
}
?>
</select>
<br<br>
<input type="submit" value="reset">
</form> 
</body>
</html>                            
