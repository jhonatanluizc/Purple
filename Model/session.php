<?php session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['senha'])) {
	session_destroy();
	$sessaoNome = "";
} else {
	$email = $_SESSION['email'];
	$senha = $_SESSION['senha'];

	include_once('conexao.php');

	$select = ("select * from clientes where email='$email' and senha='$senha'");
	$result = $conn->query($select);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$sessaoNome = " " . $row['nome'] . "";
			$cliente = " " . $row['id'] . "";
		}
	}
	mysqli_close($conn);
}

class Session
{
	function logado()
	{
		include_once("model.php");
		if (isset($_SESSION['email']) && isset($_SESSION['senha'])) {
			$email = $_SESSION['email'];
			$senha = $_SESSION['senha'];

			$model = new Model();
			$result = $model->select("clientes", "where email = '$email' and senha = '$senha'");
			
			foreach ($result as $key => $value) {
				return true;
			}		
		}
		return false;
	}

	function login()
	{
		return true;
	}

	function logout()
	{
		return true;
	}
}