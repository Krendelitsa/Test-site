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
<form action = "index.php" method="post">
<input placeholder= "Введите сообщение" id = "text"/> 
</form>
<button id = "send"> Отправить </button>

</div>
<div id ="name"> User </div>

<script type="text/javascript">
let button = document.querySelector('#send');
button.onclick = function () {
    let textElement = document.querySelector('#text');
    let textValue = textElement.value;
    $.post( "ajax.php", {text: textValue } , function( text ) {
        let div = document.querySelector('#messages');
        div.textContent = text;
    });
};  //какая-то фигня с привязкой других файлов. css постоянно отваливался, js вообще не подключился.
</script>

	
</body>