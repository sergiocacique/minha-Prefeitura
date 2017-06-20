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

$servico = $_POST['NomeProjeto'];
$publico = addslashes($_POST['Publico']);
$bolsista_qtd = moeda($_POST['QtdBolsista']);
$bolsista_valor = moeda($_POST['ValorBolsista']);
$outras_despesas = moeda($_POST['OutrasDespesas']);
$convenio = moeda($_POST['valorConvenio']);
$FNAS = moeda($_POST['FNAS']);
$recurso_proprio = moeda($_POST['RecursoProprio']);
$total = moeda($_POST['Total']);
$obs = $_POST['observacao'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

$DtAtualizacao = date('Y-m-d H:i:s');

if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
  $Acao = addslashes(trim($_POST['acao']));
}else{
  $Acao = 'Arquivo';
}
$DtAtualizacao = date('Y-m-d H:i:s');

$DtCadastro1 = date('Y-m');
$Protocolo = "U".$verTempo->CdUsuario."P".date('Y').date('m').date('d');

$Atual=$pdo->prepare("SELECT * FROM projetos_sociais WHERE CdUsuario = '".$verTempo->CdUsuario."' AND DATE_FORMAT(DtCadastro, '%Y-%m') = '".$DtCadastro1."' ");
$Atual->execute();
$lAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();

if ($tAtual == 0){
    $Protocolo = $Protocolo;
}else{
    $Protocolo = $lAtual->Protocolo;
}




    $query = "INSERT INTO projetos_sociais(";
    $query = $query . " CdUsuario,";
    $query = $query . " CdPrefeitura,";
    $query = $query . " servico,";
    $query = $query . " publico,";
    $query = $query . " bolsista_qtd,";
    $query = $query . " bolsista_valor,";
    $query = $query . " outras_despesas,";
    $query = $query . " convenio,";
    $query = $query . " FNAS,";
    $query = $query . " recurso_proprio,";
    $query = $query . " total,";
    $query = $query . " obs,";
    $query = $query . " mes,";
    $query = $query . " ano,";
    $query = $query . " Acao,";
    $query = $query . " Protocolo,";
    $query = $query . " DtCadastro";

    $query = $query . " )VALUES(";

    $query = $query . " :CdUsuario,";
    $query = $query . " :CdPrefeitura,";
    $query = $query . " :servico,";
    $query = $query . " :publico,";
    $query = $query . " :bolsista_qtd,";
    $query = $query . " :bolsista_valor,";
    $query = $query . " :outras_despesas,";
    $query = $query . " :convenio,";
    $query = $query . " :FNAS,";
    $query = $query . " :recurso_proprio,";
    $query = $query . " :total,";
    $query = $query . " :obs,";
    $query = $query . " :mes,";
    $query = $query . " :ano,";
    $query = $query . " :Acao,";
    $query = $query . " :Protocolo,";
    $query = $query . " :DtCadastro";
    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":servico",$servico);
    $buscasegura->bindValue(":publico",$publico);
    $buscasegura->bindValue(":bolsista_qtd",$bolsista_qtd);
    $buscasegura->bindValue(":bolsista_valor",$bolsista_valor);
    $buscasegura->bindValue(":outras_despesas",$outras_despesas);
    $buscasegura->bindValue(":convenio",$convenio);
    $buscasegura->bindValue(":FNAS",$FNAS);
    $buscasegura->bindValue(":recurso_proprio",$recurso_proprio);
    $buscasegura->bindValue(":total",$total);
    $buscasegura->bindValue(":obs",$obs);
    $buscasegura->bindValue(":mes",$mes);
    $buscasegura->bindValue(":ano",$ano);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":Protocolo",$Protocolo);
    $buscasegura->bindValue(":DtCadastro",$DtAtualizacao);
    $buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Projeto Social cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
    location.href="../index.php?p=projetos_sociais"
</script>
