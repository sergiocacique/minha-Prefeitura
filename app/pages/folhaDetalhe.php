<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM servidor WHERE Protocolo = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo retorna_mes_extenso($rsLinha->Mes);?> / <?php echo ($rsLinha->Ano);?><br><br>

      </h4>

      <div class="col-md-12 ocultar">
        <table class="table table-hover">

            <thead>
            <tr>
                <th>CPF</th>
                <th>NOME</th>
                <th>CARGO</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $Folha=$pdo->prepare("SELECT * FROM servidor WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND Protocolo = '".$id."' ORDER BY Nome ASC");
            $Folha->execute();
            $lFolha=$Folha->fetchAll(PDO::FETCH_OBJ);

            foreach ($lFolha as $vFolha) {
                ?>
                <tr>

                    <td><code><?php echo mask($vFolha->CPF,'***.###.###-**');?></code></td>
                    <td><?php echo $vFolha->Nome;?></td>
                    <td><?php echo $vFolha->Cargo;?></td>
                </tr>
            <?php }?>
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
