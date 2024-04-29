<?php
include("connection.php");
include('header.php');
include('openssl_encrypt_decrypt.php');
?>

<div class="container">

	<div class="row">
	<div class="col-md-6 col-md-offset-3 regdiv">
		<div class="col-md-12 text-center">
			<h3 class="text-primary">Create Your Account</h3>
		</div>
		
		<form method="post" id="registration_form">
		
		  <div class="row mt-4">
		  <div class="col-md-6 form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" name="name" />
		  </div>
		  <div class="col-md-6 form-group">
			<label for="email">Email address:</label>
			<input type="email" class="form-control" name="email" />
		  </div>
		  <div class="col-md-6 form-group">
			<label for="mnumber">Mobile Number:</label>
			<input type="number" class="form-control" name="mnumber" />
		  </div>
		  <div class="col-md-6 form-group">
			<label for="age">Age:</label>
			<input type="number" class="form-control" name="age" />
		  </div>
		  <div class="col-md-6 form-group">
			<label for="pwd">Password:</label>
			<input type="password" class="form-control" name="pwd" />
		  </div>
		  <div class="col-md-6 form-group">
			<label for="cpwd">Confirm Password:</label>
			<input type="password" class="form-control" name="cpwd" />
		  </div>
		  <div class="col-md-12">
			<div class="form-group">
				<p class="text-left" style="font-size:18px;">Gender :</p>
			</div>
			<div class="form-group text-left">
				<label class="radio-inline"><input type="radio" name="gender" value="male" /> &nbsp;Male</label>&nbsp;&nbsp;
				<label class="radio-inline"><input type="radio" name="gender" value="female" /> &nbsp;Female</label>
			</div>
		  </div>
		  <div class="col-md-12 form-group">
		  <button type="submit" class="btn btn-primary" name="btn_submit">Create</button>
		  </div>
		  </div>
		  
		</form>
		
	</div>
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
	
	$var="select max(uid) as uid from user";
	$res_var=$con->query($var);
	$row = mysqli_fetch_assoc($res_var);
	$uid_row = $row['uid'];
	
	if(!empty($uid_row))
	{				
		$uid = $uid_row + 1;				
	}
	else
	{
		$uid  = '101';				
	}

	$sel = "select email from user where email='$encemail'";
	$rel=$con->query($sel);	
	$data=mysqli_fetch_assoc($rel);	
	$emailid_data = encrypt_decrypt('decrypt', $data['email']);;
	
	
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
		$ins = "Insert into user(uid,name,gender,email,password,mobileno,age) values('$uid','$encname','$encgender','$encemail','$enccpwd','$encmnumber','$encage')";							
						
		if(mysqli_query($con, $ins))
		{
			echo "<script>alert('Registration Successfully');</script>";
			echo "<script>window.location.href='Login.php'</script>";									
		}	
		else
		{
			echo "<script>alert('Invalid');</script>";							
		}	
	}
	
}

include('footer.php') 
?>


<script type="text/javascript" language="javascript" >
	
	$(function(){
	$( "#registration_form" ).validate({
	  rules: {
		  name:{
		  required: true
		  },
		  email:{
		  required: true
		  },
		  mnumber:{
		  required: true
		  },
		  age:{
		  required: true,
		  number:true,
		  maxlength:3
		  },
		  pwd:{
		  required: true
		  },
		  cpwd:{
		  required: true
		  },
		  gender:{
		  required: true
		  }
	  },
		messages: {
			name: " <h5 style='color:red;font-size: 15px;'>Please Enter Name</h5>",
			email: "<h5 style='color:red;font-size: 15px;'>Please Enter Email</h5>",
			mnumber: "<h5 style='color:red;font-size: 15px;'>Please Enter Mobile Number</h5>",
			age: "<h5 style='color:red;font-size: 15px;'>Please Enter Age</h5>",
			pwd: "<h5 style='color:red;font-size: 15px;'>Please Enter Password</h5>",
			cpwd: "<h5 style='color:red;font-size: 15px;'>Please Enter Confirm Password</h5>",
			gender: "<h5 style='color:red;font-size: 15px;'>Select Gender</h5>",
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") ) {
				error.prependTo( element.parent().parent() );
			}
			else { 
				error.insertAfter( element );
			}
		}
	});
	
	});
</script>