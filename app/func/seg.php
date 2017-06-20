<?php
$pdo=conectar();
session_start();

$agora = date('Y-m-d H:i:s');
session_cache_expire(10);
$tokenUser = md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);

$Tempo=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$_SESSION['UsuarioID']."'");
$Tempo->execute();
$verTempo=$Tempo->fetch(PDO::FETCH_OBJ);


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


if($_SESSION['MP']  != $tokenUser){
    ob_start();
    ob_end_clean();
    session_destroy();
    header("Location: login.php"); exit;
}
?>
