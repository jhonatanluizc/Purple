<?php session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['senha']) )
{
	session_destroy();
	$sessaoNome = "";
}
else
{
	$email = $_SESSION['email'];
	$senha = $_SESSION['senha'];

	include_once('../clientes/conexao.php');

	$select = ("select * from clientes where email='$email' and senha='$senha'");
	$result = $conn->query($select);

	if ($result->num_rows > 0) 
	{   
		while($row = $result->fetch_assoc()) 
		{
			$cliente = " ".$row['id']."";
			$sessaoNome = " ".$row['nome']."";


		}
	} 
	mysqli_close($conn);
}
?>

<?php 
$item = $_GET["codigo"];
$quantidade = 1;

if ($sessaoNome == "") {
	echo "<script type='text/javascript'> alert('Faça o login para acessar!');history.go(-1);</script>";

}
else{
	

	include_once('../gerenciamento/conexao.php');

	$select = ("select * from carrinho where cliente='$cliente' and item='$item'");
	$result = $conn->query($select);

	if ($result->num_rows == 0) 
	{   
		$sql = "INSERT INTO carrinho (cliente, item, quantidade) VALUES ('$cliente','$item','$quantidade')";
//relatorio
		if ($conn->query($sql) === TRUE) {    
			echo "<script type='text/javascript'> alert('Item Adicionado ao Carrinho!');history.go(-1);</script>";
		} 
		else {
			echo "<script type='text/javascript'> alert('Algo errado não está certo!');history.go(-1);</script>" . $sql . "<br>" . $conn->error;
		}
	}else {


		$select = ("select * from carrinho where cliente='$cliente' and item='$item'");
		$result = $conn->query($select);

		if ($result->num_rows > 0) 
		{   
			while($row = $result->fetch_assoc()) 
			{
				$quantidade = " ".$row['quantidade']."";
				$id = " ".$row['id']."";
			}
		} 

		if ($quantidade>=20) {
			echo "<script type='text/javascript'> alert('Limite Excencido!');history.go(-1);</script>";
		}else{
		$quantidade = $quantidade + 1;
		$sql = "UPDATE carrinho SET quantidade = '$quantidade' where id = $id ";

		if ($conn->query($sql) === TRUE) {    
			echo "<script type='text/javascript'> alert('Item Atualizado!');history.go(-1);</script>";
		} else {
			echo "<script type='text/javascript'> alert('Algo errado não está certo!');history.go(-1);</script>" . $sql . "<br>" . $conn->error;
		}
		}

	}


	




}

?>