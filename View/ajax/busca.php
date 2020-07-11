<?php
// Incluir aquivo de conexão
include("conn.php");

// Recebe o valor enviado
$valor = $_GET['valor'];

// Procura titulos no banco relacionados ao valor

$select = ("select * from itens where categoria like '%".$valor."%' or nome like '%".$valor."%' limit 5");

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
    ?>
    <div id="result" onclick="location.href='../itens.php?codigo=<?php echo $codigo ?>';" >
<table>
      <tr><td><img style=" width: 70px; margin-top: 7px;" src='../gerenciamento/<?php echo $icone ?>'></td>
     <td><?php echo $nome ?></td></tr>
    
  </table>    
    
    </div>

    <?php
/*
    $cont++;
    if ($cont == 5) {
      break;
    }
*/
  }

} 
?>