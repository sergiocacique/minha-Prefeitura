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

$numero_processo = $_POST['NumProcesso'];
$objeto = addslashes($_POST['objeto']);
$convenio = moeda($_POST['valorConvenio']);
$recurso_proprio = moeda($_POST['ValorRecurso']);
$total = moeda($_POST['ValorTotal']);
$fisico = $_POST['Andamento'];
$valor_realizado = moeda($_POST['ValorGasto']);
$observacao = addslashes($_POST['observacao']);
$estatus = $_POST['StatusObra'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$Acao = "Arquivo";
$DtCadastro = date('Y-m-d H:i:s');
$origem = addslashes($_POST['Origem']);
$contrato = $_POST['NumConvenio'];
$DtEmissao = formatarData($_POST['DtContrato']);
$Prazo = $_POST['Prazo'];

$DtAtualizacao = date('Y-m-d H:i:s');

if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
  $Acao = addslashes(trim($_POST['acao']));
}else{
  $Acao = 'Arquivo';
}
$DtAtualizacao = date('Y-m-d H:i:s');

$DtCadastro1 = date('Y-m');
$Protocolo = "U".$verTempo->CdUsuario."P".date('Y').date('m').date('d');

$Atual=$pdo->prepare("SELECT * FROM obras WHERE CdUsuario = '".$verTempo->CdUsuario."' AND DATE_FORMAT(DtCadastro, '%Y-%m') = '".$DtCadastro1."' ");
$Atual->execute();
$lAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();

if ($tAtual == 0){
    $Protocolo = $Protocolo;
}else{
    $Protocolo = $lAtual->Protocolo;
}




    $query = "INSERT INTO obras(";
    $query = $query . " CdUsuario,";
    $query = $query . " CdPrefeitura,";
    $query = $query . " numero_processo,";
    $query = $query . " Protocolo,";
    $query = $query . " objeto,";
    $query = $query . " convenio,";
    $query = $query . " recurso_proprio,";
    $query = $query . " total,";
    $query = $query . " fisico,";
    $query = $query . " valor_realizado,";
    $query = $query . " observacao,";
    $query = $query . " estatus,";
    $query = $query . " mes,";
    $query = $query . " ano,";
    $query = $query . " Acao,";
    $query = $query . " DtCadastro,";
    $query = $query . " origem,";
    $query = $query . " contrato,";
    $query = $query . " DtEmissao,";
    $query = $query . " Prazo";

    $query = $query . " )VALUES(";

    $query = $query . " :CdUsuario,";
    $query = $query . " :CdPrefeitura,";
    $query = $query . " :numero_processo,";
    $query = $query . " :Protocolo,";
    $query = $query . " :objeto,";
    $query = $query . " :convenio,";
    $query = $query . " :recurso_proprio,";
    $query = $query . " :total,";
    $query = $query . " :fisico,";
    $query = $query . " :valor_realizado,";
    $query = $query . " :observacao,";
    $query = $query . " :estatus,";
    $query = $query . " :mes,";
    $query = $query . " :ano,";
    $query = $query . " :Acao,";
    $query = $query . " :DtCadastro,";
    $query = $query . " :origem,";
    $query = $query . " :contrato,";
    $query = $query . " :DtEmissao,";
    $query = $query . " :Prazo";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":numero_processo",$numero_processo);
    $buscasegura->bindValue(":Protocolo",$Protocolo);
    $buscasegura->bindValue(":objeto",$objeto);
    $buscasegura->bindValue(":convenio",$convenio);
    $buscasegura->bindValue(":recurso_proprio",$recurso_proprio);
    $buscasegura->bindValue(":total",$total);
    $buscasegura->bindValue(":fisico",$fisico);
    $buscasegura->bindValue(":valor_realizado",$valor_realizado);
    $buscasegura->bindValue(":observacao",$observacao);
    $buscasegura->bindValue(":estatus",$estatus);
    $buscasegura->bindValue(":mes",$mes);
    $buscasegura->bindValue(":ano",$ano);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":DtCadastro",$DtCadastro);
    $buscasegura->bindValue(":origem",$origem);
    $buscasegura->bindValue(":contrato",$contrato);
    $buscasegura->bindValue(":DtEmissao",$DtEmissao);
    $buscasegura->bindValue(":Prazo",$Prazo);
    $buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Obra cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
    location.href="../index.php?p=obras"
</script>
