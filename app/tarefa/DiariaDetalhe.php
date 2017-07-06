<?php
include ("../../conexao.php");
include('../func/funcoes.php');
$pdo=conectar();

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM diarias WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo $rsLinha->nome;?><br><br>

      </h4>

      <div class="col-md-12 ocultar">
        <table class="table">

            <tbody>
            <?php if($rsLinha->cargo != ""){?>
            <tr>
                <td>Cargo</td>
                <td><?php echo $rsLinha->cargo;?></td>
            </tr>
            <?php }?>
            <tr>
                <td>Destino</td>
                <td><?php echo $rsLinha->destino;?></td>
            </tr>
            <tr>
                <td>Objetivo</td>
                <td><?php echo $rsLinha->objetivo;?></td>
            </tr>
            <tr>
                <td>Periodo</td>
                <td><?php echo $rsLinha->periodo;?></td>
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
                            <td>Dias</td>
                            <td><?php echo $rsLinha->dias;?></td>
                        </tr>
                        <tr>
                            <td>Valor da Diária (R$)</td>
                            <td><?php echo 'R$' . number_format($rsLinha->valor_diaria, 2, ',', '.');?></td>
                        </tr>
                        <tr>
                            <td>Valor Bruto (R$)</td>
                            <td><?php echo 'R$' . number_format($rsLinha->valor_bruto, 2, ',', '.');?></td>
                        </tr>
                        <tr>
                            <td>INSS (R$)</td>
                            <td><?php echo 'R$' . number_format($rsLinha->inss, 2, ',', '.');?></td>
                        </tr>
                        <tr>
                            <td>IRRF (R$)</td>
                            <td><?php echo 'R$' . number_format($rsLinha->irff, 2, ',', '.');?></td>
                        </tr>

                        <tr>
                            <td>Valor Liquido (R$)</td>
                            <td><?php echo 'R$' . number_format($rsLinha->valor_liquido, 2, ',', '.');?></td>
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
<?php if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){?>
<a href="./acao/diariasStatus.php?id=<?php echo $rsLinha->id;?>&a=aprovar" class="btn btn-green">Aprovar</a>
<?php }else{?>
<a href="./acao/diariasStatus.php?id=<?php echo $rsLinha->id;?>&a=tramitar" class="btn btn-green">Enviar para o orgão fiscalizador</a>
<?php }?>
<a href="./acao/diariasStatus.php?id=<?php echo $rsLinha->id;?>&a=excluir" class="btn btn-red">Excluir</a>
