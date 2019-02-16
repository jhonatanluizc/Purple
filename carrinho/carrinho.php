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
			$sessaoNome = " ".$row['nome']."";
			$cliente = " ".$row['id']."";

		}
	} 

	
	mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="pt">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Purple - Carrinho</title>
	<!-- Bootstrap core CSS -->
	<link href="../bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript -->
	<script src="../jquery-3.3.1-dist/jquery-3.3.1.js"></script>
	<script src="../bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
	<!-- meus estilos -->
	<link href="../css/estilos.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../css/font/fa-solid.css">
	<link rel="stylesheet" type="text/css" href="../css/font/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="../css/font/fa-brands.css">

	<!-- ajax -->
	<script type="text/javascript" src="funcs.js"></script>

	<!-- css menu -->
	<link href="../css/grayscale.css" rel="stylesheet">

</head>
<style type="text/css">

.card_lista{
	border-width: 2px;
}
.card_lista:hover{
	border-width: 2px;
	transition:all 0.5s linear;
	transition-delay: .1s;
	border-color: #9a37e1;
	border-style: solid;
}

#cardlist_img {
	margin-left: -30px; 
	margin-top: -20px;
	margin-bottom: 7px;
	width: 140px;
	height: 80px;
}

@media(max-width: 767px){
	#cardlist_img{
		margin-left: -8px; 
		width: 160px;
		height: 100px;
	}


}

</style>

<body>

	<div id="wrap">
		<div id="main">
			<!-- Esse é o menu do topo -->
			<nav class="navbar fixed-top" id="mainNav">
				<div class="container">
					<div><a class="js-scroll-trigger" href="../index.php"><img src="../img/icone.png" id="logo_purple"></a> 
						<span  class="dropdown show">
							<a  id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="../img/bar.png" id="bar_purple"></a>
								<div id='drop_menu' class="dropdown-menu" aria-labelledby="dropdownMenuLink">
									<a style="color: black;" class="dropdown-item" href="../lista.php?categoria=computador">Computador</a>
									<a style="color: black;" class="dropdown-item" href="../lista.php?categoria=headset">Headset</a>
									<a style="color: black;" class="dropdown-item" href="../lista.php?categoria=monitor">Monitor</a>           
									<a style="color: black;" class="dropdown-item" href="../lista.php?categoria=mouse">Mouse</a>
									<a style="color: black;" class="dropdown-item" href="../lista.php?categoria=mousepad">MousePad</a>
									<a style="color: black;" class="dropdown-item" href="../lista.php?categoria=notebook">Notebook</a>
									<a style="color: black;" class="dropdown-item" href="../lista.php?categoria=teclado">Teclado</a>
								</span>
							</div>
						</div>
						<form action="../lista.php" method="get">
							<input autocomplete="off" onkeyup="buscarNoticias(this.value)" id="inp_search" placeholder=" Buscar Produtos..." type="search" name="nome" minlength="1" required=""> 				
							<button id="btn_search" type="submit"><i style="color: white;" class="fas fa-search"></i></button>
						</form>
						<div id="btn_nav_all" class="row">
							<div  class="dropdown" >
								<a  id="dropdownMenuButton" data-toggle="dropdown" class=""><i id="btn_nav" class="fas fa-user-circle"></i></a>
								<div id='drop_menu' class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<?php 
									if ($sessaoNome == "") {
										echo "<a  style='color: black;' class='dropdown-item' href='../clientes/login.php'><i class='fas fa-sign-in-alt'></i> Login</a>";
										echo "<a  style='color: black;' class='dropdown-item' href='../clientes/cadastro.php'><i class='fas fa-address-card'></i> Cadastro</a>";
									}
									else{
										echo "<a style='color: black;' class='dropdown-item' href='../clientes/config_conta.php'><i class='fas fa-user'></i> Perfil</a>";
										echo "<a style='color: black;' class='dropdown-item' href='../clientes/dados_conta.php'><i class='fas fa-cog'></i> Conta</a>"; 
										echo "<a style='color: black;' class='dropdown-item' href='../clientes/deslogar.php'><i class='fas fa-sign-out-alt'></i> Sair</a>";
									}
									?>
								</div>
							</div>
							<div class="">
								<?php 
								if ($sessaoNome == "") {
									echo "<a class='' title='Login Necessário!' href='../clientes/login.php'><i style='color:white;' id='btn_nav' class='fas fa-heart ml-1' ></i></a>";
								}
								else{
									echo "<a class='' href='../favorito/favorito.php'><i id='btn_nav' class='fas fa-heart ml-1' ></i></a>";
								}
								?>
							</div>
							<div class="">
								<?php 
								if ($sessaoNome == "") {
									echo "<a class='' title='Login Necessário!' href='../clientes/login.php'><i style='color:white;' id='btn_nav' class='fas fa-shopping-cart ml-1'></i></a>";
								} 
								else{
									echo "<a class='' href='../carrinho/carrinho.php'><i id='btn_nav' class='fas fa-shopping-cart ml-1'></i></a>";
								}
								?>
							</div>				
						</div>
					</div>
				</nav>
				<!-- Terminando o menu do topo -->

				<div align="center" class="fixed-top resultado"><div align="left" id="resultado"></div></div>



				<div style="margin-top: 75px;"></div>
				<div align="center" ><a href="../index.php"><img src="../img/pi.png" class="img-fluid mt-5"></a></div>
				<div style="margin-top: 75px;"></div>



				<div  class="container " style="background-color: white; border-radius: 5px;">




					<?php	

					include_once('../gerenciamento/conexao.php');

					if ($sessaoNome == "") {
						echo "<script>window.location.assign('../index.php');</script>";
					}else{

						$i=0;
						//preocurando itens no carrinho!
						$select = ("select * from carrinho where cliente = $cliente");
						$result = $conn->query($select);

						if ($result->num_rows > 0) 
						{   
							//resultado
							while($row = $result->fetch_assoc()) 
							{
								$item = "".$row['item']."";
								$quantidade = "".$row['quantidade']."";

							//comecanso a lista
								$select2 = ("select * from itens where codigo = $item");
								$result2 = $conn->query($select2);
								if ($result2->num_rows > 0) 
								{   
									while($row = $result2->fetch_assoc()) 
									{
										$codigo = "".$row['codigo']."";
										$nome = "".$row['nome']."";
										$categoria = "".$row['categoria']."";
										$marca = "".$row['marca']."";
										$modelo = "".$row['modelo']."";
										$precoboleto = "".$row['precoboleto']."";
										$precocartao = "".$row['precocartao']."";
										$descricao = "".$row['descricao']."";
										$icone = "".$row['icone']."";	
										$estoque = "".$row['estoque']."";
										$nomer = substr("$nome", 0, 37);

										?>







										<?php
										$cartao = round($precocartao,2);
										$cartaox = number_format($cartao/10, 2,',','.');

										$cartao = number_format($cartao, 2,',','.');
										$subtotal = $precocartao * $quantidade;
										$subtotal = round($subtotal,2);
										$total[$i] = $subtotal;

										$i++;
										$subtotal = number_format($subtotal, 2,',','.');
										?>
										<div class="card card_lista" align="center" ondblclick="location.href='../itens.php?codigo=<?php echo $codigo ?>';">
											<br>
											<div class="row col-md-12">
												<div class=" col-md-2"><a href='../itens.php?codigo=<?php echo $codigo ?>'><img id="cardlist_img" src='../gerenciamento/<?php echo $icone ?>'></a></div>
												<div class=" col-md-3 "><b  style='font-size:15px;'><?php echo $nomer ?></b></div>
												<div class=" col-md-2" '>Preço<br><b style='color:red;'>R$<?php echo $cartao ?></b><br></div>

												<div class=" col-md-2 mt-2"><a href='menoscarrinho.php?codigo=<?php echo $codigo ?>'><i class='fas fa-minus-circle'></i></a><b> <?php echo $quantidade ?> </b><a href='maiscarrinho.php?codigo=<?php echo $codigo ?>'><i class='fas fa-plus-circle'></i></a></div>

												<div class=" col-md-2"'>Subtotal<br><b  style='color:red;'>R$<?php echo $subtotal ?></b></div>

												<div class=" col-md-1 mt-2" style='color:red;'><a  href='deletecarrinho.php?codigo=<?php echo $codigo ?>' ><i class='fas fa-trash-alt' ></i></a></div>
											</div>
										</div>
										<?php


									}

								}
							// fim da lista


							}
						}
						else{
				//echo "<script type='text/javascript'>alert('Carrinho Vazio!')</script>";
				//echo "<script type='text/javascript'>history.go(-1)</script>";

							?>
							<div class="container" align="center" style="background-color: white; border-radius: 20px;">
								<br>
								<div style="border-radius: 15px; border-style: solid; border-width: 1px; border-color: black;">
									<br>


									<i id="ico_error"class="fas fa-shopping-cart"></i>
									<br>

									<h3 id="h3_error" style="margin-top: 30px;">Nenhum produto encontrado em seu carrinho</h3>
									<br>
									<h5 id="h5_error">Adicione um produto e tente novamente</h5>
									<br>
								</div>
								<br>


							</div>
							<?php
						}


					}




					mysqli_close($conn);
					?>










					<hr>


					<?php

					if (empty($quantidade)) {
						$total = 0;
					}else{$total = array_sum($total);}




					?>
					<?php 
					if ($total>0) {

						?>

						<div  class="container row">

							<div class="col-md-4 ">
								<form method="post" class="mt-2" action="../frete/calcula_frete_carrinho.php?itemTotal=<?php echo $total ?>&qnt=<?php echo $i ?>">

									<div ><i class="fas fa-truck"></i><smail> Calcular o Frete e Prazos:</smail></div>

									<input type="" style="width: 50%; border-style: solid; border-width: 2px 0px 2px 2px; border-radius: 2px 0px 0px 2px;" name="cep">
									<input type="submit" style="margin-left: -5px; border-style: solid; border-radius: 0px 2px 2px 0px;" class="btn-primary"  name="" value="OK"><br>
									<a href=""><small onclick="window.open('http://www.buscacep.correios.com.br/sistemas/buscacep/');">Não sei meu CEP</small></a>

								</form>
								<?php 



								if (!empty($_GET['totalPac'])) {



									$totalPac = $_GET['totalPac'];
									$prazoPac = $_GET['prazoPac'];
									$totalSedex = $_GET['totalSedex'];
									$prazoSedex = $_GET['prazoSedex'];



									$totalPac =number_format($totalPac,2,",",".");
									$totalSedex =number_format($totalSedex,2,",",".");
									echo "<small>Correios PAC - $prazoPac dia(s) úteis R$$totalPac<br>";
									echo "Correios SEDEX - $prazoSedex dia(s) úteis R$$totalSedex</small>";




								}

								?>
							</div>

							<div class="col-md-4">




								<h2 >Total</h2>

								<h4 class="fc-red"> R$<?php echo number_format($total,2,",","."); ?></h4>
								<h6><b class="fc-red">10x de R$<?php echo number_format($total/10,2,",","."); ?></b> sem juros no cartão</h6>

								<h4 class="fc-green">R$<?php echo number_format($total-($total*0.12),2,",","."); ?></h4>
								<h6>No boleto com 12% de desconto</h6>


								<div  class="mt-4">





								</div>

							</div>

							<div class="col-md-4">
								<form action="../compra/dados_conta.php" method="post">
									<i class="fas fa-truck"></i> Modo De Envio:
									<br>

									<input required type="radio" name="envio" value="pac" > Correios PAC<br>
									<input type="radio" name="envio" value="sedex"> Correios SEDEX<br>
									<hr>

									<input type="submit"  value="Confirmar Compra" class="btn btn-lg mb-2 mt-2 btn-confirma">
								</form>

							</div>



						</div>

					</div>     

				<?php } echo "</div>"; ?>





				<!-- uma margem top -->
				<div style="margin-top: 80px;"></div>


			</div>
		</div>
		<!-- aqui começa o rodapé -->
		<div class="footer">
			<footer class="py-3">
				<div class="container ">
					<div class="row" align="center">
						<div class="col-md-8">
							<div class="navbar-brand"><span class="footer_form" > Inscreva e receba nossas promoções &nbsp;&nbsp;&nbsp;</span>
								<form method="post" action="../newsletter.php" class="form-inline" >
									<input required="" name="email" id="inp_pesquisa" class="form-control-lg" type="email" placeholder="Digite seu e-mail:" aria-label="Search">
									<button id="btn_pesquisa" class="btn-lg btn-outline-dark" type="submit"><i id="pesq_ico" class="fas fa-check"></i></button>        
								</form>
							</div>
						</div>
						<div class="col col-md-4 mt-2">
							<h4 class="fc-white">Siga-nos</h4>
							<a href="https://www.facebook.com/PurpleInformatica/"><i class="fab fa-facebook-square fs-40 fc-purple"></i></a>
							&nbsp;&nbsp;&nbsp;
							<a href="https://www.instagram.com/purpleinformatica/"><i class="fab fa-instagram fs-40 fc-purple" ></i></a>
						</div>
					</div>
				</div>
				<div class="container mt-4">
					<p class="text-center text-white">Copyright &copy; Purple Informática 2018</p>
				</div>
			</footer>
		</div>
		<!-- aqui termina o rodapé -->

		<!-- Custom scripts for this template -->
		<script src="../js/grayscale.js"></script>


	</body>

	</html>
