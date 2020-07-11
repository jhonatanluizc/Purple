<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../../Public/vendor/bootstrap/css/bootstrap.min.css">   
	<!-- Estilos -->
	<link rel="stylesheet" href="../../Public/css/style.css">
	<!-- Bootstrap JavaScript -->
	<script src="../../Public/vendor/js/jquery.js"></script>
	<!-- Validation JavaScript -->
	<script src="../../Public/js/validation/cpf.js"></script>
	<script src="../../Public/js/validation/senha.js"></script>
	<script src="../../Public/js/validation/email.js"></script>



</head>



<style type="text/css">

#form_login{width: 60%; margin-left: 20%;}



</style>

<body>
	<div id="wrap">
		<div id="main">
			<div style="margin-top: 15px;"></div>
			<div align="center" ><a href="../index.php"><img src="../img/pi.png" class="img-fluid mt-5"></a></div>
			<div style="margin-top: 15px;"></div>



			<div class="container" style="color: white;">

				<form class="mt-5" method="post" action="logando.php" >


					<div id="form_login">


						<div>
							<label>* E-mail:</label>
							<input required id="email" name="email" type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control form-control-lg ">
						</div>

						<div style="margin-top: 20px;">
							<label>* Senha:</label>
							<input required id="senha" name="senha" type="password"  class="form-control form-control-lg">
							<label><small> <a href="esqueci_senha.php" style="color: white;">Esqueci a Senha</a></small></label>
						</div>
						<div style="margin-top: 20px;">
							<button style="float: right;" type="submit" class="btn btn-lg mb-2 btn-confirma">Confirmar!</button>
						</div>

					</div>	
				</form>

			</div>
		</div>
	</div>


	<!-- Footer -->
	<footer class="py-5 footer">
		<div class="container">
			<p class="text-center text-white">Copyright &copy; Purple Informática 2018</p>
		</div>
		<!-- /.container -->
	</footer>



</body>
</html>