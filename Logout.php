<?php session_start(); 
?>


<!DOCTYPE html>

<html>
<head>
<title></title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


</head>

<body>

<?php 

if (isset($_SESSION['uid_session']) && !empty($_SESSION['uid_session']))
{
	session_destroy();
	echo "<script>window.location.href='Login.php'</script>";
}
else if(isset($_SESSION['friendid_session']) && !empty($_SESSION['friendid_session']))
{
	session_destroy();
	echo "<script>window.location.href='Login.php'</script>";
}
	
?>


</body>

</html>
