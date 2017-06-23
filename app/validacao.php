<?php
session_cache_expire(30);
include ("../conexao.php");

$pdo=conectar();
session_start();



$usuario = addslashes(trim($_POST['txUsuario']));
$senha = addslashes(trim($_POST['txSenha']));
$senha = md5($_POST['txSenha']);

$Verifica=$pdo->prepare("SELECT * FROM admin WHERE Email = '".$usuario."' AND Senha = '".$senha."' AND Acao = 'Publicado'");
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
    $AtualizarUsuario->bindValue(":CdUsuario",$CdUsuario);
    $AtualizarUsuario->execute();

    if($verVerifica->CdPrefeitura == 0){
        header('Location: prefeituras.php'); exit;
    }else{
        $_SESSION['CdPrefeitura'] = $verVerifica->CdPrefeitura;
        header('Location: index.php'); exit;
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
