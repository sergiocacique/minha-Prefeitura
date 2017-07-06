<!-- START JUMBOTRON -->
<?php
$id = $_GET['servidor'];

$Atual=$pdo->prepare("SELECT * FROM funcionario WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);
?>
<script>
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
          <p><?php echo $vAdmin->RazaoSocial?></p>
        </li>
        <li>Recursos Humano</li>
        <li>Servidores</li>
        <li><a href="#" class="active"><?php echo $rsLinha->Nome?></a>
        </li>
      </ul>
      <!-- END BREADCRUMB -->
    </div>
  </div>
</div>
<!-- END JUMBOTRON -->
<!-- START CONTAINER FLUID -->
<div class="container-fluid container-fixed-lg">
  <div class="col-md-3 col-sm-3">
    <div class="panel panel-default">
        <div class="panel-body">

            <div class="col-sm-9 col-md-12">
                <div class="category">
                    <div class="title">
                        <h4>VÁZIO</h4>
                        <small>não há registro.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="col-md-9 col-sm-9">
    <ul class="nav nav-tabs">
    	<li class="active"><a href="#pessoais" data-toggle="tab">Dados Pessoais</a></li>
    	<li><a href="#documentacao" data-toggle="tab">Documentação</a></li>
      <li><a href="#endereco" data-toggle="tab">Endereço</a></li>
      <li><a href="#dependente" data-toggle="tab">Dependentes</a></li>

    </ul>

    <div class="tab-content">
    	<div class="tab-pane fade in active" id="pessoais">
        <form class="validate" action="acao/#" method="post" enctype="multipart/form-data">
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Nome</label>
                  <input required="required" id="numero_processo" name="numero_processo" class="form-control" type="text" value="<?php echo $rsLinha->Nome?>" placeholder="Nome Completo do Servidor">
                </div>
              </div>
              </div>
            <div class="row">

            <div class="col-sm-4">
              <div class="form-group form-group-default">
                <label>Matricula</label>
                <input required="required" id="numero_processo" name="numero_processo" class="form-control" type="text" value="<?php echo $rsLinha->Matricula?>" placeholder="Número da Matricula">
                </select>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-group form-group-default input-group">
                <label>Admissão</label>
                <input type="text" class="form-control usd" id="valor_licitacao" name="valor_licitacao" value="<?php echo $rsLinha->Admissao?>" placeholder="00/00/0000" onkeyup="mascaraData( this, event )">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group form-group-default">
                <label>Demissao</label>
                <input type="text" class="form-control usd" id="valor_licitacao" name="valor_licitacao" value="<?php echo $rsLinha->Demissao?>" placeholder="00/00/0000" onkeyup="mascaraData( this, event )">
              </div>
            </div>
          </div>
            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default" aria-required="true">
                  <label>Telefone</label>
                  <input class="form-control" name="dtAbertura" type="text" maxlength="10" value="<?php echo $rsLinha->Telefone;?>" placeholder="(00) 0000-0000">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Celular</label>
                  <input id="publicado" name="publicado" class="form-control" type="text" value="<?php echo $rsLinha->Celular;?>" placeholder="(00) 9 0000-0000">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Data de Nascimento</label>
                  <input class="form-control" name="DtPublicacao" type="text" maxlength="10" value="<?php echo date('d/m/Y', strtotime($rsLinha->DtNascimento));?>" placeholder="00/00/0000">
                </div>
              </div>


            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Email</label>
                  <input class="form-control" name="numeroDOM" aria-required="true" type="text" value="<?php echo $rsLinha->Email;?>" placeholder="email@provedor.com.br">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Naturalidade</label>
                  <input class="form-control" name="DtHomologacao" type="text" maxlength="10" value="<?php echo $rsLinha->Naturalidade;?>" placeholder="Cidade de nascimento">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Sexo</label>
                  <select class="form-control" required="required" id="situacao" name="situacao">

                          <option value="F"<?php if($rsLinha->Sexo == "F"){;?> selected<?php }?>>Feminino</option>
                          <option value="M"<?php if($rsLinha->Sexo == "M"){;?> selected<?php }?>>Masculino</option>

                  </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Estado Civil</label>
                  <select class="form-control" required="required" id="situacao" name="situacao">

                          <option value="F"<?php if($rsLinha->EstadoCivil == "Solteiro"){;?> selected<?php }?>>Solteiro(a)</option>
                          <option value="M"<?php if($rsLinha->EstadoCivil == "Casado"){;?> selected<?php }?>>Casado(a)</option>
                          <option value="M"<?php if($rsLinha->EstadoCivil == "Separado"){;?> selected<?php }?>>Separado(a)</option>
                          <option value="M"<?php if($rsLinha->EstadoCivil == "Viuvo"){;?> selected<?php }?>>Viuvo(a)</option>
                          <option value="M"<?php if($rsLinha->EstadoCivil == "Divorciado"){;?> selected<?php }?>>Divorciado(a)</option>
                          <option value="M"<?php if($rsLinha->EstadoCivil == "União Estável"){;?> selected<?php }?>>União Estável</option>

                  </select>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Mãe</label>
                  <input class="form-control" name="DtHomologacao" type="text" maxlength="10" value="<?php echo $rsLinha->Mae;?>" placeholder="Nome da Mãe">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group form-group-default">
                  <label>Pai</label>
                  <input class="form-control" name="DtHomologacao" type="text" maxlength="10" value="<?php echo $rsLinha->Pai;?>" placeholder="Nome do Pai">
                </div>
              </div>

            </div>
          </div>
          <br />


        </form>
    	</div>
    	<div class="tab-pane fade" id="documentacao">
    		<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
    	</div>
    	<div class="tab-pane fade" id="endereco">
    		<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold.</p>
    	</div>
    	<div class="tab-pane fade" id="dependente">
    		<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party.</p>
    	</div>
    </div>


  </div>
</div>
<!-- END CONTAINER FLUID -->
