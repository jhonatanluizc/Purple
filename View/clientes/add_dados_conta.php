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
	$email = $_SESSION['email'];
	$senha = $_SESSION['senha'];

	include_once('conexao.php');

	$rg = $_POST['rg'];
	$tel = $_POST['tel'];	
	$cel = $_POST['cel'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	$complemento = $_POST['complemento'];
	$bairro = $_POST['bairro'];
	$cep = $_POST['cep'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];



	$rua = ucwords(trim($rua));
	$complemento = ucwords(trim($complemento));
	$bairro = ucwords(trim($bairro));
	$cidade = ucwords(trim($cidade));
	

	
	$sql = "UPDATE clientes SET rg = '$rg', tel = '$tel', cel = '$cel', rua = '$rua', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cep = '$cep', cidade = '$cidade', estado = '$estado' where email='$email' and senha='$senha'";

	if ($conn->query($sql) === TRUE) {    
		echo "<script>window.alert('Salvo Com Sucesso!');javascript:history.go(-2);</script>";

	} else {
		echo "<script>window.alert('Erro Ao Salvar');</script>" . $sql . "<br>" . $conn->error;
		header('Location:javascript:history.go(-3)');	
	}
	

}


$_SESSION['senha'] = $senha;
$_SESSION['email'] = $email;


mysqli_close($conn);
?>