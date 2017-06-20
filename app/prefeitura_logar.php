<?php
header("Content-Type: text/html; charset=ISO-8859-1",true) ;

include ("../conexao.php");
include('func/funcoes.php');
include ("func/seg.php");



$ID = $_GET['idPrefeitura'];

$_SESSION['CdPrefeitura'] = $ID;


    header('Location: index.php'); exit;
?>
