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
        <form class="validate" action="acao/passagensAdicionar.php" method="post" enctype="multipart/form-data">
        <p>Informação Básica</p>
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="form-group form-group-default" aria-required="true">
                <label>Nome</label>
                  <input class="form-control" name="Nome" required="" aria-required="true"  type="text">
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
            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Data da Viagem</label>
                  <input data-mask="date" class="form-control" name="DtViagem" aria-required="true" type="text" placeholder="00/00/0000">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Data da Volta</label>
                  <input data-mask="date" class="form-control" name="DtVolta" type="text" placeholder="00/00/0000">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor</label>
                  <input data-mask="money" class="form-control usd" name="Valor" type="text">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Secretária</label>
                  <select class="form-control" id="Secretaria" name="Secretaria">
                      <?php
                      $Secretaria=$pdo->prepare("SELECT * FROM estrutura WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' ORDER BY Nome ASC");
                      $Secretaria->execute();
                      $lSecretaria=$Secretaria->fetchAll(PDO::FETCH_OBJ);

                      foreach ($lSecretaria as $vSecretaria) {
                          ?>
                          <option value="<?php echo $vSecretaria->CdEstrutura; ?>" ><?php echo $vSecretaria->Nome; ?></option>
                          <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Destino</label>
                  <input  class="form-control usd" name="Destino" type="text">
                </div>
              </div>


            </div>
          </div>

          <p class="m-t-10">Informações Importante</p>
          <div class="form-group-attached">

            <div class="row clearfix">

              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Objetivo da Viagem</label>
                  <textarea class="form-control" name="Objetivo" id="Objetivo" placeholder="" aria-invalid="false"></textarea>
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
