<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">

		<link href="style.css" rel="stylesheet"></link>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        </script>
		<title>chat</title>
	</head>
	
<body class="body">
	<p class="name_chat">
	<img width="100" height="100" <img src="http://localhost/images/avachat.jpg" class="img_chat" alt="avatar chat" align="left" 
  vspace="5" hspace="5"/>Friends
	</p>    
	<hr class="hr">
	<div id="messages"></div>
			<input class="input" type="text" placeholder="message..." id="text">
			<input type="submit" class="send" value="send" id="send">
			<input type="hidden" id="userId" value="<?=$_GET['userId']?>">
	
			<script src="script.js"></script>
</body>
</html>

