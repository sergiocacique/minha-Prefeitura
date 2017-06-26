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
$CdRecurso = $_POST['recurso'];
$Descricao = $_POST['descricao'];


$Acao = "Publicado";
$DtCadastro = date('Y-m-d H:i:s');
$DtCadastro1 = date('Y-m');


    $query = "INSERT INTO cpl_recursos(";

    $query = $query . " CdPrefeitura,";
    $query = $query . " CdUsuario,";
    $query = $query . " CdCPL,";
    $query = $query . " CdRecurso, ";
    $query = $query . " Descricao ";

    $query = $query . " )VALUES(";

    $query = $query . " :CdPrefeitura,";
    $query = $query . " :CdUsuario,";
    $query = $query . " :CdCPL,";
    $query = $query . " :CdRecurso,";
    $query = $query . " :Descricao";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdCPL",$CdCPL);
    $buscasegura->bindValue(":CdRecurso",$CdRecurso);
    $buscasegura->bindValue(":Descricao",$Descricao);


    $buscasegura->execute();
    echo "<div class='callout callout-success'>";
    echo "<h4>Recurso adicionado no processo com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=cplEditar&id=<?php echo $CdCPL;?>&t=recursos"
</script>
