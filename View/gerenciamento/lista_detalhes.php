<!DOCTYPE html>
<html>
<head>
	<title>Resultado Da Consulta</title>
</head>
<body>
	<?php
	include_once('conexao.php');
	
	$codigo = $_GET['codigo'];


	$select = ("select * from itens where codigo='$codigo'");
	$result = $conn->query($select);

	if ($result->num_rows > 0) 
	{		
		while($row = $result->fetch_assoc()) 
		{
			$codigo = "".$row['codigo']."";
			$nome = "".$row['nome']."";
			$categoria = "".$row['categoria']."";
			$marca = "".$row['marca']."";
			$modelo = "".$row['modelo']."";
			
			$precoboleto = "".$row['precoboleto']."";
			$precocartao = "".$row['precocartao']."";
			$brevedescricao = "".$row['brevedescricao']."";
			$descricao = "".$row['descricao']."";
			$icone = "".$row['icone']."";
			
			$img1 = "".$row['img1']."";
			$img2 = "".$row['img2']."";
			$img3 = "".$row['img3']."";
			$img4 = "".$row['img4']."";
			$video = "".$row['video']."";
			$estoque = "".$row['estoque']."";
		}
	} 
	else
	{
		echo "0 results <br>";
		echo "<script>javascript:history.back(-2)</script>";		
		echo "<script>javascript:alert('Não Encontrado!')</script>";

	}
	mysqli_close($conn);
	?>
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

	
	

	<!--print "<p>".nl2br($produto['detalhes_do_produto'])."</p>";-->
</body>
</html>