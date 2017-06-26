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


$id = $_GET['id'];
$CdCPL = $_GET['CdCPL'];
$t = $_GET['t'];


$Ultimo=$pdo->prepare("DELETE FROM cpl_empresa WHERE id = '".$id."'");
$Ultimo->execute();



    echo "<div class='callout callout-success'>";
    echo "<h4>Empresa excluida no processo com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=cplEditar&id=<?php echo $CdCPL;?>&t=empresa"
</script>
