<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM obras WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo $rsLinha->numero_processo;?><br><br>

      </h4>

      <div class="col-md-12 ocultar">
        <table class="table">

            <tbody>

            <tr>
                <td>Objeto</td>
                <td><?php echo $rsLinha->objeto;?></td>
            </tr>
            <tr>
                <td>V.Convênio</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->convenio, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>V. Recurso Próprio</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->recurso_proprio, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>V.Total</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->total, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Andamento</td>
                <td><?php echo 'R$ '. number_format($rsLinha->fisico, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Valor Realizado</td>
                <td><?php echo 'R$ ' .number_format($rsLinha->valor_realizado, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Observação</td>
                <td><?php echo $rsLinha->observacao;?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo $rsLinha->estatus;?></td>
            </tr>
            <tr>
                <td>Origem</td>
                <td><?php echo $rsLinha->origem;?></td>
            </tr>
            <tr>
                <td>N.Contrato</td>
                <td><?php echo $rsLinha->contrato;?></td>
            </tr>

            <tr>
                <td>Mês / Ano</td>
                <td><?php echo retorna_mes_extenso($rsLinha->mes);?> / <?php echo $rsLinha->ano;?></td>
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
