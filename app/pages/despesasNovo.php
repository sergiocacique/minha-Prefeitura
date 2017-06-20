<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");
?>

<div class="panel panel-default">
    <div class="panel-body">
        <form class="validate" action="acao/despesasAdicionar.php" method="post" enctype="multipart/form-data">

          <div class=" col-sm-12 col-md-4">
              <label>Mês</label>

              <select class="form-control" id="mes" name="mes">
                  <?php
                  for ($i = 1; $i <= 12; $i++){
                      ?>
                      <option value="<?=$i?>"><?=retorna_mes_extenso($i)?></option>
                  <?php }?>
              </select>

          </div>

          <div class=" col-sm-12 col-md-4">
              <label>Ano</label>

              <select class="form-control" id="ano" name="ano">
                  <?php
                  for($ano=date('Y');$ano > date('Y')-10;$ano--){
                      ?>
                      <option value="<?=$ano?>"><?=$ano?></option>
                  <?php }?>
              </select>

          </div>
          <div class=" col-sm-12 col-md-4">
              <label>Categoria</label>

              <select class="form-control" id="categoria" name="categoria">
                  <option value="Empenho">Empenho</option>
                  <option value="Liquidação">Liquidação</option>
              </select>

          </div>

          <div class=" col-sm-12 col-md-12">
              <div class="fancy-form">
                  <label>Titulo do Evento</label>
                  <input id="titulo" name="titulo" class="form-control" type="text" placeholder="Digite o titulo">
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
          <?php if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){?>
          <div class=" col-sm-12 col-md-4">
              <label>Ação</label>

              <select class="form-control" id="acao" name="acao">
                  <option value="Publicado">Publicar Agora</option>
                  <option value="Arquivo">Guardar para Publicar depois</option>
              </select>

          </div>
          <?php }?>
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
