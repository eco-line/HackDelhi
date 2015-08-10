<?php session_start();?>
<?php 
	if(!isset($_GET['id']))
	{
		$i="restaurant";
	}
	else
	{
		$i=$_GET['id'];
	}
	$temp=json_decode(file_get_contents("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=28.6674043,77.0542848&radius=500&types=".$i."&key=AIzaSyBE36kr-nWS8gYQDjdaj-5z7-GH7iE-voI"),true);
	
?>
<?php 
	$servername = "localhost";   // username and password of phpmyadmin
	$username = "sponsorh_golu";			 // username and password of phpmyadmin
	$password = "lumia625";				 // username and password of phpmyadmin
	$dbname = "sponsorh_hack";		 // username and password of phpmyadmin
	
	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);
	
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
?>

<!doctype html>
<html>
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>Hack Delhi</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<script src="js/respond.js"></script>
		<style>
			body,html
			{
			background-color:#F2F2F2;
			}
			.header
			{
			height:80px;
			margin-bottom:20px;
			background-color:#332C2F;
			}
			.map
			{
			height:500px;
			background-color:white;
			}
			.hotel-name
			{
			height:500px;
			
			}
			.side-outside
			{
			height:500px;
			width:100%;
			padding:15px;
			background-color:white;
			}
			.location
			{
			width:100%;
			position:relative;
			left:2%;
			
			}
			.order-food
			{
			height:50px;
			}
			.order-food a
			{
			text-decoration:none;
			}
			.text-verdana
			{
			font-family:verdana;
			}
			.food-type h3 
			{
			font-size:22px;
			}
			.food-image
			{
			width:90%;
			height:90px;
			margin-left:5%;
			}
			.bg-white
			{
			background-color:white;
			}
			.left-margin
			{
			position:relative;
			left:5%;
			}
			.ad
			{
			height:auto;
			margin-bottom:40px;
			margin-top:30px;
			}
			.facilities
			{
			margin-bottom:40px;
			}
			.facilities-images
			{
			width:100%;
			height:150px;
			border:5px solid #dadada;
			border-radius:5px;
			margin-top:20px;
			}
			.facilities a
			{
			text-decoration:none;
			}
			.row a
			{
			text-decoration:none;
			}			
			.row-fluid h4
			{
			font-family:verdana;
			text-align:center;
			}
			.thumbnail
			{
			width:30%;
			height:auto;
			margin-right:3%;
			float:left;
			margin-top:20px;
			}
			.carousel {
			margin-bottom: 0;
			padding: 0 40px 30px 40px;
			}
			/* Reposition the controls slightly */
			.carousel-control {
			left: -12px;
			}
			.carousel-control.right {
			right: -12px;
			}
			/* Changes the position of the indicators */
			.carousel-indicators {
			right: 50%;
			top: auto;
			bottom: 0px;
			margin-right: -19px;
			}
			/* Changes the colour of the indicators */
			.carousel-indicators li {
			background: #c0c0c0;
			}
			.carousel-indicators .active {
			background: #333333;
			}		
			footer
			{
			margin-top:40px;
			background-color:#332C2F;
			}
			.tabs
			{
			text-align:center;
			float:left;
			width:19%;
			margin-right:1%;
			}
			.header-links
			{
			line-height:55px;border:1px solid black;border-radius:5px;
			}
			.header-links:hover
			{
			background-color:#5cb85c;
			}
		</style>
		<link rel="stylesheet" href="style.css" type="text/css" />
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="chat.js"></script>
		<script type="text/javascript">
			
			function call_chat()
			{
				// ask user for name with popup prompt    
				var name = prompt("Enter your name:", "Guest");
				
				// default name is 'Guest'
				if (!name || name === ' ') {
					name = "Guest";	
				}
				
				// strip tags
				name = name.replace(/(<([^>]+)>)/ig,"");
				
				// display name on page
				$("#name-area").html("You are: <span>" + name + "</span>");
				
				// kick off chat
				var chat =  new Chat();
				$(function() {
					
					chat.getState(); 
					
					// watch textarea for key presses
					$("#sendie").keydown(function(event) {  
						
						var key = event.which;  
						
						//all keys including return.  
						if (key >= 33) {
							
							var maxLength = $(this).attr("maxlength");  
							var length = this.value.length;  
							
							// don't allow new content if length is maxed out
							if (length >= maxLength) {  
								event.preventDefault();  
							}  
						}  
					});
					// watch textarea for release of key press
					$('#sendie').keyup(function(e) {	
						
						if (e.keyCode == 13) { 
							
							var text = $(this).val();
							var maxLength = $(this).attr("maxlength");  
							var length = text.length; 
							
							// send 
							if (length <= maxLength + 1) { 
								
								chat.send(text, name);	
								$(this).val("");
								
								} else {
								
								$(this).val(text.substring(0, maxLength));
								
							}	
							
							
						}
					});
					
				});
			}
		</script>
		<style>
			.chat_room
			{
			border:1px solid black;
			width:275px;
			position:fixed;
			left:76%;
			top:30%;
			z-index:1;
			display:none;
			background:-webkit-radial-gradient(rgb(0,0,0),rgb(5,232,243));
			}
			
			
		</style>
	</head>
	<body onload="setInterval('chat.update()', 100)">
		<div class="chat_room">
			<div id="page-wrap" style="width:270px;">
				
				
				<div id="chat-wrap" >
					<div id="chat-area"></div>
				</div>
				<center>
					<form id="send-message-area" style="height:50px;">
						
						<textarea id="sendie" placeholder="Enter message here ....." maxlength='100' style="resize: none; overflow:hidden; max-width: 90%; max-height: 40px; height:40px;  width:90%;" ></textarea>
					</form>
				</center>
				
			</div>
			<br/>
			<br/>
			<br/>
			<br/>
		</div>
		
		<div onclick="chat_box_show();" style="border:1px solid white; z-index:8;left:80%; top:94%; width:190px; text-align:center; border-top-left-radius:5px; border-top-right-radius:5px; padding:10px; height:40px; background:-webkit-linear-gradient(rgb(0,0,0),rgb(5,232,243)); font-size:20px; color:white; cursor:pointer; position:fixed;" >Queries/complaints</div>
		<div class="row">
			<div class="col-md-12">
				<div class="header">
					<div class="container">
						<div class="row">
							<div class="col-md-4" style="">
								<a href="index.php"><img src="images/logo.png" style="height:80px;width:auto;"></a>
							</div>
							<div class="col-md-2" style="font-family:verdana;color:white;height:80px;text-align:center;">
								<a href="#facilities"><h4 class="header-links">Facilities</h4></a>
							</div>
							<div class="col-md-2" style="font-family:verdana;color:white;height:80px;background-color:;text-align:center;">
								<a href="#offers"><h4 class="header-links">Offers</h4></a>
							</div>
							<div class="col-md-2" style="font-family:verdana;color:white;height:80px;background-color:;text-align:center;">
								<a href="#order-food"><h4 class="header-links">Order Food</h4></a>
							</div>
							<div class="col-md-2" style="font-family:verdana;color:white;height:80px;background-color:;text-align:center;">
								<button style="margin-top:20px;width:80px;" type="button" class="btn btn-success text-verdana" id="myBtn">Login</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="container">
			
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header" style="background-color: #5cb85c;
						color:white !important;
						text-align: center;
						font-size: 30px;padding:35px 50px;">
							<button type="button" class="close" style="background-color: #5cb85c;
							color:white !important;
							text-align: center;
							font-size: 30px;" data-dismiss="modal">&times;</button>
							<h4 style="background-color: #5cb85c;
							color:white !important;
							text-align: center;
							font-size: 30px;"><span class="glyphicon glyphicon-lock"></span> Login</h4>
						</div>
						<div class="modal-body" style="padding:40px 50px;">
							<form role="form" id="">
								<div class="form-group" >
									<label for="usrname"><span class="glyphicon glyphicon-user"></span> Room No</label>
									<input type="text" class="form-control" name="uname" id="username" placeholder="Enter room no.">
								</div>
								<div class="form-group">
									<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
									<input type="password" class="form-control" name="pwd" id="pwd" placeholder="Enter password">
								</div>
								<div class="checkbox">
									<!-- <label><input type="checkbox" value="" checked>Remember me</label>-->
									<span id="form_error" style="font-weight:bold;"></span>
								</div>
								<br/>
								<button type="button" onclick="user_login();" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
							</form>
						</div>
						<div class="modal-footer" style="	background-color: #f9f9f9;">
							<button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
							<!--<p>Not a member? <a href="#">Sign Up</a></p>
							<p>Forgot <a href="#">Password?</a></p>-->
						</div>
					</div>
					
				</div>
			</div> 
		</div>
		
		
		<div class="container" >
			<div class="row" style="margin-bottom:20px;">
				<div class="col-md-9">
					<a href="http://sponsorhunt.in/HackDelhi1/index.php?id=restaurant"  ><h5 class="tabs"><i class="fa fa-beer"></i> Restaurants</h5></a>
					<a href="http://sponsorhunt.in/HackDelhi1/index.php?id=hospital"><h5 class="tabs"><i class="fa fa-hospital-o"></i> Hospitals</h5></a>
					<a href="http://sponsorhunt.in/HackDelhi1/index.php?id=atm"><h5 class="tabs"><i class="fa fa-money"></i> ATM</h5></a>
					<a href="http://sponsorhunt.in/HackDelhi1/index.php?id=department_store"><h5 class="tabs"><i class="fa fa-truck"></i> Department Store</h5></a>
					<a href="http://sponsorhunt.in/HackDelhi1/index.php?id=pharmacy"><h5 class="tabs"><i class="fa fa-medkit"></i> Pharmacy</h5></a>
					<div id="googleMap" style="position:relative;height:450px;width:100%;"></div>
				</div>
				<div class="col-md-3">
					<div class="side-outside">
						<div class="hotel-name">
							<img src="images/logo.png" style="width:100%;height:auto;margin-bottom:20px;">
							<div class="location">
								<i class="fa fa-map-marker" style="float:left;margin-top:3px;"></i>
								<p class="text-verdana" style="display:block;margin-left:20px;font-size:15px;letter-spacing:0px;">Plot No. D, Outer Ring Road, <br> Paschim Vihar, Delhi</p>
							</div>
							<div class="order-food">
								<a href="#order-food"><button type="button" class="btn btn-success btn-block text-verdana">Order Food</button></a>
							</div>
							<div id="fare" style="height:250px;font-family:verdana;">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="ad">
				<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-8">
						<a href="http://www.uber.com"><img style="width:100%;height:auto;" src="images/uber.jpg"></a>
					</div>
					<div class="col-md-2">
					</div>
				</div>
			</div>
			
			
			<div class="facilities" id="facilities">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-verdana" style="text-align:center;font-weight:bold;">Facilities Provided</h2>
					</div>
					<div class="col-md-3">
						<img class="facilities-images" src="images/pool.jpg">
						<h4 style="text-align:center;">Swimming Pool</h4>
						<a href="#"><button type="button" class="btn btn-success btn-block text-verdana">Open - 9 AM to 6 PM</button></a>
					</div>
					<div class="col-md-3">
						<img class="facilities-images" src="images/gym.jpg">
						<h4 style="text-align:center;">24 Hours Gym</h4>
						<a href="#"><button type="button" class="btn btn-success btn-block text-verdana">Open - 6 AM to 10 AM</button></a>
					</div>
					<div class="col-md-3">
						<img class="facilities-images" src="images/massage.jpg">
						<h4 style="text-align:center;">Massage Lounge</h4>
						<a href="#"><button type="button" onclick="msg_book(200);" class="btn btn-success btn-block text-verdana">Book Now</button></a>
					</div>
					<div class="col-md-3">
						<img class="facilities-images" src="images/taxi.jpg">
						<h4 style="text-align:center;">On call Taxi Service</h4>
						<a href="#"><button type="button" class="btn btn-success btn-block text-verdana">Select a place on map to book</button></a>
					</div>
				</div>
			</div>
			
			<?php	
				$search_sql = "SELECT * FROM notice ";
				$search_result = $conn->query($search_sql);
				if($search_result->num_rows > 0) 
				{
					while($row = $search_result->fetch_assoc()) 
					{
						
					?>
					
					<div class="row" >
						<div class="col-md-12" style="text-align:center;">
							<h4>Note : <?php echo $row['note']; ?></h4>
						</div>
					</div>
					
					<?php
					}
				}
			?>
			
			<div class="row" style="margin-top:50px;" id="offers">
				<div class="col-md-12">
					<h2 class="text-verdana" style="text-align:center;font-weight:bold;margin-bottom:20px;margin-top:30px;">Exciting Offers </h2>
				</div>
				<div class="span12">
					<div class="well"> 
						<div id="myCarousel" class="carousel slide">
							
							<ol class="carousel-indicators">
								<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<li data-target="#myCarousel" data-slide-to="1"></li>
								<li data-target="#myCarousel" data-slide-to="2"></li>
							</ol>
							
							<!-- Carousel items -->
							<div class="carousel-inner">
								
								<div class="item active">
									<div class="row-fluid">
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/kasauli.jpg"><h4>Kasol Packages</h4></div></a>
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/rishikesh.jpg"><h4>Rishikesh Packages</h4></div></a>
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/manali.jpg"><h4>Manali Packages</h4></div></a>
										
									</div><!--/row-fluid-->
								</div><!--/item-->
								
								<div class="item">
									<div class="row-fluid">
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/amritsar.jpg"><h4>Amritsar Packages</h4></div></a>
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/chandigarh.jpg"><h4>Chandigarh Packages</h4></div></a>
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/corbett.jpg"><h4>Corbett Packages</h4></div></a>
									</div><!--/row-fluid-->
								</div><!--/item-->
								
								<div class="item">
									<div class="row-fluid">
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/jaipur.jpg"><h4>Jaipur Packages</h4></div></a>
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/musoorie.jpg"><h4>Musoorie Packages</h4></div></a>
										<a href="#"><div class="thumbnail"><img style="width:100%;height:150px;" src="images/pushkar.jpg"><h4>Pushkar Packages</h4></div></a>
									</div><!--/row-fluid-->
								</div><!--/item-->
								
							</div><!--/carousel-inner-->
							
						</div><!--/myCarousel-->
						
					</div><!--/well-->   
				</div>
			</div>
			
			
			
			<div class="order-food" id="order-food">
				<div class="row">
					<div class="col-md-9 bg-white">
						<h2 class="text-verdana" style="font-weight:bold;text-align:center;">Order Your Food Here</h2>
						
						
						<div class="food-type text-verdana">
							<h3 class="left-margin text-verdana">Popular Dishes</h3>
						</div>
						<img class="food-image" style="margin-bottom:20px;" src="images/menu1.jpg">
						<div class="food-details left-margin">
							<h4 style="width:70%;float:left;">Chinese Fried Rice</h4>
							<h4 style="width:30%;float:left;">Rs 149.00 &nbsp; <span onclick="add_product(149,'Chinese Fried Rice',1);" style="border-radius:19px; padding-right:4px;padding-left:4px; border:1px solid black;background:#449d44;; cursor:pointer;"  > + </span></h4>
						</div>
						
						<div class="food-details left-margin">
							<h4 style="width:70%;float:left;">Veg. Regular Thali</h4>
							<h4 style="width:30%;float:left;">Rs 249.00 &nbsp; <span onclick="add_product(249,'Veg. Regular Thali',1);" style="border-radius:19px; padding-right:4px;padding-left:4px; border:1px solid black;background:#449d44;; cursor:pointer;"  > + </span></h4>
						</div>
						
						<div class="food-details left-margin">
							<h4 style="width:70%;float:left;">Chilly Potato</h4>
							<h4 style="width:30%;float:left;">Rs 100.00 &nbsp; <span onclick="add_product(100,'Chilly Potato',1);" style="border-radius:19px; padding-right:4px;padding-left:4px; border:1px solid black;background:#449d44;; cursor:pointer;"  > + </span></h4>
						</div>
						
						<div class="food-details left-margin">
							<h4 style="width:70%;float:left;">Paneer Roll </h4>
							<h4 style="width:30%;float:left;">Rs 170.00 &nbsp; <span onclick="add_product(170,'Paneer Roll ',1);" style="border-radius:19px; padding-right:4px;padding-left:4px; border:1px solid black;background:#449d44;; cursor:pointer;"  > + </span></h4>
						</div>
						
						<div class="food-details left-margin">
							<h4 style="width:70%;float:left;">Gulab Jamun</h4>
							<h4 style="width:30%;float:left;">Rs 150.00 &nbsp; <span onclick="add_product(150,'Gulab Jamun',1);" style="border-radius:19px; padding-right:4px;padding-left:4px; border:1px solid black;background:#449d44;; cursor:pointer;"  > + </span></h4>
						</div>
					</div>
					<div class="col-md-3" style="background-color:#E6E6E6;height:412px;" >
						<div style="text-align:center; border-bottom:1px solid black; "><h2>Your order</h2></div><br/>
						<div class="products" style="max-height:248px; overflow-y:scroll;" >
							
							
						</div>
						<div style="text-align:center; "><h3>Total Bill : Rs <span id="bill">0</span></h3></div>
						<center><button id="confirm_order" onclick="confirm_order();" style="visibility:hidden; color:white; border:none;height:40px; width:160px;border-radius:10px; background:-webkit-linear-gradient(rgb(0,0,0),rgb(15,115,109)); letter-spacing:1px;">Comfirm your order</button>
						</center>
					</div>
				</div>
			</div>			
			
			
		</div>
		
		<footer>
			<div class="row">
				<div class="col-md-12" style="text-align:center;color:white;margin-top:20px;">
					<h4>Copyright <i class="fa fa-copyright"></i> HackDelhi</h4>
					<h5>Made with love by Team 4Code</h5>
				</div>
			</div>
		</footer>
		
		<!-- javascript -->
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
			var count1=1;
			var login_status=0;
			var user_room=0;
			function add_product(price,product,count)
			{
				var bill= parseInt(document.getElementById('bill').innerHTML);
				document.getElementById('bill').innerHTML=bill+price;
				//var product1=String(product);
				var inner='<table width="100%" id="table'+count1+'"   cellspacing="10" style=" padding:5px;background:white;"><tr><td width="15%"  style="padding:3px; border:1px solid black;font-size:20px;text-align:center;"><div id="pr'+count1+'">'+count+'</div></td><td></td><td style="font-size:18px;padding-right:3px;text-align:right;">'+product+'</td></tr><tr><td><br></td></tr><tr><td width="15%" onclick="inc_val('+count1+','+price+');" style="cursor:pointer; border:1px solid black; font-size:25px; text-align:center;">+</td><td onclick="dec_val('+count1+','+price+');" style="cursor:pointer; border:1px solid black; font-size:25px; text-align:center;" width="15%">-</td><td style="text-align:right; font-size:18px;padding-right:3px;" >Rs.<span id="price'+count1+'">'+price+'</span></td></tr></table><br/>';
				$(".products").append(inner);
				if(count==1)
				{
					$('#confirm_order').css({'visibility':'visible'});			
				}
				
				count1++;
			}
			
			
			function inc_val(vl,pri)
			{
				//alert(pri);
				
				var cl=parseInt(document.getElementById('pr'+vl).innerHTML);
				
				var price1=parseInt(document.getElementById('price'+vl).innerHTML);
				//alert(price1);
				var pri=parseInt(pri);
				document.getElementById('pr'+vl).innerHTML=cl+1;
				document.getElementById('price'+vl).innerHTML=price1+pri;
				var bill= parseInt(document.getElementById('bill').innerHTML);
				document.getElementById('bill').innerHTML=bill+pri;
				
			}
			
			function dec_val(vl,pri)
			{
				var cl=parseInt(document.getElementById('pr'+vl).innerHTML);
				
				
				if(cl==1)
				{
					document.getElementById('table'+vl).innerHTML='';
					//$('table'+vl).remove();
					var bill= parseInt(document.getElementById('bill').innerHTML);
					//count1=1;
					if(bill!=0)
					{
						document.getElementById('bill').innerHTML=bill-pri;
					}
					var bill= parseInt(document.getElementById('bill').innerHTML);
					
					if(bill==0)
					{
						$('#confirm_order').css({'visibility':'hidden'});			
					}
					//count1=1;
				}
				
				
				
				else
				{
					
					
					var price1=parseInt(document.getElementById('price'+vl).innerHTML);
					document.getElementById('pr'+vl).innerHTML=cl-1;
					document.getElementById('price'+vl).innerHTML=price1-pri;
					var bill= parseInt(document.getElementById('bill').innerHTML);
					document.getElementById('bill').innerHTML=bill-pri;
					
					var bill= parseInt(document.getElementById('bill').innerHTML);
					
					if(bill==0)
					{
						$('#confirm_order').css({'visibility':'hidden'});			
					}
					
				}
			}
			function user_login()
			{
				
				//	alert('dixit');
				
				var uname=document.getElementById('username').value;
				var password=document.getElementById('pwd').value;
				//alert(uname+' '+password);
				if(uname=='' || password=='')
				{
					document.getElementById('form_error').innerHTML='Please enter room no & password';
				}
				else
				{
					document.getElementById('form_error').innerHTML='';
					$.ajax({
						type: "POST",
						url: "check_login.php",
						data: {"uname":uname,"pwd":password},
						success: function (response) {
							response1=JSON.parse(response);
							//alert(response1);
							if(response1[0]=='false')
							{
								document.getElementById('form_error').innerHTML='Invalid credentials';
							}
							else
							{
								login_status=1;
								document.getElementById('form_error').innerHTML='Welcome '+ response1[0];
								user_room=response1[1];
								<?php 
									$_SESSION['id']='1';
									
								?>
							}
						}
					});
				}
			}
			//		alert('<?php echo $_SESSION['name'];?>');
			<?php
				if($_SESSION['id']==1 && $_SESSION['name']!='')
				{
					echo "login_status=1;
					document.getElementById('form_error').innerHTML='Welcome ".$_SESSION['name']."';
					user_room='".$_SESSION['room']."';
					";
				}
			?>
			//login_status=1;
			
			
			function confirm_order()
			{
				if(login_status==0)
				{
					alert('Please Login First');
				}
				else
				{
					var bill=parseInt(document.getElementById('bill').innerHTML);
					//alert(user_room);	
					$.ajax({
						type: "post",
						url: "confirm_order.php",
						data: {"room":user_room,"type":"food","total":bill},
						success: function (response) {
							if(response=='true')
							{
								
								alert('Your order has been confirmed , it will reach you in 20-30 minutes ,Thank you');
							}
							else
							{
								alert('Please try again');
							}
						}
					});
					
				}
			}
			
			
			function msg_book(fare)
			{
				if(login_status==0)
				{
					alert('Please Login First');
				}
				else
				{
					$.ajax({
						type: "post",
						url: "salon_order.php",
						data: {"total":fare,"room":user_room},
						success: function (response) {
							if(response=='true')
							{
								var time = prompt("Please enter time ");
    							if(time!='')
								{
									alert('Thank you,your order has been successfully booked');
								}
							}
							else
							{
								alert('Please try again');
							}
						}
					});
				}	
			}
			function book_cab(fare)
			{
				//alert(f);
				if(login_status==0)
				{
					alert('Please Login First');
				}
				else
				{
					$.ajax({
						type: 'post',
						url: 'cab_order.php',
						data: {'total':fare,'room':user_room},
						success: function (response) {
							if(response=='true')
							{
								alert('Thank you,your cab will come in 10-15 minutes');
							}
							else
							{
								alert('Please try again');
							}
						}
					});
				}
			}
			var j=0;
			function chat_box_show()
			{
				if(j==0)
				{
					call_chat();
					j=1;
				}
				$('.chat_room').toggle();
			}
		</script>
		
		<script>
			$(document).ready(function() {
				$("#myBtn").click(function(){
					$("#myModal").modal();
				});
				$('#myCarousel').carousel({
					interval: 10000
				})
			});
		</script>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<?php
			echo "<script>
			var marker ;
			var myCenter=new google.maps.LatLng(28.6674043,77.0542848);
			var xcenter;
			function initialize( )
			{
			var mapProp = {
			center:myCenter,
			zoom:16,
			mapTypeId:google.maps.MapTypeId.ROADMAP
			};
			var directionsDisplay;
			var directionsService = new google.maps.DirectionsService();
			var map=new google.maps.Map(document.getElementById(\"googleMap\"),mapProp);
			directionsDisplay = new google.maps.DirectionsRenderer();
			directionsDisplay.setMap(map);
			var opt= { preserveViewport : true };
			directionsDisplay.setOptions(opt);
			var arker=new google.maps.Marker({
			position:myCenter,
			icon:'current.png'
			});
			arker.setMap(map);
			if(marker === undefined)
			{
			}
			else
			{
			var request = {
			origin:myCenter,
			destination:marker.getPosition(),
			travelMode: google.maps.TravelMode.DRIVING
			};
			directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
			var dis= response.routes[0].legs[0].distance.value/1000 ;
			var xxx=response.routes[0].legs[0].duration.value/60;
			var f=100;
			if(dis>.1)
			f=f+(dis-.1)*100;
			if(xxx>5)
			f=f+(xxx-5)*1;
			document.getElementById('fare').innerHTML += \"<h4 style='float:left;margin-right:5px;'>Distance:</h4> \" + \"<h4 style='float:left;margin-right:5px;'>\" + response.routes[0].legs[0].distance.value/1000 + \"</h4>\" + \" <h4 style='float:left;'>km</h4> <br><h4 style='float:left;margin-right:5px;'>Duration:</h4>\"+ \"<h4 style='float:left;margin-right:5px;'>\" + xxx.toFixed(2)+ \"</h4>\" +\" <h4 style='float:left;'>minutes</h4><br><h4 style='float:left;margin-right:5px;'>Fare: </h4>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h4 style='float:left;margin-right:5px;'> Rs</h4> \"+ \"<h4 style='float:left;'>\" +f + \"</h4>\" +\" <br> <br><br><br> <a href='#'><button type='button' class='btn btn-success btn-block text-verdana' onclick='book_cab(\" +f + \");'>Book a Cab Now</button></a>\";
			directionsDisplay.setDirections(response);
			}
			});
			
			
			}
			
			" ;
			
			foreach ($temp["results"] as $xyz)
			{
				echo "xcenter=new google.maps.LatLng(".$xyz["geometry"]["location"]["lat"].",".$xyz["geometry"]["location"]["lng"].");
				
				
				
				marker=createMarker(xcenter,map);
				
				
				
				
				
				" ;
			}
			echo "}
			function createMarker(pos,mapp)
			{
			var mark = new google.maps.Marker({
			position:pos,
			map: mapp
			}); 
			google.maps.event.addListener(mark, 'click', function() {
			marker=this;
			fetchdetails();
			initialize();
			});
			return mark;
			}
			function fetchdetails()
{
";
foreach ($temp["results"] as $xyz)
{
echo "if(marker.getPosition().lat() === new google.maps.LatLng(".$xyz["geometry"]["location"]["lat"].",".$xyz["geometry"]["location"]["lng"].").lat() && marker.getPosition().lng() === new google.maps.LatLng(".$xyz["geometry"]["location"]["lat"].",".$xyz["geometry"]["location"]["lng"].").lng()  )
    {
          
          var nam=\"".$xyz["name"]."\" ;
         document.getElementById('fare').innerHTML =\"<h4 style='float:left;margin-right:5px;color:blue;'> \" + nam + \" </h4><br>\" + \"<br>\" ;
        
	
         
   }
";
}
echo "
}
			google.maps.event.addDomListener(window, 'load', initialize);
			</script>
		"; ?>
		
	</body>
</html>								
