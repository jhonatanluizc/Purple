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


	$select = ("select * from clientes where email='$email' or cpf='$cpf'");
	$result = $conn->query($select);

	if ($result->num_rows > 0) 
	{   
		echo "<script language='JavaScript'>var r = confirm('CPF ou Email já cadastrado!\\nTentar Novamente?');if (r == true) {history.go(-1);} else {history.go(-2);}";

	}
	else{

//adicionando valores ao banco de dados
		$sql = "INSERT INTO clientes (nome, sobrenome, datanascimento, cpf, senha, email)
		VALUES ('$nome','$sobrenome','$datanascimento','$cpf','$senha','$email')";
//relatorio
		if ($conn->query($sql) === TRUE) {    
			echo "<script>window.alert('$nome\\nGravado Com Sucesso!');history.go(-2);</script>";

		} else {
			echo "<script>window.alert('Erro Ao Gravar\\n$nome');</script>" . $sql . "<br>" . $conn->error;
		}
	}

	

	mysqli_close($conn);
	?>

	

		
	</script>

</body>
</html>