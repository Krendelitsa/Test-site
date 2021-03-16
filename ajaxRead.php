<?php
require_once ('functions.php');

$myId = $_POST['userId'];

$messages = getTextArray();

foreach ($messages as $message){
    if ($message['userId'] == $myId){
        echo "<div class='myMessage'>" . $message['text'] . "</div>";
    }else{
        echo "<div class='notMyMessage'>" . $message['text'] . "</div>";
    }
}

?>




