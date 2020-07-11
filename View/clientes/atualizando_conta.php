<?php
session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['senha']) ) {
	header('Location:javascript:history.go(-1)');
}


if (!isset($_SESSION['email']) or !isset($_SESSION['senha']) )
{
	session_destroy();
	$sessaoNome = "";
}
else
{
	$Semail = $_SESSION['email'];
	$Ssenha = $_SESSION['senha'];

	include_once('conexao.php');

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];	
	$datanascimento = $_POST['datanascimento'];	
	$cpf = $_POST['cpf'];
	$senha = $_POST['senha'];
	$email = $_POST['email'];

	$nome = ucfirst(trim($nome));
	$sobrenome = ucwords(trim($sobrenome));
	$email = strtolower($email);	


	if (!empty($senha)) {

	$senha = sha1($senha);
	$sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', datanascimento = '$datanascimento', cpf = '$cpf', senha = '$senha', email = '$email' where email='$Semail' and senha='$Ssenha' ";

	if ($conn->query($sql) === TRUE) {    
		echo "<script>window.alert('$nome\\nAlterado Com Sucesso!');javascript:history.go(-2);</script>";			
	}else{
		echo "<script>window.alert('Erro Ao Alterar\\n$nome');</script>" . $sql . "<br>" . $conn->error;
		header('Location:javascript:history.go(-3)');	
	}
	$_SESSION['senha'] = $senha;

	}else{
		$sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', datanascimento = '$datanascimento', cpf = '$cpf', email = '$email' where email='$Semail' and senha='$Ssenha' ";

	if ($conn->query($sql) === TRUE) {    
		echo "<script>window.alert('$nome\\nAlterado Com Sucesso!');javascript:history.go(-2);</script>";			
	}else{
		echo "<script>window.alert('Erro Ao Alterar\\n$nome');</script>" . $sql . "<br>" . $conn->error;
		header('Location:javascript:history.go(-3)');	
	}
	}





	
}


$_SESSION['email'] = $email;


mysqli_close($conn);
?>











