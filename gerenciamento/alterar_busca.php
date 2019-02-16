<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alterar Item</title>
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
	<form name="Item" action="alterar.php" method="post">
		Código:
		<input type="number" name="codigo"><br><br>
		<input type="submit" value="Ok">
		<input type="reset" value="Limpar">
		<a href="index.php"><input type="button" value="Voltar"></a>
	</form>
</body>
</html>