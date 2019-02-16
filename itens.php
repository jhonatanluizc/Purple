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

  include_once('clientes/conexao.php');

  $select = ("select * from clientes where email='$email' and senha='$senha'");
  $result = $conn->query($select);

  if ($result->num_rows > 0) 
  {   
    while($row = $result->fetch_assoc()) 
    {
      $sessaoNome = " ".$row['nome']."";

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

  <title>Purple - Item</title>

  <!-- Bootstrap core CSS -->
  <link href="bootstrap-4.0.0-dist/css/bootstrap.css" rel="stylesheet">
  
  <!-- ajax -->
  <script type="text/javascript" src="funcs.js"></script>

  <!-- Bootstrap core JavaScript -->
  <script src="jquery-3.3.1-dist/jquery-3.3.1.js"></script>
  <script src="bootstrap-4.0.0-dist/js/bootstrap.bundle.js"></script>
  <!-- meus estilos -->
  <link href="css/estilos.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="css/font/fa-solid.css">
  <link rel="stylesheet" type="text/css" href="css/font/fontawesome.css">
  <link rel="stylesheet" type="text/css" href="css/font/fa-brands.css">


  <!-- css menu -->
  <link href="css/grayscale.css" rel="stylesheet">



</head>
<style type="text/css">


.bgc-1{
  background-color: #FFFFFF;
  border-radius: 2px;
}

.fr{float: right;}

.rodape{background-color:  #191919;}


@media(max-width: 450px){
  .btn-img{
    width: 60px;
    height: 40px;
  }
}
@media(max-width: 400px){
  .btn-img{
    width: 50px;
    height: 30px;
  }
}
@media(max-width: 345px){
  .btn-img{
    width: 40px;
    height: 20px;
  }
}
@media(max-width: 320px){
  .btn-img{
    width: 70px;
    height: 50px;
  }
}



</style>


<body>
  <div id="wrap">
    <div id="main">


      <?php
      include_once('gerenciamento/conexao.php');

      $codigo = $_GET['codigo'];


      $select = ("select * from itens where codigo='$codigo'");
      $result = $conn->query($select);

      if ($result->num_rows > 0) 
      {   
        while($row = $result->fetch_assoc()) 
        {
         $codigo = "".$row['codigo']."";
         $nome = "".$row['nome']."";
         $categoria = "".$row['categoria']."";
         $marca = "".$row['marca']."";
         $modelo = "".$row['modelo']."";

         $precoboleto = "".$row['precoboleto']."";
         $precocartao = "".$row['precocartao']."";
         $brevedescricao = "".$row['brevedescricao']."";
         $descricao = "".$row['descricao']."";
         $icone = "".$row['icone']."";

         $img1 = "".$row['img1']."";
         $img2 = "".$row['img2']."";
         $img3 = "".$row['img3']."";
         $img4 = "".$row['img4']."";
         $video = "".$row['video']."";
         $estoque = "".$row['estoque']."";
       }
     } 
     else
     {
      echo "0 results <br>";
      echo "<script>javascript:history.back(-2)</script>";    
      echo "<script>javascript:alert('Não Encontrado!')</script>";  
    }
    mysqli_close($conn);


    ?>



   <!-- Esse é o menu do topo -->
      <nav class="navbar fixed-top" id="mainNav">
        <div class="container">
          <div><a class="js-scroll-trigger" href="index.php"><img src="img/icone.png" id="logo_purple"></a> 
            <span  class="dropdown show">
              <a  id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="img/bar.png" id="bar_purple"></a>
                <div id='drop_menu' class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a style="color: black;" class="dropdown-item" href="lista.php?categoria=computador">Computador</a>
                  <a style="color: black;" class="dropdown-item" href="lista.php?categoria=headset">Headset</a>
                  <a style="color: black;" class="dropdown-item" href="lista.php?categoria=monitor">Monitor</a>           
                  <a style="color: black;" class="dropdown-item" href="lista.php?categoria=mouse">Mouse</a>
                  <a style="color: black;" class="dropdown-item" href="lista.php?categoria=mousepad">MousePad</a>
                  <a style="color: black;" class="dropdown-item" href="lista.php?categoria=notebook">Notebook</a>
                  <a style="color: black;" class="dropdown-item" href="lista.php?categoria=teclado">Teclado</a> 
                </span>
              </div>
            </div>
            <form action="lista.php" method="get">
              <input id="inp_search" autocomplete="off" onkeyup="buscarNoticias(this.value)" placeholder=" Buscar Produtos..." type="search" name="nome" minlength="1" required="">         
              <button id="btn_search" type="submit"><i style="color: white;" class="fas fa-search"></i></button>
            </form>
            <div id="btn_nav_all" class="row">
              <div  class="dropdown" >
                <a  id="dropdownMenuButton" data-toggle="dropdown" class=""><i id="btn_nav" class="fas fa-user-circle"></i></a>
                <div id='drop_menu' class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <?php 
                  if ($sessaoNome == "") {
                    echo "<a  style='color: black;' class='dropdown-item' href='clientes/login.php'><i class='fas fa-sign-in-alt'></i> Login</a>";
                    echo "<a  style='color: black;' class='dropdown-item' href='clientes/cadastro.php'><i class='fas fa-address-card'></i> Cadastro</a>";
                  }
                  else{
                    echo "<a style='color: black;' class='dropdown-item' href='clientes/config_conta.php'><i class='fas fa-user'></i> Perfil</a>";
                    echo "<a style='color: black;' class='dropdown-item' href='clientes/dados_conta.php'><i class='fas fa-cog'></i> Conta</a>"; 
                    echo "<a style='color: black;' class='dropdown-item' href='clientes/deslogar.php'><i class='fas fa-sign-out-alt'></i> Sair</a>";
                  }
                  ?>
                </div>
              </div>
              <div class="">
                <?php 
                if ($sessaoNome == "") {
                  echo "<a class='' title='Login Necessário!' href='clientes/login.php'><i style='color:white;' id='btn_nav' class='fas fa-heart ml-1' ></i></a>";
                }
                else{
                  echo "<a class='' href='favorito/favorito.php'><i id='btn_nav' class='fas fa-heart ml-1' ></i></a>";
                }
                ?>
              </div>
              <div class="">
                <?php 
                if ($sessaoNome == "") {
                  echo "<a class='' title='Login Necessário!' href='clientes/login.php'><i style='color:white;' id='btn_nav' class='fas fa-shopping-cart ml-1'></i></a>";
                } 
                else{
                  echo "<a class='' href='carrinho/carrinho.php'><i id='btn_nav' class='fas fa-shopping-cart ml-1'></i></a>";
                }
                ?>
              </div>        
            </div>
          </div>
        </nav>
        <!-- Terminando o menu do topo -->

        <div align="center" class="fixed-top resultado"><div align="left" id="resultado"></div></div>


    <div style="margin-top: 50px;"></div>
    <div align="center" ><a href="index.php"><img src="img/pi.png" class="img-fluid mt-5"></a></div>
    <div style="margin-top: 50px;"></div>



<!--    <div class="thumbnail">
     
        <img src="bg.png" alt="Lights" style="width:100%">
        <div class="caption"> -->


          <!-- Page Content -->
          <div class="container bgc-1" >
           <hr>
           <!-- Portfolio Item Heading -->
           <h1 align="center" style='font-size:30px;'><?php echo "$nome";?></h1>
           <hr>
           
           <!-- Portfolio Item Row -->
           <div class="row">

            <div class="col-md-8" align="center">

              <img class="img-fluid" id="imgshow" src="gerenciamento/<?php echo $img1 ?>" alt="">

              <button  class="btn_img" id="btn_img1" onclick="document.getElementById('imgshow').src='gerenciamento/<?php echo $img1 ?>'"><img class="btn-img" src="gerenciamento/<?php echo $img1 ?>" height="50" width="75"></button>

              <button class="btn_img" id="btn_img2" onclick="document.getElementById('imgshow').src='gerenciamento/<?php echo $img2 ?>'"><img class="btn-img" src="gerenciamento/<?php echo $img2 ?>" height="50" width="75"></button>
              <button class="btn_img" id="btn_img3" onclick="document.getElementById('imgshow').src='gerenciamento/<?php echo $img3 ?>'"><img  class="btn-img" src="gerenciamento/<?php echo $img3 ?>" height="50" width="75"></button> 
              <button class="btn_img" id="btn_img4" onclick="document.getElementById('imgshow').src='gerenciamento/<?php echo $img4 ?>'"><img  class="btn-img" src='gerenciamento/<?php echo $img4 ?>' height='50' width='75'></button> 

              <script type="text/javascript">
                var img2 = '<?php echo $img2 ?>';
                var img3 = '<?php echo $img3 ?>';
                var img4 = '<?php echo $img4 ?>';

                if(img2 == ""){
                  document.getElementById('btn_img2').style.display = 'none';
                }
                if(img3 == ""){
                  document.getElementById('btn_img3').style.display = 'none';
                }
                if(img4 == ""){
                  document.getElementById('btn_img4').style.display = 'none';
                }



              </script>   

            </div>

            <div class="col-md-4">




              <h2 class="mt-100"><?php echo $categoria ?></h2>

              <h4 class="fc-red"> R$<?php echo number_format($precocartao,2,",","."); ?></h4>
              <h6><b class="fc-red">10x de R$<?php echo number_format($precocartao/10,2,",","."); ?></b> sem juros no cartão</h6>

              <h4 class="fc-green">R$<?php echo number_format($precocartao-($precocartao*0.12),2,",","."); ?></h4>
              <h6>No boleto com 12% de desconto</h6>


              <div  class="mt-4">

                <a href="carrinho/addcarrinho.php?codigo=<?php echo($codigo)?>"><button class="btn btn-lg mb-1 btn-confirma"><b style="font-size: 25px;"><i class="fas fa-shopping-cart"></i> Comprar </b></button></a>
                <br>
                <a href="favorito/addfavorito.php?codigo=<?php echo($codigo)?>"><i class="fas fa-heart"></i><small><b> Adicionar a lista de desejos</b></small></a>

              </div>


              <form method="post" class="mt-3" action="frete/calcula_frete.php?item=<?php echo $codigo ?>&cartao=<?php echo $precocartao ?>">

                <div ><i class="fas fa-truck"></i><smail> Calcular o Frete e Prazos:</smail></div>
                <input type="" style="width: 50%; border-style: solid; border-width: 2px 0px 2px 2px; border-radius: 2px 0px 0px 2px;"  name="cep">
                <input style="margin-left: -5px; border-style: solid; border-radius: 0px 2px 2px 0px;" class="btn-primary" type="submit"  name="" value="OK"><br>
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

          </div>
          <hr>
          <div class="mt-5" align="center">



            <?php  
            if (!empty($video)) {
             echo "<iframe style='width:80%; height:400px; border-radius:5px;' src='$video' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe><br>";
           }
           ?>
           
         </div>

         <!-- /.row -->
         <div style="margin-top: 50px;"></div>
         <div style=" margin: 25px; border-style: solid; border-color: #441974; border-radius: 10px; border-width: 3px; background-color: #f9f9f9">

          <div  style="font-size: 28px; border-radius: 5px; border-style: solid; border-color: black;border-width: 2px; margin-left: 25px; margin-right: 25px; margin-top: 10px;"><div  align="center">Descrição do Produto</div></div>
          <br>
          <p style="margin: 30px; font-size:14px;" ><?php echo "".nl2br($descricao)."" ?></p>
          <br>

        </div>
        
        <br><br><br><br>


      </div>
      <!-- /.container -->
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
              <form method="post" action="newsletter.php" class="form-inline" >
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

  <!-- script menu -->
  <script src="js/grayscale.js"></script>


</body>

</html>
