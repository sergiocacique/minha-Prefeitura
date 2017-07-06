<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include('../func/seg.php');
$pdo=conectar();

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM vw_diario_oficial WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo $rsLinha->Titulo;?><br><br>
      </h4>
      <p>
        <br />
        <?php echo $rsLinha->Texto;?><br><br>
      </p>
      <div class="col-md-12 ocultar">

          <div class="callout callout-success callout-left fade in">
              <small>Publicado por: <?php echo $vPor->Nome;?></small><br />
              <small>Código Identificador: <?php echo $rsLinha->Codigo;?></small>
              <hr />
              <small>Matéria publicada no Diário Oficial do <?php echo $vAdmin->Titulo;?> no dia <?php echo date('d/m/Y', strtotime($rsLinha->DtPublicacao));?>. Edição <?php echo $rsLinha->Edicao;?>
                  A verificação de autenticidade da matéria pode ser feita informando o código identificador no site:
                  <?php echo $vAdmin->Dominio;?>/diario_oficial/ </small>
          </div>


      </div>
  </div>
</div>
