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

$ID = $_GET['chamado'];
$Acao = $_GET['acao'];
$CdAdmin = $verTempo->CdUsuario;
$DtAtualizacao = date('Y-m-d H:i:s');

$query = "UPDATE sic_ticket SET ";
$query = $query . " Acao=:Acao, ";
$query = $query . " WHERE ";
$query = $query . " CdPrefeitura=:CdPrefeitura";
$query = $query . " AND ";
$query = $query . " id=:id";

$buscasegura=$pdo->prepare($query);
$buscasegura->bindValue(":Acao",$Acao);
$buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
$buscasegura->bindValue(":id",$ID);

$buscasegura->execute();


$Atual=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '". $CdAdmin ."'");
$Atual->execute();
$vAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();


$Assunto = "Este chamando foi fechado por ".$vAtual->Nome." em  ".date('d/m/Y', strtotime($DtAtualizacao)).".<br /><br />Atenciosamente,<br /><br />".$vAdmin->RazaoSocial.".";

$query1 = "INSERT INTO sic_ticket_resposta (";

$query1 = $query1 . " CdPrefeitura, ";
$query1 = $query1 . " idResposta, ";
$query1 = $query1 . " CdAdmin, ";
$query1 = $query1 . " Assunto, ";
$query1 = $query1 . " DtCadastro, ";
$query1 = $query1 . " DtAtualizacao, ";
$query1 = $query1 . " Acao ";

$query1 = $query1 . " ) VALUES ( ";

$query1 = $query1 . " :CdPrefeitura, ";
$query1 = $query1 . " :idResposta, ";
$query1 = $query1 . " :CdAdmin, ";
$query1 = $query1 . " :Assunto, ";
$query1 = $query1 . " :DtCadastro, ";
$query1 = $query1 . " :DtAtualizacao, ";
$query1 = $query1 . " :Acao ";

$query1 = $query1 . " ) ";


$Adicionar=$pdo->prepare($query1);
$Adicionar->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
$Adicionar->bindValue(":idResposta",$ID);
$Adicionar->bindValue(":CdAdmin",$CdAdmin);
$Adicionar->bindValue(":Assunto",$Assunto);
$Adicionar->bindValue(":DtCadastro",$DtAtualizacao);
$Adicionar->bindValue(":DtAtualizacao",$DtAtualizacao);
$Adicionar->bindValue(":Acao",$Acao);
$Adicionar->execute();

$query2 = "UPDATE sic_ticket_resposta SET ";
$query2 = $query2 . " Acao=:Acao, ";
$query2 = $query2 . " WHERE ";
$query2 = $query2 . " CdPrefeitura=:CdPrefeitura";
$query2 = $query2 . " AND ";
$query2 = $query2 . " idResposta=:idResposta";

$buscasegura=$pdo->prepare($query2);
$buscasegura->bindValue(":Acao",$Acao);
$buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
$buscasegura->bindValue(":idResposta",$ID);

$buscasegura->execute();

    echo "<div class='callout callout-success'>";
    echo "<h4>Sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
     location.href="../index.php?p=esic"
</script>
