<!DOCTYPE html>
<html>
<head>
	<title>Resultado Da Consulta</title>
</head>
<body>
	<?php
	include_once('conexao.php');
	$codigo = $_POST['codigo'];

	$select = ("select * from itens where codigo = $codigo");
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
	<form method="POST" action="alterar_info.php" enctype="multipart/form-data">
		<label>Código:</label>
		<br>
		<input type="text" name="codigo" readonly value="<?php echo $codigo ?>">
		<br>
		<label>Nome:</label>
		<br>
		<input type="text" name="nome" pattern="[- a-zA-Z0-9á-úÁ-Ú_, ]+" value="<?php echo $nome ?>" required>
		<br>
		<label>Categoria:</label>
		<br>
		<input type="text" name="categoria" pattern="[- a-zA-Z0-9á-úÁ-Ú_, ]+" value="<?php echo $categoria ?>" required>
		<br>
		<label>Marca:</label>
		<br>
		<input type="text" name="marca" value="<?php echo $marca ?>" required>
		<br>
		<label>Modelo:</label>
		<br>
		<input type="text" name="modelo" value="<?php echo $modelo ?>" required>
		<br>
		<label>Preco No Boleto</label>
		<br>
		<input type="number" step="0.01" name="precoboleto" value="<?php echo $precoboleto ?>" required>
		<br>
		<label>Preco No Cartão</label>
		<br>
		<input type="number" step="0.01" name="precocartao" value="<?php echo $precocartao ?>">
		<br>
		<label>Breve Descrição:</label>
		<br>
		<textarea name="brevedescricao" rows='3' cols='100' style="resize: none;" required><?php echo $brevedescricao ?></textarea>
		<br>
		<label>Descrição:</label>
		<br>
		<textarea name="descricao" rows='3' cols='100' style="resize: none;" required><?php echo $descricao ?></textarea>
		<br>
		<label>Icone:</label>
		<br>
		<input type="text" width="30px" name="ico" readonly value="<?php echo $icone ?>">&nbsp;&nbsp;<input type="file" name="icone">
		<br>
		<label>Imagem 1</label>
		<br>
		<input type="text" width="30px" name="imagem1" readonly value="<?php echo $img1 ?>">&nbsp;&nbsp;<input type="file" name="img1">
		<br>
		<label>Imagem 2</label><br>
		<input type="text" width="30px" name="imagem2"  value="<?php echo $img2 ?>">&nbsp;&nbsp;<input type="file" name="img2">
		<br>
		<label>Imagem 3</label>
		<br>
		<input type="text" width="30px" name="imagem3"  value="<?php echo $img3 ?>">&nbsp;&nbsp;<input type="file" name="img3">
		<br>
		<label>Imagem 4</label>
		<br>
		<input type="text" width="30px" name="imagem4"  value="<?php echo $img4 ?>">&nbsp;&nbsp;<input type="file" name="img4">
		<br>
		<label>Video</label>
		<br>
		<input type="text" name="video" value="<?php echo $video ?>">
		<br>
		<label>Estoque</label>
		<br>
		<input type="text" name="estoque" value="<?php echo $estoque ?>" required>
		<br>
		<br>
		<input type="submit" value="Alterar">
		<input type="reset" name="">
	</form>
</body>
</html>