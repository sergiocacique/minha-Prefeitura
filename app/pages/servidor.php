<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p><?php echo $vAdmin->RazaoSocial?></p>
        </li>
        <li>Recursos Humano</li>
        <li><a href="#" class="active">Servidores</a>
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
<?php
/* Constantes de configuração */
 define('QTDE_REGISTROS', 28);
 define('RANGE_PAGINAS', 1);

 if (isset($_POST['descricao']) and ($_POST['descricao'] != '')){
     $nunSIAFI = $_POST['descricao'];
     $nunSIAFI = mysql_real_escape_string($nunSIAFI);
 }elseif (isset($_GET['descricao']) and ($_GET['descricao'] != '')){
     $nunSIAFI = $_GET['descricao'];
     $nunSIAFI = mysql_real_escape_string($nunSIAFI);
 }

 /* Recebe o número da página via parâmetro na URL */
 $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

 /* Calcula a linha inicial da consulta */
 $linha_inicial = ($pagina_atual -1) * QTDE_REGISTROS;

 /* Instrução de consulta para paginação com MySQL */
 $sql = "SELECT * FROM funcionario WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."'";

 if (isset($nunSIAFI) AND $nunSIAFI  != ''){
     $nunSIAFI = str_replace(" ","%", $nunSIAFI);
     $sql =$sql . " AND (Nome LIKE '%".$nunSIAFI."%' OR Matricula LIKE '%".$nunSIAFI."%' OR CPF LIKE '%".$nunSIAFI."%')";
 }
 $sql = $sql . " GROUP BY CPF ORDER BY Nome ASC  LIMIT {$linha_inicial}, " . QTDE_REGISTROS;

 $stm = $pdo->prepare($sql);
 $stm->execute();
 $dados = $stm->fetchAll(PDO::FETCH_OBJ);

 /* Conta quantos registos existem na tabela */
 $sqlContador = "SELECT COUNT(*) AS total_registros FROM funcionario WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."'";
 if (isset($nunSIAFI) AND $nunSIAFI  != ''){
     $nunSIAFI = str_replace(" ","%", $nunSIAFI);
     $sqlContador =$sqlContador . " AND (Nome LIKE '%".$nunSIAFI."%' OR Matricula LIKE '%".$nunSIAFI."%' OR CPF LIKE '%".$nunSIAFI."%')";
 }

 $stm = $pdo->prepare($sqlContador);
 $stm->execute();
 $valor = $stm->fetch(PDO::FETCH_OBJ);

 /* Idêntifica a primeira página */
 $primeira_pagina = 1;

 /* Cálcula qual será a última página */
 $ultima_pagina  = ceil($valor->total_registros / QTDE_REGISTROS);

 /* Cálcula qual será a página anterior em relação a página atual em exibição */
 $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual -1 : 0 ;

 /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
 $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 0 ;

 /* Cálcula qual será a página inicial do nosso range */
 $range_inicial  = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1 ;

 /* Cálcula qual será a página final do nosso range */
 $range_final   = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina ;

 /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
 $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'btn btn-default' : 'esconder';

 /* Verifica se vai exibir o botão "Anterior" e "Último" */
 $exibir_botao_final = ($range_final > $pagina_atual) ? 'btn btn-default' : 'esconder';

 foreach($dados as $artigo){
  ?>
<div class="col-md-3 text-center">
  <div class="panel panel-default">
    <div class="panel-body text-center">
      <div>
        <a class="kit-avatar kit-avatar-128" href="?p=servidor_detalhe&servidor=<?php echo $artigo->id;?>">
        <?php if($artigo->Foto != ""){?>
            <img alt="" src="http://www.minhaprefeitura.com.br/dinamico/servidores/<?php echo $artigo->Foto;?>">
        <?php }else{?>
            <img alt="" src="http://www.minhaprefeitura.com.br/dinamico/servidores/semfoto.png">
        <?php }?>
      </a>
      </div>
      <h4> <?=$artigo->Nome?></h4><br>
      <a href="?p=servidor_detalhe&servidor=<?php echo $artigo->id;?>" class="btn btn-default font-branco">Acessar</a>
    </div>
  </div>
</div>
<?php } ?>

<div class='box-paginacao col-md-12 text-center'>
  <div class="panel panel-default">
    <div class="panel-body text-center">
       <a class='box-navegacao <?=$exibir_botao_inicio?>' href="?p=servidor&page=<?=$primeira_pagina?>" title="Primeira Página"><i class="fa fa-angle-double-left"></i></a>
       <a class='box-navegacao <?=$exibir_botao_inicio?>' href="?p=servidor&page=<?=$pagina_anterior?>" title="Página Anterior"><i class="fa fa-angle-left"></i></a>

      <?php
      /* Loop para montar a páginação central com os números */
      for ($i=$range_inicial; $i <= $range_final; $i++):
        $destaque = ($i == $pagina_atual) ? 'btn btn-success' : '' ;
        ?>
        <a class='box-numero <?=$destaque?>' href="?p=servidor&page=<?=$i?>"><?=$i?></a>
      <?php endfor; ?>

       <a class='box-navegacao <?=$exibir_botao_final?>' href="?p=servidor&page=<?=$proxima_pagina?>" title="Próxima Página"><i class="fa fa-angle-right"></i></a>
       <a class='box-navegacao <?=$exibir_botao_final?>' href="?p=servidor&page=<?=$ultima_pagina?>" title="Última Página"><i class="fa fa-angle-double-right"></i></a>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
</div></div>
<!-- END CONTAINER FLUID -->
