<script>

function vizualizar(id){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    $('#modalRecusar').modal('show');
    $("#conteudoModal").load('tarefa/folhaDetalhe.php?id=' + id);
}
function editar(id){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    $('#modalRecusar').modal('show');
    $("#conteudoModal").load('pages/folhaEditar.php?id=' + id);
}

</script>

<div class="modal fade fill-in in" id="modalRecusar" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalLargeLabel">FOLHA DE PAGAMENTO</h4>
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
        <li><a href="#" class="active">Minhas Tarefas</a></li>
        <li><?php echo $_GET['t'];?></li>
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
    <?php
    if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
        $UsuarioLog1 = " Acao IN('Aguardando','Pendente','Arquivo','Correcao','Cadastrando')";
    }else{
        $UsuarioLog1 = "CdUsuario = '".$verTempo->UsuarioID."' AND Acao IN('Pendente','Arquivo','Correcao','Cadastrando')";
    }

    if(isset($_GET['m']) && isset($_GET['a'])){
      $mesSeleciona = (int) $_GET['m'];
      $anoSeleciona = (int) $_GET['a'];


    }elseif(isset($_POST['m']) && isset($_POST['a'])){
      $mesSeleciona = (int) $_POST['m'];
      $anoSeleciona = (int) $_POST['a'];



    }else{
      $sql = "SELECT * FROM servidor WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND $UsuarioLog1 GROUP BY Mes, Ano ORDER BY Ano DESC";
    $Atual=$pdo->prepare($sql);
    $Atual->execute();
    $vAtual=$Atual->fetch(PDO::FETCH_OBJ);


    }


    $sql="SELECT * FROM servidor WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' AND $UsuarioLog1 GROUP BY Mes, Ano ORDER BY Ano DESC";
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
          <h4>Folha de Pagamento</strong></h4>
      </div>

      <div class="panel-body">
        <div class="row discovery">


          <div class="table-responsive">
            <table class="table table-full">
              <thead>
                <tr>
                  <th>Mês</th>

                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lCaixa as $ler) {?>
                <tr>
                  <td><?php echo retorna_mes_extenso($ler->Mes);?></td>
                  <!-- <td><?php //echo $ler->destino;?></td>
                  <td><?php //echo $ler->objetivo;?></td>
                  <td><?php //echo number_format($ler->valor_liquido, 2, ',', '.');?></td> -->
                  <td class="text-right">
                    <a href="javascript:void(0)" onclick="vizualizar(<?php echo $ler->Protocolo; ?>)" type="button" class="btn btn-round btn-primary" data-title="Visualizar" ><i class="fa fa-plus"></i></a>
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

  <div class="summary col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9"><?php include ('menu.php');?></div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
