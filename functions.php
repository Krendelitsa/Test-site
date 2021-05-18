<?php

function addTextToArray($text, $user)
{
$serverName = 'localhost';
$dataBaseName = 'chat';
$userName = 'root';
$password = 'root';

try {
    $connection = new PDO("mysql:host=$serverName;dbname=$dataBaseName", $userName, $password);

    $query = $connection->query("INSERT INTO `messages`(`user`,`text`) VALUES ('".$user."','".$text."')");
}
   catch (PDOException $e){
	   echo $e->getMessage();
   }
	
    return true;
}

function getTextArray()
{
$serverName = 'localhost';
$dataBaseName = 'chat';
$userName = 'root';
$password = 'root';

try {
    $connection = new PDO("mysql:host=$serverName;dbname=$dataBaseName", $userName, $password);
	$query2 = $connection->query("SELECT * FROM `messages`");
	    $result = $query2->fetchAll();
	 return $result;
	 }
   catch (PDOException $e){echo $e->getMessage();}
  
   
}
?>

