<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p>Servidores</p>
        </li>
        <li><a href="#" class="active">Passagens</a>
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
<div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3">
  <div class="panel panel-default">

    <div class="panel-body">
      <div class="row discovery">

          <?php

          $Ano=$pdo->prepare("SELECT * FROM passagens WHERE Acao = 'Publicado' GROUP BY DATE_FORMAT(DtViagem, '%Y') ORDER BY DATE_FORMAT(DtViagem, '%Y') DESC");
          $Ano->execute();

          $lAno=$Ano->fetchAll(PDO::FETCH_OBJ);
          $tAno = $Ano->rowCount();

          foreach ($lAno as $vAno) {

              ?>
              <div class="category">
                  <div class="title">
                      <h4 class="txt-passagens">Passagens de <strong><?php echo date('Y', strtotime($vAno->DtViagem));?></strong></h4>
                  </div>
                  <div class="col-sm-9 col-md-12">
                      <?php
                      $Mes=$pdo->prepare("SELECT * FROM passagens WHERE DATE_FORMAT(DtViagem, '%Y') = '".date('Y', strtotime($vAno->DtViagem))."' AND Acao = 'Publicado' GROUP BY DATE_FORMAT(DtViagem, '%m') ORDER BY DATE_FORMAT(DtViagem, '%m') DESC");
                      $Mes->execute();

                      $lMes=$Mes->fetchAll(PDO::FETCH_OBJ);
                      $tMes = $Mes->rowCount();

                      foreach ($lMes as $vMes) {

                          ?>
                          <div class="cards">
                              <div class="item">
                                  <a class="btn btn-primary btn-cons" href="passagens_ver.php?m=<?php echo date('m', strtotime($vMes->DtViagem));?>&a=<?php echo date('Y', strtotime($vMes->DtViagem));?>">
                                      <i class="fa fa-search fa-1x pull-left"></i>
                                      <?php echo retorna_mes_extenso(date('m', strtotime($vMes->DtViagem)));?></a>
                              </div>
                          </div>
                          <?php
                      }
                      ?>
                  </div>

              </div>
              <?php
          }
          ?>

      </div>
    </div>
  </div>
</div>

<div class="summary col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9">
  <div class="panel panel-default">
    <div class="grid-title no-border">
    <h4>Filtros</h4>

    </div>
    <div class="panel-body">
      ss
    </div>
  </div>
</div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
