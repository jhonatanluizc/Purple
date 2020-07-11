<?php session_start();

if (!isset($_SESSION['email']) or !isset($_SESSION['senha']) ) {
	header('Location:javascript:history.go(-1)');
}



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
			$sessaoNome = " ".$row['nome']."";

			$nome = "".$row['nome']."";
			$sobrenome = "".$row['sobrenome']."";	
			$datanascimento = "".$row['datanascimento']."";	
			$cpf = "".$row['cpf']."";
			$senha = "".$row['senha']."";
			$email = "".$row['email']."";

			$rg = "".$row['rg']."";
			$tel = "".$row['tel']."";	
			$cel = "".$row['cel']."";	

			$rua = "".$row['rua']."";
			$numero = "".$row['numero']."";
			$complemento = "".$row['complemento']."";
			$bairro = "".$row['bairro']."";
			$cep = "".$row['cep']."";
			$cidade = "".$row['cidade']."";
			$estado = "".$row['estado']."";



		}
	} 
	mysqli_close($conn);
}
?>
<?php 
$envio = $_POST['envio'];
?>
}


<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<!-- Bootstrap core CSS -->
	<link href="../bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">   
	<!-- meus estilos -->
	<link href="../css/estilos.css" rel="stylesheet">
	
	<script src="../jquery-3.3.1-dist/jquery-3.3.1.js"></script>
	<script src="../validar/rg.js"></script>
	<script src="../validar/mascara.js"></script>



</head>



<style type="text/css">

</style>
<body>
	<div id="wrap">
		<div id="main">
			<div style="margin-top: 15px;"></div>
			<div align="center" ><a href="../index.php"><img src="../img/pi.png" class="img-fluid mt-5"></a></div>
			<div style="margin-top: 15px;"></div>

			<div class="container" style="color: white">
				<form class="mt-5" method="post" action="add_dados_conta.php?envio=<?php echo $envio ?>" >

					<div class="row" >
						<div class="col mt-4">
							<label  class="ml-2">RG:</label>
							<input required onkeypress="mascara(this, '##.###.###-#')" pattern="[0-9 x X -.]+" maxlength="12" minlength="9" type="text" name="rg" id="rg" value="<?php echo $rg ?>" class="form-control form-control-lg inp-cadstro">
						</div>
						<div class="col mt-4">
							<label class="ml-2">Telefone:</label>
							<input required onkeypress="mascara(this, '## ####-####')" pattern="[0-9 -]+" maxlength="13" minlength="11" type="text" name="tel" id="tel" value="<?php echo $tel ?>" class="form-control form-control-lg inp-cadstro">
						</div>
					</div>

					<div class="row">
						<div class="col mt-4">
							<label class="ml-2">Celular:</label>
							<input required onkeypress="mascara(this, '## #####-####')" pattern="[0-9 -]+" maxlength="13" minlength="11" type="text" name="cel"  id="cel" value="<?php echo $cel ?>" class="form-control form-control-lg inp-cadstro">
						</div>

						<div class="col mt-4">
							<label class="ml-2">CEP:</label>
							<input required onkeypress="mascara(this, '#####-###')" pattern="[0-9 -]+" maxlength="9" minlength="9" type="text" id="cep" name="cep" value="<?php echo $cep ?>" class="form-control form-control-lg inp-cadstro">
						</div>
					</div>

					<div class="row ">
						<div class="col mt-4">
							<label class="ml-2"> Cidade:</label>
							<input required id="cidade" name="cidade" type="text" value="<?php echo $cidade ?>" class="form-control form-control-lg inp-cadstro">
							
						</div>
						<div class="col mt-4">
							<label class="ml-2">Estado:</label>

							<select name="estado"   class="form-control form-control-lg inp-cadstro">
								<option value="<?php echo $estado ?>"><?php echo $estado ?></option>
								<option value="AC">AC</option>
								<option value="AL">AL</option>
								<option value="AP">AP</option>
								<option value="AM">AM</option>
								<option value="BA">BA</option>
								<option value="CE">CE</option>
								<option value="DF">DF</option>
								<option value="ES">ES</option>
								<option value="GO">GO</option>
								<option value="MA">MA</option>
								<option value="MT">MT</option>
								<option value="MS">MS</option>
								<option value="MG">MG</option>
								<option value="PA">PA</option>
								<option value="PB">PB</option>
								<option value="PR">PR</option>
								<option value="PE">PE</option>
								<option value="PI">PI</option>
								<option value="RJ">RJ</option>
								<option value="RN">RN</option>
								<option value="RS">RS</option>
								<option value="RO">RO</option>
								<option value="RR">RR</option>
								<option value="SC">SC</option>
								<option value="SP">SP</option>
								<option value="SE">SE</option>
								<option value="TO">TO</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col mt-4">
							<label class="ml-2">Rua:</label>
							<input required id="rua" name="rua" type="text" value="<?php echo $rua ?>" class="form-control form-control-lg inp-cadstro">
						</div>
						<div class="col mt-4">
							<label class="ml-2">Numero:</label>
							<input required type="text" name="numero" minlength="1" maxlength="5" value="<?php echo $numero ?>" class="form-control form-control-lg inp-cadstro">
						</div>
					</div>
					<div class="row">
						<div class="col mt-4">
							<label class="ml-2">Bairro:</label>
							<input required id="bairro" name="bairro" type="text" value="<?php echo $bairro ?>"  class="form-control form-control-lg inp-cadstro">
						</div>
						<div class="col mt-4">
							<label class="ml-2">Complemento:</label>
							<input required id="complemento" name="complemento" type="text" value="<?php echo $complemento ?>"  class="form-control form-control-lg inp-cadstro">
						</div>
					</div>
					<div class="" style="float: right;">
						<br>
						<button type="submit" class="btn btn-lg mb-2 btn-confirma">Confirmar!</button>
					</div>
				</form>
			</div>
			<!-- uma margem top -->
			<div style="margin-top: 100px;"></div>
			<!-- Footer -->

		</div>
	</div>

	<footer class="py-5 footer" style="background-color: black;">
		<div class="container">
			<p class="m-0 text-center text-white">Copyright &copy; Purple Informática 2018</p>
		</div>
		<!-- /.container -->
	</footer>



</body>
</html>