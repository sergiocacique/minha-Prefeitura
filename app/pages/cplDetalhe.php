<?php
include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM cpl WHERE CdCPL = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);

$Estrutura=$pdo->prepare("SELECT * FROM estrutura WHERE CdEstrutura = '".$rsLinha->Orgao."'");
$Estrutura->execute();
$vEstrutura=$Estrutura->fetch(PDO::FETCH_OBJ);

$Modalidade=$pdo->prepare("SELECT * FROM cpl_modalidade WHERE id = '".$rsLinha->Modalidade."'");
$Modalidade->execute();
$vModalidade=$Modalidade->fetch(PDO::FETCH_OBJ);

$Situacao=$pdo->prepare("SELECT * FROM cpl_situacao WHERE id = '".$rsLinha->Situacao."'");
$Situacao->execute();
$vSituacao=$Situacao->fetch(PDO::FETCH_OBJ);

?>
<div class="panel panel-default">
  <div class="panel-body  text-left">
      <h4 class="text-muted text-left col-md-9">
          <?php echo $rsLinha->NumeroProcesso;?><br><br>

      </h4>

      <div class="col-md-12 ocultar">
        <table class="table">

            <tbody>

            <tr>
                <td>Objeto</td>
                <td><?php echo $rsLinha->Descricao;?></td>
            </tr>
            <tr>
                <td>Valor Contrato</td>
                <td><?php echo 'R$ ' . number_format($rsLinha->valor_licitacao, 2, ',', '.');?></td>
            </tr>
            <tr>
                <td>Data de entrada</td>
                <td><?php
                    if($rsLinha->DtAbertura != "0000-00-00" && !is_null($rsLinha->DtAbertura)){
                echo date('d/m/Y', strtotime($rsLinha->DtAbertura));
              }?></td>

            </tr>
            <tr>
                <td>Unidade</td>
                <td><?php echo $vEstrutura->Nome;?></td>
            </tr>
            <tr>
                <td>Fonte</td>
                <td>
                    <?php

                    $Recursos=$pdo->prepare("SELECT * FROM cpl_recursos WHERE CdCPL = '".$rsLinha->CdCPL."'");
                    $Recursos->execute();
                    $lisRecursos=$Recursos->fetchAll(PDO::FETCH_OBJ);

                    foreach ($lisRecursos as $vRecursos){

                    $Recurso=$pdo->prepare("SELECT * FROM cpl_recurso WHERE id = '".$vRecursos->CdRecurso."'");
                    $Recurso->execute();
                    $vRecurso=$Recurso->fetch(PDO::FETCH_OBJ);
                        ?>
                        <code><?php echo $vRecurso->nome;?> <?php if ($vRecursos->Descricao != ""){ echo "  " .$vRecursos->Descricao; }?><br></code>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td>Modalidade</td>
                <td><?php echo $vModalidade->nome;?></td>
            </tr>

            <tr class="fundoTable">
                <td colspan="2">
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th colspan="2">Aviso de Abertura</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Data de Abertura</td>
                            <td><code><?php
                              if($rsLinha->DtAbertura != "0000-00-00" && !is_null($rsLinha->DtAbertura)){
                            echo date('d/m/Y', strtotime($rsLinha->DtAbertura));
                          }
                          ?></code></td>
                        </tr>
                        <tr>
                            <td>Data de Publicação</td>
                            <td><code><?php
                            if($rsLinha->DtPublicacao != "0000-00-00" && !is_null($rsLinha->DtPublicacao)){
                              echo date('d/m/Y', strtotime($rsLinha->DtPublicacao));
                            }?></code></td>
                        </tr>
                        <tr>
                            <td>Veículo de publicação (Ex. DOM)</td>
                            <td><code><?php echo $rsLinha->Veiculo;?></code></td>
                        </tr>
                        <tr>
                            <td>Número do DOM</td>
                            <td><code><?php echo $rsLinha->numeroDOM;?></code></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>Publicação Diário Oficial</td>
                <td><?php if($rsLinha->DtPublicacao != "0000-00-00" && !is_null($rsLinha->DtPublicacao)){
                  echo date('d/m/Y', strtotime($rsLinha->DtPublicacao));
                }?></td>
            </tr>
            <tr>
                <td>Número Diário</td>
                <td><?php echo $rsLinha->numeroDOM;?></td>
            </tr>
            <tr>
                <td>Situação</td>
                <td><?php echo $vSituacao->nome;?></td>
            </tr>
            <tr>
                <td>Valor</td>
                <td><?php echo 'R$' . number_format($rsLinha->valor_licitacao, 2, ',', '.');?></td>
            </tr>

            <tr class="fundoTable">
                <td colspan="2">
                  <?php
                  $Empresa=$pdo->prepare("SELECT * FROM cpl_empresa WHERE CdCPL = '".$rsLinha->CdCPL."' AND (Acao = 'Publicado')");
                  $Empresa->execute();
                  $lisEmpresa=$Empresa->fetchAll(PDO::FETCH_OBJ);
                  $tEmpresa = $Empresa->rowCount();

                  if($tEmpresa != 0){
                  ?>
                    <table class="table table-bordered table-striped">

                        <thead>
                        <tr>
                            <th colspan="2">EMPRESAS PARTICIPANTES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Nome</td>
                            <td>CPF / CNPJ</td>
                        </tr>
                        <?php
                        foreach ($lisEmpresa as $vEmpresa){


                            if ($vEmpresa->Situacao == "Ganhadora"){
                                $classSituacao = "success";
                                $classIcon = "fa-check";
                            }else{
                                $classSituacao = "warning";
                                $classIcon = "fa-times";
                            }
                            ?>
                            <tr>
                                <td><?php echo $vEmpresa->Nome;?></td>
                                <td><?php echo $vEmpresa->CPFCNPJ;?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?php }?>
                </td>
            </tr>

            </tbody>
        </table>
        <div class="panel-heading">
            <h3 class="panel-title">Anexos</h3>
        </div>
        <div class="help-block text-center">

          <?php
          $Anexo=$pdo->prepare("SELECT * FROM arquivos WHERE Codigo = '".$rsLinha->CdCPL."'");
          $Anexo->execute();
          $lisAnexo=$Anexo->fetchAll(PDO::FETCH_OBJ);
          $x=0;
          ?>
          <ul class="nav nav-tabs">
            <?php foreach ($lisAnexo as $vAnexo){
              $x++
              ?>
          	<li<?php if($x == 1){?> class="active"<?php }?>><a href="#<?php echo $x;?>" data-toggle="tab"><?php echo $vAnexo->Tipo;?></a></li>
            <?php }?>

          </ul>

          <?php
          $Anexo1=$pdo->prepare("SELECT * FROM arquivos WHERE Codigo = '".$rsLinha->CdCPL."'");
          $Anexo1->execute();
          $lisAnexo1=$Anexo1->fetchAll(PDO::FETCH_OBJ);
          $x1=0;
          ?>

          <div class="tab-content">
            <?php foreach ($lisAnexo1 as $vAnexo1){
              $x1++;
               ?>
        	<div class="tab-pane fade in active" id="<?php echo $x1;?>">
        		<p>
              <object type="application/pdf"  data="../dinamico/municipio/<?php echo $vAdmin->Pasta;?>/anexo/<?php echo $vAnexo1->Arquivo;?>"  width="100%" height="300" >
                <a class="btn btn-3d btn-reveal btn-purple" target="_blank" href="../dinamico/municipio/<?php echo $vAdmin->Pasta;?>/anexo/<?php echo $vAnexo1->Arquivo;?>">Ver PDF</a>
                </object>
            </p>
        	</div>
          <?php }?>

        </div>





          <div class="callout callout-success callout-left fade in">
              <small>cadastrado em: <?php echo date('d/m/Y h:m:s', strtotime($rsLinha->DtCadastro));?></small><br>
              <small>publicado em: <?php echo date('d/m/Y h:m:s', strtotime($rsLinha->DtAtualizacao));?></small><br />
              <small>cadastrado por: <?php echo $vPor->Nome;?></small>
          </div>




      </div>
  </div>
</div>
