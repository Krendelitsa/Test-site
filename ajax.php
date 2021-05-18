<?php
require_once ('function.php');

addTextToArray($_POST['text'], $_POST['userId']);


$messages = getTextArray();

foreach ($messages as $message){
    if ($message['user'] == 1){
		echo "<div class='user_1'>" . "<img src='http://localhost/images/pixie.jpg' alt='Avatar' width='100' height='100' class='user_avatar1' ><p class='name_user1'>Pixie</p><div class='container1' align='left'></div>";
	    echo "<div class='user_1'>" . $message['text'] . "</div>";
}
	if ($message['user'] == 2){
		echo "<div class='user_2'>" . "<img src='http://localhost/images/brut.jpg' alt='Avatar' width='100' height='100' class='user_avatar2' ><p class='name_user2'>Brut</p> <div class='container2' align='left'></div>";
	    echo "<div class='user_2'>" . $message['text'] . "</div>";
}
	if ($message['user'] == 3){
		echo "<div class='user_3'>" . "<img src='http://localhost/images/racoon.jpg' alt='Avatar' width='100' height='100' class='user_avatar3' ><p class='name_user3'>Racoon</p><div class='container3' align='left'></div>";
		echo "<div class='user_3'>" . $message['text'] . "</div>";
}
}
?>
