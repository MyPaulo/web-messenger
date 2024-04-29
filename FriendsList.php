<?php include('UserHeader.php');
include('openssl_encrypt_decrypt.php');

$val = !empty($_SESSION["uid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php'</script>";
}
$uid_session = $_SESSION["uid_session"];

$key = "steganographyabc";
 
?>

<div class="middlecontent">
<div class="container">


	<div id="searchbox">
	 <form method="post">
		<div class="input-group" style="width: 40%;">
			<input name="search_name" type="text" class="form-control" placeholder="Search Email ID or Contact No.">
			<div class="input-group-btn">
				<button class="btn btn-primary" name="btn_search" type="submit">
					<i class="fa fa-search" aria-hidden="true" style="font-size: 17px;"></i>
				</button>
			</div>
		</div>	
	  </form>	
	</div>		

</br>

	<table class="table table-bordered table-hover">
			
	<?php
	
	$arr = array();
	
	$sel = "select Distinct * from friends where uid='$uid_session' or fid='$uid_session'";	  	
	$rel=$con->query($sel);
	if(mysqli_num_rows($rel)==0)
	{			  
		echo "<center><h3>No records found</h3></center>";
		echo "<script>document.getElementById('searchbox').style.display='none'</script>";
	}
	else
	{
		echo'<thead style="background-color:grey;color:white">           
		<tr>                  						
		<th>Name</th>
		<th>Email ID</th>
		<th>Contact No.</th>
		<th>Action</th>
		</tr>
		</thead>

		<tbody>';
		
		while($data=mysqli_fetch_array($rel))
		{
			$uid = $data['uid'];
			$fid = $data['fid'];
			
			if($fid != $uid_session)
			{
				$arr[] = $fid;
			}
			else
			{
				$arr[] = $uid;
			}
			
		}
	

	$len = count($arr);

	for($i = 0; $i<$len; $i++)
	{
		
		$search_name="";

if(isset($_POST['btn_search']))
{
   $search_name = $_POST['search_name'];
}
else
{
   $search_name = "";   
}
	

if($search_name == "")
{
	$sel1 = "select  uid,name,email,mobileno from user where uid = '$arr[$i]'";
}
else
{
	$search_name = encrypt_decrypt('encrypt', $search_name);	
    $sel1 = "select  uid,name,email,mobileno from user where uid = '$arr[$i]' and (email like '%$search_name%' or mobileno like '%$search_name%')";	
}

		
	$rel1=$con->query($sel1);
		
		
	if(mysqli_num_rows($rel1)==0)
	{			  
		echo "<center><h3>No records to display</h3></center>";
		echo "<script>document.getElementById('searchbox').style.display='none'</script>";
	}
	else
	{
		echo "<script>document.getElementById('searchbox').style.display='block'</script>";	
		
			  
		while($data1=mysqli_fetch_array($rel1))
		{
			
				
			$name=encrypt_decrypt('decrypt', $data1['name']);
			$email=encrypt_decrypt('decrypt', $data1['email']);
			$mobileno=encrypt_decrypt('decrypt', $data1['mobileno']);
			//$uid=$data['uid'];
			$fid=$data1['uid'];
					
			echo'<tr style="color:black">
			<td>'.$name.'</td>
			<td>'.$email.'</td>	
			<td>'.$mobileno.'</td>
			<td><a href="FriendsList1.php?fid='.$fid.'" class="btn btn-primary">Chat</a></td>
			</tr>';			
		}
		
	}

	}
	
	echo"</tbody>";

}	
		
	?>
				 
  </table>
   
</div>
</div>
</div> 
  
<?php 
  
if(isset($_POST['btn_submit']))
{  	
    $name = $_POST['name'];
	$encname = encrypt_decrypt('encrypt', $name);
	
	$gender = $_POST['gender'];
	$encgender = encrypt_decrypt('encrypt', $gender);
	
    $email = $_POST['email'];
	$encemail = encrypt_decrypt('encrypt', $email);
	
	$mnumber = $_POST['mnumber'];
	$encmnumber = encrypt_decrypt('encrypt', $mnumber);
	
	$age = $_POST['age'];
	$encage = encrypt_decrypt('encrypt', $age);
	
	$pwd = $_POST['pwd'];
	$encpwd = encrypt_decrypt('encrypt', $pwd);
	
	$cpwd = $_POST['cpwd'];
	$enccpwd = encrypt_decrypt('encrypt', $cpwd);
	
	$var="select max(friendid) as friendid from friends";
	$res_var=$con->query($var);
	$row = mysqli_fetch_assoc($res_var);
	$friendid_row = $row['friendid'];
	
	if(!empty($friendid_row))
	{				
		$friendid = $friendid_row + 1;				
	}
	else
	{
		$friendid  = '1001';				
	}

	$sel = "select email from friends where email='$encemail'";
	$rel=$con->query($sel);	
	$data=mysqli_fetch_assoc($rel);	
	$emailid_data = fnDecrypt($data['email'], $key);
	
	
	if($cpwd != $pwd)
	{
		echo "<script>alert('Confirm Password does not match with the Password');</script>";
	}
	else if($email==$emailid_data)
	{
		echo "<script>alert('This Email ID is already registered');</script>";
	}
	else
	{
		$ins = "Insert into friends(friendid,uid,name,gender,email,password,mobileno,age) values('$friendid','$uid_session','$encname','$encgender','$encemail','$enccpwd','$encmnumber','$encage')";							
						
		if(mysqli_query($con, $ins))
		{
			echo "<script>alert('Friends Added Successfully');</script>";
			echo "<script>window.location.href='AddFriends.php'</script>";									
		}	
		else
		{
			echo "<script>alert('Invalid');</script>";							
		}	
	}
	
}

include('footer.php')?>

<script>
		

</script>
