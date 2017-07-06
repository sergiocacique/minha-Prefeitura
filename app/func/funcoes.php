<?php
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Boa_Vista');

$diahoje = date('d');
$meshoje = date('m');
$anohoje = date('Y');
$semanahoje = date('w');

// if (isset($_POST['ano']) and ($_POST['ano'] != ''))
// {
//     $SelAno = $_POST['ano'];
//     $SelAno = mysql_real_escape_string($SelAno);
// }else{
//     $SelAno = date('Y');
// }
//
// if (isset($_POST['mes']) and ($_POST['mes'] != ''))
// {
//     $SelMes = $_POST['mes'];
//     $SelMes = mysql_real_escape_string($SelMes);
// }else{
//     $SelMes = date('n');
// }
//
// $MesSelecionado = $SelMes;
// $AnoSeleciona = $SelAno;



// $mesSeguinte = ($MesSelecionado+1);
// $anoSeguinte = ($AnoSeleciona);
//
// if($mesSeguinte > 12){
//     $mesSeguinte = 1;
//     $anoSeguinte = ($AnoSeleciona+1);
// }
//
//
// $mesAnterior = ($MesSelecionado-1);
// $anoAnterior = ($AnoSeleciona);
//
// if($mesAnterior == 0){
//     $mesAnterior = 12;
//     $anoAnterior = ($AnoSeleciona-1);
// }
//
// $anoSeguinteRREO = ($AnoSeleciona+1);
// $anoAnteriorRREO = ($AnoSeleciona-1);

function retorna_mes($MES){
    switch ($MES) {
        case 1 : $MES='JAN'; break;
        case 2 : $MES='FEV';    break;
        case 3 : $MES='MAR';    break;
        case 4 : $MES='ABR';    break;
        case 5 : $MES='MAI';    break;
        case 6 : $MES='JUN';    break;
        case 7 : $MES='JUL';    break;
        case 8 : $MES='AGO';    break;
        case 9 : $MES='SET'; break;
        case 10 : $MES='OUT'; break;
        case 11 : $MES='NOV';    break;
        case 12 : $MES='DEZ'; break;
    }
    return $MES;
}

function retorna_mes_extenso($MES){
    switch ($MES) {
        case 1 : $MES='JANEIRO'; break;
        case 2 : $MES='FEVEREIRO';    break;
        case 3 : $MES='MARÇO';    break;
        case 4 : $MES='ABRIL';    break;
        case 5 : $MES='MAIO';    break;
        case 6 : $MES='JUNHO';    break;
        case 7 : $MES='JULHO';    break;
        case 8 : $MES='AGOSTO';    break;
        case 9 : $MES='SETEMBRO'; break;
        case 10 : $MES='OUTUBRO'; break;
        case 11 : $MES='NOVEMBRO';    break;
        case 12 : $MES='DEZEMBRO'; break;
    }
    return $MES;
}



function mask($val, $mask)
{
    $maskared = '';
    $k = 0;
    for($i = 0; $i<=strlen($mask)-1; $i++)
    {
        if($mask[$i] == '*')
        {
            $k++;
        }
        if($mask[$i] == '#')
        {
            if(isset($val[$k]))
                $maskared .= $val[$k++];
        }
        else
        {
            if(isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}


function moeda($get_valor) {
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor);
    return $valor;
}

function dump($objeto){
    echo "<pre>";
    var_dump($objeto);
    echo "</pre>";
}

function formatarData($data){
    $rData = implode("-", array_reverse(explode("/", trim($data))));
    return $rData;
}

function formatarData2($data){
    $rData = implode("/", array_reverse(explode("-", trim($data))));
    return $rData;
}

function removeAcentos($string, $slug = false) {
    $string = strtolower($string);

    // Código ASCII das vogais
    $ascii['a'] = range(224, 230);
    $ascii['e'] = range(232, 235);
    $ascii['i'] = range(236, 239);
    $ascii['o'] = array_merge(range(242, 246), array(240, 248));
    $ascii['u'] = range(249, 252);

    // Código ASCII dos outros caracteres
    $ascii['b'] = array(223);
    $ascii['c'] = array(231);
    $ascii['d'] = array(208);
    $ascii['n'] = array(241);
    $ascii['y'] = array(253, 255);

    foreach ($ascii as $key=>$item) {
        $acentos = '';
        foreach ($item AS $codigo) $acentos .= chr($codigo);
        $troca[$key] = '/['.$acentos.']/i';
    }

    $string = preg_replace(array_values($troca), array_keys($troca), $string);

    // Slug?
    if ($slug) {
        // Troca tudo que não for letra ou número por um caractere ($slug)
        $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
        // Tira os caracteres ($slug) repetidos
        $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
        $string = trim($string, $slug);
    }

    return $string;
}

function validar_cpf($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);
    // Valida tamanho
    if (strlen($cpf) != 11)
        return false;
    // Calcula e confere primeiro dígito verificador
    for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto))
        return false;
    // Calcula e confere segundo dígito verificador
    for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        $soma += $cpf{$i} * $j;
    $resto = $soma % 11;
    return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
}

// function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
// {
//   $lmin = 'abcdefghijklmnopqrstuvwxyz';
//   $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
//   $num = '1234567890';
//   $simb = '!@#$%*-';
//   $retorno = '';
//   $caracteres = '';
//   $caracteres .= $lmin;
//   if ($maiusculas) $caracteres .= $lmai;
//   if ($numeros) $caracteres .= $num;
//   if ($simbolos) $caracteres .= $simb;
//   $len = strlen($caracteres);
//   for ($n = 1; $n <= $tamanho; $n++) {
//   $rand = mt_rand(1, $len);
//   $retorno .= $caracteres[$rand-1];
// }
//   return $retorno;
// }

function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
  $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
  $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
  $nu = "0123456789"; // $nu contem os números
  $si = "!@#$%¨&*()_+="; // $si contem os símbolos

  if ($maiusculas){
        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($ma);
  }

    if ($minusculas){
        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($mi);
    }

    if ($numeros){
        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($nu);
    }

    if ($simbolos){
        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($si);
    }

    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
    return substr(str_shuffle($senha),0,$tamanho);
}
?>
