</div>

<div class="text-right footer">
	<p class="footerp">Chat Messenger</p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/webcam.min.js"></script>

<!-- Configure a few settings and attach camera -->
<script language="JavaScript">
	//Webcam
		const video = document.getElementById('video');
		const canvas = document.getElementById('canvas');
		const snap = document.getElementById("snap");
		const errorMsgElement = document.querySelector('span#errorMsg');
		const constraints = {
		  audio: false,
		  video: {
		    width: 350, height: 350
		  }
		};
		// Access webcam
		async function init() {
		  try {
		    const stream = await navigator.mediaDevices.getUserMedia(constraints);
		    handleSuccess(stream);
		  } catch (e) {
		    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
		  }
		}
		function handleSuccess(stream) {
			window.stream = stream;
			video.srcObject = stream;
		}
		function setup() {
			init();
		}
		// Draw image
		var context = canvas.getContext('2d');
		snap.addEventListener("click", function() {
		  context.drawImage(video, 0, 0, 350, 350);
		});
		function closefun()
		{
			stream.getTracks().forEach(function(track) {
		  track.stop();
		});
			$(".modal").modal('hide');
		}
	//END

		$(function () {
			var fileupload = $("#three");
			//var filePath = $("#two");
			var image = $("#one");
			image.click(function () {
				fileupload.click();
			});
			
			fileupload.change(function (event) {
			var data = new FormData(document.getElementById("image_form"));
			
				event.preventDefault();	
				$.ajax({
				url:"ChatSectionResponse.php",
				method:"POST",
				data:data,
				contentType: false,
				cache: false,
				processData:false,
				success:function(data)
				{
					$("#view_image").modal('show');
					$("#chat_img").html("");
					$("#chat_img").append("<center><img width='200px' height='200px' src='upload/"+data+"'/><label id='img_name' style='display: none;'>"+data+"</label></center>");
				}
				});
			});
			
			$(document).on('submit', '#save_image', function(event){
			
			var fid = $("#fid").val();
			var settime = $("#settime_change").val();
			var image = document.getElementById("img_name").innerText;
			
			var submit1 = "true";
				event.preventDefault();	

				if(settime == "--Select Time--" || settime == null)
				{
					alert("Please Select Seconds");	
				}
				else
				{
					$.ajax({
					url:"ChatSectionResponse.php",
					method:"POST",
					data:{fid:fid, settime:settime, image:image, submit1:submit1},
					success:function(data)
					{
						window.location.href="ChatSection.php?fid="+fid+"";
					}
					});
					
				}	
					
	});
		});
		
		$(function() {
		  $('li a[href^="' + location.pathname.split("/")[2] + '"]').addClass('active');

		var url = location.pathname.split("/")[2];
		  if (url == 'ViewMore_ReqDemo.php') {              
			$('.ones').addClass('active');
		   }

		   
		});		

	</script>
</body>
</html>