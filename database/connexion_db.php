<?php

try {

	$pdo = new PDO("mysql:host=localhost;dbname=magazin_procedural", "root", "");

}catch(PDOException $e)
{
	die("Error due to:" .$e->getMessage());
}


?>