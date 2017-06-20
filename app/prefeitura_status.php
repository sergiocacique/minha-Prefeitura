<?php
session_cache_expire(30);
include ("conexao.php");
include ("funcao.php");

$usuario = $_GET['idPrefeitura'];
$acao = $_GET['acao'];
$DtAtualizacao = date('Y-m-d H:i:s');


    $update = mysql_query("UPDATE prefeitura SET Acao = '".$acao."' WHERE CdPrefeitura = '".$usuario."'");

       header('Location: prefeituras.php'); exit;





?>
