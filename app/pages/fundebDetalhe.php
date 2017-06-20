<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM fundeb WHERE id = '".$id."'");
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
                <td>Titulo</td>
                <td><?php echo $rsLinha->Nome;?></td>
            </tr>
            <tr>
                <td>Mês / Ano</td>
                <td><?php echo retorna_mes_extenso($rsLinha->Mes);?> / <?php echo $rsLinha->Ano;?></td>
            </tr>

            <?php
            $dir = '../dinamico/municipio/'.$vAdmin->Pasta.'/anexo/'.$rsLinha->Ano.'/fundeb/'.$rsLinha->Arquivo;
             ?>
            <tr class="fundoTable">
                <td colspan="2">
                  <object type="application/pdf"  data="<?php echo $dir?>"  width="100%" height="300" >
                    <a class="btn btn-3d btn-reveal btn-purple" target="_blank" href="<?php echo $dir?>">Ver PDF</a>
                    </object>
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
