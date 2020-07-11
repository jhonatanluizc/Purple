<!DOCTYPE html>
<html>
<head>
	<title>Resultado Da Consulta</title>
</head>
<body>
	<?php
	include_once('conexao.php');

	$codigo = $_POST['codigo'];
	$nome = $_POST['nome'];
	$categoria = $_POST['categoria'];
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$precoboleto = $_POST['precoboleto'];
	$precocartao = $_POST['precocartao'];
	$brevedescricao = $_POST['brevedescricao'];
	$descricao = $_POST['descricao'];	
	
	$ico = $_POST['ico'];
	$imagem1 = $_POST['imagem1'];
	$imagem2 = $_POST['imagem2'];
	$imagem3 = $_POST['imagem3'];
	$imagem4 = $_POST['imagem4'];
	$video = $_POST['video'];
	$estoque = $_POST['estoque'];

	if (empty($precocartao)) {
		$precocartao = $precoboleto + ($precoboleto*0.12);

	}
	
//criando diretorio
	if (!file_exists("imagens")){
		mkdir("imagens",0700);
	}
	if (!file_exists("imagens/$categoria")){
		mkdir("imagens/$categoria",0700);
	}
	if (!file_exists("imagens/$categoria/$nome")){
		mkdir("imagens/$categoria/$nome",0700);
	}

//movendo imagens
	
	$icone = "imagens/$categoria/$nome/" . $_FILES['icone']['name'];
	if ("imagens/$categoria/$nome/" == $icone) 
	{
		$icone = "$ico";
	}
	$arquivo_tmp = $_FILES['icone']['tmp_name'];
	move_uploaded_file( $arquivo_tmp, $icone );
	

	$img1 = "imagens/$categoria/$nome/" . $_FILES['img1']['name'];
	if ("imagens/$categoria/$nome/" == $img1) 
	{
		$img1 = "$imagem1";
	}
	$arquivo_tmp = $_FILES['img1']['tmp_name'];
	move_uploaded_file( $arquivo_tmp, $img1 );

	$img2 = "imagens/$categoria/$nome/" . $_FILES['img2']['name'];
	if ("imagens/$categoria/$nome/" == $img2) 
	{
		$img2 = "$imagem2";
	}
	$arquivo_tmp = $_FILES['img2']['tmp_name'];
	move_uploaded_file( $arquivo_tmp, $img2 );

	$img3 = "imagens/$categoria/$nome/" . $_FILES['img3']['name'];
	if ("imagens/$categoria/$nome/" == $img3) 
	{
		$img3 = "$imagem3";
	}
	$arquivo_tmp = $_FILES['img3']['tmp_name'];
	move_uploaded_file( $arquivo_tmp, $img3 );

	$img4 = "imagens/$categoria/$nome/" . $_FILES['img4']['name'];
	if ("imagens/$categoria/$nome/" == $img4) 
	{
		$img4 = "$imagem4";
	}
	$arquivo_tmp = $_FILES['img4']['tmp_name'];
	move_uploaded_file( $arquivo_tmp, $img4 );



	$select = ("select * from itens where codigo = $codigo");
	$result = $conn->query($select);


	$sql = "UPDATE itens SET nome = '$nome', categoria = '$categoria', marca = '$marca', modelo = '$modelo', precoboleto = '$precoboleto', precocartao = '$precocartao', brevedescricao = '$brevedescricao',descricao = '$descricao', icone = '$icone', img1 = '$img1', img2 = '$img2', img3 = '$img3', img4 = '$img4', video = '$video', estoque = '$estoque'  WHERE codigo = '$codigo'";



	if ($conn->query($sql) === TRUE) {    
		echo "<script>window.alert('$nome\\nAlterado Com Sucesso!');</script>";
	} else {
		echo "<script>window.alert('Erro Ao Alterar\\n$nome');</script>" . $sql . "<br>" . $conn->error;
	}
	mysqli_close($conn);
	?>

	<div align="center">
		<a href="cadastro.php"><button >Cadastrar</button></a>
		<a href="consulta.php"><button>Consultar</button></a>
		<a href="lista_busca.php"><button>Listar</button></a>
		<a href="alterar_busca.php"><button>Alterar</button></a>
		<a href="deletar_busca.php"><button>Deletar</button></a>
	</div>
	<div align="center">
		<a href="index.php"><button >Home</button></a>
		<a href="cadastro.php"><button >Cadastrar</button></a>
		<a href="consulta.php"><button>Consultar</button></a>
		<a href="lista_busca.php"><button>Listar</button></a>
		<a href="alterar_busca.php"><button>Alterar</button></a>
		<a href="deletar_busca.php"><button>Deletar</button></a>
	</div>
	Detelhes do Produto:<br>
	Codigo: <?php echo $codigo ?><br>
	Nome: <?php echo $nome ?><br>
	Categoria: <?php echo $categoria ?><br>
	Marca: <?php echo $marca ?><br>
	Modelo: <?php echo $modelo ?><br>
	Preco No Boleto: <?php echo $precoboleto ?><br>
	Preco No Cartão: <?php echo $precocartao ?><br>
	Breve Descrição: <?php echo $brevedescricao ?><br>
	Descrição: <?php echo $descricao ?><br>
	Icone: <?php echo $icone ?><br><img src="<?php echo $icone?>" height="10%" width="10%"><br>
	Imagem 1: <?php echo $img1 ?><br><img src="<?php echo $img1?>" height="10%" width="10%"><br>
	<?php 
	if (empty($img2)) {
		echo "Imagem 2: não ha imagem <br>";
	}
	else{
		echo "Imagem 2: $img2 <br> <img src='$img2' height='10%' width='10%'><br>";
	}

	if (empty($img3)) {
		echo "Imagem 3: não ha imagem <br>";
	}
	else{
		echo "Imagem 3: $img3 <br> <img src='$img3' height='10%' width='10%'><br>";
	}

	if (empty($img4)) {
		echo "Imagem 4: não ha imagem <br>";
	}
	else{
		echo "Imagem 4: $img4 <br> <img src='$img4' height='10%' width='10%'><br>";
	}

	if (empty($video)) {
		echo "Video: não há video <br>";
	}
	else{
		echo "Video:<br>";
		echo "<iframe width='560' height='315' src='$video' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe><br>";
	}

	?>
	Estoque: <?php echo $estoque ?><br>

</body>
</html>