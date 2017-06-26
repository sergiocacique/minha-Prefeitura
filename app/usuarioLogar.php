<?php
session_cache_expire(30);
include ("../conexao.php");

$pdo=conectar();
session_start();

$usuario = $_GET['id'];

$Verifica=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$usuario."'");
$Verifica->execute();
$verVerifica=$Verifica->fetch(PDO::FETCH_OBJ);
$mostra = $Verifica->rowCount();

if ($mostra > 0) {

    $_SESSION['UsuarioID'] = $verVerifica->CdUsuario;
    $atual = date('Y-m-d H:i:s');
    $expira = date('Y-m-d H:i:s', strtotime('+1 min'));
    $IP = $_SERVER["REMOTE_ADDR"];
    $_SESSION['MP'] =  md5('seg'.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);


    $AtualizarUsuario=$pdo->prepare("UPDATE admin SET Horario=:Horario, Limite=:Limite WHERE CdUsuario=:CdUsuario");
    $AtualizarUsuario->bindValue(":Horario",$atual);
    $AtualizarUsuario->bindValue(":Limite",$expira);
    $AtualizarUsuario->bindValue(":CdUsuario",$verVerifica->CdUsuario);
    $AtualizarUsuario->execute();


    $Prefs=$pdo->prepare("SELECT * FROM adm_prefs WHERE CdUsuario = '".$verVerifica->CdUsuario."' AND Acao = 'Ativo'");
    $Prefs->execute();
    $vPrefs=$Prefs->fetch(PDO::FETCH_OBJ);
    $cPrefs = $Prefs->rowCount();


    if($cPrefs == 1){
      $_SESSION['CdPrefeitura'] = $verVerifica->CdPrefeitura;
      header('Location: index.php'); exit;
    }else{
        header('Location: prefeituras.php'); exit;
    }






}

//Caso contrário redireciona para a página de autenticação
else {

    auditoria($_POST,$_SESSION['UsuarioID'],'Tentativa de login com usuário '.$usuario.' resultou em usuário ou senha inválida.');

    //Destrói
    session_destroy();

    //Redireciona para a página de autenticação
    header('Location: login.php'); exit;

}
?>
