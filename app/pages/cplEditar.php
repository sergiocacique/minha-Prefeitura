<?php
$CdCPL = $_GET['id'];
$t = $_GET['t'];

$Ultimo=$pdo->prepare("SELECT * FROM vw_cpl WHERE CdCPL = '".$CdCPL."'");
$Ultimo->execute();
$vUltimo=$Ultimo->fetch(PDO::FETCH_OBJ);
?>
<script src="../js/jquery.mask.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//cdn.ckeditor.com/4.7.0/basic/ckeditor.js"></script>
<script>
jQuery(function($){
  // JQUERY MASK INPUT
  console.log('aplicando mascara')
  $('[data-mask="date"]').mask('00/00/0000');
  $('[data-mask="time"]').mask('00:00:00');
  $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
  $('[data-mask="zip"]').mask('00000-000');
  $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
  $('[data-mask="phone"]').mask('0000-0000');
  $('[data-mask="phone_with_ddd"]').mask('(00) 0000-0000');
  $('[data-mask="phone_us"]').mask('(000) 000-0000');
  $('[data-mask="cpf"]').mask('000.000.000-00', {reverse: true});
  $('[data-mask="ip_address"]').mask('099.099.099.099');
  $('[data-mask="percent"]').mask('##0,00%', {reverse: true});
  // END JQUERY MASK INPUT
});

String.prototype.formatMoney = function() {
    var v = this;

    if(v.indexOf('.') === -1) {
        v = v.replace(/([\d]+)/, "$1,00");
    }

    v = v.replace(/([\d]+)\.([\d]{1})$/, "$1,$20");
    v = v.replace(/([\d]+)\.([\d]{2})$/, "$1,$2");

    return v;
};
function id( el ){
    return document.getElementById( el );
}
function getMoney( el ){
    var money = id( el ).value.replace( ',', '.' );
    return money ;
}

function soma()
{
//        console.log('Diarias antes = '+$('#valor_diaria2').val())
    var Diarias = $('#valor_diaria2').val()

    Diarias = Diarias.replace('.', '')
    Diarias = Diarias.replace(',', '.')

//        console.log('Diarias depois = '+Diarias)
    var Dias = $('#dias2').val()

    var total = Dias*Diarias;
    id('valor_bruto2').value = String(total).formatMoney();
    var valLiq = $('#valor_liquido2').val();
    valLiq = $('#valor_bruto2').val();
    id('valor_liquido2').value = String(valLiq)
    //console.log('Valor Liquido = '+String(total).formatMoney());

}


function subtrai()
{
//        console.log('Diarias antes = '+$('#valor_diaria2').val())
    var Liq = $('#valor_bruto2').val();
    var inss = $('#inss2').val();
    var irrf = $('#irrf2').val();

    console.log('Antes = '+Liq)

    Liq = Liq.replace('.', '')
    Liq = Liq.replace(',', '.')

    console.log('INSS Antes = '+inss)
    console.log('IRRF Antes = '+irrf)
    inss = inss.replace('.', '')
    inss = inss.replace(',', '.')

    irrf = irrf.replace('.', '')
    irrf = irrf.replace(',', '.')

    console.log('INSS Depois = '+inss)
    console.log('IRRF Depois = '+irrf)

    if(inss == ''){
        inss = 0;
    }

    if(irrf == ''){
        irrf = 0;
    }

    var total = parseFloat(inss)+parseFloat(irrf)
    console.log('Total = '+total)
    var total2 = Liq-total;
    console.log('Total2 = '+total2)

    console.log('Depois = '+Liq)

//        id('valor_liquido2').value = total2.toFixed(2);
    id('valor_liquido2').value = String(total2.toFixed(2)).formatMoney();
}





function soma1()
{
//        console.log('Diarias antes = '+$('#valor_diaria2').val())
    var Diarias = $('#valor_diaria').val()

    Diarias = Diarias.replace('.', '')
    Diarias = Diarias.replace(',', '.')

//        console.log('Diarias depois = '+Diarias)
    var Dias = $('#dias').val()

    var total = Dias*Diarias;
    id('valor_bruto').value = String(total).formatMoney();
    var valLiq = $('#valor_liquido').val();
    valLiq = $('#valor_bruto').val();
    id('valor_liquido').value = String(valLiq)
//        console.log('Valor Liquido = '+valLiq);

}


function subtrai1()
{
//        console.log('Diarias antes = '+$('#valor_diaria2').val())
    var Liq = $('#valor_bruto').val();
    var inss = $('#inss').val();
    var irrf = $('#irrf').val();

    console.log('Antes = '+Liq)

    Liq = Liq.replace('.', '')
    Liq = Liq.replace(',', '.')

    console.log('INSS Antes = '+inss)
    console.log('IRRF Antes = '+irrf)
    inss = inss.replace('.', '')
    inss = inss.replace(',', '.')

    irrf = irrf.replace('.', '')
    irrf = irrf.replace(',', '.')

    console.log('INSS Depois = '+inss)
    console.log('IRRF Depois = '+irrf)

    if(inss == ''){
        inss = 0;
    }

    if(irrf == ''){
        irrf = 0;
    }

    var total = parseFloat(inss)+parseFloat(irrf)
    console.log('Total = '+total)
    var total3 = Liq-total;
    console.log('Total = '+total3)

    console.log('Depois = '+Liq)

//        id('valor_liquido2').value = total2.toFixed(2);
    id('valor_liquido').value = String(total3.toFixed(2)).formatMoney();
}

function maskIt(w,e,m,r,a){
// Cancela se o evento for Backspace
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
// Variáveis da função
    var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
    var mask = (!r) ? m : m.reverse();
    var pre  = (a ) ? a.pre : "";
    var pos  = (a ) ? a.pos : "";
    var ret  = "";
    if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
// Loop na máscara para aplicar os caracteres
    for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
        if(mask.charAt(x)!='#'){
            ret += mask.charAt(x); x++; }
        else {
            ret += txt.charAt(y); y++; x++; } }
// Retorno da função
    ret = (!r) ? ret : ret.reverse()
    w.value = pre+ret+pos; }
// Novo método para o objeto 'String'
String.prototype.reverse = function(){
    return this.split('').reverse().join(''); };
function number_format( number, decimals, dec_point, thousands_sep ) {
    var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
    var d = dec_point == undefined ? "," : dec_point;
    var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
    var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
}
function mascaraData( campo, e )
{
	var kC = (document.all) ? event.keyCode : e.keyCode;
	var data = campo.value;

	if( kC!=8 && kC!=46 )
	{
		if( data.length==2 )
		{
			campo.value = data += '/';
		}
		else if( data.length==5 )
		{
			campo.value = data += '/';
		}
		else
			campo.value = data;
	}
}

</script>
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p><?php echo $vAdmin->Fantasia?></p>
        </li>
        <li>Transparência</li>
        <li>Processo: <?php echo $vUltimo->NumeroProcesso;?></li>
        <li><a href="#" class="active">CONTRATO E LICITAÇÃO</a>
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
    			<li<?php if($t == "basico"){?> class="active"<?php }?>>
    				<a href="#basico" data-toggle="tab">
    					Informações Básicas
    				</a>
    			</li>
    			<li<?php if($t == "empresa"){?> class="active"<?php }?>>
    				<a href="#empresa" data-toggle="tab">
    					Empresas
    				</a>
    			</li>
    			<li<?php if($t == "recursos"){?> class="active"<?php }?>>
    				<a href="#recursos" data-toggle="tab">
    					Recursos
    				</a>
    			</li>
          <li<?php if($t == "anexo"){?> class="active"<?php }?>>
    				<a href="#anexo" data-toggle="tab">
    					Anexos
    				</a>
    			</li>
          <li<?php if($t == "revisao"){?> class="active"<?php }?>>
    				<a href="#revisao" data-toggle="tab">
    					Revisão
    				</a>
    			</li>
    		</ul>
    	</div>

      <div class="col-md-9 col-sm-9 nopadding">
    		<div class="tab-content tab-stacked">
    			<div id="basico" class="tab-pane<?php if($t == "basico"){?> active<?php }?>">
    				<h4>Informações Básicas</h4>
            <form class="validate" action="acao/cplAlterar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="CdCPL" value="<?php echo $vUltimo->CdCPL;?>">
            <p>Informação Básica</p>
              <div class="form-group-attached">
                <div class="row clearfix">
                  <div class="col-sm-12">
                    <div class="form-group form-group-default">
                      <label>Orgão Participante</label>
                      <select class="form-control" id="orgao" name="orgao">
                          <?php
                          $Secretaria=$pdo->prepare("SELECT * FROM estrutura WHERE CdPrefeitura = '". $vAdmin->CdPrefeitura ."' ORDER BY Nome ASC");
                          $Secretaria->execute();
                          $lSecretaria=$Secretaria->fetchAll(PDO::FETCH_OBJ);

                          foreach ($lSecretaria as $vSecretaria) {
                              ?>
                              <option value="<?php echo $vSecretaria->CdEstrutura; ?>"<?php if($vUltimo->NumeroProcesso == $vSecretaria->CdEstrutura){?> selected<?php }?>><?php echo $vSecretaria->Nome; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                  </div>
                <div class="row">

                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Número do Processo</label>
                    <input required="required" id="numero_processo" name="numero_processo" class="form-control" type="text" placeholder="0001/<?php echo date('Y')?>" value="<?php echo $vUltimo->NumeroProcesso;?>">
                    </select>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group form-group-default input-group">
                    <span class="input-group-addon">R$</span>
                    <label>Valor do Contrato</label>
                    <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control usd" id="valor_licitacao" name="valor_licitacao" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###.###,##',true)" value="<?php echo number_format($vUltimo->valor_licitacao, 2, ',', '.');?>">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Situação</label>
                    <select class="form-control" required="required" id="situacao" name="situacao">
                        <?php
                        $Situacao=$pdo->prepare("SELECT * FROM cpl_situacao ORDER BY nome ASC");
                        $Situacao->execute();
                        $lSituacao=$Situacao->fetchAll(PDO::FETCH_OBJ);

                        foreach ($lSituacao as $vSituacao) {
                        ?>
                            <option value="<?php echo $vSituacao->id; ?>"<?php if($vUltimo->id_situacao == $vSituacao->id){?> selected<?php }?>><?php echo $vSituacao->nome; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>
              </div>
                <div class="row clearfix">
                  <div class="col-sm-4">
                    <div class="form-group form-group-default required" aria-required="true">
                      <label>Data da Abertura</label>
                      <input class="form-control" name="dtAbertura" type="text" maxlength="10" placeholder="00/00/0000" onkeyup="mascaraData( this, event )" value="<?php echo date('d/m/Y', strtotime($vUltimo->DtAbertura));?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Publicado em</label>
                      <input id="publicado" name="publicado" class="form-control" type="text" placeholder="DOM - Diário Oficial Municipal" value="<?php echo $vUltimo->Veiculo;?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Data da Publicação</label>
                      <input class="form-control" name="DtPublicacao" type="text" maxlength="10" placeholder="00/00/0000" onkeyup="mascaraData( this, event )" value="<?php echo date('d/m/Y', strtotime($vUltimo->DtPublicacao));?>">
                    </div>
                  </div>


                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group form-group-default required" aria-required="true">
                      <label>Número do DOC. de Publicação</label>
                      <input class="form-control" name="numeroDOM" aria-required="true" type="text" placeholder="DOM - 0001" value="<?php echo $vUltimo->numeroDOM;?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Data de Homologação</label>
                      <input class="form-control" name="DtHomologacao" type="text" maxlength="10" placeholder="00/00/0000" onkeyup="mascaraData( this, event )" value="<?php echo date('d/m/Y', strtotime($vUltimo->DtHomologacao));?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Número do DOM Homologação</label>
                      <input class="form-control" name="DomHomologacao" type="text" placeholder="DOM - 0001" value="<?php echo $vUltimo->DomHomologacao;?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group form-group-default">
                      <label>Objeto do Contrato</label>
                      <textarea class="form-control" name="objetivo" id="objetivo" placeholder="Digite aqui o objeto do contrato." aria-invalid="false"><?php echo $vUltimo->Descricao;?></textarea>
                      <script>
                          //CKEDITOR.replace( 'objetivo' );

                        // Turn off automatic editor creation first.
                        CKEDITOR.disableAutoInline = true;
                        CKEDITOR.inline( 'objetivo' );
                    </script>
                    </div>
                  </div>
                </div>
              </div>
              <br />
              <div class="form-group-attached">

                <div class="row clearfix">
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Finalidade</label>
                      <select class="form-control" required="required" id="finalidade" name="finalidade">
                          <?php
                          $Finalidade=$pdo->prepare("SELECT * FROM cpl_finalidade ORDER BY nome ASC");
                          $Finalidade->execute();
                          $lFinalidade=$Finalidade->fetchAll(PDO::FETCH_OBJ);

                          foreach ($lFinalidade as $vFinalidade) {
                          ?>
                              <option value="<?php echo $vFinalidade->id; ?>"<?php if($vUltimo->id_finalidade == $vFinalidade->id){?> selected<?php }?>><?php echo $vFinalidade->nome; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Modalidade</label>
                      <select class="form-control" required="required" id="modalidade" name="modalidade">
                          <?php
                          $Modalidade=$pdo->prepare("SELECT * FROM cpl_modalidade ORDER BY nome ASC");
                          $Modalidade->execute();
                          $lModalidade=$Modalidade->fetchAll(PDO::FETCH_OBJ);

                          foreach ($lModalidade as $vModalidade) {
                          ?>
                              <option value="<?php echo $vModalidade->id; ?>"<?php if($vUltimo->id_modalidade == $vModalidade->id){?> selected<?php }?>><?php echo $vModalidade->nome; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Tipo</label>
                      <select class="form-control" required="required" id="tipo" name="tipo">
                          <?php
                          $Tipo=$pdo->prepare("SELECT * FROM cpl_tipo ORDER BY nome ASC");
                          $Tipo->execute();
                          $lTipo=$Tipo->fetchAll(PDO::FETCH_OBJ);

                          foreach ($lTipo as $vTipo) {
                          ?>
                              <option value="<?php echo $vTipo->id; ?>"<?php if($vUltimo->id_tipo == $vTipo->id){?> selected<?php }?>><?php echo $vTipo->nome; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>



                </div>


              </div>


              <br>
              <button class="btn btn-success" type="submit">Salvar</button>
            </form>
    			</div>

    			<div id="empresa" class="tab-pane<?php if($t == "empresa"){?> active<?php }?>">
    				<h4>Empresas</h4>
              <form id="formulario_clientes" name="formulario_clientes" class="validate" action="acao/cplAddEmpresa.php" method="post">
                  <input type="hidden" name="CdCPL" value="<?php echo $vUltimo->CdCPL;?>">
              <div class="form-group-attached">
                <div class="row clearfix">
                  <div class="col-sm-8">
                    <div class="form-group form-group-default">
                      <label>Empresas Participantes</label>
                      <select class="form-control" id="idEmpresa" name="idEmpresa">
                          <?php
                          $Empresas=$pdo->prepare("SELECT * FROM empresas ORDER BY Nome ASC");
                          $Empresas->execute();
                          $lEmpresas=$Empresas->fetchAll(PDO::FETCH_OBJ);

                          foreach ($lEmpresas as $vEmpresas) {
                              ?>
                              <option value="<?php echo $vEmpresas->id; ?>" ><?php echo $vEmpresas->Nome; ?> - <?php echo $vEmpresas->CPFCNPJ; ?></option>
                              <?php
                          }
                          ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Situação</label>

                      <select class="form-control" id="situacao" name="situacao">
                          <option value="Ganhadora">Ganhadora</option>
                          <option value="Perdeu">Perdeu</option>
                          <option value="Desclassificada">Desclassificada</option>
                      </select>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-sm-10">
                    <div class="form-group form-group-default">
                      <label>Descrição</label>
                      <input id="Observacao" name="Observacao" class="form-control" required="required" type="text" placeholder="Observação">
                    </div>
                  </div>

                  <div class="col-sm-2">
                    <div class="form-group form-group-default">
                      <button type="submit" class="btn btn-3d btn-teal btn-block margin-top-30">
                          ADICIONAR EMPRESA
                      </button>
                    </div>
                  </div>
                </div>

              </div>

            </form>

            <?php
            $Empre=$pdo->prepare("SELECT * FROM cpl_empresa WHERE CdCPL = '". $vUltimo->CdCPL ."' ORDER BY Nome ASC");
            $Empre->execute();
            $lEmpre=$Empre->fetchAll(PDO::FETCH_OBJ);
            $tEmpre = $Empre->rowCount();

            if($tEmpre != 0){
            ?>

            <div>
              <table class="table">
                  <thead>
                  <tr>
                      <th></th>
                      <th>CNPJ / CPF</th>
                      <th>Nome</th>
                      <th>Ação</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($lEmpre as $vEmpre) { ?>
                      <tr>
                          <td><a class="btn btn-3d btn-reveal btn-red" href="acao/cplExcEmpresa.php?id=<?php echo $vEmpre->id; ?>&CdCPL=<?php echo $vEmpre->CdCPL; ?>&t=empresa">EXCLUIR</a></td>
                          <td><?php echo $vEmpre->CPFCNPJ; ?></td>
                          <td><?php echo $vEmpre->Nome; ?></td>
                          <td><?php echo $vEmpre->Situacao; ?></td>
                      </tr>
                      <?php
                  }
                  ?>
                  </tbody>
              </table>
            </div>
            <?php }?>
    			</div>

    			<div id="recursos" class="tab-pane<?php if($t == "recursos"){?> active<?php }?>">
    				<h4>Recursos</h4>

            <form id="formulario_clientes" name="formulario_clientes" class="validate" action="acao/cplAddRecursos.php" method="post">
                <input type="hidden" name="CdCPL" value="<?php echo $vUltimo->CdCPL;?>">
            <div class="form-group-attached">
              <div class="row clearfix">
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Recursos</label>
                    <select class="form-control" id="recurso" name="recurso">
                        <?php
                        $Recurso=$pdo->prepare("SELECT * FROM cpl_recurso ORDER BY nome ASC");
                        $Recurso->execute();
                        $lRecurso=$Recurso->fetchAll(PDO::FETCH_OBJ);

                        foreach ($lRecurso as $vRecurso) {
                            ?>
                            <option value="<?php echo $vRecurso->id; ?>" ><?php echo $vRecurso->nome; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10">
                  <div class="form-group form-group-default">
                    <label>Descrição</label>
                    <input id="descricao" name="descricao" class="form-control" required="required" type="text" placeholder="Observação">
                  </div>
                </div>

                <div class="col-sm-2">
                  <div class="form-group form-group-default">
                    <button type="submit" class="btn btn-3d btn-teal btn-block margin-top-30">
                        ADICIONAR RECURSO
                    </button>
                  </div>
                </div>
              </div>

            </div>

          </form>


            <?php
            $Recursos=$pdo->prepare("SELECT * FROM cpl_recursos WHERE CdCPL = '". $vUltimo->CdCPL ."'");
            $Recursos->execute();
            $lRecursos=$Recursos->fetchAll(PDO::FETCH_OBJ);
            $tRecursos = $Recursos->rowCount();

            if($tRecursos != 0){
            ?>
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Descrição</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($lRecursos as $vRecursos) {
                  $Rec=$pdo->prepare("SELECT * FROM cpl_recurso WHERE id = '".$vRecursos->CdRecurso."'");
                  $Rec->execute();
                  $vRec=$Rec->fetch(PDO::FETCH_OBJ);
                  ?>
                    <tr>
                        <td><a class="btn btn-3d btn-reveal btn-red" href="acao/cplExcRecurso.php?id=<?php echo $vRecursos->id; ?>&CdCPL=<?php echo $vRecursos->CdCPL; ?>&t=recursos">EXCLUIR</a></td>
                        <td><?php echo $vRec->nome; ?></td>
                        <td><?php echo $vRecursos->Descricao; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <?php }?>
    			</div>

          <div id="anexo" class="tab-pane<?php if($t == "anexo"){?> active<?php }?>">
    				<h4>Anexo</h4>
            <form id="formulario_clientes" name="formulario_clientes" class="validate" action="acao/cplAddAnexo.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="CdCPL" value="<?php echo $vUltimo->CdCPL;?>">
              <div class="form-group-attached">
                <div class="row clearfix">
                  <div class="col-sm-4">
                    <div class="form-group form-group-default">
                      <label>Tipo DOcumento</label>
                      <select class="form-control" id="Tipo" name="Tipo">
                          <option value="Edital">Edital</option>
                          <option value="Contrato na Integra">Contrato na Integra</option>
                          <option value="Extrato do Contrato">Extrato do Contrato</option>
                          <option value="Outro Documento">Outro Documento</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-8">
                    <div class="form-group form-group-default">
                      <label>Arquivo</label>
                      <input type="file" class="form-control" onchange="jQuery(this).next('input').val(this.value);" name="arquivo" id="arquivo" />
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <button class="btn btn-success" type="submit">Adicionar</button>
            </form>


            <?php
            $Arquivo=$pdo->prepare("SELECT * FROM arquivos WHERE Codigo = '". $vUltimo->CdCPL ."' AND Acao <> 'Excluido' ORDER BY Tipo ASC");
            $Arquivo->execute();
            $lArquivo=$Arquivo->fetchAll(PDO::FETCH_OBJ);
            $tArquivo = $Arquivo->rowCount();

            if($tArquivo != 0){
            ?>
            <table class="table table-striped">

                <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Data</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($lArquivo as $vArquivo) {

                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($verTempo->CdUsuario == $vArquivo->CdUsuario){
                                ?>
                                <a class="btn btn-3d btn-reveal btn-red" href="cplExcAnexo.php?id=<?php echo $vArquivo->id; ?>&CdCPL=<?php echo $vArquivo->Codigo; ?>">
                                    <i class="fa fa-times fa-1x pull-left"></i>
                                    EXCLUIR</a>
                            <?php }?>
                        </td>
                        <td><?php echo $vArquivo->Tipo; ?></td>
                        <td><?php echo $vArquivo->Arquivo; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($vArquivo->DtCadastro)); ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>


            <?php }?>
    			</div>

          <div id="revisao" class="tab-pane<?php if($t == "revisao"){?> active<?php }?>">
            <h4>Revisão Geral</h4>

            <?php
            $Atual=$pdo->prepare("SELECT * FROM cpl WHERE CdCPL = '".$CdCPL."'");
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
                         $Empresa=$gerenciador->prepare("SELECT * FROM cpl_empresa WHERE CdCPL = '".$rsLinha->CdCPL."' AND (Acao = 'Publicado')");
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
             </div>

             <form class="validate" action="acao/cplFinalizar.php" method="post" enctype="multipart/form-data">
             <input type="hidden" name="CdCPL" value="<?php echo $vUltimo->CdCPL;?>">
             <div class="form-group-attached">
               <div class="row clearfix">
                 <div class="col-sm-12">
                   <div class="form-group form-group-default">
                     <label>Ação</label>
                     <select class="form-control" id="acao" name="acao">
                         <option value="Publicado">Publicar Agora</option>
                         <option value="Arquivo">Guardar para Publicar depois</option>
                     </select>
                   </div>
                 </div>


               </div>
             </div>
             <br>
             <button class="btn btn-success" type="submit">Finalizar</button>
           </form>

          </div>

    		</div>
    	</div>
    </div>
</div>
