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
      $cliente = " ".$row['id']."";
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
include_once('../gerenciamento/conexao.php');
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




        $cartao = round($precocartao,2);
        $cartao = number_format($cartao, 2,',','.');

        $subtotal = $precocartao * $quantidade;
        $subtotal = round($subtotal,2);
        $total[$i] = $subtotal;

        $i++;
        $subtotal = number_format($subtotal, 2,',','.');
      }

    }
              // fim da lista
  }
}
else{
  echo "<script type='text/javascript'>alert('Carrinho Vazio!')</script>";
  echo "<script type='text/javascript'>history.go(-1)</script>";
}

if (empty($quantidade)) {
  $total = 0;
}else{$total = array_sum($total);}

mysqli_close($conn);
?>



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

  <link rel="stylesheet" type="text/css" href="../css/font/fa-solid.css">
  <link rel="stylesheet" type="text/css" href="../css/font/fontawesome.css">
  <link rel="stylesheet" type="text/css" href="../css/font/fa-brands.css">



</head>



<style type="text/css">

</style>
<body>
  <div id="wrap">
    <div id="main">

      <div style="margin-top: 0px;"></div>
      <div align="center" ><a href="../index.php"><img src="../img/pi.png" class="img-fluid mt-3"></a></div>
      <div style="margin-top: 15px;"></div>


      <?php 
      $envio = $_GET['envio'];

      ?>


      <div style="margin-top: 50px;"></div>

      <div class="container " style="background-color: white;">
        <hr>
        <h3 align="center">Formas De Pagamento</h3>
        <hr>



        <div class="container">
          <div class="row"> 

            <!--card -->     
            <div class='card card-item' style='width: 34rem;'>

              <div align="center" class='card-body'>
                <h5  class='card-title' align="center">Boleto Bancário</h5>
                <img class=" img-fluid" src="boleto.png" height="50" width="300">  
                <hr>
                <h3>Total a pagar</h3>
                <h3 class="fc-green">R$<?php echo number_format($total-($total*0.12),2,",","."); ?></h3>
                <h6>No boleto com 12% de desconto</h6>
                <hr>

                Após a finalização do pedido será exibido o botão para impressão do boleto bancário. <hr>
                *O link para reimpressão também será enviado para seu email e estará disponível em seu painel de controle em detalhes do pedido.<hr>

                <form align="center">


                 <input  type="submit" name="" value="Gerar Boleto" class="btn btn-lg mb-2 mt-3 btn-confirma">
               </form>

             </div>
           </div>
           <!-- fim card --> 

           <!--card -->     
           <div class='card card-item' align="center" style='width: 34rem;'>

            <div class='card-body'>
              <h5  class='card-title' align="center">
                Cartão De Crédito 
                <div  style="font-size: 20px;" align="center">
                 <i class="fab fa-cc-visa" style="color:navy;"></i>
                 <i class="fab fa-cc-amex" style="color:blue;"></i>
                 <i class="fab fa-cc-mastercard" style="color:red;"></i>
                 <i class="fab fa-cc-discover" style="color:orange;"></i>
               </div>   
             </h5> 





             <h3>Total a pagar</h3>
             <h3 class="fc-red"> R$<?php echo number_format($total,2,",","."); ?></h3>


             <form align="center">

              Nome Do Titular
              <input type="text" name="nomeTitular" class="form-control form-control-sm" >
              Número Do Cartão
              <input type="text" name="numCartao" class="form-control form-control-sm" >

              Data de Validade
              <div class="row">
               <div class="col-6">
                 <input class="form-control form-control-sm " type="number" name="validadeMes"  max="12" min="1" placeholder="Mês">
               </div>
               <div class="col-6">

                 <input class="form-control form-control-sm" type="number" name="validadeAno" max="2018" min="1950" placeholder="Ano">
               </div>
             </div>

             Código De Segurança
             <input class="form-control form-control-sm" type="text" name="codSeguranca" maxlength="3" minlength="3" min="000" max="999">
             Parcelar em 
             <select name="estado"   class="form-control form-control-sm inp-cadstro">

              <option value="1">1x R$<?php echo number_format($total,2,",","."); ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>) </option>
              <option value="2">2x R$<?php echo number_format($total/2,2,",","."); ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>) </option>
              <option value="3">3x R$<?php echo number_format($total/3,2,",","."); ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>) </option>
              <option value="4">4x R$<?php echo number_format($total/4,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="5">5x R$<?php echo number_format($total/5,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="6">6x R$<?php echo number_format($total/6,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="7">7x R$<?php echo number_format($total/7,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="8">8x R$<?php echo number_format($total/8,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="9">9x R$<?php echo number_format($total/9,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="10">10x R$<?php echo number_format($total/10,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="11">11x R$<?php echo number_format($total/11,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              <option value="12">12x R$<?php echo number_format($total/12,2,",",".");  ?> s/juros (total R$<?php echo number_format($total,2,",","."); ?>)</option>
              

            </select>

            <input  type="submit" name="" value="Finalizar compra" class="btn btn-lg mb-2 mt-3 btn-confirma">
          </form>

        </div>
      </div>
      <!-- fim card --> 


    </div>
  </div>





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
