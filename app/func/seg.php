<?php
$pdo=conectar();
$gerenciador=conectar();
$pagto=conectar();
$diario=conectar();
session_start();

if($_SESSION['UsuarioID']  == ""){
    ob_start();
    ob_end_clean();
    session_destroy();
    header("Location: login.php"); exit;
}

$agora = date('Y-m-d H:i:s');
session_cache_expire(10);
$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

$Tempo=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$_SESSION['UsuarioID']."'");
$Tempo->execute();
$verTempo=$Tempo->fetch(PDO::FETCH_OBJ);

$Pemissao=$pdo->prepare("SELECT * FROM adm_permissao WHERE CdUsuario = '".$verTempo->CdUsuario."'");
$Pemissao->execute();
$vPemissao=$Pemissao->fetch(PDO::FETCH_OBJ);

if(isset($_SESSION['CdPrefeitura']) != "") {

  $Admin=$pdo->prepare("SELECT * FROM vw_prefeitura WHERE CdPrefeitura = " . $_SESSION['CdPrefeitura'] . "");
  $Admin->execute();
  $vAdmin=$Admin->fetch(PDO::FETCH_OBJ);

}


//if($agora >= $verTempo['Limite']){
//    ob_start();
//    ob_end_clean();
//    session_destroy();
//    header("Location: login.php"); exit;
//}



?>
