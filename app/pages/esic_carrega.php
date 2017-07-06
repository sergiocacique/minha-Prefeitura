<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 25/08/14
 * Hora: 09:18
 */

include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");
$SelAcao = $_POST['acao'];

if($SelAcao == "1"){

    $Acao = "Acao = 'Aberto'";
    $Titulo = "Novos Chamados";

}elseif($SelAcao == "2"){

    $Acao = "DtFinal <= CURRENT_DATE() AND (Acao = 'Aberto' OR Acao = 'Em Andamento')";
    $Titulo = "Chamados Atrasados";

}elseif($SelAcao == "3"){

    $Acao = "Acao = 'Em Andamento'";
    $Titulo = "Chamados Em Andamento";

}elseif($SelAcao == "4"){

    $Acao = "Acao = 'Fechado'";
    $Titulo = "Chamados Fechados";

}else{

    $Acao = "Acao = 'Aberto' OR Acao = 'Em Andamento' OR Acao ='Fechado'";
    $Titulo = "Todos os Chamados";

}
$sql = "SELECT * FROM sic_ticket WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND  $Acao ORDER BY DtCadastro DESC";
$Selecionado=$pdo->prepare($sql);
$Selecionado->execute();

$lSelecionado=$Selecionado->fetchAll(PDO::FETCH_OBJ);
$tSelecionado = $Selecionado->rowCount();
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-comments-o fa-2x"></i> <?php echo $Titulo;?></h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Protocolo</th>
                <th>Nome</th>
                <th>Local</th>
                <th>Data</th>
                <th>Previsto</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($lSelecionado as $vSelecionado) {
              $Usuarios=$pdo->prepare("SELECT * FROM sic_usuario WHERE id = '".$vSelecionado->CdUsuario."'");
              $Usuarios->execute();

              $lUsuarios=$Usuarios->fetch(PDO::FETCH_OBJ);
              $tUsuarios = $Usuarios->rowCount();

                ?>
                <tr onclick="document.location = '?p=esic_ver&c=<?php echo $vSelecionado->id; ?>';" style="cursor:pointer">
                    <td><?php echo $vSelecionado->Protocolo; ?></td>
                    <td><?php echo $lUsuarios->Nome; ?></td>
                    <td><?php echo $vSelecionado->Orgao; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($vSelecionado->DtCadastro)); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($vSelecionado->DtFinal)); ?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
