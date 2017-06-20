<?php
/**
 * Created by PhpStorm.
 * User: elidiane
 * Date: 24/11/14
 * Time: 09:34
 */
include ("conexao.php");
include ("funcao.php");
include ("seg.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gerenciador 4.0</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/side_panel.css">
    <link rel="stylesheet" href="css/morris.css">
    <link rel="stylesheet" href="css/charts-inline.min.css">
    <link rel="stylesheet" href="css/card.css">

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



<?php include ("topo.php");

$sqlLinha3 = mysql_query("SELECT * FROM adm_permissao WHERE CdUsuario = '".$verPerfil['CdUsuario']."'");
$rsLinha3 = mysql_fetch_array($sqlLinha3);

?>


<div id="" class="container">

    <div class="row discovery">

        <?php

            if ($verPerf['Acao'] == "Bloqueado") { ?>
                <div class="aviso">
                    <div class="callout callout-warning callout-left fade in">

                        <h4>CONTA BLOQUEADA</h4>
                        <p>Conta bloqueada por atraso de pagamento, as alterações feitas não serão aplicadas no GERENCIADOR.</p>
                    </div>
                </div>
            <?php }
        ?>
        <div class="col-sm-12 col-md-4 left-bar">

            <div class="col-sm-12 col-md-12">
                <div class="header">
                    <h1><strong>Olá</strong><br><?php echo $verPerfil['Nome'];?></h1>
                    <div class="tagline"> Bem vindo(a) ao Gerenciador. </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body text-left">

                        <div id="notices_boxhome" class="clearfix notices-boxhome widget">
                            <h3 class="message">Avisos</h3>
                            <div class="col-sm-12 col-md-12">
                                <?php

                                $pub = "SELECT * FROM chat WHERE id_para = '".$_SESSION['UsuarioID']."'";
                                $pub = $pub . " ORDER BY DtCadatro DESC LIMIT 3";


                                $sqlDiarias1 = mysql_query($pub);
                                $DiariasTotal1 = mysql_num_rows($sqlDiarias1);


                                $pub1 = "SELECT * FROM chat WHERE lido = 0 AND id_para = '".$_SESSION['UsuarioID']."'";
                                $pub1 = $pub1 . " ORDER BY DtCadatro DESC ";


                                $sqlDiarias11 = mysql_query($pub1);
                                $DiariasTotal11 = mysql_num_rows($sqlDiarias11);

                                ?>
                                <div class="right_block"  style="display: block;">
                                    <p class="count1">
                                        Você tem <b><?php echo $DiariasTotal11;?></b> avisos não lidos
                                    </p>
                                    <ul>
                                        <?php
                                        for ($y1 = 0; $y1 < $DiariasTotal1; $y1++){
                                            $verTotalDir1 = mysql_fetch_array($sqlDiarias1);

                                            if ($verTotalDir1['arquivo'] != ""){
                                                $anexo = "<i class='fa fa-paperclip'></i>";
                                            }else{
                                                $anexo = "";
                                            }
                                        ?>
                                        <li class="widget-status">
                                            <a class="" href="ver_avisos.php?id=<?php echo base64_encode($verTotalDir1['id']);?>"><?php echo $anexo;?> <?php echo $verTotalDir1['titulo'];?></a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                    <a class="red red-arrow" href="avisos.php">Ver todos os avisos</a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>

        </div>




              <div class="col-md-8">

                    <!-- Menu -->
                  <div class="col-sm-4">
                      <section class="cardCategory" style="background-color: #476266">
                          <a class="category-card-link"href="meusdados.php">
                              <div class="category-icon text-center">
                                  <i class="fa fa-address-card fa-2x font-branco"></i>
                              </div>
                              <h3 class="category-title">Meus Dados</h3>
                          </a>
                      </section>
                  </div>

                  <?php if ($verPerfil['esic'] == 'sim'){ ?>
              <div class="col-sm-4">
                    <section class="cardCategory" style="background-color: #A6495A">
                        <a class="category-card-link"<?php if ($verPerf['Acao'] == "Bloqueado") {?>href="javascript:void()"<?php }else{?>href="esic/"<?php }?>>
                            <div class="category-icon text-center">
                                <i class="fa fa-comments-o fa-2x font-branco"></i>
                            </div>
                            <h3 class="category-title">e-SIC</h3>
                             <p class="category-description">Acesso a informação</p>
                        </a>
                    </section>
                  </div>
                  <?php } ?>

                  <?php if ($verPerfil['transparencia'] == 'sim'){ ?>
                      <div class="col-sm-4">
                          <section class="cardCategory" style="background-color: #008b92">
                              <a class="category-card-link"<?php if ($verPerf['Acao'] == "Bloqueado") {?>href="javascript:void()"<?php }else{?>href="transparencia/"<?php }?>>
                                  <div class="category-icon text-center">
                                      <i class="fa fa-diamond fa-2x font-branco"></i>
                                  </div>
                                  <h3 class="category-title">Portal da Transparência</h3>
                                  <!-- <p class="category-description">Acesso a informação</p> -->
                              </a>
                          </section>
                      </div>
                  <?php } ?>
                  <?php if ($verPerfil['rh'] == 'sim'){ ?>
                    <div class="col-sm-4">
                          <section class="cardCategory" style="background-color: #0086f9">
                              <a class="category-card-link"<?php if ($verPerf['Acao'] == "Bloqueado") {?>href="javascript:void()"<?php }else{?>href="rh/"<?php }?>>
                                  <div class="category-icon text-center">
                                      <i class="fa fa-shield fa-2x font-branco"></i>
                                  </div>
                                  <h3 class="category-title">Recursos Humano</h3>
                                  <!-- <p class="category-description">Contra-Cheque, Servidores e etc...</p> -->
                              </a>
                          </section>
                        </div>
                  <?php } ?>
                  <?php if ($verPerfil['diario_oficial'] == 'sim'){ ?>
                    <div class="col-sm-4">
                          <section class="cardCategory" style="background-color: #006e9f">
                              <a class="category-card-link"<?php if ($verPerf['Acao'] == "Bloqueado") {?>href="javascript:void()"<?php }else{?>href="diario_oficial/"<?php }?>>
                                  <div class="category-icon text-center">
                                      <i class="fa fa-book fa-2x font-branco"></i>
                                  </div>
                                  <h3 class="category-title">Diário Oficial</h3>
                                  <!-- <p class="category-description">Acesso a informação</p> -->
                              </a>
                          </section>
                        </div>
                  <?php } ?>

                  <?php if ($verPerfil['portal'] == 'sim'){ ?>
                    <div class="col-sm-4">
                          <section class="cardCategory" style="background-color: #ef9d65">
                              <a class="category-card-link" href="portal/">
                                  <div class="category-icon text-center">
                                      <i class="fa fa-institution fa-2x font-branco"></i>
                                  </div>
                                  <h3 class="category-title">Portal Municipal</h3>
                                  <!-- <p class="category-description">Acesso a informação</p> -->
                              </a>
                          </section>
                        </div>
                  <?php } ?>

                  <?php if ($rsLinha3['usuario'] == 'sim'){ ?>
                    <div class="col-sm-4">
                          <section class="cardCategory" style="background-color: #A62F4C">
                              <a class="category-card-link" href="usuarios.php">
                                  <div class="category-icon text-center">
                                      <i class="fa fa-users fa-2x font-branco"></i>
                                  </div>
                                  <h3 class="category-title">Usuários</h3>
                                  <!-- <p class="category-description">Acesso a informação</p> -->
                              </a>
                          </section>
                        </div>
                  <?php } ?>

                  <?php if ($rsLinha3['administrador'] == 'sim'){ ?>
                      <div class="col-sm-4">
                          <section class="cardCategory" style="background-color: #241D20">
                              <a class="category-card-link" href="configuracao.php">
                                  <div class="category-icon text-center">
                                      <i class="fa fa-cogs fa-2x font-branco"></i>
                                  </div>
                                  <h3 class="category-title">Configuração</h3>
                                  <!-- <p class="category-description">Acesso a informação</p> -->
                              </a>
                          </section>
                      </div>
                  <?php } ?>


               </div>

              <!-- <div class="col-md-3">
                <div class="header">
                    <h1>e-SIC</h1>
                </div>
                  <div id="graph" class="graph"></div>
               </div> -->
            </div>
            <!-- e-SIC fim -->



    </div>
</div>

</body>
</html>
