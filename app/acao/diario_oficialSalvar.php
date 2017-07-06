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

$Categoria = $_POST['Categoria'];
$ID = (int) $_POST['CdDIario'];
$Titulo = $_POST['txtTitulo'];
$texto = $_POST['texto'];
$Acao = $_POST['acao'];


    $query = "UPDATE publicacao SET";
    $query = $query . " CdCategoria = :CdCategoria,";
    $query = $query . " Titulo = :Titulo,";
    $query = $query . " Texto = :Texto,";
    $query = $query . " Acao = :Acao";
    $query = $query . " WHERE";
    $query = $query . " id = :id";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdCategoria",$Categoria);
    $buscasegura->bindValue(":Titulo",$Titulo);
    $buscasegura->bindValue(":Texto",$texto);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":id",$ID);

    $buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Diário Oficial atualizado com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=diario_oficial"
</script>
