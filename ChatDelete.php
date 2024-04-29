<?php session_start();
include("connection.php");

$seconds = $_POST['seconds'];
$uid_session = $_SESSION["uid_session"];
$fid = $_POST['fid'];

if($seconds == 11)
{
	$seconds = "Infinity";
}


	$sel = "select * from chats where uid in ('$uid_session','$fid') and fid in ('$fid','$uid_session') and seconds = '$seconds'";
	$rel=$con->query($sel);	
	
	if(mysqli_num_rows($rel) > 0){
		
		$data=mysqli_fetch_assoc($rel);
		//chatid = $data['chatid'];
		if($seconds == "Infinity")
		{

		}
		else
		{
			$delete = "delete from chats where uid in ('$uid_session','$fid') and fid in ('$fid','$uid_session') and seconds = '$seconds'";							
			if(mysqli_query($con, $delete))
			{
				//echo'Chat Deleted';
				//echo $chatid;
				
			}	
			else
			{							
			}	
		}
		
	}
	else
	{
		//$seconds++;
	}
	

if($seconds == "Infinity")
{
	$seconds = "Infinity";
}	
else
{
	$seconds++;	
}	
	

//$output['chatid'] = $chatid;
$output['seconds'] = $seconds;
 
echo json_encode($output);	  
?>