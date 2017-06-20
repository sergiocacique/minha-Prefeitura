<?php
// Verifica se a variável $_GET['pagina'] existe
if (isset($_GET['t'])) {
    // Pega o valor da variável $_GET['pagina']
    $arquivo = "tarefa/".$_GET['t'].".php";
} else {
    // Se não existir variável, define um valor padrão
    $arquivo = 'tarefa/inicio.php';
}
include ($arquivo); // Inclui o arquivo
?>
