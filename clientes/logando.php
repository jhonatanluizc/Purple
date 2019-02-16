	<?php
	session_start();
	include_once('conexao.php');
	$email = $_POST['email'];
	$senha1 = $_POST['senha'];
	$senha = sha1($senha1);
	$select = ("select * from clientes where email='$email' and senha='$senha'");
	$result = $conn->query($select);
	if ($result->num_rows > 0) 
	{   
		$_SESSION['email'] = $email;
		$_SESSION['senha'] = $senha;
		echo "<script>javascript:history.go(-2)</script>";
	} 
	else
	{	
		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);
		echo "0 results <br>";
		echo "<script>javascript:history.go(-1)</script>";    
		echo "<script>javascript:alert('Usuário Não Encontrado!\\nSenha ou login Incorreto!')</script>";
	}
	mysqli_close($conn);
	?>