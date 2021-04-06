
<?php
require_once ('functions.php');

addTextToArray($_POST['text'], $_POST['userId']);


$messages = getTextArray();

foreach ($messages as $message){
    if ($message['userId'] == 1){
		echo "<div class='first'>" . "<img src='https://domizo.ru/wp-content/uploads/2018/05/grafika4.jpg' id = 'first'>", 'Эрих' . "</div>";
	echo "<div class='first'>" . $message['text'] . "</div>";
    }
	if ($message['userId'] == 2){
	
        echo "<div class='second'>" . "<img src='https://st.depositphotos.com/1815178/5093/v/600/depositphotos_50932571-stock-illustration-ink-splash-illustration-of-rose.jpg' id='second'>", 'Мария' . "</div>";
echo		"<div class='second'>" . $message['text'] . "</div>";
    }
	if ($message['userId'] == 3){
        echo "<div class='third'>" . "<img src='https://avatarko.ru/img/kartinka/2/zhivotnye_loshad_1870.jpg' id = 'third'>", 'Ремарк' . "</div>";
        echo "<div class='third'>" . $message['text'] . "</div>";
    }
}

?>
