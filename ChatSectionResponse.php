<?php
include("connection.php");
session_start();

if(isset($_POST["fid"]))
{
$uid_session = $_SESSION["uid_session"];
$image = $_POST['image'];
$fid = $_POST['fid'];
$settime = $_POST['settime'];
$datetime = date("Y-m-d H:i:s");

$ins = "Insert into chats(uid,fid,endtime,message,file,datetime,seconds,status) values('$uid_session','$fid','','','$image','$datetime','$settime','Unseen')";						
if(mysqli_query($con, $ins))
{
	echo "true"; 									
}	
else
{
								
}	


  
}
else
{
$valid_extensions = array('jpeg', 'jpg', 'png');
		$path = 'upload/'; // upload directory
		$img = $_FILES['image']['name'];
		$tmp = $_FILES['image']['tmp_name'];

		// get uploaded file's extension
		$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		
		if(in_array($ext, $valid_extensions)) 
		{ 
			$path = $path.strtolower($img);
			move_uploaded_file($tmp,$path);
			echo $img;
		}
		else
		{
		echo "false";
		}
}

		
?>