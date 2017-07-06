<?php
$id = $_GET['id'];

$Atual=$pdo->prepare("SELECT * FROM ajuda_custo WHERE id = '".$id."'");
$Atual->execute();
$rsLinha=$Atual->fetch(PDO::FETCH_OBJ);

$Por=$pdo->prepare("SELECT * FROM admin WHERE CdUsuario = '".$rsLinha->CdUsuario."'");
$Por->execute();
$vPor=$Por->fetch(PDO::FETCH_OBJ);
?>
<script src="../js/jquery.mask.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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

</script>
<div class="container-fluid bg-white">
  <div class="row">
  <div class="col-sm-12">
    <div class="panel panel-transparent">
      <div class="panel-body">
        <form class="validate" action="acao/ajuda_custoSalvar.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $vUltimo->id;?>">
        <p>Informação Básica</p>
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="form-group form-group-default" aria-required="true">
                <label>Nome</label>
                  <input class="form-control" name="Nome" required="" aria-required="true"  type="text">
                </div>
              </div>
            <div class="row">

            <div class="col-sm-6">
              <div class="form-group form-group-default">
                <label>Mês</label>
                <select class="form-control" id="mes" name="mes">
                    <?php
                    for ($i = 1; $i <= 12; $i++){
                        ?>
                        <option value="<?=$i?>"<?php if($i == date('m')){?> selected="SELECT"<?php }?>><?=retorna_mes_extenso($i)?></option>
                    <?php }?>
                </select>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group form-group-default">
                <label>Ano</label>
                <select class="form-control" id="ano" name="ano">
                    <?php
                    for($ano=date('Y');$ano > date('Y')-10;$ano--){
                        ?>
                        <option value="<?=$ano?>"><?=$ano?></option>
                    <?php }?>
                </select>
              </div>
            </div>
          </div>
            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Destino</label>
                  <input class="form-control" name="Destino" aria-required="true" type="text" placeholder="">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Periodo</label>
                  <input  class="form-control" name="Periodo" type="text">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Cargo</label>
                  <input class="form-control" name="Cargo" type="text" placeholder="">
                </div>
              </div>


            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Secretária</label>
                  <select class="form-control" id="secretaria" name="secretaria">
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
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Objetivo da Viagem</label>
                  <textarea class="form-control" name="objetivo" id="objetivo" placeholder="" aria-invalid="false"></textarea>
                </div>
              </div>
            </div>
          </div>

          <p class="m-t-10">Informações Importante</p>
          <div class="form-group-attached">

            <div class="row clearfix">
              <div class="col-sm-4">
                <div class="form-group form-group-default">
                  <label>Total de Dias</label>
                  <input class="form-control" id="dias" name="dias" placeholder="Dias">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor da Diária</label>
                  <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control usd" id="valor_diaria" name="valor_diaria" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), soma1()">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor Bruto</label>
                  <input data-mask="money" class="form-control usd" id="valor_bruto" name="valor_bruto" placeholder="0,00">
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor INSS</label>
                  <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control usd" id="inss" name="inss" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), subtrai1()">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor IRRF</label>
                  <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control usd" id="irrf" name="irrf" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), subtrai1()">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group form-group-default input-group">
                  <span class="input-group-addon">R$</span>
                  <label>Valor Liquido</label>
                  <input data-mask="money" class="form-control usd" id="valor_liquido" name="valor_liquido" placeholder="0,00">
                </div>
              </div>

            </div>
          </div>
          <br />
          <div class="form-group-attached">
            <div class="row clearfix">
              <div class="col-sm-12">
                <div class="form-group form-group-default required" aria-required="true">
                  <label>Observação</label>
                  <textarea class="form-control" name="observacao" id="observacao" placeholder="" aria-invalid="false"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <?php if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){?>
                <div class="col-sm-12">
                  <div class="form-group form-group-default required" aria-required="true">
                    <label>Ação</label>
                    <select class="form-control" id="acao" name="acao">
                        <option value="Publicado">Publicar Agora</option>
                        <option value="Arquivo">Guardar para Publicar depois</option>
                    </select>
                  </div>
                </div>


              <?php }?>
            </div>
          </div>
          <br>

          <br>
          <button class="btn btn-success" type="submit">Adicionar</button>
          <button class="btn btn-default"><i class="fa fa-close"></i> Clear</button>
        </form>
      </div>
    </div>

    </div>
  </div>
</div>
