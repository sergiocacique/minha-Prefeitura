<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p>Gestão</p>
        </li>
        <li><a href="#" class="active">Prestação de Contas</a>
        </li>
      </ul>
      <!-- END BREADCRUMB -->
    </div>
  </div>
</div>
<!-- END JUMBOTRON -->
<!-- START CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg">
  <div class="row discovery">

      <?php

      $Caixa=$pdo->prepare("SELECT * FROM prestacao_conta WHERE  Acao = 'Publicado' GROUP BY Ano ORDER BY Ano DESC");
      $Caixa->execute();

      $lCaixa=$Caixa->fetchAll(PDO::FETCH_OBJ);
      $tCaixa = $Caixa->rowCount();

      if($tCaixa == 0) {
          ?>
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Prestação de Contas</h3>
              </div>

              <div class="panel-body">

                  <div class="col-sm-9 col-md-12">
                      <div class="category">
                          <div class="title">
                              <h4>VÁZIO</h4>
                              <small>não há registro.</small>
                          </div>

                      </div>
                  </div>

              </div>

          </div>
          <?php
      }else{
        foreach ($lCaixa as $ler) {

            ?>
              <div class="panel panel-default">
                  <div class="panel-body text-left">
                      <div class="category">
                          <div class="title">
                              <h4>Prestação de Contas de <strong><?php echo $ler->Ano;?></strong></h4>
                          </div>
                          <div class="col-sm-9 col-md-10">
                              <div id="category-folders-container" class="row">
                                  <ul id="category-folders" class="category-folders row">
                                      <?php
                                      $Mes=$pdo->prepare("SELECT * FROM prestacao_conta WHERE Ano = '".$ler->Ano."' AND  Acao = 'Publicado' GROUP BY CdEstrutura ORDER BY CdEstrutura DESC");
                                      $Mes->execute();

                                      $lMes=$Mes->fetchAll(PDO::FETCH_OBJ);
                                      $tMes = $Mes->rowCount();

                                      foreach ($lMes as $vMes) {

                                        $Estrutura=$pdo->prepare("SELECT * FROM estrutura WHERE CdEstrutura = '".$vMes->CdEstrutura."'");
                                        $Estrutura->execute();

                                        $lEstrutura=$Estrutura->fetch(PDO::FETCH_OBJ);

                                          ?>
                                            <a class="btn btn-success btn-cons" href="prestacao_conta_ver.php?setor=<?php echo $lEstrutura->CdEstrutura;?>&ano=<?php echo $vMes->Ano;?>"><?php echo $lEstrutura->Sigla;?></a>
                                          <?php
                                      }
                                      ?>
                                  </ul>
                              </div>              </div>

                      </div>
                  </div></div>
              <?php
          }
      }
      ?>

  </div>
</div>
<!-- END CONTAINER FLUID -->
