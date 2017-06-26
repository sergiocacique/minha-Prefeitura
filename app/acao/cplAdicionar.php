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

$Acao = "Cadastrando";

// if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
//   $Acao = addslashes(trim($_POST['acao']));
// }else{
//   $Acao = 'Arquivo';
// }
// $DtAtualizacao = date('Y-m-d H:i:s');

$DtCadastro1 = date('Y-m');
$Protocolo = "U".$verTempo->CdUsuario."P".date('Y').date('m').date('d');

$Atual=$pdo->prepare("SELECT * FROM cpl WHERE CdUsuario = '".$verTempo->CdUsuario."' AND DATE_FORMAT(DtCadastro, '%Y-%m') = '".$DtCadastro1."' ");
$Atual->execute();
$lAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();

if ($tAtual == 0){
    $Protocolo = $Protocolo;
}else{
    $Protocolo = $lAtual->Protocolo;
}




    $query = "INSERT INTO cpl(";
    $query = $query . " CdUsuario,";
    $query = $query . " CdPrefeitura,";
    $query = $query . " Orgao, ";
    $query = $query . " Protocolo, ";
    $query = $query . " DtCadastro, ";
    $query = $query . " Acao, ";
    $query = $query . " Acao2, ";
    $query = $query . " NumeroProcesso,";
    $query = $query . " valor_licitacao,";
    $query = $query . " Situacao,";
    $query = $query . " DtAbertura,";
    $query = $query . " Veiculo,";
    $query = $query . " DtPublicacao,";
    $query = $query . " numeroDOM,";
    $query = $query . " Finalidade,";
    $query = $query . " Modalidade,";
    $query = $query . " Tipo,";
    $query = $query . " Descricao,";
    $query = $query . " DtHomologacao,";
    $query = $query . " DomHomologacao";

    $query = $query . " )VALUES(";

    $query = $query . " :CdUsuario,";
    $query = $query . " :CdPrefeitura,";
    $query = $query . " :Orgao, ";
    $query = $query . " :Protocolo, ";
    $query = $query . " :DtCadastro, ";
    $query = $query . " :Acao, ";
    $query = $query . " :Acao2, ";
    $query = $query . " :NumeroProcesso,";
    $query = $query . " :valor_licitacao,";
    $query = $query . " :Situacao,";
    $query = $query . " :DtAbertura,";
    $query = $query . " :Veiculo,";
    $query = $query . " :DtPublicacao,";
    $query = $query . " :numeroDOM,";
    $query = $query . " :Finalidade,";
    $query = $query . " :Modalidade,";
    $query = $query . " :Tipo,";
    $query = $query . " :Descricao,";
    $query = $query . " :DtHomologacao,";
    $query = $query . " :DomHomologacao";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":Orgao",$Orgao);
    $buscasegura->bindValue(":Protocolo",$Protocolo);
    $buscasegura->bindValue(":DtCadastro",$DtCadastro);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":Acao2",'Pendente');
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

    $buscasegura->execute();

    $Ultimo=$pdo->prepare("SELECT * FROM cpl WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND CdUsuario = '".$verTempo->CdUsuario."' ORDER BY DtCadastro DESC");
    $Ultimo->execute();
    $vUltimo=$Ultimo->fetch(PDO::FETCH_OBJ);

    echo "<div class='callout callout-success'>";
    echo "<h4>Contrato & Licitação cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=cplEditar&id=<?php echo $vUltimo->CdCPL;?>&t=empresa"
</script>
