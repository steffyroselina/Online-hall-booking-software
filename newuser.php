<html>
<head>
<title>NEW USER</title>
</head>
<body>
<?php
if(isset($_POST["add"]))
{
$conn=new mysqli("localhost","root","steffy","avhall");
$id=$_POST["id"];
$name=$_POST["name"];
$dept=$_POST["dept"];
$pass=$_POST["password"];
$sql="insert into users values('$id','$name','$dept','$pass')";
if(mysqli_query($conn,$sql))
{
echo "<br><br>New Account Added<br><br>";
}
else 
{
echo mysqli_error();
}
/*if(isset($_POST["prev"]))
{
$ref=$_SERVER['HTTP_REFERER'];
header("Location:$ref");
}*/
$conn->close();
}
else
{
?>
<form name="users" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<br>STAFF ID<input type="text" name="id"/><br><br>
STAFF NAME<input type="text" name="name"/><br><br>
DEPARTMENT<input type="text" name="dept"/><br><br>
PASSWORD<input type="text" name="password"/><br><br>
<input type="submit" value="ADD ACCOUNT" name="add"/>
<input type="reset" value="RESET"/>
</form>
<?php
}
?>
</body>
</html>
