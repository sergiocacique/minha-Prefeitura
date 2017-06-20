<?php
/**
 * Projeto: Portal da Transparência
 * Usuário: serginho
 * Data: 25/08/14
 * Hora: 09:18
 */

include ("../conexao.php");
include('func/funcoes.php');
$pdo=conectar();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Portal da Transparência | Prefeitura de Boa Vista</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN Vendor CSS-->
    <link href="css/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="css/estilo.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="css/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="css/select2.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- BEGIN Pages CSS-->
    <link href="css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="css/pages.css" rel="stylesheet" type="text/css" />
    <!--[if lte IE 9]>
        <link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="css/windows.chrome.fix.css" />'
    }
    </script>
  </head>
  <body class="fixed-header ">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar" data-pages="sidebar">
      <div id="appMenu" class="sidebar-overlay-slide from-top">
      </div>
      <!-- BEGIN SIDEBAR HEADER -->
      <div class="sidebar-header">
        <img src="imagens/logo_white.png" alt="logo" class="brand" data-src="imagens/logo_white.png" data-src-retina="imagens/logo_white_2x.png" width="45">
        <div class="sidebar-header-controls">
          <button data-pages-toggle="#appMenu" class="btn btn-xs sidebar-slide-toggle btn-link m-l-20" type="button"><i class="fa fa-angle-down fs-16"></i>
          </button>
          <button data-toggle-pin="sidebar" class="btn btn-link visible-lg-inline" type="button"><i class="fa fs-12"></i>
          </button>
        </div>
      </div>
      <!-- END SIDEBAR HEADER -->
      <?php include ("inc/menu.php");?>
    </div>
    <!-- END SIDEBAR -->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
      <!-- START PAGE HEADER WRAPPER -->
      <!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE CONTROLS -->
        <!-- LEFT SIDE -->
        <div class="pull-left full-height visible-sm visible-xs">
          <!-- START ACTION BAR -->
          <div class="sm-action-bar">
            <a href="#" class="btn-link toggle-sidebar" data-toggle="sidebar">
              <span class="icon-set menu-hambuger"></span>
            </a>
          </div>
          <!-- END ACTION BAR -->
        </div>
        <!-- RIGHT SIDE -->
        <div class="pull-right full-height visible-sm visible-xs">
          <!-- START ACTION BAR -->
          <div class="sm-action-bar">
            <a href="#" class="btn-link" data-toggle="quickview" data-toggle-element="#quickview">
              <span class="icon-set menu-hambuger-plus"></span>
            </a>
          </div>
          <!-- END ACTION BAR -->
        </div>
        <!-- END MOBILE CONTROLS -->
        <div class=" pull-left sm-table">
          <div class="header-inner">
            <div class="brand inline">
              <img src="imagens/logo.png" alt="logo" data-src="imagens/logo.png" data-src-retina="imagens/logo_2x.png" width="50">
            </div>

            <a href="#" class="search-link" data-toggle="search"><i class="fa fa-search"></i>o que você deseja <span class="bold">pesquisar</span></a>
          </div>
        </div>
        <?php include ("inc/usuario.php");?>
      </div>
      <!-- END HEADER -->
      <!-- END PAGE HEADER WRAPPER -->
            <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
          <?php
          // Verifica se a variável $_GET['pagina'] existe
          if (isset($_GET['p'])) {
              // Pega o valor da variável $_GET['pagina']
              $arquivo = "pages/".$_GET['p'].".php";
          } else {
              // Se não existir variável, define um valor padrão
              $arquivo = 'pages/inicio.php';
          }
          include ($arquivo); // Inclui o arquivo
          ?>
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START FOOTER -->
        <div class="container-fluid container-fixed-lg footer">
          <div class="copyright sm-text-center">
            <p class="small no-margin pull-left sm-pull-reset">
              <span class="hint-text">Copyright © 2017</span>
              <span class="font-montserrat">Prefeitura Municipal de Boa Vista</span>.
              <!-- <span class="hint-text">All rights reserved.</span>
              <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a>
                        </span> -->
            </p>
            <p class="small no-margin pull-right sm-pull-reset">
              Desenvolvido por:
              <span class="hint-text"><a href="#"> CCTI </a></span>
            </p>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- END FOOTER -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
          </div>
    <!-- END PAGE CONTAINER -->
    <!--START QUICKVIEW -->
    <div id="quickview" class="quickview-wrapper" data-pages="quickview">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs">
        <li class="">
          <a href="#quickview-notes" data-toggle="tab">Notes</a>
        </li>
        <li>
          <a href="#quickview-alerts" data-toggle="tab">Alerts</a>
        </li>
        <li class="active">
          <a href="#quickview-chat" data-toggle="tab">Chat</a>
        </li>
      </ul>
      <a class="btn-link quickview-toggle" data-toggle-element="#quickview" data-toggle="quickview"><i class="pg-close"></i></a>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- BEGIN Notes !-->
        <div class="tab-pane fade  in no-padding" id="quickview-notes">
          <div class="view-port clearfix quickview-notes" id="note-views">
            <!-- BEGIN Note List !-->
            <div class="view list" id="quick-note-list">
              <div class="toolbar clearfix">
                <ul class="pull-right ">
                  <li>
                    <a href="#" class="delete-note-link"><i class="fa fa-trash-o"></i></a>
                  </li>
                  <li>
                    <a href="#" class="new-note-link" data-navigate="view" data-view-port="#note-views" data-view-animation="push"><i class="fa fa-plus"></i></a>
                  </li>
                </ul>
                <button class="btn-remove-notes btn btn-xs btn-block" style="display:none"><i class="fa fa-times"></i> Delete</button>
              </div>
              <ul>
                <!-- BEGIN Note Item !-->
                <li data-noteid="1" data-navigate="view" data-view-port="#note-views" data-view-animation="push">
                  <div class="left">
                    <!-- BEGIN Note Action !-->
                    <div class="checkbox check-warning no-margin">
                      <input id="qncheckbox1" type="checkbox" value="1">
                      <label for="qncheckbox1"></label>
                    </div>
                    <!-- END Note Action !-->
                    <!-- BEGIN Note Preview Text !-->
                    <p class="note-preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
                    <!-- BEGIN Note Preview Text !-->
                  </div>
                  <!-- BEGIN Note Details !-->
                  <div class="right pull-right">
                    <!-- BEGIN Note Date !-->
                    <span class="date">12/12/14</span>
                    <a href="#"><i class="fa fa-chevron-right"></i></a>
                    <!-- END Note Date !-->
                  </div>
                  <!-- END Note Details !-->
                </li>
                <!-- END Note List !-->
              </ul>
            </div>
            <!-- END Note List !-->
            <div class="view note" id="quick-note">
              <div>
                <ul class="toolbar">
                  <li><a href="#" class="close-note-link" data-navigate="view" data-view-port="#note-views" data-view-animation="push"><i class="pg-arrow_left"></i></a>
                  </li>
                  <li><a href="#" class="Bold"><i class="fa fa-bold"></i></a>
                  </li>
                  <li><a href="#" class="Italic"><i class="fa fa-italic"></i></a>
                  </li>
                  <li><a href="#" class=""><i class="fa fa-link"></i></a>
                  </li>
                </ul>
                <div class="body">
                  <div>
                    <div class="top">
                      <span>21st april 2014 2:13am</span>
                    </div>
                    <div class="content">
                      <div class="quick-note-editor full-width full-height js-input" contenteditable="true"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- END Notes !-->
        <!-- BEGIN Alerts !-->
        <div class="tab-pane fade no-padding" id="quickview-alerts">
          <div class="view-port clearfix" id="alerts">
            <!-- BEGIN Alerts View !-->
            <div class="view bg-white">
              <!-- BEGIN View Header !-->
              <div class="navbar navbar-default navbar-sm">
                <div class="navbar-inner">
                  <!-- BEGIN Header Controler !-->
                  <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                    <i class="pg-more"></i>
                  </a>
                  <!-- END Header Controler !-->
                  <div class="view-heading">
                    Notications
                  </div>
                  <!-- BEGIN Header Controler !-->
                  <a href="#" class="inline action p-r-10 pull-right link text-master">
                    <i class="fa fa-search"></i>
                  </a>
                  <!-- END Header Controler !-->
                </div>
              </div>
              <!-- END View Header !-->
              <!-- BEGIN Alert List !-->
              <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                <!-- BEGIN List Group !-->
                <div class="list-view-group-container">
                  <!-- BEGIN List Group Header!-->
                  <div class="list-view-group-header text-uppercase">
                    Calendar
                  </div>
                  <!-- END List Group Header!-->
                  <ul>
                    <!-- BEGIN List Group Item!-->
                    <li class="alert-list">
                      <!-- BEGIN Alert Item Set Animation using data-view-animation !-->
                      <a href="javascript:;" class="" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                        <p class="col-xs-height col-middle">
                          <span class="text-warning fs-10"><i class="fa fa-circle"></i></span>
                        </p>
                        <p class="p-l-10 col-xs-height col-middle col-xs-9 overflow-ellipsis fs-12">
                          <span class="text-master">David Nester Birthday</span>
                        </p>
                        <p class="p-r-10 col-xs-height col-middle fs-12 text-right">
                          <span class="text-warning">Today <br></span>
                          <span class="text-master">All Day</span>
                        </p>
                      </a>
                      <!-- END Alert Item!-->
                      <!-- BEGIN List Group Item!-->
                    </li>
                    <!-- END List Group Item!-->
                  </ul>
                </div>
                <!-- END List Group !-->
              </div>
              <!-- END Alert List !-->
            </div>
            <!-- EEND Alerts View !-->
          </div>
        </div>
        <!-- END Alerts !-->
        <div class="tab-pane fade in active no-padding" id="quickview-chat">
          <div class="view-port clearfix" id="chat">
            <div class="view bg-white">
              <!-- BEGIN View Header !-->
              <div class="navbar navbar-default">
                <div class="navbar-inner">
                  <!-- BEGIN Header Controler !-->
                  <a href="javascript:;" class="inline action p-l-10 link text-master" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                    <i class="pg-plus"></i>
                  </a>
                  <!-- END Header Controler !-->
                  <div class="view-heading">
                    Chat List
                    <div class="fs-11">Show All</div>
                  </div>
                  <!-- BEGIN Header Controler !-->
                  <a href="#" class="inline action p-r-10 pull-right link text-master">
                    <i class="pg-more"></i>
                  </a>
                  <!-- END Header Controler !-->
                </div>
              </div>
              <!-- END View Header !-->
              <div data-init-list-view="ioslist" class="list-view boreded no-top-border">
                <div class="list-view-group-container">
                  <div class="list-view-group-header text-uppercase">
                    a</div>
                  <ul>
                    <!-- BEGIN Chat User List Item  !-->
                    <li class="chat-user-list clearfix">
                      <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view" class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="assets/img/profiles/1x.jpg" data-src="assets/img/profiles/1.jpg" src="assets/img/profiles/1x.jpg" class="col-top">
                        </span>
                        </span>
                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                          <span class="text-master">ava flores</span>
                          <span class="block text-master hint-text fs-12">Hello there</span>
                        </p>
                      </a>
                    </li>
                    <!-- END Chat User List Item  !-->
                  </ul>
                </div>
                <div class="list-view-group-container">
                  <div class="list-view-group-header text-uppercase">b</div>
                  <ul>
                    <!-- BEGIN Chat User List Item  !-->
                    <li class="chat-user-list clearfix">
                      <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view" class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="assets/img/profiles/2x.jpg" data-src="assets/img/profiles/2.jpg" src="assets/img/profiles/2x.jpg" class="col-top">
                        </span>
                        </span>
                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                          <span class="text-master">bella mccoy</span>
                          <span class="block text-master hint-text fs-12">Hello there</span>
                        </p>
                      </a>
                    </li>
                    <!-- END Chat User List Item  !-->
                    <!-- BEGIN Chat User List Item  !-->
                    <li class="chat-user-list clearfix">
                      <a data-view-animation="push-parrallax" data-view-port="#chat" data-navigate="view" class="" href="#">
                        <span class="col-xs-height col-middle">
                        <span class="thumbnail-wrapper d32 circular bg-success">
                            <img width="34" height="34" alt="" data-src-retina="assets/img/profiles/3x.jpg" data-src="assets/img/profiles/3.jpg" src="assets/img/profiles/3x.jpg" class="col-top">
                        </span>
                        </span>
                        <p class="p-l-10 col-xs-height col-middle col-xs-12">
                          <span class="text-master">bob stephens</span>
                          <span class="block text-master hint-text fs-12">Hello there</span>
                        </p>
                      </a>
                    </li>
                    <!-- END Chat User List Item  !-->
                  </ul>
                </div>
              </div>
            </div>
            <!-- BEGIN Conversation View  !-->
            <div class="view chat-view bg-white clearfix">
              <!-- BEGIN Header  !-->
              <div class="navbar navbar-default">
                <div class="navbar-inner">
                  <a href="javascript:;" class="link text-master inline action p-l-10" data-navigate="view" data-view-port="#chat" data-view-animation="push-parrallax">
                    <i class="pg-arrow_left"></i>
                  </a>
                  <div class="view-heading">
                    John Smith
                    <div class="fs-11 hint-text">Online</div>
                  </div>
                  <a href="#" class="link text-master inline action p-r-10 pull-right ">
                    <i class="pg-more"></i>
                  </a>
                </div>
              </div>
              <!-- END Header  !-->
              <!-- BEGIN Conversation  !-->
              <div class="chat-inner" id="my-conversation">
                <!-- BEGIN From Me Message  !-->
                <div class="message clearfix">
                  <div class="chat-bubble from-me">
                    Hello there
                  </div>
                </div>
                <!-- END From Me Message  !-->
                <!-- BEGIN From Them Message  !-->
                <div class="message clearfix">
                  <div class="profile-img-wrapper m-t-5 inline">
                    <img class="col-top" width="30" height="30" src="assets/img/profiles/avatar_small.jpg" alt="" data-src="assets/img/profiles/avatar_small.jpg" data-src-retina="assets/img/profiles/avatar_small2x.jpg">
                  </div>
                  <div class="chat-bubble from-them">
                    Hey
                  </div>
                </div>
                <!-- END From Them Message  !-->
                <!-- BEGIN From Me Message  !-->
                <div class="message clearfix">
                  <div class="chat-bubble from-me">
                    Did you check out Pages framework ?
                  </div>
                </div>
                <!-- END From Me Message  !-->
                <!-- BEGIN From Me Message  !-->
                <div class="message clearfix">
                  <div class="chat-bubble from-me">
                    Its an awesome chat
                  </div>
                </div>
                <!-- END From Me Message  !-->
                <!-- BEGIN From Them Message  !-->
                <div class="message clearfix">
                  <div class="profile-img-wrapper m-t-5 inline">
                    <img class="col-top" width="30" height="30" src="assets/img/profiles/avatar_small.jpg" alt="" data-src="assets/img/profiles/avatar_small.jpg" data-src-retina="assets/img/profiles/avatar_small2x.jpg">
                  </div>
                  <div class="chat-bubble from-them">
                    Yea
                  </div>
                </div>
                <!-- END From Them Message  !-->
              </div>
              <!-- BEGIN Conversation  !-->
              <!-- BEGIN Chat Input  !-->
              <div class="b-t b-grey bg-white clearfix p-l-10 p-r-10">
                <div class="row">
                  <div class="col-xs-1 p-t-15">
                    <a href="#" class="link text-master"><i class="fa fa-plus-circle"></i></a>
                  </div>
                  <div class="col-xs-8 no-padding">
                    <input type="text" class="form-control chat-input" data-chat-input="" data-chat-conversation="#my-conversation" placeholder="Say something">
                  </div>
                  <div class="col-xs-2 link text-master m-l-10 m-t-15 p-l-10 b-l b-grey col-top">
                    <a href="#" class="link text-master"><i class="pg-camera"></i></a>
                  </div>
                </div>
              </div>
              <!-- END Chat Input  !-->
            </div>
            <!-- END Conversation View  !-->
          </div>
        </div>
      </div>
    </div>
    <!-- END QUICKVIEW-->
    <!-- START OVERLAY -->
    <div class="overlay" style="display: none" data-pages="search">
      <!-- BEGIN Overlay Content !-->
      <div class="overlay-content has-results m-t-20">
        <!-- BEGIN Overlay Header !-->
        <div class="container-fluid">
          <!-- BEGIN Overlay Logo !-->
          <img class="overlay-brand" src="imagens/logo.png" alt="logo" data-src="imagens/logo.png" data-src-retina="imagens/logo_2x.png" width="78" height="22">
          <!-- END Overlay Logo !-->
          <!-- BEGIN Overlay Close !-->
          <a href="#" class="close-icon-light overlay-close text-black fs-16">
            <i class="fa fa-close"></i>
          </a>
          <!-- END Overlay Close !-->
        </div>
        <!-- END Overlay Header !-->
        <div class="container-fluid">
          <!-- BEGIN Overlay Controls !-->
          <input id="overlay-search" class="no-border overlay-search bg-transparent" placeholder="Pesquisa..." autocomplete="off" spellcheck="false">
          <br>
          <div class="inline-block">
            <div class="checkbox right">
              <input id="checkboxn" type="checkbox" value="1" checked="checked">
              <label for="checkboxn"><i class="fa fa-search"></i> Pesquisa todo o portal</label>
            </div>
          </div>
          <div class="inline-block m-l-10">
            <p class="fs-13">Pressione enter para pesquisar</p>
          </div>
          <!-- END Overlay Controls !-->
        </div>
        <!-- BEGIN Overlay Search Results, This part is for demo purpose, you can add anything you like !-->
        <div class="container-fluid">
          <span>
                <strong>Sugestão :</strong>
            </span>
          <span id="overlay-suggestions"></span>
          <br>
          <div class="search-results m-t-40">
            <p class="bold">Sugestão de Pesquisa</p>
            <div class="row">
              <div class="col-md-6">
                <!-- BEGIN Search Result Item !-->
                <div class="">
                  <!-- BEGIN Search Result Item Thumbnail !-->
                  <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                    <div>
                      <img width="50" height="50" src="assets/img/profiles/avatar.jpg" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" alt="">
                    </div>
                  </div>
                  <!-- END Search Result Item Thumbnail !-->
                  <div class="p-l-10 inline p-t-5">
                    <h5 class="m-b-5"><span class="semi-bold result-name">convênios</span></h5>
                  </div>
                </div>
                <!-- END Search Result Item !-->
                <!-- BEGIN Search Result Item !-->
                <div class="">
                  <!-- BEGIN Search Result Item Thumbnail !-->
                  <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                    <div>T</div>
                  </div>
                  <!-- END Search Result Item Thumbnail !-->
                  <div class="p-l-10 inline p-t-5">
                    <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> related topics</h5>
                    <p class="hint-text">via pages</p>
                  </div>
                </div>
                <!-- END Search Result Item !-->
                <!-- BEGIN Search Result Item !-->
                <div class="">
                  <!-- BEGIN Search Result Item Thumbnail !-->
                  <div class="thumbnail-wrapper d48 circular bg-success text-white inline m-t-10">
                    <div><i class="fa fa-headphones large-text "></i>
                    </div>
                  </div>
                  <!-- END Search Result Item Thumbnail !-->
                  <div class="p-l-10 inline p-t-5">
                    <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> music</h5>
                    <p class="hint-text">via pagesmix</p>
                  </div>
                </div>
                <!-- END Search Result Item !-->
              </div>
              <div class="col-md-6">
                <!-- BEGIN Search Result Item !-->
                <div class="">
                  <!-- BEGIN Search Result Item Thumbnail !-->
                  <div class="thumbnail-wrapper d48 circular bg-info text-white inline m-t-10">
                    <div><i class="fa fa-facebook large-text "></i>
                    </div>
                  </div>
                  <!-- END Search Result Item Thumbnail !-->
                  <div class="p-l-10 inline p-t-5">
                    <h5 class="m-b-5"><span class="semi-bold result-name">ice cream</span> on facebook</h5>
                    <p class="hint-text">via facebook</p>
                  </div>
                </div>
                <!-- END Search Result Item !-->
                <!-- BEGIN Search Result Item !-->
                <div class="">
                  <!-- BEGIN Search Result Item Thumbnail !-->
                  <div class="thumbnail-wrapper d48 circular bg-complete text-white inline m-t-10">
                    <div><i class="fa fa-twitter large-text "></i>
                    </div>
                  </div>
                  <!-- END Search Result Item Thumbnail !-->
                  <div class="p-l-10 inline p-t-5">
                    <h5 class="m-b-5">Tweats on<span class="semi-bold result-name"> ice cream</span></h5>
                    <p class="hint-text">via twitter</p>
                  </div>
                </div>
                <!-- END Search Result Item !-->
                <!-- BEGIN Search Result Item !-->
                <div class="">
                  <!-- BEGIN Search Result Item Thumbnail !-->
                  <div class="thumbnail-wrapper d48 circular text-white bg-danger inline m-t-10">
                    <div><i class="fa fa-google-plus large-text "></i>
                    </div>
                  </div>
                  <!-- END Search Result Item Thumbnail !-->
                  <div class="p-l-10 inline p-t-5">
                    <h5 class="m-b-5">Circles on<span class="semi-bold result-name"> ice cream</span></h5>
                    <p class="hint-text">via google plus</p>
                  </div>
                </div>
                <!-- END Search Result Item !-->
              </div>
            </div>
          </div>
        </div>
        <!-- END Overlay Search Results !-->
      </div>
      <!-- END Overlay Content !-->
    </div>
    <!-- END OVERLAY -->
    <!-- BEGIN VENDOR JS -->
    <script src="js/pace.min.js" type="text/javascript"></script>
    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <script src="js/modernizr.custom.js" type="text/javascript"></script>
    <script src="js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="js/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="js/jquery-bez/jquery.bez.min.js"></script>
    <script src="js/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.actual.min.js"></script>
    <script src="js/jquery.scrollbar.min.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="js/pages.js" type="text/javascript"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
  </body>
</html>
