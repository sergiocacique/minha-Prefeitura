<script>

function vizualizar(id){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    $('#modalRecusar').modal('show');
    $("#conteudoModal").load('pages/DiariaDetalhe.php?id=' + id);
}

function novo(id){

    //antes de abrir a janela, preciso carregar os dados do cliente e preencher os campos dentro do modal
    $('#modalRecusar').modal('show');
    $("#conteudoModal").load('pages/DiariaNovo.php');
}
jQuery('#modalRecusar').on('shown.bs.modal', function () {
  $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
})

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



//Validação
$(document).ready( function() {
    $("#formularioContato").validate({
        // Define as regras
        rules:{
            Destino:{
                // campoNome será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            },
            campoEmail:{
                // campoEmail será obrigatório (required) e precisará ser um e-mail válido (email)
                required: true, email: true
            },
            campoMensagem:{
                // campoMensagem será obrigatório (required) e terá tamanho mínimo (minLength)
                required: true, minlength: 2
            }
        },
        // Define as mensagens de erro para cada regra
        messages:{
            Destino:{
                required: "Digite o destino",
                minLength: "O seu nome deve conter, no mínimo, 2 caracteres"
            },
            campoEmail:{
                required: "Digite o seu e-mail para contato",
                email: "Digite um e-mail válido"
            },
            campoMensagem:{
                required: "Digite a sua mensagem",
                minLength: "A sua mensagem deve conter, no mínimo, 2 caracteres"
            }
        }
    });
});
$(function(){
    $('#modalCPF').modal('show');
});
</script>

<div class="modal fade fill-in in" id="modalRecusar" tabindex="-1" role="dialog" aria-labelledby="modalLargeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="modalLargeLabel">DIÁRIA</h4>
            </div>
            <div class="modal-body modal-lg col-md-12" id="conteudoModal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- START JUMBOTRON -->
<div class="jumbotron" data-pages="parallax">
  <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
    <div class="inner">
      <!-- START BREADCRUMB -->
      <ul class="breadcrumb">
        <li>
          <p>Servidores</p>
        </li>
        <li><a href="#" class="active">Diárias</a>
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

<div class="col-md-12 margin-botton-10">
  <a class="btn btn-3d btn-reveal btn-purple" href="index.php">
      <i class="fa fa-home fa-1x pull-left"></i>
      INICIO
  </a>

  <a class="btn btn-3d btn-reveal btn-red" href="javascript:void(0)" onclick="novo(0)">
      <i class="fa fa-plus-circle fa-1x pull-left"></i>
      ADICIONAR Diárias
  </a>

  <a class="btn btn-3d btn-reveal btn-green" href="index.php">
      <i class="fa fa-mail-reply fa-1x pull-left"></i>
      VOLTAR
  </a>

  <a class="btn btn-3d btn-reveal btn-aqua" href="caixa-de-tarefa.php">
      <i class="fa fa-inbox fa-1x pull-left"></i>
      CAIXA DE TAREFA
  </a>
</div>

<div class="col-md-9 col-sm-9 col-md-push-3 col-sm-push-3">
  <?php

  if(isset($_GET['m']) && isset($_GET['a'])){
    $mesSeleciona = (int) $_GET['m'];
    $anoSeleciona = (int) $_GET['a'];


  }elseif(isset($_POST['m']) && isset($_POST['a'])){
    $mesSeleciona = (int) $_POST['m'];
    $anoSeleciona = (int) $_POST['a'];



  }else{

  $Atual=$pdo->prepare("SELECT * FROM diarias WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND  Acao = 'Publicado' ORDER BY ano DESC, mes DESC");
  $Atual->execute();
  $vAtual=$Atual->fetch(PDO::FETCH_OBJ);
  $tAtual = $Atual->rowCount();

  if($tAtual !=0 ){
    $mesSeleciona = $vAtual->mes;
    $anoSeleciona = $vAtual->ano;
  }else{
    $mesSeleciona = date('Y');
    $anoSeleciona = date('m');
  }

}


$ContaMes = strlen($mesSeleciona);
if($ContaMes == 2){
  $mesSeleciona = $mesSeleciona;
}else{
  $mesSeleciona = "0".$mesSeleciona;
}

  $sql="SELECT * FROM diarias WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND  Acao = 'Publicado' AND mes = '".$mesSeleciona."' AND ano = '".$anoSeleciona."' ORDER BY mes DESC, ano DESC";
  $Caixa=$pdo->prepare($sql);
  $Caixa->execute();

  $lCaixa=$Caixa->fetchAll(PDO::FETCH_OBJ);
  $tCaixa = $Caixa->rowCount();

  if($tCaixa == 0) {
    ?>
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
    <?php }else{?>
  <div class="panel panel-default">
    <div class="grid-title no-border">
        <h4>Diárias de <strong><?php echo retorna_mes_extenso($mesSeleciona);?> <?php echo $anoSeleciona;?></strong></h4>
    </div>

    <div class="panel-body">
      <div class="row discovery">


        <div class="table-responsive">
          <table class="table table-full">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Destino</th>
                <th>Objetivo</th>
                <th>Valor</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($lCaixa as $ler) {?>
              <tr>
                <td><?php echo $ler->nome;?></td>
                <td><?php echo $ler->destino;?></td>
                <td><?php echo $ler->objetivo;?></td>
                <td><?php echo number_format($ler->valor_liquido, 2, ',', '.');?></td>
                <td class="text-right">
                  <a href="javascript:void(0)" onclick="vizualizar(<?php echo $ler->id; ?>)" type="button" class="btn btn-round btn-primary" data-title="Visualizar" ><i class="fa fa-plus"></i></a>
                </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
          </div>


      </div>
    </div>
  </div>
  <?php }?>
</div>

<div class="summary col-md-3 col-sm-3 col-md-pull-9 col-sm-pull-9">
  <div class="panel panel-default">
    <div class="grid-title no-border">
    <h4>Filtros</h4>

    </div>
    <div class="panel-body">

      <div class="panel-group" id="accordion1">
                              <?php
                              $Ano=$pdo->prepare("SELECT * FROM diarias WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND  Acao = 'Publicado' GROUP BY ano ORDER BY ano DESC");
                              $Ano->execute();

                              $lAno=$Ano->fetchAll(PDO::FETCH_OBJ);
                              $tAno = $Ano->rowCount();

                              foreach ($lAno as $vAno) {
                                  ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo $vAno->ano;?>" class="collapsed">
                                                <?php echo $vAno->ano;?>
                                            </a>
                                        </h4><!-- /panel-title -->
                                    </div><!-- /panel-heading -->
                                    <div id="collapse<?php echo $vAno->ano;?>" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
                                          <ul>
                                            <?php
                                            $Mes=$pdo->prepare("SELECT * FROM diarias WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND Acao = 'Publicado' AND ano = '".$vAno->ano."' GROUP BY mes ORDER BY mes ASC");
                                            $Mes->execute();

                                            $lMes=$Mes->fetchAll(PDO::FETCH_OBJ);
                                            $tMes = $Mes->rowCount();

                                            foreach ($lMes as $vMes) {
                                              $total = strlen($vMes->mes);

                                              if($total == 2){
                                                $mesSel = $vMes->mes;
                                              }else{
                                                $mesSel = "0".$vMes->mes;
                                              }
                                                ?>
                                                <li>
                                                  <a href="?p=diaria&m=<?php echo $mesSel;?>&a=<?php echo $vMes->ano;?>"><?php echo retorna_mes_extenso($vMes->mes);?></a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                          </ul>

                                        </div><!-- /panel-body -->
                                    </div><!-- /panel-collapse -->
                                </div><!-- /panel -->
                                <?php }?>
                            </div>


    </div>
  </div>
</div>
  <!-- END PLACE PAGE CONTENT HERE -->
</div>
<!-- END CONTAINER FLUID -->
