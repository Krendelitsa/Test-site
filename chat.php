<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>

<link rel="stylesheet" type="text/css" href="css.css">
<title> Chat </title>
</head>
<body>

<div id = "chat">
<div id="messages">Загрузка...</div>
</div>
<div class = "input">
<form action = "chat.php" method="post">
<input placeholder= "Введите сообщение" id = "text"/>
    <input type="hidden" id="userId" value="<?=$_GET['userId']?>">
</form>
<button id = "send"> Отправить </button>

</div>

<script src="script.js"> </script>
</body>