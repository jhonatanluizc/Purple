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

  <title>Purple - Busca</title>

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

.cd{  border: 10px;
  border-color: red;}


  .card{

    margin: 5px;
    float: none;
    margin-bottom: 10px;
    color: black;

  }
  .rodape{background-color:  #191919;}

  .mt200{margin-top: 200px;}

  


</style>

<body>
  <div id="wrap">
    <div id="main">

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

      <div style="margin-top: 75px;"></div>
      <div align="center" ><a href="index.php"><img src="img/pi.png" class="img-fluid mt-5"></a></div>
      <div style="margin-top: 50px;"></div>


      <div  class="container" align="center">
        <div class="row" id="card_item">

          <?php
          include_once('gerenciamento/conexao.php');
          $cont = 0;


          if (!empty($_GET['nome'])) {
           $nome = $_GET['nome'];
           $select = ("select * from itens where nome like '%%$nome%%' || categoria like '%%$nome%%'");
         }
         else{ 
           $categoria = $_GET['categoria'];

           $select = ("select * from itens where categoria like '%$categoria%'");

           if ($categoria == "computador") {
             $select = ("select * from itens where categoria = 'computador home' || categoria = 'computador gamer'");
           }
           if ($categoria == "headset") {
             $select = ("select * from itens where categoria = 'headset' || categoria = 'headset gamer'");
           }
           if ($categoria == "monitor") {
             $select = ("select * from itens where categoria = 'monitor gamer'");
           }

           if ($categoria == "mouse") {
             $select = ("select * from itens where categoria = 'mouse com fio' || categoria = 'mouse sem fio' || categoria = 'mouse gamer'");
           }
           if ($categoria == "mousepad") {
             $select = ("select * from itens where categoria = 'mousepad' || categoria = 'mousepad gamer'");
           }
           if ($categoria == "teclado") {
             $select = ("select * from itens where categoria = 'teclado com fio' || categoria = 'teclado sem fio' || categoria = 'teclado gamer'");
           }
         }



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

            $nomer = mb_substr("$nome", 0, 45);

            $nomer = trim($nomer,'-');

            $nomer = trim($nomer);



            ?>
            <div class='card card-item' ondblclick="location.href='itens.php?codigo=<?php echo $codigo ?>';" style='width: 17rem;'>

             <div onclick="location.href='lista.php?categoria=<?php echo $categoria ?>';" align="center" style=" background-color: #fff;  font-size: 12px; color: black; border-radius: 3px; border-color: black; border-style: solid; border-width: 2px; margin-left: 6px; margin-right: 4px; margin-top: 3px;" ><?php echo $categoria ?></div>
             <?php

             echo "<a href='itens.php?codigo=$codigo'><img title='$nome' class='card-img-top' src='gerenciamento/$icone' alt='Card image cap'></a>";
             echo "<div class='card-body'>";


             echo("<div style='height: 73px;'>");
             if (strlen($nomer)<25) {
               echo "<span style='font-size: 20px;' >$categoria</span>";
             }
             echo "<h5 class='card-title'>$nomer</h5>";
             echo "</div>";


             $boleto =  $precoboleto;
             $boleto = round($boleto,2);
             $boleto = number_format($boleto, 2,',','.');
             echo "À vista <b class='fc-green'>R$$boleto </b><br><b><small>no boleto com 12% de desconto.</small></b><br>";
             $cartao = $precocartao/10;
             $cartao = round($cartao,2);
             $cartao = number_format($cartao, 2,',','.');

             echo "<b class='fc-red'>10x de R$$cartao</b><br><small> sem juros no cartão.</small>";

             echo "<a href='carrinho/addcarrinho.php?codigo=$codigo' class='btn btn-lg mb-1 mt-2 btn-confirma'><b style='font-size: 25px;'><i class='fas fa-shopping-cart'></i> Comprar </b></a>";
             echo "<br><a href='favorito/addfavorito.php?codigo=$codigo'><i class='fas fa-heart'></i><small><b> Adicionar a lista de desejos</b></small></a>";

             echo"</div></div>";
             $cont++;

           /*if ($cont == 16) {
            break;
          }*/

        }
        echo "</div>";
      }

      else{

        ?>

      </div>

      <div class="container" align="center" style="background-color: white; border-radius: 20px;">
        <br>
        <div style="border-radius: 15px; border-style: solid; border-width: 1px; border-color: black;">
          <br>
          <i id="ico_error" class="fas fa-exclamation-circle"></i>
          <br>

          <h3 id="h3_error" style="margin-top: 30px;">Nenhum produto encontrado para o termo de busca "<?php echo "$nome"; ?>"</h3>
          <br>
          <h5 id="h5_error">Tente novamente com outro termo para busca</h5>
          <br>
        </div>
        <br>


      </div>
      <?php

    }

    mysqli_close($conn);
    ?>








  </div>

  <!-- uma margem top -->
  <div style="margin-top: 100px;"></div>
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
