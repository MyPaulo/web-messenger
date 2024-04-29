<?php session_start();
include("connection.php");

$seconds = $_POST['seconds'];
$uid_session = $_SESSION["uid_session"];
$fid = $_POST['fid'];

$sel = "select chatid from chats where uid = '$uid_session' and fid='$fid' and seconds = '$seconds'";
$rel=$con->query($sel);	
if(mysqli_num_rows($rel) > 0){
	
	$data=mysqli_fetch_assoc($rel);
	$chatid = $data['chatid'];
	
	$delete = "delete from chats where uid = '$uid_session' and fid='$fid' and seconds = '$seconds'";							
	if(mysqli_query($con, $delete))
	{
		//echo'Chat Deleted';
		//echo $chatid;
	}	
	else
	{							
	}	
}
else
{
	//$seconds++;
}
$seconds++;
$output['chatid'] = $chatid;
$output['seconds'] = $seconds;
 
echo json_encode($output);	  
?>