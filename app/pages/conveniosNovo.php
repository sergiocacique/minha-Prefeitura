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
        <form class="validate" action="acao/conveniosAdicionar.php" method="post" enctype="multipart/form-data">
        <p>Informação Básica</p>
          <div class="form-group-attached">
            <div class="row clearfix">
            <div class="col-sm-4">
              <div class="form-group form-group-default">
                <label>Mês</label>
                <select class="form-control" id="mes" name="mes">
                    <?php
                    for ($i = 1; $i <= 12; $i++){
                        ?>
                        <option value="<?=$i?>"><?=retorna_mes_extenso($i)?></option>
                    <?php }?>
                </select>
              </div>
            </div>

            <div class="col-sm-4">
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

            <div class="col-sm-4">
              <div class="form-group form-group-default">
                <label>Tipo do Convênio</label>
                <select class="form-control" id="Tipo" name="Tipo">
                    <option value="Concedente">Concedente</option>
                    <option value="Convenente">Convenente</option>
                </select>
              </div>
            </div>
          </div>
            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Número Convênio</label>
                  <input class="form-control" name="SIAFI" required="Digite o n. do convênio" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group form-group-default">
                  <label>Orgão</label>
                  <input class="form-control" name="orgao" type="text" placeholder="MINISTERIO DA INTEGRACAO NACIONAL">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Objeto do Convênio</label>
                  <textarea class="form-control" name="objeto" id="objeto" placeholder="Digite aqui o objeto do convênio" aria-invalid="false"></textarea>
                </div>
              </div>
            </div>
          </div>


          <p class="m-t-10">Informações Importante</p>
          <div class="form-group-attached">

            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor Aprovado</label>
                  <input class="form-control usd" name="val_aprovado" required="" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor Liberado</label>
                  <input class="form-control usd" id="val_liberado" name="val_liberado" required="" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor Contrapartida</label>
                  <input class="form-control usd" id="val_contrapartida" name="val_contrapartida" aria-required="true" type="text">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Inicio da Vigencia</label>
                  <input class="form-control" id="inicio_vigencia" name="inicio_vigencia" placeholder="Digite o n. do convênio" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Fim da Vigencia</label>
                  <input class="form-control" id="fim_vigencia" name="fim_vigencia" placeholder="Digite o n. do convênio" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Data da Publicação</label>
                  <input class="form-control" id="data_publicacao" name="data_publicacao" placeholder="Digite o n. do convênio" aria-required="true" type="text">
                </div>
              </div>
            </div>
          </div>
          <br>
          <p class="m-t-10">Outras Informações</p>
          <div class="form-group-attached">

            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Data da última liberação</label>
                  <input class="form-control" id="DtUltLiberacao" name="DtUltLiberacao" placeholder="Digite o n. do convênio" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor da última liberação</label>
                  <input class="form-control usd" id="VlUltLiberacao" name="VlUltLiberacao" placeholder="" aria-required="true" type="text">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Prorrogação</label>
                  <input class="form-control" id="prorrogacao" name="prorrogacao" placeholder="" aria-required="true" type="text">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Situação do Convênio</label>
                  <input class="form-control" name="status_convenio" placeholder="" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Execução do Convênio</label>
                  <input class="form-control" id="execucao" name="execucao" placeholder="" aria-required="true" type="text">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Observação do Convênio</label>
                  <textarea class="form-control" name="observacao" id="observacao" placeholder="" aria-invalid="false"></textarea>
                </div>
              </div>

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
          <button class="btn btn-success" type="submit">Adicionar</button>
          <button class="btn btn-default"><i class="fa fa-close"></i> Clear</button>
        </form>
      </div>
    </div>

    </div>
  </div>
</div>
