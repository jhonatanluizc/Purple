<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<!-- Bootstrap core CSS -->
	<link href="../bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">   
	<!-- meus estilos -->
	<link href="../css/estilos.css" rel="stylesheet">
	
	<script src="../jquery-3.3.1-dist/jquery-3.3.1.js"></script>

	<script src="../validar/cpf.js"></script>
	<script src="../validar/senha.js"></script>
	<script src="../validar/email.js"></script>
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

			<div class="container" style="color: white;">
				<form class="mt-5" method="post" action="cadastro_cliente.php" >

					<div class="row" >
						<div class="col mt-4">
							<label>* Nome:</label>
							<input required type="text" name="nome" class="form-control form-control-lg">
						</div>
						<div class="col mt-4">
							<label>* Sobrenome:</label>
							<input required type="text" name="sobrenome" class="form-control form-control-lg">
						</div>
					</div>

					<div class="row">
						<div class="col mt-4">
							<label>* Data De Nascimento: </label>
							<input required name="datanascimento" min="1900-01-01" max="<?php $date = date('Y-m-d'); echo("$date") ?>" type="date" class="form-control form-control-lg">
						</div>

						<div class="col mt-4">
							<label>* CPF:</label>
							<input required onkeypress="mascara(this, '###.###.###-##')" minlength="11" required type="text" maxlength="14" minlength="14" id="cpf" pattern="[0-9 -.]+" name="cpf" class="form-control form-control-lg">

						</div>
					</div>

					<div class="row">
						<div class="col mt-4">
							<label>* Senha:</label>
							<input required id="senha" name="senha" type="password" class="form-control form-control-lg">
							<label><small>Pelo menos 8 caracteres</small></label>
						</div>
						<div class="col mt-4">
							<label>* Confirmar Senha:</label>
							<input required id="vsenha" type="password" class="form-control form-control-lg">
						</div>
					</div>

					<div class="row">
						<div class="col mt-4">
							<label>* E-mail:</label>
							<input required id="email" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control form-control-lg">
						</div>
						<div class="col mt-4">
							<label>* Confirmar E-mail:</label>
							<input required id="vemail" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control form-control-lg">
						</div>
					</div>
					<div style="float: right;">
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

	<footer class="py-5 footer">
		<div class="container">
			<p class="text-center text-white">Copyright &copy; Purple Informática 2018</p>
		</div>
		<!-- /.container -->
	</footer>



</body>
</html>