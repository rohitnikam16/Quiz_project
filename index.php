<?php
	session_start();
	$error="";
	if(array_key_exists("logout",$_GET)){
		unset($_SESSION['id']);
		setcookie("id","",time()-60*60);
		$_COOKIE["id"]="";
	}
	else if(array_key_exists("id",$_SESSION) OR array_key_exists("id",$_COOKIE))
	{
		header("Location: home.php");
	}
	
	
	if(array_key_exists("submit",$_POST)){
		$link=mysqli_connect("shareddb-m.hosting.stackcp.net","Quiz_Users-3130310756","ouxie74lxm","Quiz_Users-3130310756");
		if(mysqli_connect_error()){
			echo "error bhai";
		}
	
	if(!$_POST['email']){
			$error.="An email address is required<br>";
	}
	if(!$_POST['password']){
			$error.="A password is required";
	}
	if($_POST['signup']=="1"){
	if($error==""){
		$query="SELECT id FROM `users` where email='".mysqli_real_escape_string($link,$_POST['email'])."' ";
		$result=mysqli_query($link,$query);
		if(mysqli_num_rows($result)>0)
		{
			$error.="Email already exists. Please Log in!";
		}
		else {
				$query="INSERT into `users`(`email`,`password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
				if(!mysqli_query($link,$query)){
					$error="Could not sign you up";
				}
				else {
					$query="UPDATE `users` SET `password`='".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE `id`=".mysqli_insert_id($link)." LIMIT 1";
					mysqli_query($link,$query);
					$error="Signed you up! Now Log in";
				}
		}
	}
	}
	else {
		$query= "SELECT * FROM `users` where `email`= '".mysqli_real_escape_string($link,$_POST['email'])."'";
		$result= mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		if(isset($row)){
			$hashedpassword= md5(md5($row['id']).$_POST['password']);
			if($row['password']==$hashedpassword)
			{
				$_SESSION['id']=$row['id'];
				if($_POST['stayLoggedIn']=='1'){
						setcookie("id",mysqli_insert_id($link),time() + 60*60 +24*365);
					}
					header("Location: home.php");
			}
			else $error="Password is incorrect";
		}
		else $error="Email not found. Please Sign up!";
	}
	}

?>



<!doctype html>
<html lang="en">
  <head>
  <link rel="shortcut icon" src="http://rohitwebhosting-com.stackstaging.com/favicon.ico">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style type="text/css">

	.container{
		text-align:center;
		width:400px;
		position:relative;
		left:200px;
		top:250px;
	}
	#backgroundimage{
		height: 100%;
		left: 0;
		margin: 0;
		min-height: 100%;
		min-width: 674px;
		padding: 0;
		position: fixed;
		top: 0;
		width: 100%;
		z-index: -1;
	}
	#loginform{
		display:none;
	}
	</style>


    <title>Quiz</title>
  </head>
  <body>
  <img id="backgroundimage" src="background.jpg" border="0" alt="">
	
	<div class="container">
	<p><h1>Test Your Quiz!</h1></p>
	<div id="error"><?php  echo $error;  ?></div>

<form method="post" id="signupform">
<fieldset class="form-group">
	<input class="form-control" type="email" name="email" placeholder="Your Email">
</fieldset>
<fieldset class="form-group">
	<input class="form-control"  type="password" name="password" placeholder="Password">
</fieldset>
	<input type="hidden" name="signup" value="1">
<fieldset class="form-group">
		<input class="btn btn-success" type="submit" name="submit" value="Sign Up!" style="margin-top: 10px ">
		
</fieldset>

<p style="color:'green'"><a id="loginformm" style=" font-weight:bold; text-decoration:underline " href="#">Log in!</a>

</form>
<form method="post" id="loginform">
<fieldset class="form-group">
	<input class="form-control"  type="email" name="email" placeholder="Your Email">
</fieldset>
<fieldset class="form-group">
	<input class="form-control"  type="password" name="password" placeholder="Password">
</fieldset>

	<input type="hidden" name="signup" value="0">
	
	<input type="checkbox" name="stayLoggedIn" value=1>
	Remember me!
	<fieldset class="form-group">
		<input class="btn btn-success" type="submit" name="submit" value="Log in!" style="margin-top: 10px">
</fieldset>
	<a id="signinform" style=" font-weight:bold; text-decoration:underline " href="#">Sign in!</a>
</form>
	</div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$("#loginformm").click(function(){
			$("#signupform").toggle();
			$("#loginform").toggle();
		});
		$("#signinform").click(function(){
			$("#loginform").toggle();
			$("#signupform").toggle();
		});
	</script>
  </body>
</html>


