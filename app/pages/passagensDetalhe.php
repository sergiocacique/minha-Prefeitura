<?php
include ("../../conexao.php");
include('../func/funcoes.php');
$pdo=conectar();

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM passagens WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo $rsLinha->Nome;?><br><br>

      </h4>

      <div class="col-md-12 ocultar">
        <table class="table">

            <tbody>
            <tr>
                <td>Destino</td>
                <td><?php echo $rsLinha->Destino;?></td>
            </tr>
            <tr>
                <td>Objetivo</td>
                <td><?php echo $rsLinha->Objetivo;?></td>
            </tr>

            <tr class="fundoTable">
                <td colspan="2">
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th colspan="2"></th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>Valor da Passagem (R$)</td>
                            <td><?php echo 'R$' . number_format($rsLinha->valor, 2, ',', '.');?></td>
                        </tr>
                        <tr>
                            <td>Valor Bruto (R$)</td>
                            <td><?php echo date('d/m/Y', strtotime($rsLinha->DtViagem));?></td>
                        </tr>
                        <tr>
                            <td>INSS (R$)</td>
                            <td><?php echo date('d/m/Y', strtotime($rsLinha->DtVolta));?></td>
                        </tr>

                        </tbody>
                    </table>
                </td>
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
