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

$Estutura = $_POST['orgao'];
$Categoria = $_POST['Categoria'];
$Titulo = $_POST['txtTitulo'];
$texto = $_POST['texto'];
$Acao = $_POST['acao'];

$DtAtualizacao = date('Y-m-d H:i:s');

$DtCadastro1 = date('Y-m-d');
$Edicao = "1";

$Estrutura=$pdo->prepare("SELECT * FROM estrutura WHERE CdEstrutura = '".$Estutura."' ");
$Estrutura->execute();
$vEstrutura=$Estrutura->fetch(PDO::FETCH_OBJ);


$cabecalho = $vAdmin->Titulo."<br />".$vEstrutura->Nome."";
$Assinatura = "<strong>" .$vEstrutura->Secretario . "</strong><br /><i>" .$vEstrutura->Cargo . "</i>";

$Assunto = $cabecalho."<br /><br />".$texto."<br /><br />".$Assinatura;

$Atual=$pdo->prepare("SELECT * FROM publicacao WHERE CdUsuario = '".$verTempo->CdUsuario."' AND DATE_FORMAT(DtCadastro, '%Y-%m-%d') = '".$DtCadastro1."' ");
$Atual->execute();
$lAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();

if ($tAtual == 0){
    $Edicao = $Edicao;
}else{
    $Edicao = $lAtual->Edicao;
}
$senha = gerar_senha(10, true, false, true, false);

    $query = "INSERT INTO publicacao(";
    $query = $query . " CdPrefeitura,";
    $query = $query . " Codigo,";
    $query = $query . " CdEstrutura,";
    $query = $query . " CdCategoria,";
    $query = $query . " Titulo,";
    $query = $query . " Edicao,";
    $query = $query . " DtPublicacao,";
    $query = $query . " CdUsuario,";
    $query = $query . " Texto,";
    $query = $query . " Acao,";
    $query = $query . " DtCadastro";

    $query = $query . " )VALUES(";

    $query = $query . " :CdPrefeitura,";
    $query = $query . " :Codigo,";
    $query = $query . " :CdEstrutura,";
    $query = $query . " :CdCategoria,";
    $query = $query . " :Titulo,";
    $query = $query . " :Edicao,";
    $query = $query . " :DtPublicacao,";
    $query = $query . " :CdUsuario,";
    $query = $query . " :Texto,";
    $query = $query . " :Acao,";
    $query = $query . " :DtCadastro";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":Codigo",$senha);
    $buscasegura->bindValue(":CdEstrutura",$Estutura);
    $buscasegura->bindValue(":CdCategoria",$Categoria);
    $buscasegura->bindValue(":Titulo",$Titulo);
    $buscasegura->bindValue(":Edicao",$Edicao);
    $buscasegura->bindValue(":DtPublicacao",$DtAtualizacao);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":Texto",$Assunto);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":DtCadastro",$DtAtualizacao);

    $buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Diário Oficial cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=diario_oficial"
</script>
