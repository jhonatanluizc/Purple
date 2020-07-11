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

if ($sessaoNome == "") {
	echo "<script type='text/javascript'> alert('Erro com o login!');history.go(-1);</script>";

}
else{
	

	include_once('../gerenciamento/conexao.php');

	$select = ("select * from favorito where cliente='$cliente' and item='$item'");
	$result = $conn->query($select);

	if ($result->num_rows == 0) 
	{   
		$sql = "INSERT INTO favorito (cliente, item) VALUES ('$cliente','$item')";
//relatorio
		if ($conn->query($sql) === TRUE) {    
			echo "<script type='text/javascript'> alert('Item Adicionado ao favorito!');history.go(-1);</script>";
		} 
		else {
			echo "<script type='text/javascript'> alert('Algo errado não está certo!');history.go(-1);</script>" . $sql . "<br>" . $conn->error;
		}
	}else {


		$select = ("select * from favorito where cliente='$cliente' and item='$item'");
		$result = $conn->query($select);

		if ($result->num_rows > 0) 
		{   
			while($row = $result->fetch_assoc()) 
			{

				$id = " ".$row['id']."";
			}
		} 


		
		//$sql = "UPDATE carrinho SET quantidade = '$quantidade' where id = $id ";
		$sql = "DELETE FROM favorito WHERE id = '$id'";

		if ($conn->query($sql) === TRUE) {    
			//echo "<script type='text/javascript'> alert('Item Atualizado!');history.go(-1);</script>";
			echo "<script type='text/javascript'>history.go(-1);</script>";
		} else {
			echo "<script type='text/javascript'> alert('Algo errado não está certo!');history.go(-1);</script>" . $sql . "<br>" . $conn->error;
		}

	}


	




}

?>