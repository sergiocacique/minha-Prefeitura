<?php
/**
 * Created by PhpStorm.
 * User: elidiane
 * Date: 24/11/14
 * Time: 09:34
 */
 include ("../conexao.php");
 include('func/funcoes.php');
 include ("func/seg.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Boa Vista - Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/side_panel.css">
    <link rel="stylesheet" href="css/morris.css">
    <link rel="stylesheet" href="css/charts-inline.min.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="css/servidor.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script> <!-- Resource jQuery -->

    <script src="js/raphael.min.js"></script>
    <script src="js/morris.js"></script>
    <script src="js/jquery.easypiechart.min.js"></script>

    <script>



        function loadImages() {
            if (document.getElementById) {  // DOM3 = IE5, NS6
                document.getElementById('loading').style.visibility = 'hidden';
            }
            else {
                if (document.layers) {  // Netscape 4
                    document.hidepage.visibility = 'hidden';
                }
                else {  // IE 4
                    document.all.hidepage.style.visibility = 'hidden';
                }
            }
        }

        $(window).load(function() {
            // Animate loader off screen
            $("#loading2").delay(200).fadeOut("slow");
        });

        function listaChamado(acao){
            start();
            $('#loading2').css('visibility','visible');
            $.post("inicio_chamado.php", { acao: acao },
                function(data){
                    $('#conteudo').html(data);
                    $('html, body').animate({scrollTop:0}, 'slow');
                }).done(function() {
                    $('#loading2').css('visibility','hidden');
                });
        }

        function carregaDadosRecusarJSon(id){
            $.get('prefeituras_seleciona.php', {
                id: id
            }, function (data){
                $('#Acao').val(data.Acao);
                $('#id').val(data.id);//aqui eu seto a o input hidden com o id do cliente, para que a edição funcione. Em cada tela aberta, eu seto o id do cliente.
            }, 'json');
        }

        function prefeitura(id){

            //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
            carregaDadosRecusarJSon(id);

            $('#modalAcao').modal('show');
        }
    </script>
</head>
<body class="orders index">


<div id="" class="container">

    <div class="row discovery">

        <div class="col-sm-12 col-md-4 left-bar">

            <div class="col-sm-12 col-md-12">
                <div class="header">
                    <h1>Olá <?php //echo $verPerfil['Nome'];?>,</h1>
                    <div class="tagline"> Bem vindo(a) à sua conta. </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body text-left">

                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-8">

            <ul class="nav nav-tabs">
                <?php
                $Estado=$pdo->prepare("SELECT * FROM vw_prefeitura GROUP BY Estado ORDER BY Estado ASC");
                $Estado->execute();

                $lEstado=$Estado->fetchAll(PDO::FETCH_OBJ);
                $tEstado = $Estado->rowCount();
                $y1=0;

                foreach ($lEstado as $vEstado) {
                  $y1++
                ?>
                <li<?php if($y1 == 1){?> class="active"<?php }?>><a href="#<?php echo $vEstado->Estado;?>" data-toggle="tab"><?php echo $vEstado->Estado;?> - <?php echo $vEstado->nome;?></a></li>
                <?php }?>
            </ul>
            <div id="myTabContent" class="tab-content">
                <?php

                $Estados=$pdo->prepare("SELECT * FROM vw_prefeitura GROUP BY Estado ORDER BY Estado ASC");
                $Estados->execute();

                $lEstados=$Estados->fetchAll(PDO::FETCH_OBJ);
                $tEstados = $Estados->rowCount();
                  $y2 = 0;
                foreach ($lEstados as $vEstados) {
                  $y2++
                ?>
                <div class="tab-pane fade<?php if($y2 == 1){?> active in<?php }?>" id="<?php echo $vEstados->Estado;?>">
                    <?php
                    $Prefeitura=$pdo->prepare("SELECT * FROM vw_prefeitura WHERE Estado = '".$vEstados->Estado."' ORDER BY Fantasia ASC");
                    $Prefeitura->execute();

                    $lPrefeitura=$Prefeitura->fetchAll(PDO::FETCH_OBJ);
                    $tPrefeitura = $Prefeitura->rowCount();

                    foreach ($lPrefeitura as $vPrefeitura) {

                    if($vPrefeitura->Acao == "Publicado"){
                        $TipoAcao = "unlock";
                        $AcaoCor = "success";
                    }else{
                        $TipoAcao = "lock";
                        $AcaoCor = "danger";
                    }
                    ?>
                            <div class="col-md-3">
                                <div class="hexagon even">
                                    <div class="imagem <?php echo $TipoAcao;?>">
                                   <img alt="" src="../dinamico/brasao/<?php echo $vPrefeitura->Brasao;?>">
                                        </div>
                                    <p>

                                    <div class="btn-group">
                                        <a href="#" class="btn btn-<?php echo $AcaoCor;?> dropdown-toggle font-branco" data-toggle="dropdown"><?php echo $vPrefeitura->Fantasia;?> <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="prefeitura_logar.php?idPrefeitura=<?php echo ($vPrefeitura->CdPrefeitura);?>">Acessar</a></li>
                                            <li><a href="prefeitura_financeiro.php?idPrefeitura=<?php echo ($vPrefeitura->CdPrefeitura);?>">Financeiro</a></li>
                                            <li class="divider"></li>
                                            <?php if($vPrefeitura->Acao == "Publicado"){?>
                                            <li><a href="prefeitura_status.php?idPrefeitura=<?php echo ($vPrefeitura->CdPrefeitura);?>&acao=Bloqueado">Falta de Pagamento</a></li>
                                            <li><a href="prefeitura_status.php?idPrefeitura=<?php echo ($vPrefeitura->CdPrefeitura);?>&acao=Cancelar">Cancelar</a></li>
                                            <?php }else{?>
                                            <li><a href="prefeitura_status.php?idPrefeitura=<?php echo ($vPrefeitura->CdPrefeitura);?>&acao=Publicado">Liberar</a></li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                    </p>
                                </div>
                            </div>
                    <?php } ?>
                    <br clear="all">
                </div>
                <?php }?>
            </div>




            <?php
            $Prefeitura1=$pdo->prepare("SELECT * FROM vw_prefeitura GROUP BY Estado ORDER BY Estado ASC");
            $Prefeitura1->execute();

            $lPrefeitura1=$Prefeitura1->fetchAll(PDO::FETCH_OBJ);
            $tPrefeitura1 = $Prefeitura1->rowCount();

            foreach ($lPrefeitura1 as $vPrefeitura1) {

            ?>


                <?php
                $Prefeitura2=$pdo->prepare("SELECT * FROM vw_prefeitura WHERE Estado = '".$vPrefeitura1->Estado."' ORDER BY Fantasia ASC");
                $Prefeitura2->execute();

                $lPrefeitura2=$Prefeitura2->fetchAll(PDO::FETCH_OBJ);
                $tPrefeitura2 = $Prefeitura2->rowCount();

                foreach ($lPrefeitura2 as $vPrefeitura2) {


                    if($vPrefeitura2->Acao == "Publicado"){
                        $TipoAcao = "unlock";
                    }else{
                        $TipoAcao = "lock";
                    }
                    ?>



<!--                    <li>-->
<!--                        <a class="kit-avatar kit-avatar-128---><?php //echo $TipoAcao;?><!--" href="#">-->
<!--                            <img alt="" src="../dinamico/brasao/--><?php //echo $verPrefs['Brasao'];?><!--">-->
<!--                        </a>-->
<!--                        <div class="help-block btn-group btn-group-sm">-->
<!--                            <a class="btn btn-3d btn-default" href="prefeitura_logar.php?idPrefeitura=--><?php //echo ($verPrefs['CdPrefeitura']);?><!--" title="" rel="tooltip" data-original-title="view profile">-->
<!--                                <i class="fa fa-eye"></i>-->
<!--                            </a>-->
<!--                            <a class="btn btn-3d btn-default" href="prefeitura_financeiro.php?idPrefeitura=--><?php //echo ($verPrefs['CdPrefeitura']);?><!--" title="" rel="tooltip" data-original-title="add to contact">-->
<!--                                <i class="fa fa-usd"></i>-->
<!--                            </a>-->
<!--                            <a class="btn btn-3d btn-default" href="prefeitura_info.php?idPrefeitura=--><?php //echo ($verPrefs['CdPrefeitura']);?><!--" title="" rel="tooltip" data-original-title="add to contact">-->
<!--                                <i class="fa fa-info"></i>-->
<!--                            </a>-->
<!--                            <a class="btn btn-3d btn-default" href="prefeitura_info.php?idPrefeitura=--><?php //echo ($verPrefs['CdPrefeitura']);?><!--" title="" rel="tooltip" data-original-title="add to contact">-->
<!--                                <i class="fa fa-info"></i>-->
<!--                            </a>-->
<!--                            --><?php //if($verPrefs['Acao'] == "Publicado"){ ?>
<!--                                <a class="btn btn-3d btn-default" href="prefeitura_acao.php?idPrefeitura=--><?php //echo ($verPrefs['CdPrefeitura']);?><!--&acao=Bloqueia" title="" rel="tooltip" data-original-title="add to contact">-->
<!--                                    <i class="fa fa-unlock"></i>-->
<!--                                </a>-->
<!--                            --><?php //}else{?>
<!--                                <a class="btn btn-3d btn-default" href="prefeitura_acao.php?idPrefeitura=--><?php //echo ($verPrefs['CdPrefeitura']);?><!--&acao=Publicado" title="" rel="tooltip" data-original-title="add to contact">-->
<!--                                    <i class="fa fa-lock"></i>-->
<!--                                </a>-->
<!--                            --><?php //}?>
<!--                        </div>-->
<!--                        <p>-->
<!--                            <strong>--><?php //echo $verPrefs['Fantasia'];?><!--</strong>-->
<!--                        </p>-->
<!---->
<!--                    </li>-->

                <?php } ?>

            <?php } ?>


            <!-- e-SIC fim -->

</div>

</body>
</html>
