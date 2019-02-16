<?php
$itemTotal = $_GET['itemTotal'];
$qnt = $_GET['qnt'];

if ($itemTotal>=3000) {
  $itemTotal = 3000;
}



if (!$sock = @fsockopen('www.google.com.br', 80, $num, $error, 5)){
//echo 'OFF LINE';
  $conexao = "OFF LINE"; 

}
else {
//echo 'Conectado a internet';
  $i=0;
//inicio
  $data['nCdEmpresa'] = '';
  $data['sDsSenha'] = '';
  $data['sCepOrigem'] = '12701050';

  $data['sCepDestino'] = $_POST['cep'];
  $data['nVlPeso'] = '1';
  $data['nCdFormato'] = '1';
  $data['nVlComprimento'] = '16';
  $data['nVlAltura'] = '5';
  $data['nVlLargura'] = '15';
  $data['nVlDiametro'] = '0';
  $data['sCdMaoPropria'] = 's';
  $data['nVlValorDeclarado'] = $itemTotal;
  $data['sCdAvisoRecebimento'] = 'n';
  $data['StrRetorno'] = 'xml';
  $data['nCdServico'] = '04510,04014';
 //$data['nCdServico'] = '40010,40045,40215,41106';
  $data = http_build_query($data);

  $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

  $curl = curl_init($url . '?' . $data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $result = curl_exec($curl);
  $result = simplexml_load_string($result);
  foreach($result -> cServico as $row) {
 //Os dados de cada serviço estará aqui
   if($row -> Erro == 0) {

   
     
     $codigo[$i] = $row -> Codigo;
     $valor = $row -> Valor;
     $prazoEntrega[$i] = $row -> PrazoEntrega;
     $valorMaoPropria = $row -> ValorMaoPropria;
     $valorAvisoRecebimento = $row -> ValorAvisoRecebimento;
     $valorValorDeclarado = $row -> ValorValorDeclarado;
     $entregaDomiciliar = $row -> EntregaDomiciliar;
     $entregaSabado = $row -> EntregaSabado;


      echo "<hr>";



      $total[$i] = str_replace(",",".", $valor) + (str_replace(",",".", $valorMaoPropria)*$qnt) + (str_replace(",",".", $valorAvisoRecebimento)*$qnt) + str_replace(",",".", $valorValorDeclarado);

      echo "$total[$i]<br>";
      echo "Chega em $prazoEntrega[$i] dias úteis<br>";
      if ($codigo[$i] == "04510") 
      {
        $codigo[$i] = "PAC à vista";  
      }
      else if($codigo[$i] == "04014")
      {
        $codigo[$i] = "SEDEX";
      }



      echo "$codigo[$i]";
      echo "<hr>";
      $i++;


    } else {
  
     $MsgErro = $row -> MsgErro;
   }

 }
//fim

 ?>
 <script type="text/javascript"></script>
 <?php


}


if (empty($MsgErro)){
  header("location:../carrinho/carrinho.php?totalPac=$total[0]&prazoPac=$prazoEntrega[0]&totalSedex=$total[1]&prazoSedex=$prazoEntrega[1]");
}else{

  echo "<script>location.href='../itens.php?codigo=$item'; javascript:alert('$MsgErro')</script>";
 
}


?>
