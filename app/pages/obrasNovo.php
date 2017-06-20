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
        <form class="validate" action="acao/obrasAdicionar.php" method="post" enctype="multipart/form-data">
        <p>Informação Básica</p>
          <div class="form-group-attached">
            <div class="row clearfix">

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
            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Origem do Convênio</label>
                  <input class="form-control" name="Origem" aria-required="true" type="text">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Número do Convênio</label>
                  <input class="form-control" name="NumConvenio" type="text" placeholder="0110/<?php echo date('Y')?>">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Data da Emissão do Contrato</label>
                  <input data-mask="date" class="form-control" name="DtContrato" type="text" placeholder="00/00/0000">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Prazo Contratual</label>
                  <input class="form-control" name="Prazo" type="text" placeholder="180 Dias">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Número do Processo</label>
                  <input class="form-control" name="NumProcesso" type="text" placeholder="010/<?php echo date('Y')?>">
                </div>
              </div>

            </div>

          </div>

          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Objeto da Obras</label>
                  <textarea class="form-control" name="objeto" id="objeto" placeholder="" aria-invalid="false"></textarea>
                </div>
              </div>
            </div>
          </div>

          <p class="m-t-10">Informações Importante</p>
          <div class="form-group-attached">

            <div class="row clearfix">
              <div class="col-sm-6">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor do Convênio</label>
                  <input data-mask="money" class="form-control usd" name="valorConvenio" type="text">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor do Recurso Próprio</label>
                  <input data-mask="money" class="form-control usd" id="ValorRecurso" name="ValorRecurso" type="text">
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-6">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor Total</label>
                  <input data-mask="money" class="form-control usd" id="ValorTotal" name="ValorTotal" type="text">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor Gasto até agora</label>
                  <input data-mask="money" class="form-control usd" id="ValorGasto" name="ValorGasto" type="text">
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-6">
                <div class="form-group form-group-default input-group">
                  <label>Andamento da Obras</label>
                  <input data-mask="money" class="form-control usd" id="Andamento" name="Andamento" type="text">
                  <span class="input-group-addon">%</span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Status da Obra</label>
                  <select class="form-control" id="StatusObra" name="StatusObra">
                    <option value="Iniciada">Iniciada</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Parada">Parada</option>
                    <option value="Concluida">Concluida</option>
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
                  <label>Observação</label>
                  <textarea class="form-control" name="observacao" id="observacao" placeholder="" aria-invalid="false"></textarea>
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
