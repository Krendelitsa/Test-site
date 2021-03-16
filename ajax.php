<?php

$text = $_POST['text'];
$file = 'saveText.txt';
file_put_contents($saveText.txt, "\n $text \n", FILE_APPEND);

if (file_exists($saveText.txt)) {
    $text = file_get_contents($saveText.txt);
}
$textArray = file('txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); //почему-то вместо создания файла saveText.txt, создался просто txt. Но код работает корректно, только если писать имя файла везде так же как оно есть сейчас.
foreach($textArray as $value)
{
  echo $value.'<br />';  //не понимаю, как сделать, чтобы строки были отдельно.
}

?>




