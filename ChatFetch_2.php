<?php session_start();
include("connection.php");
include('AESEnc.php');
$key = "steganographyabc";


$uid_session = $_SESSION["uid_session"];

$fid = $_POST['fid'];
$currtime = $_POST['currtime'];
$chatid = $_POST['chatid'];

$sel = "select * from chats where chatid='$chatid'";
$rel=$con->query($sel);	
$data=mysqli_fetch_assoc($rel);
$endtime=$data['endtime'];
$currtime = strtotime($currtime);
$endtime_new = strtotime($endtime);

if(strtotime($currtime) <= strtotime($endtime_new))
{
	//display message;
			
		$message=$data['message'];					
		$datetime=$data['datetime'];
		
		$sel1 = "select name from user where uid='$fid'";
		$rel1=$con->query($sel1);	
		$data1=mysqli_fetch_assoc($rel1);
		$friendname=fnDecrypt($data1['name'], $key);
		
	
}
else
{
	
}



/*$sel1 = "select chatid from chats where uid ='$fid' and fid ='$uid_session'";
$rel1=$con->query($sel1);	
$data1=mysqli_fetch_assoc($rel1);
$chatid=$data1['chatid'];*/					

	

date_default_timezone_set('America/Toronto');
$currtime_new = date("Y-m-d H:i:s");	

//$currtime_new= date("Y-m-d H:i:s", (strtotime(date($currtime)) + $seconds )); 
//$output['currtime'] = $currtime;



$output['Data'] = $currtime_new;
$output['endtime'] = $endtime;

$output['message'] = $message;
$output['datetime'] = $datetime;
$output['friendname'] = $friendname;
$output['chatid'] = $chatid;


	

echo json_encode($output);  
 
?>