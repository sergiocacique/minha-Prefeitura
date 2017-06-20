<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");
?>

<div class="container-fluid bg-white">
  <div class="row">
  <div class="col-sm-12">
    <div class="panel panel-transparent">
      <div class="panel-body">
        <form class="validate" action="acao/fundebAdicionar.php" method="post" enctype="multipart/form-data">
        <p>Informação Básica</p>
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="form-group form-group-default" aria-required="true">
                <label>Nome</label>
                  <input class="form-control" name="Titulo" required="" aria-required="true"  type="text">
                </div>
              </div>
            <div class="row">

            <div class="col-sm-6">
              <div class="form-group form-group-default">
                <label>Mês</label>
                <select class="form-control" id="mes" name="mes">
                    <?php
                    for ($i = 1; $i <= 12; $i++){
                        ?>
                        <option value="<?=$i?>"<?php if($i == date('m')){?> selected="SELECT"<?php }?>><?=retorna_mes_extenso($i)?></option>
                    <?php }?>
                </select>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group form-group-default">
                <label>Ano</label>
                <select class="form-control" id="ano" name="ano">
                    <?php
                    for($ano=date('Y');$ano > date('Y')-10;$ano--){
                        ?>
                        <option value="<?=$ano?>"><?=$ano?></option>
                    <?php }?>
                </select>
              </div>
            </div>
          </div>

          </div>

          <br />
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-group-default required" aria-required="true">
                  <div class="fancy-file-upload fancy-file-primary">
                      <input type="file" class="form-control" onchange="jQuery(this).next('input').val(this.value);" name="arquivo" id="arquivo" />
                      <input type="text" class="form-control" placeholder="no file selected" readonly="" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <?php if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){?>
                <div class="col-sm-12">
                  <div class="form-group form-group-default required" aria-required="true">
                    <label>Ação</label>
                    <select class="form-control" id="acao" name="acao">
                        <option value="Publicado">Publicar Agora</option>
                        <option value="Arquivo">Guardar para Publicar depois</option>
                    </select>
                  </div>
                </div>


              <?php }?>
            </div>
          </div>
          <br>

          <br>
          <button class="btn btn-success" type="submit">Adicionar</button>
          <button class="btn btn-default"><i class="fa fa-close"></i> Clear</button>
        </form>
      </div>
    </div>

    </div>
  </div>
</div>
