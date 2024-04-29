<?php session_start();
include("connection.php");
include('openssl_encrypt_decrypt.php');
$key = "steganographyabc";


$uid_session = $_SESSION["uid_session"];
$fid = $_POST['fid'];
$currtime = $_POST['currtime'];

//$sel = "select chatid,uid,fid,message,file,datetime from chats where (uid ='$fid' OR fid ='$fid') AND (uid ='$uid_session' OR fid ='$uid_session') and endtime >= '$currtime' order by datetime desc";
$sel = "select chatid,uid,fid,message,file,datetime,webcam from chats where (uid='$uid_session' and fid='$fid' and endtime='') OR ((uid ='$uid_session' OR fid ='$uid_session') AND (uid ='$fid' OR fid ='$fid') and endtime >= '$currtime') order by datetime desc";
$rel=$con->query($sel);	
if (!$rel) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$fdata = "";
date_default_timezone_set('Asia/Kolkata');
$currtime_new = date("Y-m-d H:i:s");

while($data=mysqli_fetch_array($rel))
{

$cid = $data['chatid'];
$id1 = $data['uid'];
$id2 = $data['fid'];
$msg = $data['message'];
$file = $data['file'];
$dtime = $data['datetime'];
$webcam = $data['webcam'];

$fdata .= $cid."|".$id1."|".$id2."|".$msg."|".$file."|".$dtime."|".$webcam; 

$fdata .= "]";
}


			$sel1 = "select seconds,chatid from chats where fid='$uid_session' and endtime='' or endtime = null";
			$rel1=$con->query($sel1);	
					
			while($data1=mysqli_fetch_assoc($rel1))
			{
				$seconds = $data1['seconds'];
				$chatid = $data1['chatid'];
			
				date_default_timezone_set('Asia/Kolkata');
				
				if($seconds == "Infinity")
				{
					$datetime = date("Y-m-d H:i:s");
					$datetime_new = strtotime($datetime);
					$new_date = strtotime('+ 10 year', $datetime_new);
					$endtime= date("Y-m-d H:i:s", $new_date);
				}
				else
				{
					$secs = $seconds + 2;
					$datetime = date("Y-m-d H:i:s");
					$endtime= date("Y-m-d H:i:s", (strtotime(date($datetime)) + $secs )); 
				}						
			
				$upd = "Update chats set endtime='".$endtime."' where chatid='$chatid'";							
			
				if(mysqli_query($con, $upd))
				{
					
					//echo "<script>window.location.href='ChatSection.php?fid=".$fid."'</script>";									
				}	
				else
				{
					echo "<script>alert('Invalid');</script>";							
				}	 

			}		
			
			
			

	

$output['currtime_new'] = $currtime_new;
$output['fdata'] = $fdata;

echo json_encode($output);  
 
?>