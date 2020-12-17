<?php
	session_start();
	$db_name="parking_db";
	$db_login="root";
	$db_pass="";
	$connexion = new PDO('mysql:host=localhost;dbname='.$db_name, $db_login, $db_pass);
?>