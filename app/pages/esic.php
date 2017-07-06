<!-- START JUMBOTRON -->
<script>
function carregaAcao(acao){
    $('#loading3').css('visibility','visible');
    $.post("pages/esic_carrega.php", { acao: acao },
        function(data){
            $('#conteudo').html(data);
        }).done(function() {
        $('#loading3').css('visibility','hidden');
    });
}
</script>
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p><?php echo $vAdmin->RazaoSocial?></p>
        </li>
        <li><a href="#" class="active">e-SIC</a>
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

  <div class="col-sm-12 col-md-12">

      <div class="col-md-3">
          <div class="panel panel-default">
              <div class="panel-body">
                  <a class="ite nov" href="javascript:void(0)" onclick="carregaAcao(1)">
                      <span class="ico">
                          <i class="icon-i fa fa-file-o fa-2x"></i>
                      </span>
                      <?php
                          $Novo=$pdo->prepare("SELECT * FROM sic_ticket WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND  Acao = 'Aberto' ORDER BY DtCadastro DESC");
                          $Novo->execute();

                          $lNovo=$Novo->fetchAll(PDO::FETCH_OBJ);
                          $tNovo = $Novo->rowCount();
                      ?>
                      <span class="t"> <?php echo $tNovo;?></span>
                      <span class="d">Novos</span>
                  </a>
              </div>
          </div>
      </div>

      <div class="col-md-3">
          <div class="panel panel-default">
              <div class="panel-body">
                  <a class="ite atr" href="javascript:void(0)" onclick="carregaAcao(2)">
                      <span class="ico">
                          <i class="icon-i fa fa-clock-o fa-2x"></i>
                      </span>
                      <?php
                      $Atrasado=$pdo->prepare("SELECT * FROM sic_ticket WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND DtFinal <= CURRENT_DATE() AND (Acao = 'Aberto' OR Acao = 'Em Andamento') ORDER BY DtCadastro DESC");
                      $Atrasado->execute();

                      $lAtrasado=$Atrasado->fetchAll(PDO::FETCH_OBJ);
                      $tAtrasado = $Atrasado->rowCount();

                      ?>
                      <span class="t"> <?php echo $tAtrasado;?></span>
                      <span class="d">Atrasados</span>
                  </a>
              </div>
          </div>
      </div>

      <div class="col-md-3">
          <div class="panel panel-default">
              <div class="panel-body">
                  <a class="ite and" href="javascript:void(0)" onclick="carregaAcao(3)">
                      <span class="ico">
                          <i class="icon-i fa fa-refresh fa-2x"></i>
                      </span>
                      <?php
                      $Andamento=$pdo->prepare("SELECT * FROM sic_ticket WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND  Acao = 'Em Andamento' ORDER BY DtCadastro DESC");
                      $Andamento->execute();

                      $lAndamento=$Andamento->fetchAll(PDO::FETCH_OBJ);
                      $tAndamento = $Andamento->rowCount();
                      ?>
                      <span class="t"> <?php echo $tAndamento;?></span>
                      <span class="d">Em Andamento</span>
                  </a>
              </div>
          </div>
      </div>

      <div class="col-md-3">
          <div class="panel panel-default">
              <div class="panel-body">
                  <a class="ite fec" href="javascript:void(0)" onclick="carregaAcao(4)">
                      <span class="ico">
                          <i class="icon-i fa fa-check fa-2x"></i>
                      </span>
                      <?php
                      $Fechado=$pdo->prepare("SELECT * FROM sic_ticket WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND  Acao = 'Fechado' ORDER BY DtCadastro DESC");
                      $Fechado->execute();

                      $lFechado=$Fechado->fetchAll(PDO::FETCH_OBJ);
                      $tFechado = $Fechado->rowCount();
                      ?>
                      <span class="t"> <?php echo $tFechado;?></span>
                      <span class="d">Fechado</span>
                  </a>
              </div>
          </div>
      </div>

  </div>

  <div id="conteudo" class="col-sm-12 col-md-12">
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-comments-o fa-2x"></i> Chamados Pendentes</h3>
          </div>
          <div class="panel-body">
              <table class="table table-hover">
                  <thead>
                  <tr>
                      <th>Protocolo</th>
                      <th>Nome</th>
                      <th>Local</th>
                      <th>Data</th>
                      <th>Previsto</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php

                  $Chamados=$pdo->prepare("SELECT * FROM sic_ticket WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND  Acao = 'Aberto' ORDER BY DtCadastro DESC");
                  $Chamados->execute();

                  $lChamados=$Chamados->fetchAll(PDO::FETCH_OBJ);
                  $tChamados = $Chamados->rowCount();

                  foreach ($lChamados as $vChamados) {

                    $Usuarios=$pdo->prepare("SELECT * FROM sic_usuario WHERE id = '".$vChamados->CdUsuario."'");
                    $Usuarios->execute();

                    $lUsuarios=$Usuarios->fetch(PDO::FETCH_OBJ);
                    $tUsuarios = $Usuarios->rowCount();
                      ?>
                      <tr onclick="document.location = '?p=esic_ver&c=<?php echo $vChamados->id; ?>';" style="cursor:pointer">
                          <td><?php echo $vChamados->Protocolo; ?></td>
                          <td><?php echo $lUsuarios->Nome; ?></td>
                          <td><?php echo $vChamados->Orgao; ?></td>
                          <td><?php echo date('d/m/Y', strtotime($vChamados->DtCadastro)); ?></td>
                          <td><?php echo date('d/m/Y', strtotime($vChamados->DtFinal)); ?></td>
                      </tr>
                      <?php
                  }
                  ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
