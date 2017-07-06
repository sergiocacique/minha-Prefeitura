<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p>Município</p>
        </li>
        <li><a href="#" class="active">Usuários</a>
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
  $sql = "SELECT * FROM vw_usuarios WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND Perfil  >= ".$verTempo->Perfil." ORDER BY Acao DESC, Nome ASC";
  $Usuarios=$pdo->prepare($sql);
  $Usuarios->execute();

  $lUsuarios=$Usuarios->fetchAll(PDO::FETCH_OBJ);
  $tUsuarios = $Usuarios->rowCount();

  foreach ($lUsuarios as $vUsuarios) {

  if($vUsuarios->Acao == "Publicado"){
      $TipoAcao = "unlock";
      $AcaoCor = "success";
  }else{
      $TipoAcao = "lock";
      $AcaoCor = "danger";
  }
  ?>
          <div class="col-md-4 text-center">

            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <div class="user-profile-pic">
                      <?php if($vUsuarios->foto != ""){
                        $img = "../dinamico/usuario/".$vUsuarios->foto;
                      }else{
                        $img = "../dinamico/brasao/".$vAdmin->Brasao;
                      }?>
                      <img class="imagem" alt="" src="<?php echo $img;?>">
                    </div>
                    <h4> <?php echo $vUsuarios->Nome;?><br /><span>último acesso:
                      <?php
                      if($vUsuarios->Horario != ""){
                        echo date('d/m/Y H:i:s', strtotime($vUsuarios->Horario));
                      }else{
                        echo "Nunca Entrou";
                      }
                      ?>
                    </span></h4><br>



                      <a href="?p=usuariosVer&id=<?php echo ($vUsuarios->CdUsuario);?>" class="btn btn-<?php echo $AcaoCor;?> font-branco">Acessar</a>
                      <?php if($vUsuarios->Acao == "Publicado"){?>
                      <a href="usuarioLogar.php?id=<?php echo ($vUsuarios->CdUsuario);?>" class="btn btn-info font-branco">Logar como <?php echo $vUsuarios->Usuario;?></a>
                      <?php }?>

                </div>
            </div>


          </div>
  <?php } ?>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
