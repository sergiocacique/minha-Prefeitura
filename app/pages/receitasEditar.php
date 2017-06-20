<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM receitas WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>

<div class="panel panel-default">
    <div class="panel-body">
        <form class="validate" action="acao/receitasSalvar.php" method="post" enctype="multipart/form-data">

          <div class=" col-sm-12 col-md-4">
              <label>Mês</label>

              <select class="form-control" id="mes" name="mes">
                  <?php
                  for ($i = 1; $i <= 12; $i++){
                      ?>
                      <option value="<?=$i?>"<?php if($rsLinha->Mes == $i){?> selected="selected"<?php }?>><?=retorna_mes_extenso($i)?></option>
                  <?php }?>
              </select>

          </div>

          <div class=" col-sm-12 col-md-4">
              <label>Ano</label>

              <select class="form-control" id="ano" name="ano">
                  <?php
                  for($ano=date('Y');$ano > date('Y')-10;$ano--){
                      ?>
                      <option value="<?=$ano?>"<?php if($rsLinha->Mes == $ano){?> selected="selected"<?php }?>><?=$ano?></option>
                  <?php }?>
              </select>

          </div>
          <div class=" col-sm-12 col-md-4">
              <label>Categoria</label>

              <select class="form-control" id="categoria" name="categoria">
                  <option value="extra"<?php if($rsLinha->Categoria == "extra"){?> selected="selected"<?php }?>>Extra</option>
                  <option value="previsto"<?php if($rsLinha->Categoria == "previsto"){?> selected="selected"<?php }?>>previsto</option>
                  <option value="arrecadada"<?php if($rsLinha->Categoria == "arrecadada"){?> selected="selected"<?php }?>>arrecadada</option>
              </select>

          </div>

          <div class=" col-sm-12 col-md-12">
              <div class="fancy-form">
                  <label>Titulo do Evento</label>
                  <input id="titulo" name="titulo" class="form-control" type="text" placeholder="<?php echo $rsLinha->Titulo;?>" value="<?php echo $rsLinha->Titulo;?>">
              </div>
          </div>





          <div class=" col-sm-12 col-md-12">
              <div class="col-md-12">
                  <label>
                      Arquivo
                      <small class="text-muted">obrigatório</small>
                  </label>

                  <!-- custom file upload -->
                  <div class="fancy-file-upload fancy-file-primary">
                      <i class="fa fa-upload"></i>
                      <input type="file" class="form-control" onchange="jQuery(this).next('input').val(this.value);" name="arquivo" id="arquivo" />
                      <input type="text" class="form-control" placeholder="nenhum arquivo selecionado" readonly="" />
                      <span class="button">Procurar Arquivo</span>
                  </div>
                  <small class="text-muted block">Tamanho máximo: 20Mb (pdf)</small>

              </div>
          </div>
          <div class="col-sm-12 col-md-12">
              <hr>
          </div>

            <div class=" col-sm-12 col-md-12">
                <button type="reset" class="btn btn-3d btn-danger margin-bottom-30 font-branco">CANCELAR</button>
                <button type="submit" class="btn btn-3d btn-primary margin-bottom-30 font-branco">GRAVAR</button>
            </div>

        </form>
    </div>
</div>
