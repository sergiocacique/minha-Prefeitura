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
<!-- END JUMBOTRON -->
<!-- START CONTAINER FLUID -->
<nav class="secondary-sidebar padding-30">
<p class="menu-title">CONTRATO E LICITAÇÃO</p>
  <ul class="sub-menu no-padding">
    <li class="active">
      <a href="#">
        <span class="title">Informação Básica</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span class="title">Empresas</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span class="title">Recursos</span>
      </a>
    </li>
    <li>
      <a href="#">
        <span class="title">Anexos</span>
      </a>
    </li>

  </ul>
</nav>
<div class="container-fluid container-fixed-lg">
  <!-- BEGIN PlACE PAGE CONTENT HERE -->



<div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3">
  <div class="container-fluid bg-white">
    <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-transparent">
        <div class="panel-body">
          <form class="validate" action="acao/cplAdicionar.php" method="post" enctype="multipart/form-data">
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
                            <option value="<?php echo $vSecretaria->CdEstrutura; ?>" ><?php echo $vSecretaria->Nome; ?></option>
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
                  <input required="required" id="numero_processo" name="numero_processo" class="form-control" type="text" placeholder="0001/<?php echo date('Y')?>">
                  </select>
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor do Contrato</label>
                  <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control usd" id="valor_licitacao" name="valor_licitacao" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###.###,##',true)">
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
                          <option value="<?php echo $vSituacao->id; ?>"><?php echo $vSituacao->nome; ?></option>
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
                    <input class="form-control" name="dtAbertura" type="text" maxlength="10" placeholder="00/00/0000" onkeyup="mascaraData( this, event )">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Publicado em</label>
                    <input id="publicado" name="publicado" class="form-control" type="text" placeholder="DOM - Diário Oficial Municipal">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Data da Publicação</label>
                    <input class="form-control" name="DtPublicacao" type="text" maxlength="10" placeholder="00/00/0000" onkeyup="mascaraData( this, event )">
                  </div>
                </div>


              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group form-group-default required" aria-required="true">
                    <label>Número do DOC. de Publicação</label>
                    <input class="form-control" name="numeroDOM" aria-required="true" type="text" placeholder="DOM - 0001">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Data de Homologação</label>
                    <input class="form-control" name="DtHomologacao" type="text" maxlength="10" placeholder="00/00/0000" onkeyup="mascaraData( this, event )">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group form-group-default">
                    <label>Número do DOM Homologação</label>
                    <input class="form-control" name="DomHomologacao" type="text" placeholder="DOM - 0001">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group form-group-default">
                    <label>Objeto do Contrato</label>
                    <textarea class="form-control" name="objetivo" id="objetivo" placeholder="Digite aqui o objeto do contrato." aria-invalid="false"></textarea>
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
                            <option value="<?php echo $vFinalidade->id; ?>"><?php echo $vFinalidade->nome; ?></option>
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
                            <option value="<?php echo $vModalidade->id; ?>"><?php echo $vModalidade->nome; ?></option>
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
                            <option value="<?php echo $vTipo->id; ?>"><?php echo $vTipo->nome; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                  </div>
                </div>



              </div>
              

            </div>


            <br>
            <button class="btn btn-success" type="submit">Adicionar</button>
            <button class="btn btn-default"><i class="fa fa-close"></i> Clear</button>
          </form>
        </div>
      </div>

      </div>
    </div>
  </div>
</div>


  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
