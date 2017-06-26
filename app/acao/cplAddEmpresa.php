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


$CdCPL = $_POST['CdCPL'];
$Empresa = $_POST['idEmpresa'];
$Situacao = $_POST['situacao'];
$Observacao = $_POST['Observacao'];

$Acao = "Publicado";
$DtCadastro = date('Y-m-d H:i:s');
$DtCadastro1 = date('Y-m');

$Ultimo=$pdo->prepare("SELECT * FROM empresas WHERE id = '".$Empresa."'");
$Ultimo->execute();
$vUltimo=$Ultimo->fetch(PDO::FETCH_OBJ);


    $query = "INSERT INTO cpl_empresa(";

    $query = $query . " CdPrefeitura,";
    $query = $query . " CdUsuario,";
    $query = $query . " CdCPL,";
    $query = $query . " Nome, ";
    $query = $query . " CPFCNPJ, ";
    $query = $query . " Situacao, ";
    $query = $query . " Acao, ";
    $query = $query . " DtCadastro, ";
    $query = $query . " DtAtualizacao,";
    $query = $query . " Descricao";


    $query = $query . " )VALUES(";

    $query = $query . " :CdPrefeitura,";
    $query = $query . " :CdUsuario,";
    $query = $query . " :CdCPL,";
    $query = $query . " :Nome,";
    $query = $query . " :CPFCNPJ, ";
    $query = $query . " :Situacao, ";
    $query = $query . " :Acao, ";
    $query = $query . " :DtCadastro, ";
    $query = $query . " :DtAtualizacao, ";
    $query = $query . " :Descricao";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":CdCPL",$CdCPL);
    $buscasegura->bindValue(":Nome",$vUltimo->Nome);
    $buscasegura->bindValue(":CPFCNPJ",$vUltimo->CPFCNPJ);
    $buscasegura->bindValue(":Situacao",$Situacao);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":DtCadastro",$DtCadastro);
    $buscasegura->bindValue(":DtAtualizacao",$DtCadastro);
    $buscasegura->bindValue(":Descricao",$Observacao);


    $buscasegura->execute();
    echo "<div class='callout callout-success'>";
    echo "<h4>Empresa adicionada no processo com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=cplEditar&id=<?php echo $CdCPL;?>&t=empresa"
</script>
