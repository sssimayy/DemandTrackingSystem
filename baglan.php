<?php ob_start(); 

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>


<?php

	$dsn = 'mysql:host=127.0.0.1;dbname=bitirmeson;';
$username = 'root';
$password = '';
try {
	$db = new PDO($dsn, $username, $password);
	$db->query("SET CHARACTER SET utf8");
    } catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage(); 
		}



?>

