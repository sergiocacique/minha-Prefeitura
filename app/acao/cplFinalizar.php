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

$Acao = $_POST['acao'];
$Acao2 = "Pendente";
$CdCPL = $_POST['CdCPL'];
$DtAtualizacao =  date('Y-m-d H:i:s');

    $query = "UPDATE cpl SET ";
    $query = $query . " Acao=:Acao, ";
    $query = $query . " Acao2=:Acao2,";
    $query = $query . " DtAtualizacao=:DtAtualizacao";
    $query = $query . " WHERE ";
    $query = $query . " CdCPL=:CdCPL";


    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":Acao2",$Acao2);
    $buscasegura->bindValue(":DtAtualizacao",$DtAtualizacao);
    $buscasegura->bindValue(":CdCPL",$CdCPL);

    $buscasegura->execute();


    echo "<div class='callout callout-success'>";
    echo "<h4>Contrato & Licitação finalizado com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=cpl"
</script>
