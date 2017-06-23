<?php
$CdCPL = $_GET['id'];

$Ultimo=$pdo->prepare("SELECT * FROM vw_cpl WHERE CdCPL = '".$CdCPL."'");
$Ultimo->execute();
$vUltimo=$Ultimo->fetch(PDO::FETCH_OBJ);
?>
<!-- END JUMBOTRON -->
<!-- START CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg">
  <!-- BEGIN PlACE PAGE CONTENT HERE -->

  <div class="col-md-12 margin-botton-10">
    <a class="btn btn-3d btn-reveal btn-purple" href="index.php">
        <i class="fa fa-home fa-1x pull-left"></i>
        INICIO
    </a>


    <a class="btn btn-3d btn-reveal btn-green" href="index.php">
        <i class="fa fa-mail-reply fa-1x pull-left"></i>
        VOLTAR
    </a>

    <a class="btn btn-3d btn-reveal btn-aqua" href="p=minha_tarefa">
        <i class="fa fa-inbox fa-1x pull-left"></i>
        CAIXA DE TAREFA
    </a>
  </div>

<div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3">
  <div class="container-fluid bg-white">
    <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-transparent">
        <div class="panel-body">
          <form class="validate" action="acao/cplAdicionar.php" method="post" enctype="multipart/form-data">
          <p>Informação Básica</p>
            <div class="form-group-attached">
              <div class="row clearfix">
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Orgão Participante</label>
                    <select class="form-control" id="orgao" name="orgao">
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

              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Número do Processo</label>
                  <input required="required" id="numero_processo" name="numero_processo" class="form-control" type="text" placeholder="0001/<?php echo date('Y')?>">
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor do Contrato</label>
                  <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control usd" id="valor_licitacao" name="valor_licitacao" placeholder="0,00">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Situação</label>
                  <select class="form-control" required="required" id="situacao" name="situacao">
                      <?php
                      $Situacao=$pdo->prepare("SELECT * FROM cpl_situacao ORDER BY nome ASC");
                      $Situacao->execute();
                      $lSituacao=$Situacao->fetchAll(PDO::FETCH_OBJ);

                      foreach ($lSituacao as $vSituacao) {
                      ?>
                          <option value="<?php echo $vSituacao->id; ?>"><?php echo $vSituacao->nome; ?></option>
                          <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
            </div>
              <div class="row clearfix">
                <div class="col-sm-4">
                  <div class="form-group form-group-default required" aria-required="true">
                    <label>Data da Abertura</label>
                    <input required="required" data-mask="date" id="dtAbertura" name="dtAbertura" class="form-control" type="text" placeholder="00/00/0000">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Publicado em</label>
                    <input id="publicado" name="publicado" class="form-control" type="text" placeholder="DOM - Diário Oficial Municipal">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Data da Publicação</label>
                    <input data-mask="date" class="form-control" name="DtPublicacao" type="text" placeholder="00/00/0000">
                  </div>
                </div>


              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group form-group-default required" aria-required="true">
                    <label>Número do DOC. de Publicação</label>
                    <input class="form-control" name="numeroDOM" aria-required="true" type="text" placeholder="DOM - 0001">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Data de Homologação</label>
                    <input data-mask="date" class="form-control" name="DtHomologacao" type="text" placeholder="00/00/0000">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Número do DOM Homologação</label>
                    <input class="form-control" name="DomHomologacao" type="text" placeholder="DOM - 0001">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Objeto do Contrato</label>
                    <textarea class="form-control" name="objetivo" id="objetivo" placeholder="" aria-invalid="false"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <br />
            <div class="form-group-attached">

              <div class="row clearfix">
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Finalidade</label>
                    <select class="form-control" required="required" id="finalidade" name="finalidade">
                        <?php
                        $Finalidade=$pdo->prepare("SELECT * FROM cpl_finalidade ORDER BY nome ASC");
                        $Finalidade->execute();
                        $lFinalidade=$Finalidade->fetchAll(PDO::FETCH_OBJ);

                        foreach ($lFinalidade as $vFinalidade) {
                        ?>
                            <option value="<?php echo $vFinalidade->id; ?>"><?php echo $vFinalidade->nome; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Modalidade</label>
                    <select class="form-control" required="required" id="modalidade" name="modalidade">
                        <?php
                        $Modalidade=$pdo->prepare("SELECT * FROM cpl_modalidade ORDER BY nome ASC");
                        $Modalidade->execute();
                        $lModalidade=$Modalidade->fetchAll(PDO::FETCH_OBJ);

                        foreach ($lModalidade as $vModalidade) {
                        ?>
                            <option value="<?php echo $vModalidade->id; ?>"><?php echo $vModalidade->nome; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Tipo</label>
                    <select class="form-control" required="required" id="tipo" name="tipo">
                        <?php
                        $Tipo=$pdo->prepare("SELECT * FROM cpl_tipo ORDER BY nome ASC");
                        $Tipo->execute();
                        $lTipo=$Tipo->fetchAll(PDO::FETCH_OBJ);

                        foreach ($lTipo as $vTipo) {
                        ?>
                            <option value="<?php echo $vTipo->id; ?>"><?php echo $vTipo->nome; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>



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
</div>

<div class="summary col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9">

  <div class="panel panel-default">
    <div class="grid-title no-border">
      <h4>Contrato e Licitação<br> <small>Processo: <?php echo $vUltimo->NumeroProcesso;?></small></h4>
    </div>
    <div class="panel-body">

      <div class="panel-group" id="accordion1">
                              <?php
                              $Ano=$pdo->prepare("SELECT * FROM cpl WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND Acao = 'Publicado' GROUP BY DATE_FORMAT(DtAbertura, '%Y') ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC");
                              $Ano->execute();

                              $lAno=$Ano->fetchAll(PDO::FETCH_OBJ);
                              $tAno = $Ano->rowCount();

                              foreach ($lAno as $vAno) {
                                  ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo date('Y', strtotime($vAno->DtAbertura));?>" class="collapsed">
                                                <?php echo date('Y', strtotime($vAno->DtAbertura));?>
                                            </a>
                                        </h4><!-- /panel-title -->
                                    </div><!-- /panel-heading -->
                                    <div id="collapse<?php echo date('Y', strtotime($vAno->DtAbertura));?>" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
                                          <ul>
                                            <?php
                                            $Mes=$pdo->prepare("SELECT * FROM cpl WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND Acao = 'Publicado' AND DATE_FORMAT(DtAbertura, '%Y') = '".date('Y', strtotime($vAno->DtAbertura))."' GROUP BY DATE_FORMAT(DtAbertura, '%m') ORDER BY DATE_FORMAT(DtAbertura, '%m') ASC");
                                            $Mes->execute();

                                            $lMes=$Mes->fetchAll(PDO::FETCH_OBJ);
                                            $tMes = $Mes->rowCount();

                                            foreach ($lMes as $vMes) {
                                              $total = strlen(date('m', strtotime($vMes->DtAbertura)));



                                              if($total == 2){
                                                $mesSel = date('m', strtotime($vMes->DtAbertura));
                                              }else{
                                                $mesSel = "0".date('m', strtotime($vMes->DtAbertura));
                                              }
                                                ?>
                                                <li>
                                                  <a href="?p=cpl&m=<?php echo $mesSel;?>&a=<?php echo date('Y', strtotime($vMes->DtAbertura));?>"><?php echo retorna_mes_extenso(date('m', strtotime($vMes->DtAbertura)));?></a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                          </ul>

                                        </div><!-- /panel-body -->
                                    </div><!-- /panel-collapse -->
                                </div><!-- /panel -->
                                <?php }?>
                            </div>


    </div>
  </div>
</div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
