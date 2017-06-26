<?php
$CdCPL = $_GET['id'];

$Ultimo=$pdo->prepare("SELECT * FROM vw_cpl WHERE CdCPL = '".$CdCPL."'");
$Ultimo->execute();
$vUltimo=$Ultimo->fetch(PDO::FETCH_OBJ);
?>
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p><?php echo $vAdmin->Fantasia?></p>
        </li>
        <li>Transparência</li>
        <li>CONTRATO E LICITAÇÃO</li>
        <li><a href="#" class="active">Empresas</a>
        </li>
      </ul>
      <!-- END BREADCRUMB -->
    </div>
  </div>
</div>
<div class="container-fluid container-fixed-lg">
  <div class="row">
    <div class="col-md-3 col-sm-3 nopadding">
    		<ul class="nav nav-tabs nav-stacked nav-alternate">
    			<li>
    				<a href="#tab_g" data-toggle="tab">
    					Informações Básicas
    				</a>
    			</li>
    			<li class="active">
    				<a href="#tab_h" data-toggle="tab">
    					Empresas
    				</a>
    			</li>
    			<li>
    				<a href="#tab_i" data-toggle="tab">
    					Recursos
    				</a>
    			</li>
          <li>
    				<a href="#tab_i" data-toggle="tab">
    					Anexos
    				</a>
    			</li>
    		</ul>
    	</div>

      <div class="col-md-9 col-sm-9 nopadding">
    		<div class="tab-content tab-stacked">
    			<div id="tab_g" class="tab-pane active">
    				<h4>Alternate Stacked 1</h4>
    				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    			</div>

    			<div id="tab_h" class="tab-pane">
    				<h4>Alternate Stacked 2</h4>
    				<p>Maecenas metus nulla, commodo a sodales sed, dignissim pretium nunc.</p>
    			</div>

    			<div id="tab_i" class="tab-pane">
    				<h4>Alternate Stacked 3</h4>
    				<p>Nam et lacus neque. Ut enim massa, sodales tempor convallis et, iaculis ac massa.</p>
    			</div>
    		</div>
    	</div>
    </div>
</div>
