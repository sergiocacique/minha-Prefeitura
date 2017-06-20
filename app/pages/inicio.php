<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p>Município</p>
        </li>
        <li><a href="#" class="active"><?php echo $vAdmin->RazaoSocial?></a>
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
<?php if($vAdmin->Acao == "Cancelado"){?>
  <div class="alert alert-danger margin-bottom-30"><!-- SUCCESS -->
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

	<h4>Conta <strong>Cancelada</strong></h4>

	<p>
		Conta cancelada. não é possível fazer alterações no GERENCIADOR.
	</p>

	<a href="#purchase" class="btn btn-info btn-sm margin-top-10">Reativar Conta</a>
	<!-- <a href="#" class="btn btn-default btn-sm margin-top-10">Cancel</a> -->
</div>

<?php }?>
<?php if($vAdmin->Acao == "Bloqueado"){?>
  <div class="alert alert-warning margin-bottom-30"><!-- SUCCESS -->
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

	<h4>Conta <strong>Bloqueada</strong></h4>

	<p>
		Conta bloqueada por atraso de pagamento, as alterações feitas não serão aplicadas no GERENCIADOR.
	</p>

	<a href="#purchase" class="btn btn-info btn-sm margin-top-10">Informar Pagamento</a>
	<a href="#" class="btn btn-default btn-sm margin-top-10">Cancelar</a>
</div>

<?php }?>

<?php if($vAdmin->Acao == "Aguardando"){?>
  <div class="alert alert-info margin-bottom-30"><!-- SUCCESS -->
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>

	<h4>Conta <strong>Pré-Configurada</strong></h4>

	<p>
		Conta Pré-Configurada para continuar usando o GERENCIADO configura sua conta.
	</p>

	<a href="#purchase" class="btn btn-info btn-sm margin-top-10">Configurar</a>
	<a href="#" class="btn btn-default btn-sm margin-top-10">Cancelar</a>
</div>

<?php }?>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
