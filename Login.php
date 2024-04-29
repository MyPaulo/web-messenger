<?php session_start();
include("connection.php");
include('header.php');
include('openssl_encrypt_decrypt.php'); 
?>

<div class="container-fluid">

	<div class="row">
	<div class="col-md-4 col-md-offset-4 lgndiv">
		<div class="col-md-12 text-center">
			<h3 class="text-primary">Login</h3>
		</div>
		
		<form id="myform" method="post">
		  <div class="form-group">
			<label for="email">Email address:</label>
			<input type="email" class="form-control" name="email" />
		  </div>
		  <div class="form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" name="pswd" />
		  </div> 
		  <button type="submit" class="btn btn-primary" name="btn_login">Login</button>
		</form>
		
		<h5>Don't have an account?<a href="Register.php" style="color:skyblue"> Register</h5></a>
	</div>
	</div>

	
	
</div>

</div>

<?php

if(isset($_POST['btn_login']))
{
    $email = $_POST['email'];
	$encemail = encrypt_decrypt('encrypt', $email);
	
    $pswd = $_POST['pswd'];
	$encpswd = encrypt_decrypt('encrypt', $pswd);
		
	$sel = "select uid from user where email='$encemail' and password='$encpswd'";
	$rel=$con->query($sel);	
			
	if($data=mysqli_fetch_assoc($rel))
	{
		$uid = $data['uid'];
			
		$_SESSION["uid_session"] = $uid;
		
		echo "<script>window.location.href='AddFriends.php'</script>";							
	}
	else
	{
		echo "<script>alert('Invalid Login');</script>";
	}
			
}

include('footer.php'); 

?>

<script>

    $(function()
    {
            $("#myform").validate({
            
            rules:{
                email: "required",		
                pswd : "required",				
           },

            messages:{				
			   email:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Email ID</b></h5>",
               pswd:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Password</b></h5>",
                							
            },

            submitHandler: function(form){
                form.submit();
            }

        });

    }); 
	
</script>
