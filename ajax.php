<?php
require_once ('function.php');

addTextToArray($_POST['text'], $_POST['userId']);


$messages = getTextArray();

foreach ($messages as $message){
    if ($message['userId'] == 1){
		echo "<div class='user_1'>" . "<img src='https://cdn1.savepice.ru/uploads/2021/3/9/97110b25866fae89044479006c3fca29-full.jpg' alt='Avatar'width='100' height='100' class='user_avatar1' > <p class='name_user1'>Pixie</p>  <div class='container1' align='left'> </div>";
	    echo "<div class='user_1'>" . $message['text'] . "</div>";
}
	if ($message['userId'] == 2){
		echo "<div class='user_2'>" . "<img src='https://cdn1.savepice.ru/uploads/2021/3/9/744698587c6f37316592335796fbc5c6-full.jpg' alt='Avatar'width='100' height='100' class='user_avatar2' > <p class='name_user2'>Brut</p>  <div class='container2' align='left'> </div>";
	    echo "<div class='user_2'>" . $message['text'] . "</div>";
}
	if ($message['userId'] == 3){
		echo "<div class='user_3'>" . "<img src='https://cdn1.savepice.ru/uploads/2021/3/9/9ab1b97f7932483b26bf2b4ab71f1942-full.jpg' alt='Avatar'width='100' height='100' class='user_avatar3' > <p class='name_user3'>Racoon</p>  <div class='container3' align='left'> </div>";
		echo "<div class='user_3'>" . $message['text'] . "</div>";
}
}
?>