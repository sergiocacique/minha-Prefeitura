<?php

include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$idResposta = addslashes($_POST['id']);
$CdAdmin = $_SESSION['UsuarioID'];
$Assunto1 = addslashes($_POST['editor1']);

$DtAtualizacao = date('Y-m-d H:i:s');
$dataFinal =  date('Y-m-d', strtotime($DtAtualizacao. ' + 3 days'));

$Assunto = $Assunto1;

    $query = "INSERT INTO sic_ticket_resposta(";
    $query = $query . " CdPrefeitura,";
    $query = $query . " idResposta,";
    $query = $query . " CdAdmin,";
    $query = $query . " Assunto,";
    $query = $query . " DtCadastro,";
    $query = $query . " DtAtualizacao,";
    $query = $query . " Acao";

    $query = $query . " )VALUES(";

    $query = $query . " :CdPrefeitura,";
    $query = $query . " :idResposta,";
    $query = $query . " :CdAdmin,";
    $query = $query . " :Assunto,";
    $query = $query . " :DtCadastro,";
    $query = $query . " :DtAtualizacao,";
    $query = $query . " :Acao";
    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":idResposta",$idResposta);
    $buscasegura->bindValue(":CdAdmin",$CdAdmin);
    $buscasegura->bindValue(":Assunto",$Assunto);
    $buscasegura->bindValue(":DtCadastro",$DtAtualizacao);
    $buscasegura->bindValue(":DtAtualizacao",$DtAtualizacao);
    $buscasegura->bindValue(":Acao",'Aberto');
    $buscasegura->execute();


    $query2 = "UPDATE sic_ticket SET";
    $query2 = $query2 . " Acao = :Acao,";
    $query2 = $query2 . " DtFechamento = :DtFechamento,";
    $query2 = $query2 . " DtAtualizacao = :DtAtualizacao,";
    $query2 = $query2 . " WHERE ";
    $query2 = $query2 . " CdPrefeitura = :CdPrefeitura";
    $query2 = $query2 . " AND ";
    $query2 = $query2 . " id = :id";


    $Atualiza=$pdo->prepare($query2);
    $Atualiza->bindValue(":Acao",'Aberto');
    $Atualiza->bindValue(":DtFechamento",$dataFinal);
    $Atualiza->bindValue(":DtAtualizacao",$DtAtualizacao);
    $Atualiza->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $Atualiza->bindValue(":id",$idResposta);
    $Atualiza->execute();




    echo "<div class='callout callout-success'>";
    echo "<h4>Atualizado com sucesso!</h4>";
    echo "</div>";
    ?>

<script language= "JavaScript">
    location.href="../index.php?p=esic_ver&c=<?php echo $idResposta;?>"
</script>
