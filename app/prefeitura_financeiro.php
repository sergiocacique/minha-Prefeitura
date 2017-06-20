<?php
/**
 * Created by PhpStorm.
 * User: elidiane
 * Date: 24/11/14
 * Time: 09:34
 */
include ("../conexao.php");
include ("funcao.php");
include ("seg.php");
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
    <link rel="stylesheet" href="css/table.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
    </script>
</head>
<body class="orders index">
<?php include ("topo1.php");?>

<?php

$idPrefeitura = $_GET['idPrefeitura'];
?>
  <section class="page-header page-header-xs">
    <div class="container">
      <h1>Servidores</h1>
      <ol class="breadcrumb">
        <li>
          <a href="index.php">Inicio</a>
        </li>
        <li class="active">Servidores</li>
      </ol>
    </div>
  </section>

  <div id="" class="container">
    <div class="row discovery">
        <div class="col-sm-9 col-md-10">
          <div class="header">

            <a class="btn btn-3d btn-reveal btn-purple" href="index.php">
              <i class="fa fa-home fa-1x pull-left"></i>
              INICIO
            </a>

            <a class="btn btn-3d btn-reveal btn-red" href="#">
              <i class="fa fa-plus-circle fa-1x pull-left"></i>
              ADICIONAR NOVA OBRA
            </a>

            <a class="btn btn-3d btn-reveal btn-green" href="index.php">
              <i class="fa fa-mail-reply fa-1x pull-left"></i>
              VOLTAR
            </a>

          </div>
        </div>
    </div>

    <div class="row discovery2">
      <div class="panel panel-default">
        <div class="panel-body">
          aqui vem o conteudo
        </div>
        </div>

  </div>


      <div class="row discovery2">

          <ul class="nav nav-tabs nav-top-border">
              <?php

              $pub = "SELECT * FROM prefeitura_contrato WHERE CdPrefeitura = '".$idPrefeitura."' ";
              $pub = $pub . " ORDER BY Vigencia DESC";

              $sqlDiarias1 = mysql_query($pub);
              $DiariasTotal1 = mysql_num_rows($sqlDiarias1);

              for ($y1 = 0; $y1 < $DiariasTotal1; $y1++){
              $verTotalDir1 = mysql_fetch_array($sqlDiarias1);

              if($verTotalDir1['Acao'] == "Pago"){
                  $CoraAcao = "verde";
              }else{
                  $CoraAcao = "vermelho";
              }
              ?>
              <li <?php if($y1 == 0){?>class="active"<?php }?>><a href="#contrato<?php echo $verTotalDir1['id']?>" data-toggle="tab"><?php echo $verTotalDir1['Vigencia'];?></a></li>
              <?php }?>


          </ul>

          <div class="panel panel-default tab-content">
              <?php

              $pub = "SELECT * FROM prefeitura_contrato WHERE CdPrefeitura = '".$idPrefeitura."' ";
              $pub = $pub . " ORDER BY Vigencia DESC";

              $sqlDiarias1 = mysql_query($pub);
              $DiariasTotal1 = mysql_num_rows($sqlDiarias1);

              for ($y1 = 0; $y1 < $DiariasTotal1; $y1++){
                  $verTotalDir1 = mysql_fetch_array($sqlDiarias1);

                  if($verTotalDir1['Acao'] == "Pago"){
                      $CoraAcao = "verde";
                  }else{
                      $CoraAcao = "vermelho";
                  }
                  ?>
              <div class="panel-body tab-pane fade in <?php if($y1 == 0){?>active<?php }?>" id="contrato<?php echo $verTotalDir1['id']?>">
                  <div class="transactions-bar">
                      <table class="transactions-table">
                          <tbody>
                          <?php

                          $pub1 = "SELECT * FROM prefeitura_financeiro WHERE CdPrefeitura = '".$idPrefeitura."' AND id_contrato = '".$verTotalDir1['id']."'";
                          $pub1 = $pub1 . " ORDER BY DtVencimento ASC";

                          $sqlDiarias11 = mysql_query($pub1);
                          $DiariasTotal11 = mysql_num_rows($sqlDiarias11);

                          for ($y11 = 0; $y11 < $DiariasTotal11; $y11++){
                              $verTotalDir11 = mysql_fetch_array($sqlDiarias11);

                              if($verTotalDir11['Acao'] == "Pago"){
                                  $CoraAcao = "verde";
                              }else{
                                  $CoraAcao = "vermelho";
                              }
                              ?>
                              <tr>
                                  <td class="type"><i class="fa fa-circle font-<?php echo $CoraAcao;?>"></i></td>
                                  <td class="vencimento"><?php echo date('d/m/Y', strtotime($verTotalDir11['DtVencimento']));?></td>
                                  <td class="description"><?php echo $verTotalDir11['Detalhe'];?></td>
                                  <td class="category"><?php echo $verTotalDir11['NumeroNota'];?></td>
                                  <td class="amount right ng-binding"><?php echo 'R$ '.number_format($verTotalDir11['Valor'], 2, ',', '.');?></td>
                                  <td class="situation"><i class="fa fa-thumbs-o-up fa-2x font-<?php echo $CoraAcao;?>"></i></td>
                                  <td class="actions">

                                      <div class="btn-group">
                                          <a href="#" class="btn dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span></a>
                                          <ul class="dropdown-menu">
                                              <li><a href="informativo_editar.php">Editar</a></li>
                                              <li class="divider"></li>
                                              <li><a href="informativo_acao.php">Excluir</a></li>
                                          </ul>
                                      </div>

                                  </td>
                              </tr>
                          <?php } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
              <?php }?>
          </div>

          <div class="panel panel-default">
              <div class="panel-body">





              </div>
          </div>
      </div>
<?php include ("rodape.php");?>
</body>
</html>



