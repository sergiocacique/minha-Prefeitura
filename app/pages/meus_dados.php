<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <!-- <li>
          <p>Pages</p>
        </li> -->
        <li><a href="#" class="active">Meus Dados</a>
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
  <div class="panel panel-default">


                <div class="table-responsive">
                    <div class="panel-body  text-left">
                        <h4 class="text-muted text-left col-md-9">
                            <?php echo $rsPagina['Nome'];?>


                        </h4>
                        <?php
                        if ($rsPagina['Acao'] == 'Ativado'){
                            $color = "dirtygreen";
                        }else{
                            $color = "red";
                        }
                        ?>


                        <div class="col-md-12 ocultar">




                            <table class="table">

                                <tbody>
                                <tr>
                                    <td>Secretária</td>
                                    <td><?php echo $rsLinha4['Nome'];?></td>
                                </tr>
                                <tr>
                                    <td>Data de Nascimento</td>
                                    <td><?php
                                        if ($rsPagina['DtNascimento'] != "") {
                                            echo date('d/m/Y', strtotime($rsPagina['DtNascimento']));
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Matricula</td>
                                    <td><code><?php echo $rsPagina['Matricula'];?></td>
                                </tr>
                                <tr>
                                    <td>CPF</td>
                                    <td><?php echo $rsPagina['CPF'];?></td>
                                </tr>

                                </tbody>
                            </table>


                            <a class="btn btn-3d btn-green" href="javascript:void(0)" data-toggle="modal" title="Cadastrar Abastecimento" data-target="#modalCadastrar">

                                Dados de Acesso</a>



                            <a class="btn btn-3d btn-amber" href="javascript:void(0)" data-toggle="modal" title="Editar Perfil" data-target="#modalEditar">
                                EDITAR
                            </a>





                        </div>
                    </div>
                </div>
            </div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
