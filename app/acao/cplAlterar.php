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

$Orgao = $_POST['orgao'];
$CdCPL = $_POST['CdCPL'];

$CdUsuario = $verTempo->CdUsuario;

$NumeroProcesso = $_POST['numero_processo'];
$valor_licitacao = moeda($_POST['valor_licitacao']);
$Situacao = $_POST['situacao'];
$DtAbertura = formatarData($_POST['dtAbertura']);
$Veiculo = $_POST['publicado'];
$DtPublicacao = formatarData($_POST['DtPublicacao']);

$DtHomologacao = formatarData($_POST['DtHomologacao']);
$DomHomologacao = $_POST['DomHomologacao'];

$numeroDOM = $_POST['numeroDOM'];
$Finalidade = $_POST['finalidade'];
$Modalidade = $_POST['modalidade'];
$Tipo = $_POST['tipo'];
$Descricao = $_POST['objetivo'];
$DtCadastro = date('Y-m-d H:i:s');
$DtCadastro1 = date('Y-m-d');


    $query = "UPDATE cpl SET ";
    $query = $query . " Orgao=:Orgao, ";
    $query = $query . " NumeroProcesso=:NumeroProcesso,";
    $query = $query . " valor_licitacao=:valor_licitacao,";
    $query = $query . " Situacao=:Situacao,";
    $query = $query . " DtAbertura=:DtAbertura,";
    $query = $query . " Veiculo=:Veiculo,";
    $query = $query . " DtPublicacao=:DtPublicacao,";
    $query = $query . " numeroDOM=:numeroDOM,";
    $query = $query . " Finalidade=:Finalidade,";
    $query = $query . " Modalidade=:Modalidade,";
    $query = $query . " Tipo=:Tipo,";
    $query = $query . " Descricao=:Descricao,";
    $query = $query . " DtHomologacao=:DtHomologacao,";
    $query = $query . " DomHomologacao=:DomHomologacao";
    $query = $query . " WHERE ";
    $query = $query . " CdCPL=:CdCPL";


    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":Orgao",$Orgao);
    $buscasegura->bindValue(":NumeroProcesso",$NumeroProcesso);
    $buscasegura->bindValue(":valor_licitacao",$valor_licitacao);
    $buscasegura->bindValue(":Situacao",$Situacao);
    $buscasegura->bindValue(":DtAbertura",$DtAbertura);
    $buscasegura->bindValue(":Veiculo",$Veiculo);
    $buscasegura->bindValue(":DtPublicacao",$DtPublicacao);
    $buscasegura->bindValue(":numeroDOM",$numeroDOM);
    $buscasegura->bindValue(":Finalidade",$Finalidade);
    $buscasegura->bindValue(":Modalidade",$Modalidade);
    $buscasegura->bindValue(":Tipo",$Tipo);
    $buscasegura->bindValue(":Descricao",$Descricao);
    $buscasegura->bindValue(":DtHomologacao",$DtHomologacao);
    $buscasegura->bindValue(":DomHomologacao",$DomHomologacao);
    $buscasegura->bindValue(":CdCPL",$CdCPL);

    $buscasegura->execute();



    echo "<div class='callout callout-success'>";
    echo "<h4>Contrato & Licitação cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=cplEditar&id=<?php echo $CdCPL;?>&t=basico"
</script>
