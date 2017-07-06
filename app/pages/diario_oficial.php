<script>

function vizualizar(id){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    $('#modalRecusar').modal('show');
    $("#conteudoModal").load('pages/diario_oficialDetalhe.php?id=' + id);
}

</script>

<div class="modal fade fill-in in" id="modalRecusar" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalLargeLabel">DIÁRIO OFICIAL</h4>
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

    <a class="btn btn-3d btn-reveal btn-red" href="?p=diario_novo" onclick="novo(0)">
        <i class="fa fa-plus-circle fa-1x pull-left"></i>
        ADICIONAR PUBLICAÇÃO
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
    <?php
    if(isset($_GET['m']) && isset($_GET['a'])){
      $mesSeleciona = (int) $_GET['m'];
      $anoSeleciona = (int) $_GET['a'];


    }elseif(isset($_POST['m']) && isset($_POST['a'])){
      $mesSeleciona = (int) $_POST['m'];
      $anoSeleciona = (int) $_POST['a'];



    }else{

    $Atual=$pdo->prepare("SELECT * FROM vw_diario_oficial WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' ORDER BY DATE_FORMAT(DtPublicacao, '%Y') DESC, DATE_FORMAT(DtPublicacao, '%m') DESC");
    $Atual->execute();
    $vAtual=$Atual->fetch(PDO::FETCH_OBJ);

    $diaSeleciona = date('d', strtotime($vAtual->DtPublicacao));
    $mesSeleciona = date('m', strtotime($vAtual->DtPublicacao));
    $anoSeleciona = date('Y', strtotime($vAtual->DtPublicacao));

    $ContaMes = strlen($mesSeleciona);
    if($ContaMes == 2){
      $mesSeleciona = $mesSeleciona;
    }else{
      $mesSeleciona = "0".$mesSeleciona;
    }

    $ContaDia = strlen($diaSeleciona);
    if($ContaDia == 2){
      $diaSeleciona = $diaSeleciona;
    }else{
      $diaSeleciona = "0".$diaSeleciona;
    }

  }

    $sql="SELECT * FROM vw_diario_oficial WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND DATE_FORMAT(DtPublicacao, '%d') = '".$diaSeleciona."' AND DATE_FORMAT(DtPublicacao, '%m') = '".$mesSeleciona."' AND DATE_FORMAT(DtPublicacao, '%Y') = '".$anoSeleciona."' ORDER BY DATE_FORMAT(DtPublicacao, '%d') DESC, DATE_FORMAT(DtPublicacao, '%m') DESC, DATE_FORMAT(DtPublicacao, '%Y') DESC ";
    $Caixa=$pdo->prepare($sql);
    $Caixa->execute();

    $lCaixa=$Caixa->fetchAll(PDO::FETCH_OBJ);
    $tCaixa = $Caixa->rowCount();

    if($tCaixa == 0) {
      ?>
    <div class="panel panel-default">
      <div class="panel-body">conteudo</div>
    </div>
    <?php }else{?>
    <div class="panel panel-default">
      <div class="grid-title no-border">
          <h4>Diário Oficial de <strong><?php echo retorna_mes_extenso($mesSeleciona);?> <?php echo $anoSeleciona;?></strong></h4>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
        	<table class="table table-hover">
        		<thead>
        			<tr>
                <th>Código Identificador</th>
        				<th>Categoria</th>
        				<th>Titulo</th>
        				<th>Ação</th>
        			</tr>
        		</thead>
        		<tbody>
              <?php foreach ($lCaixa as $ler) {

                if($ler->Acao == "Aguardando"){
                  $CorLabel = "warning";
                }elseif($ler->Acao == "Publicado"){
                  $CorLabel = "success";
                }
                ?>
        			<tr>
                <td><?php echo $ler->Codigo;?></td>
                <td><?php echo $ler->Nome;?></td>
        				<td><?php echo $ler->Titulo;?></td>
        				<td>
                  <span class="label label-<?php echo $CorLabel;?>"><?php echo $ler->Acao;?> </span>
                  <?php if ($ler->Acao == "Aguardando"){?>
                  <a href="?p=diario_oficialEditar&i=<?php echo $ler->id;?>" class="btn btn-default btn-xs"><i class="fa fa-edit white"></i> Editar </a>
                  <?php }else{ ?>
                  <a href="javascript:void(0)" onclick="vizualizar(<?php echo $ler->id; ?>)" class="btn btn-default btn-xs"><i class="fa fa-search white"></i> ver </a>
                  <?php }?>
                </td>
        			</tr>
            <?php }?>
        		</tbody>
        	</table>
        </div>
      </div>
    </div>
    <?php }?>
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
