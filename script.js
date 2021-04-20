let button = document.querySelector('#send');
button.onclick = function () {
    let textElement = document.querySelector('#text');
    let textValue = textElement.value;
	textElement.value = '';
    let userElement = document.querySelector('#userId');
    let userValue = userElement.value;
    $.post( "ajax.php", {text: textValue, userId: userValue} , function( text ) {
        let div = document.querySelector('#messages');
        div.innerHTML = text;
	
    });
};

let timerId = setInterval(() => testTick(), 3000);
function testTick(){
$('#messages').load("ajax.php");
}