<?php session_start();
include("connection.php");

$uid_session = $_SESSION["uid_session"];

$textbx_msg = $_POST['textbx_msg'];
$fid = $_POST['fid'];
$settime = $_POST['settime'];

date_default_timezone_set('Asia/Kolkata');
$datetime = date("Y-m-d H:i:s");

$ins = "Insert into chats(uid,fid,endtime,message,file,datetime,seconds,status,webcam) values('$uid_session','$fid','','$textbx_msg','','$datetime','$settime','','')";						
if(mysqli_query($con, $ins))
{
										
}	
else
{
								
}	

$sel = "select chatid from chats order by chatid desc Limit 1";
$rel=$con->query($sel);	
$data=mysqli_fetch_assoc($rel);
$chatid=$data['chatid'];

$output['textbx_msg'] = $textbx_msg;
$output['datetime'] = $datetime;
$output['seconds'] = $settime;
$output['chatid'] = $chatid;
$output['file'] = $file;
 
echo json_encode($output);  
  
?>