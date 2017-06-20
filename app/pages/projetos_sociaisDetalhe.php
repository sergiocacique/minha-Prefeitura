<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM projetos_sociais WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo $rsLinha->servico;?><br><br>

      </h4>

      <div class="col-md-12 ocultar">
        <table class="table">

            <tbody>

            <tr>
                <td>Público</td>
                <td><?php echo $rsLinha->publico;?></td>
            </tr>
            <tr>
                <td>Qtd.Bolsista</td>
                <td><?php echo $rsLinha->bolsista_qtd;?></td>
            </tr>
            <tr>
                <td>Valor de Bolsista</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->bolsista_valor, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Outras Despesas</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->outras_despesas, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Convênio</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->convenio, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Fundo Nacional de Assistência Social (FNAS)</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->FNAS, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Recurso Próprio</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->recurso_proprio, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->total, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Observação</td>
                <td><?php echo $rsLinha->obs;?></td>
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
