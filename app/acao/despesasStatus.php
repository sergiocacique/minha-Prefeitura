<?php

include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();


// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
}

$id = $_GET['id'];
$acao = $_GET['a'];

if($acao == "aprovar"){
  $verAcao = "Publicado";
}elseif($acao == "tramitar"){
  $verAcao = "Aguardando";
}elseif($acao == "excluir"){
  $verAcao = "Excluido";
}

$DtCadastro = date('Y-m-d H:i:s');

    $query = "UPDATE despesas SET ";
    $query = $query . " Acao=:Acao, ";
    $query = $query . " DtAtualizacao=:DtAtualizacao";
    $query = $query . " WHERE ";
    $query = $query . " id=:id";


    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":DtAtualizacao",$DtCadastro);
    $buscasegura->bindValue(":Acao",$verAcao);
    $buscasegura->bindValue(":id",$id);

    $buscasegura->execute();



    echo "<div class='callout callout-success'>";
    echo "<h4>Receita ".$verAcao." com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=minha_tarefa&t=despesas"
</script>
