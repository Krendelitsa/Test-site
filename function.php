<?php

function addTextToArray($text, $user)
{
    $currentText = getTextArray();
    $currentText[] = [
        'userId' => $user,
        'text' => $text
    ];
    file_put_contents('saveText.txt', serialize($currentText));
    return true;
}

function getTextArray()
{
    if (file_exists('saveText.txt')) {
        $rawText = file_get_contents('saveText.txt');
        return unserialize($rawText);
    }

    return [];
}
?>