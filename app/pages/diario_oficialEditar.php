<?php
$id = $_GET['i'];

$Atual=$pdo->prepare("SELECT * FROM vw_diario_oficial WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);
?>
<script src="//cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>
<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p><?php echo $vAdmin->RazaoSocial?></p>
        </li>
        <li><a href="#" class="active">Diário Oficial</a>
        </li>
      </ul>
      <!-- END BREADCRUMB -->
    </div>
  </div>
</div>
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
  <div class="col-md-12 col-sm-12">
    <div class="panel panel-default">
      <div class="panel-body">
        <p>
          <span id="contador"></span>
        </p>
      </div>
    </div>
  </div>

  <div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3">

    <div class="panel panel-default">
      <div class="panel-body">
        <form class="validate" action="acao/diario_oficialSalvar.php" method="post">
          <input type="hidden" id="CdDIario" name="CdDIario" value="<?php echo $rsLinha->id;?>" />
          <div class="form-group-attached">

              <div class="row clearfix">

              <div class="col-sm-12">
                <div class="form-group form-group-default required">
                  <label>Categoria</label>
                  <select class="form-control" id="Categoria" name="Categoria">
                      <?php
                      $Categoria=$pdo->prepare("SELECT * FROM publicacao_categoria  ORDER BY Nome ASC");
                      $Categoria->execute();
                      $lCategoria=$Categoria->fetchAll(PDO::FETCH_OBJ);

                      foreach ($lCategoria as $vCategoria) {
                          ?>
                          <option value="<?php echo $vCategoria->id; ?>"<?php if($vCategoria->id == $rsLinha->CdCategoria){?> selected<?php }?>><?php echo $vCategoria->Nome; ?></option>
                          <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">

            <div class="col-sm-12">
              <div class="form-group form-group-default required">
                <label>Titulo</label>
                <input required="required" id="txtTitulo" name="txtTitulo" required="required" class="form-control" type="text" value="<?php echo $rsLinha->Titulo;?>">
              </div>
            </div>
          </div>

            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-group-default required" aria-required="true">
                  <textarea class="form-control" required="required" name="texto" id="texto" aria-invalid="false"><?php echo $rsLinha->Texto;?></textarea>
                  <script>
                      //CKEDITOR.replace( 'objetivo' );

                    // Turn off automatic editor creation first.
                    // CKEDITOR.disableAutoInline = true;
                    CKEDITOR.replace( 'texto' );
                </script>
                </div>
              </div>
            </div>



          </div>
          <br />
          <div class="form-group-attached">

            <div class="row clearfix">
              <div class="col-sm-3">
                <div class="form-group form-group-default">
                  <label>Edição</label>
                  <input required="required" id="txtEdicao" name="txtEdicao" disabled required="required" class="form-control" type="text" value="<?php echo$rsLinha->Edicao ;?>">
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group form-group-default">
                  <label>Data de Publicação</label>
                  <input required="required" id="dtPublicacao" name="dtPublicacao" disabled required="required" class="form-control" type="text" value="<?php echo date('d', strtotime($rsLinha->DtPublicacao)) ;?> DE <?php echo retorna_mes_extenso(date('m', strtotime($rsLinha->DtPublicacao)));?> DE <?php echo date('Y', strtotime($rsLinha->DtPublicacao));?>">
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Ação</label>
                  <select class="form-control" required="required" id="acao" name="acao">
                    <option value="Aguardando">Apenas Salvar</option>
                    <option value="Publicado">Salvar e Publicar</option>
                  </select>
                </div>
              </div>





            </div>


          </div>


          <br>
          <button class="btn btn-success" type="submit">Salvar</button>
          <button class="btn btn-default"><i class="fa fa-close"></i> Clear</button>
        </form>
      </div>
    </div>


  </div>

  <div class="summary col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9">
    <div class="panel panel-default">
      <div class="grid-title no-border">
      <h4>Filtros</h4>

      </div>
      <div class="panel-body">

        <div class="panel-group" id="accordion1">
                                <?php
                                $Ano=$pdo->prepare("SELECT * FROM vw_diario_oficial WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' GROUP BY DATE_FORMAT(DtPublicacao, '%Y') ORDER BY DATE_FORMAT(DtPublicacao, '%Y') DESC");
                                $Ano->execute();

                                $lAno=$Ano->fetchAll(PDO::FETCH_OBJ);
                                $tAno = $Ano->rowCount();

                                foreach ($lAno as $vAno) {
                                    ?>
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <h4 class="panel-title">
                                              <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo date('Y', strtotime($vAno->DtPublicacao));?>" class="collapsed">
                                                  <?php echo date('Y', strtotime($vAno->DtPublicacao));?>
                                              </a>
                                          </h4><!-- /panel-title -->
                                      </div><!-- /panel-heading -->
                                      <div id="collapse<?php echo date('Y', strtotime($vAno->DtPublicacao));?>" class="panel-collapse collapse" style="height: 0px;">
                                          <div class="panel-body">
                                            <ul>
                                              <?php
                                              $Mes=$pdo->prepare("SELECT * FROM vw_diario_oficial WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND DATE_FORMAT(DtPublicacao, '%Y') = '".date('Y', strtotime($vAno->DtPublicacao))."' GROUP BY DATE_FORMAT(DtPublicacao, '%m') ORDER BY DATE_FORMAT(DtPublicacao, '%m') ASC");
                                              $Mes->execute();

                                              $lMes=$Mes->fetchAll(PDO::FETCH_OBJ);
                                              $tMes = $Mes->rowCount();

                                              foreach ($lMes as $vMes) {
                                                $total = strlen(date('m', strtotime($vMes->DtPublicacao)));



                                                if($total == 2){
                                                  $mesSel = date('m', strtotime($vMes->DtPublicacao));
                                                }else{
                                                  $mesSel = "0".date('m', strtotime($vMes->DtPublicacao));
                                                }
                                                  ?>
                                                  <li>
                                                    <a href="?p=diario_oficial&m=<?php echo $mesSel;?>&a=<?php echo date('Y', strtotime($vMes->DtPublicacao));?>"><?php echo retorna_mes_extenso(date('m', strtotime($vMes->DtPublicacao)));?></a>
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
