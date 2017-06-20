<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM convenios WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo $rsLinha->nunSIAFI;?><br><br>

      </h4>

      <div class="col-md-12 ocultar">
        <table class="table">

            <tbody>

            <tr>
                <td>Tipo</td>
                <td><?php echo $rsLinha->Tipo;?></td>
            </tr>
            <tr>
                <td>Orgão</td>
                <td><?php echo $rsLinha->orgao;?></td>
            </tr>
            <tr>
                <td>Objeto</td>
                <td><?php echo $rsLinha->objeto;?></td>
            </tr>
            <tr>
                <td>V.Aprovado</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->aprovado, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Inicio da Vigencia</td>
                <td><?php echo date('d/m/Y', strtotime($rsLinha->InicioVigencia));?></td>
            </tr>
            <tr>
                <td>Fim da Vigencia</td>
                <td><?php echo date('d/m/Y', strtotime($rsLinha->FimVigencia));?></td>
            </tr>
            <tr>
                <td>Publicação</td>
                <td><?php echo date('d/m/Y', strtotime($rsLinha->Publicacao));?></td>
            </tr>
            <tr>
                <td>Data Liberado</td>
                <td><?php echo date('d/m/Y', strtotime($rsLinha->DtUltLiberacao));?></td>
            </tr>
            <tr>
                <td>V.Última Liberado</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->VlUltLiberacao, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>V.Contrapartida</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->Contrapartida, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Prorrogação</td>
                <td><?php echo date('d/m/Y', strtotime($rsLinha->prorrogacao));?></td>
            </tr>
            <tr>
                <td>Execução</td>
                <td><?php echo $rsLinha->execucao;?></td>
            </tr>


            <tr>
                <td>Mês / Ano</td>
                <td><?php echo retorna_mes_extenso($rsLinha->mes);?> / <?php echo $rsLinha->ano;?></td>
            </tr>
            <tr>
                <td>Observação</td>
                <td><?php echo $rsLinha->observacao;?></td>
            </tr>



            </tbody>
        </table>




          <div class="callout callout-success callout-left fade in">
              <small>cadastrado em: <?php echo date('d/m/Y h:m:s', strtotime($rsLinha->DtCadastro));?></small><br>
              <small>publicado em: <?php echo date('d/m/Y h:m:s', strtotime($rsLinha->DtAtualizacao));?></small><br />
              <small>cadastrado por: <?php echo $vPor->Nome;?></small>
          </div>




      </div>
  </div>
</div>
