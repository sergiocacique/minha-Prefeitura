<?php
session_cache_expire(30);
include ("../conexao.php");

$pdo=conectar();
session_start();



ob_start();
ob_end_clean();
session_destroy();

//Redireciona para a página de autenticação
header('Location: index.php'); exit;
?>
