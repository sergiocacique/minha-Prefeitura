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
$Destino = $_POST['Destino'];
$Nome = $_POST['Nome'];
$CdUsuario = $_SESSION['UsuarioID'];

$Cargo = addslashes($_POST['Cargo']);
$Secretaria = (isset($_POST['secretaria']))? $_POST['secretaria'] : '';
$Periodo = (isset($_POST['Periodo']))? $_POST['Periodo'] : '';

$Objetivo = (isset($_POST['objetivo']))? $_POST['objetivo'] : '';
$Dias = (isset($_POST['dias']))? $_POST['dias'] : '';
$Valor_Diaria = moeda($_POST['valor_diaria']);
$Valor_Bruto = moeda($_POST['valor_bruto']);
$INSS = moeda($_POST['inss']);
$IRRF = moeda($_POST['irrf']);
$Valor_Liquido = moeda($_POST['valor_liquido']);

$DtAtualizacao = date('Y-m-d H:i:s');

if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
  $Acao = addslashes(trim($_POST['acao']));
}else{
  $Acao = 'Arquivo';
}
$DtAtualizacao = date('Y-m-d H:i:s');

$DtCadastro1 = date('Y-m');
$Protocolo = "U".$verTempo->CdUsuario."P".date('Y').date('m').date('d');

$Atual=$pdo->prepare("SELECT * FROM diarias WHERE CdUsuario = '".$verTempo->CdUsuario."' AND DATE_FORMAT(DtCadastro, '%Y-%m') = '".$DtCadastro1."' ");
$Atual->execute();
$lAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();

if ($tAtual == 0){
    $Protocolo = $Protocolo;
}else{
    $Protocolo = $lAtual->Protocolo;
}




    $query = "INSERT INTO diarias(";
    $query = $query . " CdUsuario,";
    $query = $query . " CdPrefeitura,";
    $query = $query . " Protocolo,";
    $query = $query . " nome,";
    $query = $query . " cargo,";
    $query = $query . " destino,";
    $query = $query . " objetivo,";
    $query = $query . " periodo,";
    $query = $query . " dias,";
    $query = $query . " valor_diaria,";
    $query = $query . " valor_bruto,";
    $query = $query . " inss,";
    $query = $query . " irff,";
    $query = $query . " valor_liquido,";
    $query = $query . " mes,";
    $query = $query . " ano,";
    $query = $query . " secretaria,";
    $query = $query . " Acao,";
    $query = $query . " DtCadastro";

    $query = $query . " )VALUES(";

    $query = $query . " :CdUsuario,";
    $query = $query . " :CdPrefeitura,";
    $query = $query . " :Protocolo,";
    $query = $query . " :nome,";
    $query = $query . " :cargo,";
    $query = $query . " :destino,";
    $query = $query . " :objetivo,";
    $query = $query . " :periodo,";
    $query = $query . " :dias,";
    $query = $query . " :valor_diaria,";
    $query = $query . " :valor_bruto,";
    $query = $query . " :inss,";
    $query = $query . " :irff,";
    $query = $query . " :valor_liquido,";
    $query = $query . " :mes,";
    $query = $query . " :ano,";
    $query = $query . " :secretaria,";
    $query = $query . " :Acao,";
    $query = $query . " :DtCadastro";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":Protocolo",$Protocolo);
    $buscasegura->bindValue(":nome",$Nome);
    $buscasegura->bindValue(":cargo",$Cargo);
    $buscasegura->bindValue(":destino",$Destino);
    $buscasegura->bindValue(":objetivo",$Objetivo);
    $buscasegura->bindValue(":periodo",$Periodo);
    $buscasegura->bindValue(":dias",$Dias);
    $buscasegura->bindValue(":valor_diaria",$Valor_Diaria);
    $buscasegura->bindValue(":valor_bruto",$Valor_Bruto);
    $buscasegura->bindValue(":inss",$INSS);
    $buscasegura->bindValue(":irff",$IRRF);
    $buscasegura->bindValue(":valor_liquido",$Valor_Liquido);
    $buscasegura->bindValue(":mes",$Mes);
    $buscasegura->bindValue(":ano",$Ano);
    $buscasegura->bindValue(":secretaria",$Secretaria);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":DtCadastro",$DtAtualizacao);

    $buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Diária cadastrada com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=diaria"
</script>
