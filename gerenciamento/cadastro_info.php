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


//pegando dados
	$nome = $_POST['nome'];
	$categoria = $_POST['categoria'];
	$marca = $_POST['marca'];
	$modelo = $_POST['modelo'];
	$precoboleto = $_POST['precoboleto'];
	$precocartao = $_POST['precocartao'];
	$brevedescricao = $_POST['brevedescricao'];
	$descricao = $_POST['descricao'];	
	$video = $_POST['video'];
	$estoque = $_POST['estoque'];

	
	if (empty($precocartao)) {
		$precocartao = $precoboleto + ($precoboleto*0.12);
	}


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

//$Icone = diretorio
	$icone = "imagens/$categoria/$nome/" . $_FILES['icone']['name'];
	$arquivo_tmp = $_FILES['icone']['tmp_name'];
	move_uploaded_file( $arquivo_tmp, $icone  );



	$img1 = "imagens/$categoria/$nome/" . $_FILES['img1']['name'];
	$arquivo_tmp = $_FILES['img1']['tmp_name'];
	move_uploaded_file( $arquivo_tmp, $img1  );


	$img2 = "imagens/$categoria/$nome/" . $_FILES['img2']['name'];
	if ($img2 != "imagens/$categoria/$nome/") {
		$arquivo_tmp = $_FILES['img2']['tmp_name'];
		move_uploaded_file( $arquivo_tmp, $img2  ); 
	}
	else{
		$img2 = null;
	}


	$img3 = "imagens/$categoria/$nome/" . $_FILES['img3']['name'];
	if ($img3 != "imagens/$categoria/$nome/") {
		$arquivo_tmp = $_FILES['img3']['tmp_name'];
		move_uploaded_file( $arquivo_tmp, $img3  );
	}
	else{
		$img3 = null;
	}
	

	$img4 = "imagens/$categoria/$nome/" . $_FILES['img4']['name'];
	if ($img4 != "imagens/$categoria/$nome/") {
		$arquivo_tmp = $_FILES['img4']['tmp_name'];
		move_uploaded_file( $arquivo_tmp, $img4  );
	}
	else{
		$img4 = null;
	}



//adicionando valores ao banco de dados
	$sql = "INSERT INTO itens (nome, categoria, marca, modelo, precoboleto, precocartao, brevedescricao, descricao, icone, img1, img2, img3, img4, video, estoque)
	VALUES ('$nome','$categoria','$marca','$modelo','$precoboleto','$precocartao','$brevedescricao','$descricao','$icone','$img1','$img2','$img3','$img4','$video','$estoque')";
//relatorio
	if ($conn->query($sql) === TRUE) {    
		echo "<script>window.alert('$nome\\nGravado Com Sucesso!');</script>";
	} else {
		echo "<script>window.alert('Erro Ao Gravar\\n$nome');</script>" . $sql . "<br>" . $conn->error;
	}


	$select = ("select * from itens where nome='$nome' and marca='$marca' and modelo='$modelo'");
	$result = $conn->query($select);

	if ($result->num_rows > 0) 
	{		
		while($row = $result->fetch_assoc()) 
		{
			$codigo = "".$row['codigo']."";
			
		}
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



	Detelhes do cadastro:<br>
	Código:<?php echo $codigo ?><br>
	Nome: <?php echo $nome ?><br>
	Categoria: <?php echo $categoria ?><br>
	Marca: <?php echo $marca ?><br>
	Modelo: <?php echo $modelo ?><br>
	Preço No Boleto: <?php echo $precoboleto ?><br>
	Preco No Cartão: <?php echo $precocartao ?><br>
	Breve Descrição: <?php echo $brevedescricao ?><br>
	Descrição: <?php echo $descricao ?><br>
	Icone: <?php echo $icone ?><br><img src="<?php echo $icone ?>" height="10%" width="10%"><br>
	Imagem 1: <?php echo $img1 ?><br><img src="<?php echo $img1 ?>" height="10%" width="10%"><br>

	<?php 
	if(empty($_FILES['img2']['name'])){
		echo "Imagem 2: não ha imagem <br>";}
		else
		{
			echo "Imagem 2: $img2 <br> <img src='$img2' height='10%' width='10%'><br>";
		}




		if(empty($_FILES['img3']['name']))
		{
			echo "Imagem 3: não ha imagem <br>";
		}
		else
		{
			echo "Imagem 3: $img3 <br> <img src='$img3' height='10%' width='10%'><br>";
		}



		if(empty($_FILES['img4']['name']))
		{
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

		Estoque: <?php echo $estoque; ?><br>



	</body>
	</html>