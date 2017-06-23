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

$Mes = $_POST['mes'];
$Ano = $_POST['ano'];

$DtViagem = formatarData($_POST['DtViagem']);
$DtVolta = formatarData($_POST['DtVolta']);
$Destino = addslashes($_POST['Destino']);
$valor = moeda($_POST['Valor']);
$Objetivo = addslashes($_POST['Objetivo']);
$CdSecretaria = (int)$_POST['Secretaria'];
$observacao = addslashes($_POST['observacao']);

$Nome = addslashes($_POST['Nome']);

$DtAtualizacao = date('Y-m-d H:i:s');

if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
  $Acao = addslashes(trim($_POST['acao']));
}else{
  $Acao = 'Arquivo';
}
$DtAtualizacao = date('Y-m-d H:i:s');

$DtCadastro1 = date('Y-m');
$Protocolo = "U".$verTempo->CdUsuario."P".date('Y').date('m').date('d');

$Atual=$pdo->prepare("SELECT * FROM passagens WHERE CdUsuario = '".$verTempo->CdUsuario."' AND DATE_FORMAT(DtCadastro, '%Y-%m') = '".$DtCadastro1."' ");
$Atual->execute();
$lAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();

if ($tAtual == 0){
    $Protocolo = $Protocolo;
}else{
    $Protocolo = $lAtual->Protocolo;
}




    $query = "INSERT INTO passagens(";
    $query = $query . " CdUsuario,";
    $query = $query . " CdPrefeitura,";
    $query = $query . " observacao,";
    $query = $query . " Protocolo,";
    $query = $query . " Nome,";
    $query = $query . " Destino,";
    $query = $query . " Objetivo,";
    $query = $query . " valor,";
    $query = $query . " mes,";
    $query = $query . " ano,";
    $query = $query . " Acao,";
    $query = $query . " DtCadastro,";
    $query = $query . " DtAtualizacao,";
    $query = $query . " DtViagem,";
    $query = $query . " DtVolta,";
    $query = $query . " CdSecretaria";

    $query = $query . " )VALUES(";

    $query = $query . " :CdUsuario,";
    $query = $query . " :CdPrefeitura,";
    $query = $query . " :observacao,";
    $query = $query . " :Protocolo,";
    $query = $query . " :Nome,";
    $query = $query . " :Destino,";
    $query = $query . " :Objetivo,";
    $query = $query . " :valor,";
    $query = $query . " :mes,";
    $query = $query . " :ano,";
    $query = $query . " :Acao,";
    $query = $query . " :DtCadastro,";
    $query = $query . " :DtAtualizacao,";
    $query = $query . " :DtViagem,";
    $query = $query . " :DtVolta,";
    $query = $query . " :CdSecretaria";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":observacao",$observacao);
    $buscasegura->bindValue(":Protocolo",$Protocolo);
    $buscasegura->bindValue(":Nome",$Nome);
    $buscasegura->bindValue(":Destino",$Destino);
    $buscasegura->bindValue(":Objetivo",$Objetivo);
    $buscasegura->bindValue(":valor",$valor);
    $buscasegura->bindValue(":mes",$Mes);
    $buscasegura->bindValue(":ano",$Ano);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":DtCadastro",$DtAtualizacao);
    $buscasegura->bindValue(":DtAtualizacao",$DtAtualizacao);
    $buscasegura->bindValue(":DtViagem",$DtViagem);
    $buscasegura->bindValue(":DtVolta",$DtVolta);
    $buscasegura->bindValue(":CdSecretaria",$CdSecretaria);

    $buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Passagem cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=passagens"
</script>
