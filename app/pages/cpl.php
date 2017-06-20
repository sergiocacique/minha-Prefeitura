<script>

function vizualizar(id){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    $('#modalRecusar').modal('show');
    $("#conteudoModal").load('pages/cplDetalhe.php?id=' + id);
}
function novo(id){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    $('#modalRecusar').modal('show');
    $("#conteudoModal").load('pages/cplNovo.php');
}

</script>

<div class="modal fade fill-in in" id="modalRecusar" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalLargeLabel">CONTRATOS E LICITAÇÕES</h4>
            </div>
            <div class="modal-body modal-lg col-md-12" id="conteudoModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p><?php echo $vAdmin->Fantasia?></p>
        </li>
        <li>Transparência</li>
        <li><a href="#" class="active">Contratos e Licitações</a>
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

    <a class="btn btn-3d btn-reveal btn-red" href="javascript:void(0)" onclick="novo(0)">
        <i class="fa fa-plus-circle fa-1x pull-left"></i>
        ADICIONAR Contratos e Licitações
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
  <?php

  if(isset($_GET['m']) && isset($_GET['a'])){
    $mesSeleciona = (int) $_GET['m'];
    $anoSeleciona = (int) $_GET['a'];


  }elseif(isset($_POST['m']) && isset($_POST['a'])){
    $mesSeleciona = (int) $_POST['m'];
    $anoSeleciona = (int) $_POST['a'];



  }else{

  $Atual=$pdo->prepare("SELECT * FROM cpl WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND Acao = 'Publicado' ORDER BY DATE_FORMAT(DtAbertura, '%Y') DESC, DATE_FORMAT(DtAbertura, '%m') DESC");
  $Atual->execute();
  $vAtual=$Atual->fetch(PDO::FETCH_OBJ);

  $mesSeleciona = date('m', strtotime($vAtual->DtAbertura));
  $anoSeleciona = date('Y', strtotime($vAtual->DtAbertura));
}


$ContaMes = strlen($mesSeleciona);
if($ContaMes == 2){
  $mesSeleciona = $mesSeleciona;
}else{
  $mesSeleciona = "0".$mesSeleciona;
}

  $sql="SELECT * FROM cpl WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND Acao = 'Publicado' AND DATE_FORMAT(DtAbertura, '%m') = '".$mesSeleciona."' AND DATE_FORMAT(DtAbertura, '%Y') = '".$anoSeleciona."' ORDER BY DATE_FORMAT(DtAbertura, '%m') DESC, DATE_FORMAT(DtAbertura, '%Y') DESC";
  $Caixa=$pdo->prepare($sql);
  $Caixa->execute();

  $lCaixa=$Caixa->fetchAll(PDO::FETCH_OBJ);
  $tCaixa = $Caixa->rowCount();

  if($tCaixa == 0) {
    ?>
    <div class="panel panel-default">
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
    <?php }else{?>
  <div class="panel panel-default">
    <div class="grid-title no-border">
        <h4>Contratos e Licitações de <strong><?php echo retorna_mes_extenso($mesSeleciona);?> <?php echo $anoSeleciona;?></strong></h4>
    </div>

    <div class="panel-body">
      <div class="row discovery">


        <div class="table-responsive">
          <table class="table table-full">
            <thead>
              <tr>
                <th>Categoria</th>
                <th>Nome</th>

                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lCaixa as $ler) {?>
              <tr>
                <td><?php echo $ler->NumeroProcesso;?></td>
                <td><?php echo $ler->Descricao;?></td>

                <td class="text-right">
                  <a href="javascript:void(0)" onclick="vizualizar(<?php echo $ler->CdCPL; ?>)" type="button" class="btn btn-round btn-primary" data-title="Visualizar" ><i class="fa fa-plus"></i></a>
                </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
          </div>


      </div>
    </div>
  </div>
  <?php }?>
</div>

<div class="summary col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9">
  <?php
  $Caixa=$pdo->prepare("SELECT * FROM cpl WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND Acao IN('Arquivo','Correcao','Cadastrando')");
  $Caixa->execute();

  $lCaixa=$Caixa->fetchAll(PDO::FETCH_OBJ);
  $tCaixa = $Caixa->rowCount();


  if($tCaixa != 0 ){
      ?>
<div class="panel panel-default">
  <div class="grid-title no-border">
  <h4>Caixa de Tarefa</h4>
  </div>
  <div class="panel-body">
  <p> você tem <strong><?php echo $tCaixa;?></strong> Contrato(s) e Licitação(ões) na sua caixa de tarefas <a href="p=minha_tarefa" class="alert-link">ir para caixa de tarefa</a>.</p>
</div>
</div>
<?php }?>
  <div class="panel panel-default">
    <div class="grid-title no-border">
    <h4>Filtros</h4>

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