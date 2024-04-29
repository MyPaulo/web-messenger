<?php
    include("connection.php");
session_start();
    //$img = $_POST['canvas'];
    $img = $_POST['image'];
	$select_time1 = $_POST['time'];
	if($select_time1 != "")
	{
		$folderPath = "upload/";
 
	    $image_parts = explode("data:image/png;base64,", $img);
		
	    $image_type_aux = explode("image/", $image_parts[0]);
		
	    $image_type = $image_type_aux[1];
	  
	    $image_base64 = base64_decode($image_parts[1]);
	    $fileName = uniqid() . '.png';
	  $datetime = date("Y-m-d H:i:s");
	    $file = $folderPath . $fileName;
	    file_put_contents($file, $image_base64);
	  
		$uid_session = $_SESSION["uid_session"];
		
		$ins = "Insert into chats(uid,fid,endtime,message,file,datetime,seconds,status,webcam) values('$uid_session','".$_POST["fid"]."','','','$fileName','$datetime','$select_time1','Unseen','')";						
		if(mysqli_query($con, $ins))
		{
			//echo "<script>window.location.href='ChatSection?fid=".$_POST['fid']."'</script>";							
		}	
		else
		{
										
		}	
	}
    else
    {
    	echo "time error";
    	//echo "<script>alert('kindly select time ');window.location.href='ChatSection.php?fid=".$_POST["fid"]."';</script>";
    }
	
	
  
?>