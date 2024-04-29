<?php session_start();
include("connection.php");

$uid_session = $_SESSION["uid_session"];

$fid = $_GET['fid'];
$sel = "select seconds,chatid from chats where fid='$uid_session' and endtime=''";

			$rel=$con->query($sel);	
					
			while($data=mysqli_fetch_assoc($rel))
			{
				$seconds = $data['seconds'];
				$chatid = $data['chatid'];
			
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
					
														
				}	
				else
				{
					echo "<script>alert('Invalid');</script>";							
				}	 



			}
			
			echo "<script>window.location.href='ChatSection.php?fid=".$fid."'</script>";
			 
?>