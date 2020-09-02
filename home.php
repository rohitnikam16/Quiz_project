<?php
	session_start();
	
	if(array_key_exists("id",$_COOKIE)){
		$_SESSION["id"]=$_COOKIE["id"];
	}
	
	
	if(array_key_exists("id",$_SESSION)){
		
	}
	else {
		header("Location: index.php");
	}

?>


<! DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MY QUIZ</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<img id="backgroundimage" src="bckgrnd.jpg" border="0" alt="">
	<div style="margin-left:40px; margin-top:20px" ><a href='index.php?logout=1'> <button class="btn btn-success" style="height:35px">LOG OUT </button></a></div>
    <div class="grid">
		<div id="quiz">
			<h1>QUIZ</h1>
			<hr style="margin-bottom: 20px">
			
			<p id="question"></p>
			
			<div class="buttons">
				<button id="btn0" ><span id="choice0"></span></button>
				<button id="btn1"><span id="choice1"></span></button>
				<button id="btn2"><span id="choice2"></span></button>
				<button id="btn3"><span id="choice3"></span></button>
			<div/>
			
			<button id="next"> Next </button>
			
			
			<hr style="margin-top: 50px">
			<footer>
				<p id="progress">Question x of y.</p>
			</footer>
	    
	</div>
	</div>
	<div id="bton"></div>
	</div>
		
	<script type="text/javascript" src="quiz_controller.js"></script>
	<script type="text/javascript" src="question.js"></script>
	<script type="text/javascript" src="app.js"></script>

</body>
</html>
