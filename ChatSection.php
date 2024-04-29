<?php include('header.php');
include('UserHeader.php');
include('openssl_encrypt_decrypt.php');

$val = !empty($_SESSION["uid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php'</script>";
}
$uid_session = $_SESSION["uid_session"];

$key = "steganographyabc";

$fid = $_GET['fid'];

$sel = "select name from user where uid='$fid'";
$rel=$con->query($sel);	
$data=mysqli_fetch_assoc($rel);
$friendname=encrypt_decrypt('decrypt', $data['name']);

?>

	<div class="container">
	<div class="col-md-offset-9 col-md-3">
		
	</div>
	</div>
	
	<?php 
	
	date_default_timezone_set('Asia/Kolkata');
	$currtime = date("Y-m-d H:i:s");	
	
	?>
	
	<input type="hidden" value="<?php echo $currtime ?>" id="currtime"/>
	<input type="hidden" value="<?php echo $uid_session ?>" id="uid"/>
	<input type="hidden" id="fid" value="<?php echo $fid ?>" class="form-control" />
	<input type="hidden" id="f_name" value="<?php echo $friendname ?>" class="form-control" />

    <div class="container main">

    <div class="col-md-12 chatdiv1">
    <div class="col-md-2 frndsdiv">
        <div class="input-group">
        <!--<input type="search" Class="form-control srch" placeholder="Search..." />-->
        </div>    
    </div>
    <div class="col-md-1">
    <img src="images/man.png" Class="img3 img-circle" />
    </div>
    <div class="col-md-5">
    <span Class="head1"><?php echo $friendname ?></span>
    <span Class="msg1"><?php echo $friendname ?>, You...</span>
    </div>
	
    <div class="col-md-1">
    <form method="post" id="image_form" enctype="multipart/form-data">
	
    <span class="glyphicon glyphicon-paperclip icon1" id="one"></span>
	<input type="file" id="three" name="image" style="display: none"/>
	</form>
    </div>
		
	
	<div class="col-md-1">
		<span class="glyphicon glyphicon-facetime-video icon1" onClick="setup();" data-toggle="modal" data-target="#myModal"></span>
    </div>
	
    </div>
   
    </div>

    <!--<div class="col-md-2 selectchat">

	<div class="col-md-2 selectchat">
    <div class="col-md-12">
    <div class="col-md-12 frndsdiv1">
    <div class="col-md-8 col-md-offset-2">
    <img src="images/admin.png" Class="img2 img-circle" />
    </div>
    <div class="col-md-12 text-center">
    <span Class="head">Friend 1</span>
    </div>
    </div>

    <div class="col-md-12">
    <hr />
    </div>
	
	<div class="col-md-12 frndsdiv1">
    <div class="col-md-8 col-md-offset-2">
    <img src="images/admin.png" Class="img2 img-circle" />
    </div>
    <div class="col-md-12 text-center">
    <span Class="head">Friend 2</span>
    </div>
    </div>
	
	<div class="col-md-12">
    <hr />
    </div>
	
	<div class="col-md-12 frndsdiv1">
    <div class="col-md-8 col-md-offset-2">
    <img src="images/admin.png" Class="img2 img-circle" />
    </div>
    <div class="col-md-12 text-center">
    <span Class="head">Friend 3</span>
    </div>
    </div>
	
	<div class="col-md-12">
    <hr />
    </div>
	
	<div class="col-md-12 frndsdiv1">
    <div class="col-md-8 col-md-offset-2">
    <img src="images/admin.png" Class="img2 img-circle" />
    </div>
    <div class="col-md-12 text-center">
    <span Class="head">Friend 4</span>
    </div>
    </div>
	
	<div class="col-md-12">
    <hr />
    </div>
	
	<div class="col-md-12 frndsdiv1">
    <div class="col-md-8 col-md-offset-2">
    <img src="images/admin.png" Class="img2 img-circle" />
    </div>
    <div class="col-md-12 text-center">
    <span Class="head">Friend 5</span>
    </div>
    </div>

    </div>

    </div>-->

	
<div class="container main">
    <div class="col-md-12 chatdiv">

    <div class="col-md-12 chatdiv2" id="chat">  
    </div>
	
	
		<div class="col-md-9 btndiv">
			<div class="col-md-11">
				<input type="text" id="textbx_msg" value="" class="form-control" placeholder="Type here..." />
			</div>
			<div class="col-md-1 btnsend">
				<button id="btn_send"><i class="glyphicon glyphicon-send" style="font-size:17px;"></i></button>
			</div>
		
		</div>
		
		<div class="col-md-3">
			<div class="form-group">
			  <label>Set Time(Secs):</label>
			  <select class="form-control" id="settime_change">
			  <option disabled selected value="-- Select Time --">-- Select Time --</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="Infinity">Infinity</option>
			  </select>
			</div>
		</div>
		
		
	
    </div>
</div>

	
	<div id="view_image" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="save_image">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						
					</div>
					<div class="modal-body">
						
						<div id="chat_img"></div>
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="operation1" id="operation1" />
						<input type="submit" name="submit" id="action1" class="btn btn-success" value="Confirm" />
					</div>
				</div>
			</form>
		</div>
	</div>
	
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-lg">

		<!-- Modal content-->
		 <form method="POST">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Webcam</h4>
		  </div>
		  <div class="modal-body">
		  	<div class="container-fluid">
		  		<div class="row">
		  			<div class="col-md-6">
					  	<div class="video-wrap">
						    <video id="video" playsinline autoplay></video>
						</div>
					</div>
		  			<div class="col-md-6">
		  				<canvas id="canvas" width="350" height="350" name="canvas"></canvas>
		  			</div>
		  		</div>
		  	</div>
		  	<input type="text" id="select_time1" name="select_time1" style="display: none;"/>
			<!--<div id="my_camera"></div>
			
			<input type="hidden" name="image" class="image-tag">
			<div id="results">Your captured image will appear here...</div>-->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-info" id="snap">Take Snapshot</button>
			<button type="button" class="btn btn-default" onclick="closefun()">Close</button>
			<button class="btn btn-success" onclick="UploadPic()" type="button">Submit</button>
		  </div>
		</div>
	</form>
	  </div>
	</div>



<?php include('footer.php'); ?>


<script>


$("#settime_change").change(function(){
$("#select_time1").val(this.value);

})

timer();


	
//chatfetch();

function timer()
{
		
	var text = setInterval(function() {
	var uid = $("#uid").val();
	var fid = $("#fid").val();
	var currtime = $("#currtime").val();
	var f_name = $("#f_name").val();
	
	
	$.ajax({
	  type: "POST",
	  url: "ChatFetch.php",
	  dataType: "json",
	  data:{fid : fid, currtime : currtime},
	  success: function(data){
		$("#chat").html("");
				
		
		$("#currtime").val(data.currtime_new);
		//console.log(data.currtime_new);
		
		var fdata = data.fdata;
		//console.log(data.fdata);
		
		if(fdata!="")
		{			
			
			var i = 0;
			var msg_array = fdata.split(']');
			var arrayLength = msg_array.length;
			
			for(i = 0; i < arrayLength; i++)
			{				
				var data1 = msg_array[i].split('|');
				var cid = data1[0];
				var id1 = data1[1];
				var id2 = data1[2];
				var msg = data1[3];
				var file = data1[4];
				var dtime = data1[5];
				var webcam = data1[6];
				
				if(id1 == uid)
				{
					if(file == undefined)
					{
						
					}
					else{
						
					if(file != "" && file !=null)
					{
						//$('<div class="row"><div class="col-md-5 col-lg-5"><img style="width:40%; height:40%;" src="upload/'+file+'" alt="file"/></div></div>').appendTo('#chat');
						$("<center style='margin:15px 0px'><table width='100%' style = 'background-color:#00d0ff5e;border-radius:15px;'><tr><td style='width: 30%; padding-left:20px; text-align: left;'>" + dtime + "</td><td style='width: 70%; text-align: right; padding-right:20px'><img src='http://localhost/Web%20Based%20Chat%20Messenger(New)/upload/" + file + "' width='100px' data-enlargable style='cursor: zoom-in' />&nbsp;<b><font color='green'> : You</font></b></td></tr></table></center>").appendTo('#chat');
					}
					else
					{
						$('<center style="margin:15px 0px"><table width="100%" style = "background-color:#00d0ff5e;border-radius:15px;"><tr><td style="width: 30%; padding-left:20px; text-align: left;">' + dtime + '</td><td style="width: 70%; text-align: right; padding-right:20px">&nbsp;' + msg + '<b><font color="green"> : You </font></b></td></tr></table></center>').appendTo('#chat');
						//$('<div class="row"><div id="date" class="col-md-4 text-left" style="margin-top:2%;"><span class="datetime'+chatid+'">'+dtime+'</span></div><div class="col-md-8 text-right" style="margin-top:2%;"><span class="msgsend'+chatid+'" >'+msg+' : You </span></div><div></br>').appendTo('#chat');
					}
					}
				}
				else
				{
					if(file == undefined)
					{
						
					}
					else{
					
					if(file != "" && file !=null)
					{
						//$('<div class="row"><div class="col-md-5 col-lg-5"><img style="width:40%; height:40%;" src="upload/'+file+'" alt="file"/></div></div>').appendTo('#chat');
						$("<center style='margin:15px 0px'><table width='100%' style = 'background-color:#ffff005e;border-radius:15px;'><tr><td style='width: 70%; padding-left:10px'>&nbsp;<b style='color:#ff5e00'>"+f_name+" : </font></b>&nbsp;&nbsp;&nbsp;<img src='http://localhost/Web%20Based%20Chat%20Messenger(New)/upload/" + file + "' width='100px' data-enlargable style='cursor: zoom-in' />&nbsp;</td><td style='width: 30%; text - align: right;'>" + dtime + "</td></tr></table></center>").appendTo('#chat');
					}
					else
					{
						$('<center style="margin:15px 0px"><table width="100%" style = "background-color:#ffff005e;border-radius:15px;"><tr><td style="width: 70%; padding-left:10px">&nbsp;<b style="color:#ff5e00">'+f_name+' : </font></b>' + msg + '</td><td style="width: 30%; text - align: right;">' + dtime + '</td></tr></table></center>').appendTo('#chat');
						//$('<div class="row"><div class="col-md-8 text-left" style="margin-top:2%;"><span class="msgsend'+cid+'" >'+f_name+': '+msg+'</span></div><div id="date" class="col-md-4 text-right" style="margin-top:2%;"><span class="datetime'+cid+'">'+dtime+'</span></div><div></br>').appendTo('#chat');	
					}
						
					}
				}
			}

		}
		else
		{
			$("#chat").html("");
		}

	  }
	  
	});		
		

    //if (seconds <= 0){ clearInterval(text)};
	}, 1000);
	
		
}	
				





$('#btn_send').click(function(){
	
	var textbx_msg = $("#textbx_msg").val();
	var fid = $("#fid").val();
	var settime = $("#settime_change").val();
	
	if(settime == "--Select Time--" || settime == null)
	{
		alert("Please Select Seconds");	
	}
	else if(textbx_msg == "" || textbx_msg == null)
	{
		alert("Please Type a Message");
	}
	else
	{
	
		$.ajax({
		  type: "POST",
		  url: "ChatSend.php",
		  dataType: "json",
		  data:{textbx_msg:textbx_msg, fid:fid, settime:settime},
		  success: function(data){
			console.log(data);
			
			//$("#chatid").val(data.chatid);
			$("#textbx_msg").val("");
			
			
			/*if(data.file == undefined)
			{
						
			}
			else{
					
				if(file != "" && file !=null)
				{
					$("<center style='margin:15px 0px'><table width='100%' style = 'background-color:#00d0ff5e;border-radius:15px;'><tr><td style='width: 30%; padding-left:20px; text-align: left;'>" + data.datetime + "</td><td style='width: 70%; text-align: right; padding-right:20px'><img src='upload/" + data.file + "' width='100px' data-enlargable style='cursor: zoom-in' />&nbsp;<b><font color='green'> : You</font></b></td></tr></table></center>").appendTo('#chat');	
						
				}
				else
				{
					$('<center style="margin:15px 0px"><table width="100%" style = "background-color:#00d0ff5e;border-radius:15px;"><tr><td style="width: 30%; padding-left:20px; text-align: left;">' + data.datetime + '</td><td style="width: 70%; text-align: right; padding-right:20px">&nbsp;' + data.textbx_msg + '<b><font color="green"> : You </font></b></td></tr></table></center>').appendTo('#chat');
						
				}
						
			}*/
		
			//$('<div class="row"><div id="date" class="col-md-4 text-left" style="margin-top:2%;"><span class="datetime'+data.chatid+'">'+data.datetime+'</span></div><div class="col-md-8 text-right" style="margin-top:2%;"><span class="msgsend'+data.chatid+'" >'+data.textbx_msg+' : You </span></div><div></br>').appendTo('#chat');
			
			
					
		  }
		  
		});	
		
	}	

 });


 
function UploadPic(){
	// Generate the image data
    var Pic = document.getElementById("canvas").toDataURL("image/png");
    //Pic = Pic.replace(/^data:image\/(png|jpg);base64,/, "")
    var fid = <?php echo $_GET['fid']; ?>;
    var time = $("#select_time1").val();
    // Sending the image data to Server
    $.ajax({
        type: 'POST',
        url: 'storeImage.php',
        data: {image:Pic, fid:fid, time:time},
        success: function (msg) {
            if(msg == "time error")
            {
            	alert('kindly select time ');
            	const canvas = document.getElementById('canvas');
            	const context = canvas.getContext('2d');
				context.clearRect(0, 0, canvas.width, canvas.height);
            	$(".modal").modal('hide');
            }
            else
            {
            	alert('Upload Successfully');
            	$("#canvas").innerHTML = "";
            	$(".modal").modal('hide');
            }
        }
    });
}



</script>

