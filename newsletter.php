<?php 


	$email = $_POST["email"];

	include_once('gerenciamento/conexao.php');

	$select = ("select * from newsletter where email='$email'");
	$result = $conn->query($select);

	if ($result->num_rows == 0) 
	{   
		$sql = "INSERT INTO newsletter (email) VALUES ('$email')";
//relatorio
		if ($conn->query($sql) === TRUE) {    
			echo "<script type='text/javascript'> alert('E-mail salvo com sucesso');history.go(-1);</script>";
		} 
		else {
			echo "<script type='text/javascript'> alert('Algo errado não está certo!');history.go(-1);</script>" . $sql . "<br>" . $conn->error;
		}
	}else {

echo "<script type='text/javascript'> alert('E-mail já cadastrado');history.go(-1);</script>";


	}
	mysqli_close($conn);

 ?>