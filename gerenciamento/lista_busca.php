<!DOCTYPE html>
<html>
<head>
	<title>Resultado Da Consulta</title>
</head>

<body>
	<div align="center">
		<a href="index.php"><button >Home</button></a>
		<a href="cadastro.php"><button >Cadastrar</button></a>
		<a href="consulta.php"><button>Consultar</button></a>
		<a href="lista_busca.php"><button>Listar</button></a>
		<a href="alterar_busca.php"><button>Alterar</button></a>
		<a href="deletar_busca.php"><button>Deletar</button></a>
	</div>
	*clique na imagem para ver os detalhes
	<?php
	include_once('conexao.php');

	$select = ("select * from itens");
	$result = $conn->query($select);

	echo "<table border='1px'>";
	echo "<tr><th width='100px' align='center'>Código</th>";
	echo "<th width='200px'>Nome</th>";
	echo "<th width='200px'>Categoria</th>";
	echo "<th width='200px'>Marca</th>";
	echo "<th width='200px'>Preço</th>";
	echo "<th width='100px'>Detalhes</th><tr>";


	if ($result->num_rows > 0) 
	{		
		while($row = $result->fetch_assoc()) 
		{
			echo "<tr>";
			echo "<td align='center'>". $row['codigo']."</td>";
			echo "<td align='center'>". $row['nome']."</td>";
			echo "<td align='center'>". $row['categoria']."</td>";
			echo "<td align='center'>". $row['marca']."</td>";
			echo "<td align='center'>R$ " . $row['precoboleto']."</td>";
			
			$icone = "".$row['icone']."";
			$codigo = "".$row['codigo']."";			
			echo "<td align='center' ><a href='lista_detalhes.php?codigo=$codigo'><img width='100px' heigth='100px' src='$icone'></a></td>";
			echo "<tr>";		
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


</body>
</html>