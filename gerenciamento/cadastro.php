<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Purple Informática</title>
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
	
	<form method="POST" action="cadastro_info.php" enctype="multipart/form-data">
		<label>Nome:</label><br>
		<input type="text" name="nome" pattern="[- a-zA-Z0-9á-úÁ-Ú_, ]+" required=""><br>
		<label>Categoria:</label><br>
		<input type="text" name="categoria" pattern="[- a-zA-Z0-9á-úÁ-Ú_, ]+" required=""><br>
		<label>Marca:</label><br>
		<input type="text" name="marca" required=""><br>
		<label>Modelo:</label><br>
		<input type="text" name="modelo" required=""><br>
		<label>Preço No Boleto:</label><br>
		<input type="number" step="0.01" name="precoboleto" required=""><br>
		<label>Preço No Cartão:</label><br>
		<input type="number" step="0.01" name="precocartao"><br>
		<label>Breve Descrição:</label><br>
		<textarea name="brevedescricao" rows='3' cols='100' style="resize: none;" required=""></textarea><br>
		<label>Descrição:</label><br>
		<textarea name="descricao" rows='3' cols='100' style="resize: none;" required=""></textarea><br>
		<label>Icone:</label><br>
		<input type="file" name="icone" required=""><br>
		<label>Imagem 1:</label><br>
		<input type="file" name="img1" required=""><br>
		<label>Imagem 2:</label><br>
		<input type="file" name="img2"><br>
		<label>Imagem 3:</label><br>
		<input type="file" name="img3"><br>
		<label>Imagem 4:</label><br>
		<input type="file" name="img4"><br>
		<label>Video:</label><br>
		<input type="text" name="video"><br>
		<label>Estoque:</label><br>
		<input type="text" name="estoque" required=""><br><br>
		<input type="submit" value="Cadastrar">
		<input type="reset" name="">
	</form>


</body>
</html>