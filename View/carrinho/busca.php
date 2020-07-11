<?php
// Incluir aquivo de conexão
include("../gerenciamento/conexao.php");

// Recebe o valor enviado
$valor = $_GET['valor'];

// Procura titulos no banco relacionados ao valor

$select = ("select * from itens where categoria like '%".$valor."%' or nome like '%".$valor."%'");

// Exibe todos os valores encontrados

$result = $conn->query($select);

$cont = 0;

if ($result->num_rows > 0 and strlen($valor)>3) 
{   
  while($row = $result->fetch_assoc()) 
  {     
    $codigo = "".$row['codigo']."";
    $nome = "".$row['nome']."";
    $icone = "".$row['icone']."";

    $precoboleto = "".$row['precoboleto']."";
    $precocartao = "".$row['precocartao']."";

    $nomer = mb_substr("$nome", 0, 60);
    $nomer = trim($nomer,'-');          
    $nomer = trim($nomer);


    ?>


<b>
    <div id="result" onclick="location.href='../itens.php?codigo=<?php echo $codigo ?>';" >
      <table class="col-md-12">
        <tr><td><img style=" width: 70px;" src='../gerenciamento/<?php echo $icone ?>'></td>
         <td style="font-size: 13px;"><?php echo $nomer ?></td><td style="font-size: 13px; text-align: right;"><?php echo "<span style='color: green;'>R$&nbsp;$precoboleto</span><br><span style='color: red;'> R$&nbsp;$precocartao</span>" ?></td></tr>

       </table>    
</b>
     </div>

     <?php

     $cont++;
     if ($cont == 5) {
      break;
    }

  }

} 
?>