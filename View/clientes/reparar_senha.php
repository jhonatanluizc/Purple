<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
</head>
<style type="text/css">


</style>
<body>


	<?php
//conectando
	include_once('conexao.php');


//pegando dados por post
	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];	
	$datanascimento = $_POST['datanascimento'];	
	$cpf = $_POST['cpf'];
	$senha1 = $_POST['senha'];
	$senha = sha1($senha1);
	$email = $_POST['email'];

	$nome = ucfirst(trim($nome));
	$sobrenome = ucwords(trim($sobrenome));
	$email = strtolower($email);


	$select = ("select * from clientes where nome='$nome' and sobrenome='$sobrenome' and datanascimento='$datanascimento' and cpf='$cpf' and sobrenome='$sobrenome' and email='$email'");
	$result = $conn->query($select);

	if ($result->num_rows > 0) 
	{   

		$sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', datanascimento = '$datanascimento', cpf = '$cpf', senha = '$senha', email = '$email' where email='$email' and nome='$nome' ";

		if ($conn->query($sql) === TRUE) {    
			echo "<script>window.alert('$nome\\nSenha Alterada com Sucesso!');javascript:history.go(-2);</script>";
			
		} else {
			echo "<script>window.alert('Erro ao Alterar a Senha\\n$nome');</script>" . $sql . "<br>" . $conn->error;
			header('Location:javascript:history.go(-3)');	
		}

	}
	else{
		echo "<script>window.alert('Verifique os Dados e Tente Novamente!');javascript:history.go(-1);</script>";

	}

	

	mysqli_close($conn);
	?>

	


</script>

</body>
</html>