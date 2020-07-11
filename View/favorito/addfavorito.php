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
	echo "<script type='text/javascript'> alert('Faça o login para acessar!');history.go(-1);</script>";

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
			echo "<script type='text/javascript'> alert('Adicionado a lista de desejos!');history.go(-1);</script>";
		}else 
		{
			echo "<script type='text/javascript'> alert(' Erro ao adicionar a lista de desejos!');history.go(-1);</script>" . $sql . "<br>" . $conn->error;
		}
	}else 
	{		
		echo "<script type='text/javascript'> alert('O item já existe na lista de desejos!');history.go(-1);</script>";
	}
}

?>