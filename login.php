<?php
session_start();
?>
<html>
<head>
<title>LOGIN</title>
</head>
<body>
<?php
if(isset($_POST['login']))
{
$conn=new mysqli("localhost","root","steffy","avhall");
$user=$_POST['uname'];
$password=$_POST['upass'];
$result=$conn->query("select * from users where staffid='$user' and password='$password'");
$num=$result->num_rows;
if($num==1)
{
if($user=='admin')
{
$_SESSION['user']=$user;
header('Location:admin.html');
}
else
{
$_SESSION['user']=$user;
header('Location:user.php');
}
}
else
{
header('Location:login.php');
}
}
else
{
?>
<form method='post' action='<?php echo $_SERVER['PHP_SELF'];?>'>
<br><br>
USERNAME<input type="text" name="uname">
<br><br><br>
PASSWORD<input type="password" name="upass">
<input type="submit" name="login" value="LOGIN">
<?php
}
?>
</form>
</body>
</html>
