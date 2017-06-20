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

$Execucao = (isset($_POST['execucao']))? $_POST['execucao'] : '';
$Tipo = (isset($_POST['Tipo']))? $_POST['Tipo'] : '';
$SIAFI = (isset($_POST['SIAFI']))? $_POST['SIAFI'] : '';
$Orgao = (isset($_POST['orgao']))? $_POST['orgao'] : '';
$Objeto = (isset($_POST['objeto']))? $_POST['objeto'] : '';

$ValAprovado = moeda($_POST['val_aprovado']);
$ValLiberado = moeda($_POST['val_liberado']);
$ValContrapartida = moeda($_POST['val_contrapartida']);

$AntInicioVigencia = (isset($_POST['inicio_vigencia']))? $_POST['inicio_vigencia'] : '';
$InicioVigencia = implode("-",array_reverse(explode("/",$AntInicioVigencia)));

$AntFimVigencia = (isset($_POST['fim_vigencia']))? $_POST['fim_vigencia'] : '';
$FimVigencia = implode("-",array_reverse(explode("/",$AntFimVigencia)));

$AntDataPublicacao = (isset($_POST['data_publicacao']))? $_POST['data_publicacao'] : '';
$DataPublicacao = implode("-",array_reverse(explode("/",$AntDataPublicacao)));

$AntProrrogacao = (isset($_POST['prorrogacao']))? $_POST['prorrogacao'] : '';
$Prorrogacao = implode("-",array_reverse(explode("/",$AntProrrogacao)));

if ($Prorrogacao != ""){
    $Prorrogacao = $Prorrogacao;
}else{
    $Prorrogacao = "0000-00-00";
}



$StatusConvenio = (isset($_POST['status_convenio']))? $_POST['status_convenio'] : '';
$Observacao = (isset($_POST['observacao']))? $_POST['observacao'] : '';


    $DtUltLiberacao = formatarData($_POST['DtUltLiberacao']);
    $VlUltLiberacao = moeda($_POST['VlUltLiberacao']);

$DtAtualizacao = date('Y-m-d H:i:s');

if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
  $Acao = addslashes(trim($_POST['acao']));
}else{
  $Acao = 'Arquivo';
}
$DtAtualizacao = date('Y-m-d H:i:s');




// Depois verifica se é possível mover o arquivo para a pasta escolhida
    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo


    $query = "INSERT INTO convenios(";
    $query = $query . " CdPrefeitura,";
    $query = $query . " CdUsuario,";
    $query = $query . " Acao,";
    $query = $query . " Tipo,";
    $query = $query . " nunSIAFI,";
    $query = $query . " ano,";
    $query = $query . " mes,";
    $query = $query . " observacao,";
    $query = $query . " prorrogacao,";
    $query = $query . " orgao,";
    $query = $query . " execucao,";
    $query = $query . " objeto,";
    $query = $query . " aprovado,";
    $query = $query . " liberado,";
    $query = $query . " InicioVigencia,";
    $query = $query . " FimVigencia,";
    $query = $query . " Publicacao,";
    $query = $query . " Contrapartida,";
    $query = $query . " estatus,";
    $query = $query . " DtUltLiberacao,";
    $query = $query . " VlUltLiberacao,";
    $query = $query . " DtAtualizacao,";
    $query = $query . " DtCadastro";

    $query = $query . " )VALUES(";

    $query = $query . " :CdPrefeitura,";
    $query = $query . " :CdUsuario,";
    $query = $query . " :Acao,";
    $query = $query . " :Tipo,";
    $query = $query . " :nunSIAFI,";
    $query = $query . " :ano,";
    $query = $query . " :mes,";
    $query = $query . " :observacao,";
    $query = $query . " :prorrogacao,";
    $query = $query . " :orgao,";
    $query = $query . " :execucao,";
    $query = $query . " :objeto,";
    $query = $query . " :aprovado,";
    $query = $query . " :liberado,";
    $query = $query . " :InicioVigencia,";
    $query = $query . " :FimVigencia,";
    $query = $query . " :Publicacao,";
    $query = $query . " :Contrapartida,";
    $query = $query . " :estatus,";
    $query = $query . " :DtUltLiberacao,";
    $query = $query . " :VlUltLiberacao,";
    $query = $query . " :DtAtualizacao,";
    $query = $query . " :DtCadastro";
    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":Tipo",$Tipo);
    $buscasegura->bindValue(":nunSIAFI",$SIAFI);
    $buscasegura->bindValue(":ano",$Ano);
    $buscasegura->bindValue(":mes",$Mes);
    $buscasegura->bindValue(":observacao",$Observacao);
    $buscasegura->bindValue(":prorrogacao",$Prorrogacao);
    $buscasegura->bindValue(":orgao",$Orgao);
    $buscasegura->bindValue(":execucao",$Execucao);
    $buscasegura->bindValue(":objeto",$Objeto);
    $buscasegura->bindValue(":aprovado",$ValAprovado);
    $buscasegura->bindValue(":liberado",$ValLiberado);
    $buscasegura->bindValue(":InicioVigencia",$InicioVigencia);
    $buscasegura->bindValue(":FimVigencia",$FimVigencia);
    $buscasegura->bindValue(":Publicacao",$DataPublicacao);
    $buscasegura->bindValue(":Contrapartida",$ValContrapartida);
    $buscasegura->bindValue(":estatus",$StatusConvenio);
    $buscasegura->bindValue(":DtUltLiberacao",$DtUltLiberacao);
    $buscasegura->bindValue(":VlUltLiberacao",$VlUltLiberacao);
    $buscasegura->bindValue(":DtCadastro",$DtAtualizacao);
    $buscasegura->bindValue(":DtAtualizacao",$DtAtualizacao);
    $buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Convênio cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
    location.href="../index.php?p=convenios"
</script>
