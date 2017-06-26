<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");
?>

<div class="panel panel-default">
    <div class="panel-body">
        <form class="validate" action="acao/folhaAdicionar.php" method="post" enctype="multipart/form-data">
          <div class=" col-sm-12 col-md-12">
              <div class="col-md-12">
                  <label>
                      Arquivo
                      <small class="text-muted">obrigatório</small>
                  </label>

                  <!-- custom file upload -->
                  <div class="fancy-file-upload fancy-file-primary">
                      <i class="fa fa-upload"></i>
                      <input type="file" class="form-control" onchange="jQuery(this).next('input').val(this.value);" name="filename" id="filename" />
                      <input type="text" class="form-control" placeholder="nenhum arquivo selecionado" readonly="" />
                      <span class="button">Procurar Arquivo</span>
                  </div>
                  <small class="text-muted block">Tamanho máximo: 20Mb (.csv<br>Recomendamos importar no máximo 2000 registros por vez)</small>

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
