<!-- START JUMBOTRON -->
<?php
$CdNoticia = (int) $_GET['c'];

$Chamado=$pdo->prepare("SELECT * FROM sic_ticket WHERE  id = '".$CdNoticia."'");
$Chamado->execute();

$lChamado=$Chamado->fetch(PDO::FETCH_OBJ);

$Usuario=$pdo->prepare("SELECT * FROM sic_usuario WHERE  id = '".$lChamado->CdUsuario."'");
$Usuario->execute();

$lUsuario=$Usuario->fetch(PDO::FETCH_OBJ);
 ?>

<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p><?php echo $vAdmin->RazaoSocial?></p>
        </li>
        <li>
          <p>e-sic</p>
        </li>
        <li><a href="#" class="active">chamado #<?php echo $lChamado->Protocolo;?></a>
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
      <?php if($lChamado->DtFinal <= date('Y-m-a') AND $lChamado->Acao != 'Fechado'){?>
      <div class="aviso">
          <div class="callout callout-danger callout-left fade in">

              <h4>ATRASADO</h4>
              <p>Este chamado esta com atrasado</p>
          </div>
      </div>
      <?php } ?>
    <div class="col-sm-9 col-md-4">

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="margin-bottom-30">
                    <h2 class="size-18 text-muted margin-bottom-6"><?php echo $lUsuario->Nome;?></h2>
                    <p>
                        Data: <strong><?php echo date('d/m/Y', strtotime($lChamado->DtCadastro));?></strong><br>
                        Previsto: <strong><?php echo date('d/m/Y', strtotime($lChamado->DtFinal));?></strong><br>
                        <br>
                        Status: <strong><?php echo $lChamado->Acao;?></strong>
                        <br><br>

                    <div class="btn-group">
                        <a href="#" class="btn btn-3d dropdown-toggle" data-toggle="dropdown">Ação <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../acao/esic_Status.php?chamado=<?php echo $lChamado->id; ?>&acao=aberto"><span class="ite fec ico"><i class="icon-i fa fa-check fa-2x"></i></span> Aberto</a></li>
                            <li><a href="../acao/esic_Status.php?chamado=<?php echo $lChamado->id; ?>&acao=em andamento"><span class="ite fec ico"><i class="icon-i fa fa-check fa-2x"></i></span> Em Andamento</a></li>
                            <li><a href="../acao/esic_Status.php?chamado=<?php echo $lChamado->id; ?>&acao=aguardando"><span class="ite fec ico"><i class="icon-i fa fa-check fa-2x"></i></span> Aguardando</a></li>
                            <li><a href="../acao/esic_Status.php?chamado=<?php echo $lChamado->id; ?>&acao=fechado"><span class="ite fec ico"><i class="icon-i fa fa-check fa-2x"></i></span> Fechado</a></li>
                        </ul>
                    </div>
  <!--                          --><?php //if($rsPagina['Acao'] == "Aberto"){?>
  <!--                              <a class="btn btn-3d btn-reveal btn-red" href="esic_status.php?chamado=--><?php //echo $rsPagina['id'];?><!--&acao=Fechado">-->
  <!--                                  <i class="fa fa-times fa-3x pull-left"></i>-->
  <!--                                  Fechar Chamado</a>-->
  <!--                          --><?php //}?>
                    </p>


                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="margin-bottom-30">
                    <p>
                        Tipo de Recebimento:<br /> <strong><?php echo $lChamado->Recebimento;?></strong><br>
                        Usar minha pergunta no FAQ:<br /> <strong><?php echo $lChamado->Autorizacao;?></strong><br>

                    </p>


                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="margin-bottom-30">
                    <p>
                        CPF: <strong><?php echo $lUsuario->CPF;?></strong><br>
                        Nascimento: <strong><?php echo date('d/m/Y', strtotime($lUsuario->DtNascimento));?></strong><br />
                        <br>
                        Telefone: <strong><?php echo $lUsuario->Telefone;?></strong><br>
                        E-mail: <strong><?php echo $lUsuario->Email;?></strong><br>
                        <br />
                        CEP: <strong><?php echo $lUsuario->CEP;?></strong><br />
                        Endereco: <strong><?php echo $lUsuario->Endereco;?></strong><br />
                        Bairro: <strong><?php echo $lUsuario->Bairro;?></strong><br />
                        Cidade: <strong><?php echo $lUsuario->Cidade;?></strong><br />
                        Estado: <strong><?php echo $lUsuario->Estado;?></strong><br />

                    </p>


                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">outros chamando de <?php echo $lUsuario->Nome;?></h3>
            </div>
            <div class="panel-body">
                <div class="margin-bottom-30">
                    <p>
                        <?php

                        $Chamados=$pdo->prepare("SELECT * FROM sic_ticket WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND CdUsuario = '".$lChamado->CdUsuario."' AND id <> '".$CdNoticia."' ORDER BY DtAtualizacao DESC");
                        $Chamados->execute();

                        $lChamados=$Chamados->fetchAll(PDO::FETCH_OBJ);
                        $tChamados = $Chamados->rowCount();

                        foreach ($lChamados as $vChamados) {
                            ?>
                            <a href="esic_ver.php?chamado=<?php echo $vChamados->id; ?>">
                                <strong><?php echo $vChamados->Protocolo; ?></strong> - <?php echo date('d/m/Y', strtotime($vChamados->DtCadastro));?><br>
                            </a>
                            <?php
                        }
                        ?>
                    </p>


                </div>
            </div>
        </div>










    </div>
    <div class="col-sm-9 col-md-8">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $lChamado->Protocolo;?></h3>
            </div>
            <div class="panel-body">
              <p>
                  <?php echo $lChamado->Assunto;?>
              </p>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">RESPOSTAS</h3>
            </div>
            <div class="panel-body">
                <div class="height-250 slimscroll">
                    <?php

                    $cmd = "select * from sic_ticket_resposta WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND idResposta = '".$lChamado->id."' ORDER BY DtAtualizacao ASC";

                    $Produtos=$pdo->prepare($cmd);
                    $Produtos->execute();

                    $lProdutos=$Produtos->fetchAll(PDO::FETCH_OBJ);
                    $tProdutos = $Produtos->rowCount();

                    foreach ($lProdutos as $vProdutos) {


                        if($vProdutos->CdUsuario != ""){
                          $Adm=$pdo->prepare("SELECT * FROM sic_usuario CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND WHERE id = '".$vProdutos->CdUsuario."'");
                          $Adm->execute();

                          $vAdm=$Adm->fetch(PDO::FETCH_OBJ);


                            $NomeUsuario = $vAdm->Nome;
                        }else{

                          $Adm=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$vProdutos->CdAdmin."'");
                          $Adm->execute();

                          $vAdm=$Adm->fetch(PDO::FETCH_OBJ);



                            $NomeUsuario = $vAdm->Nome;
                        }
                        ?>
                        <div class="clearfix margin-bottom-20">
                            <h4 class="size-15 nomargin nopadding bold"><?php echo $NomeUsuario;?></h4>
              <span class="size-13 text-muted">
              <?php echo $vProdutos->Assunto;?><br>
              <span class="text-success size-11"><?php echo date('d/m/Y', strtotime($vProdutos->DtCadastro));?></span>
              </span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php if($lChamado->Acao == "Aberto"){?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">RESPONDER O CHAMADO</h3>
            </div>
            <div class="panel-body">
                <form class="margin-top-20" action="../acao/esic_responder.php" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo $lChamado->id;?>">

                        <textarea name="editor1" id="editor1"></textarea>
                        <script>
                            CKEDITOR.replace( 'editor1' );
                        </script>
                        <div class="text-muted text-right margin-top-3 size-12 margin-bottom-10"><br></div>
                        <button class="btn btn-primary btn-3d" type="submit">
                            ENVIAR
                        </button>

                </form>
            </div>
        </div>
        <?php }?>







    </div>
  </div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
