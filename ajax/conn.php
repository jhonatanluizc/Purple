<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$db = "purple";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
	die("<script>window.alert('Erro na conexão');</script>" . $conn->connect_error);  
} 
//echo "<script>window.alert('Conectado a $db');</script>";
?>
