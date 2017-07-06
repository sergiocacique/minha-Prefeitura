<?php

include ("../../conexao.php");
include('../func/funcoes.php');
include ("../func/seg.php");

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();


// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID'])) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login.php"); exit;
}


if(!empty($_FILES['filename']['tmp_name'])){

  $Protocolo = "U".$verTempo->CdUsuario."P".date('Y').date('m').date('d');
  $arquivos = explode('.', $_FILES['filename']['name']);
  $extensao = strtolower($arquivos[count($arquivos) - 1]);

  if($extensao == "csv"){

    function csv2array($csv = array(),  $delimiter = ';'){
        return str_getcsv($csv, $delimiter);
    }

    function vinculo($key){
        $vinculado = array();
        $orgao = 0;

    }

    //------------

    //Transferir o arquivo


    if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
        echo "<div id='aviso'>Arquivo <strong>{$_FILES['filename']['name']}</strong> transferido com sucesso. </div>";
    }


    $data = date('Y-m-d H:i:s');


    $query = "INSERT INTO servidor(";
    $query = $query . " CdPrefeitura,";
    $query = $query . " Protocolo,";
    $query = $query . " CdUsuario,";
    $query = $query . " Nome,";
    $query = $query . " CPF,";
    $query = $query . " Orgao,";
    $query = $query . " Secretaria,";
    $query = $query . " Cargo,";
    $query = $query . " CargoComissao,";
    $query = $query . " RemuneracaoBasica,";
    $query = $query . " IRRF,";
    $query = $query . " INSS,";
    $query = $query . " DecimoAdto,";
    $query = $query . " DecimoFinal,";
    $query = $query . " DecimoINSS,";
    $query = $query . " DecimoIRRF,";
    $query = $query . " Ferias,";
    $query = $query . " Mes,";
    $query = $query . " Ano,";
    $query = $query . " DtCadastro,";
    $query = $query . " Acao";
    $query = $query . ") VALUES ";
    $saldo = 0;
    $saldo2 = 0;


    $csv = array_map('csv2array', file($_FILES['filename']['tmp_name']));
    //$csv = array_map('str_getcsv', file($_FILES['filename']['tmp_name']));

    //var_dump($csv);

    echo "<div id='mostrar_salva'>";
    foreach ($csv as $key => $dados) {
        if($key > 0){

    //            var_dump($csv);
    //            exit;

            $CdUsuario = $verTempo->CdUsuario;

            $Nome = addslashes(trim($dados[0]));
            $CPF = $dados[1];
            $Orgao = addslashes(trim($dados[2]));
            $Secretaria = addslashes(trim($dados[3]));
            $Cargo = addslashes(trim($dados[4]));
            $CargoComissao = addslashes(trim($dados[5]));
            $RemuneracaoBasica = moeda($dados[6]);
            $IRRF = moeda($dados[7]);
            $PSS = moeda($dados[8]);
            $DecimoAdto = moeda($dados[9]);
            $DecimoFinal = moeda($dados[10]);
            $DecimoPSS = moeda($dados[11]);
            $DecimoIRRF = moeda($dados[12]);
            $Ferias = moeda($dados[13]);
            $Mes = $dados[14];
            $Ano = $dados[15];
            $DtCadastro = $data;
            if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
              $Acao = addslashes(trim($_POST['acao']));
            }else{
              $Acao = 'Arquivo';
            }

            if ($Mes == "01"){
                $Mes = "1";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "02"){
                $Mes = "2";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "03"){
                $Mes = "3";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "04"){
                $Mes = "4";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "05"){
                $Mes = "5";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "06"){
                $Mes = "6";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "07"){
                $Mes = "7";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "08"){
                $Mes = "8";
            }else{
                $Mes = $Mes;
            }

            if ($Mes == "09"){
                $Mes = "9";
            }else{
                $Mes = $Mes;
            }


            if (strlen($CPF) == "11"){

                $CPF = $CPF;

            }elseif (strlen($CPF) == "10"){

                $CPF = "0".$CPF;

            }elseif (strlen($CPF) == "9"){

                $CPF = "00".$CPF;

            }elseif (strlen($CPF) == "8"){

                $CPF = "000".$CPF;
            }elseif (strlen($CPF) == "7"){

                $CPF = "0000".$CPF;
            }elseif (strlen($CPF) == "6"){

                $CPF = "00000".$CPF;
            }elseif (strlen($CPF) == "5"){

                $CPF = "000000".$CPF;
            }elseif (strlen($CPF) == "4"){

                $CPF = "0000000".$CPF;
            }elseif (strlen($CPF) == "3"){

                $CPF = "00000000".$CPF;
            }elseif (strlen($CPF) == "2"){
                $CPF = "000000000".$CPF;

            }elseif (strlen($CPF) == "1"){
                $CPF = "0000000000".$CPF;

            }
            $query = $query . ($key == 1? '': ',');
            $query = $query . " ('$vAdmin->CdPrefeitura',";
            $query = $query . " '$Protocolo',";
            $query = $query . " '$CdUsuario',";
            $query = $query . " '$Nome',";
            $query = $query . " '$CPF',";
            $query = $query . " '$Orgao',";
            $query = $query . " '$Secretaria',";
            $query = $query . " '$Cargo',";
            $query = $query . " '$CargoComissao',";
            $query = $query . " '$RemuneracaoBasica',";
            $query = $query . " '$IRRF',";
            $query = $query . " '$PSS',";
            $query = $query . " '$DecimoAdto',";
            $query = $query . " '$DecimoFinal',";
            $query = $query . " '$DecimoPSS',";
            $query = $query . " '$DecimoIRRF',";
            $query = $query . " '$Ferias',";
            $query = $query . " '$Mes',";
            $query = $query . " '$Ano',";
            $query = $query . " '$DtCadastro',";
            $query = $query . " '$Acao'";
            $query = $query . ") ";


        }

    }
    var_dump($query);
    $cadastro=$pdo->query($query);
    $cadastro->execute();

        echo "<div class='callout callout-success'>";
        echo "<h4>Folha de Pagamento cadastrada com sucesso!</h4>";
        echo "</div>";

  }elseif( $extensao == "xml"){

    $arquivo = new DomDocument();
		$arquivo->load($_FILES['arquivo']['tmp_name']);
    $linhas = $arquivo->getElementsByTagName("Row");

    $primeira_linha = true;

    $data = date('Y-m-d H:i:s');


    $query = "INSERT INTO servidor(";
    $query = $query . " CdPrefeitura,";
    $query = $query . " Protocolo,";
    $query = $query . " CdUsuario,";
    $query = $query . " Nome,";
    $query = $query . " CPF,";
    $query = $query . " Orgao,";
    $query = $query . " Secretaria,";
    $query = $query . " Cargo,";
    $query = $query . " CargoComissao,";
    $query = $query . " RemuneracaoBasica,";
    $query = $query . " IRRF,";
    $query = $query . " INSS,";
    $query = $query . " DecimoAdto,";
    $query = $query . " DecimoFinal,";
    $query = $query . " DecimoINSS,";
    $query = $query . " DecimoIRRF,";
    $query = $query . " Ferias,";
    $query = $query . " Mes,";
    $query = $query . " Ano,";
    $query = $query . " DtCadastro,";
    $query = $query . " Acao";
    $query = $query . ") VALUES ";
    $saldo = 0;
    $saldo2 = 0;

    foreach($linhas as $linha){
			if($primeira_linha == false){
				$nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
				$email = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
				$niveis_acesso_id = $linha->getElementsByTagName("Data")->item(2)->nodeValue;


        $CdUsuario = $verTempo->CdUsuario;

        $Nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
        $CPF = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
        $Orgao = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
        $Secretaria = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
        $Cargo = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
        $CargoComissao = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
        $RemuneracaoBasica = moeda($linha->getElementsByTagName("Data")->item(6)->nodeValue);
        $IRRF = moeda($linha->getElementsByTagName("Data")->item(7)->nodeValue);
        $PSS = moeda($linha->getElementsByTagName("Data")->item(8)->nodeValue);
        $DecimoAdto = moeda($linha->getElementsByTagName("Data")->item(9)->nodeValue);
        $DecimoFinal = moeda($linha->getElementsByTagName("Data")->item(10)->nodeValue);
        $DecimoPSS = moeda($linha->getElementsByTagName("Data")->item(11)->nodeValue);
        $DecimoIRRF = moeda($linha->getElementsByTagName("Data")->item(12)->nodeValue);
        $Ferias = moeda($linha->getElementsByTagName("Data")->item(13)->nodeValue);
        $Mes = $linha->getElementsByTagName("Data")->item(14)->nodeValue;
        $Ano = $linha->getElementsByTagName("Data")->item(15)->nodeValue;
        $DtCadastro = $data;
        if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
          $Acao = addslashes(trim($_POST['acao']));
        }else{
          $Acao = 'Arquivo';
        }

        if ($Mes == "01"){
            $Mes = "1";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "02"){
            $Mes = "2";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "03"){
            $Mes = "3";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "04"){
            $Mes = "4";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "05"){
            $Mes = "5";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "06"){
            $Mes = "6";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "07"){
            $Mes = "7";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "08"){
            $Mes = "8";
        }else{
            $Mes = $Mes;
        }

        if ($Mes == "09"){
            $Mes = "9";
        }else{
            $Mes = $Mes;
        }


        if (strlen($CPF) == "11"){

            $CPF = $CPF;

        }elseif (strlen($CPF) == "10"){

            $CPF = "0".$CPF;

        }elseif (strlen($CPF) == "9"){

            $CPF = "00".$CPF;

        }elseif (strlen($CPF) == "8"){

            $CPF = "000".$CPF;
        }elseif (strlen($CPF) == "7"){

            $CPF = "0000".$CPF;
        }elseif (strlen($CPF) == "6"){

            $CPF = "00000".$CPF;
        }elseif (strlen($CPF) == "5"){

            $CPF = "000000".$CPF;
        }elseif (strlen($CPF) == "4"){

            $CPF = "0000000".$CPF;
        }elseif (strlen($CPF) == "3"){

            $CPF = "00000000".$CPF;
        }elseif (strlen($CPF) == "2"){
            $CPF = "000000000".$CPF;

        }elseif (strlen($CPF) == "1"){
            $CPF = "0000000000".$CPF;

        }
        $query = $query . ($key == 1? '': ',');
        $query = $query . " ('$vAdmin->CdPrefeitura',";
        $query = $query . " '$Protocolo',";
        $query = $query . " '$CdUsuario',";
        $query = $query . " '$Nome',";
        $query = $query . " '$CPF',";
        $query = $query . " '$Orgao',";
        $query = $query . " '$Secretaria',";
        $query = $query . " '$Cargo',";
        $query = $query . " '$CargoComissao',";
        $query = $query . " '$RemuneracaoBasica',";
        $query = $query . " '$IRRF',";
        $query = $query . " '$PSS',";
        $query = $query . " '$DecimoAdto',";
        $query = $query . " '$DecimoFinal',";
        $query = $query . " '$DecimoPSS',";
        $query = $query . " '$DecimoIRRF',";
        $query = $query . " '$Ferias',";
        $query = $query . " '$Mes',";
        $query = $query . " '$Ano',";
        $query = $query . " '$DtCadastro',";
        $query = $query . " '$Acao'";
        $query = $query . ") ";

			}
			$primeira_linha = false;
		}

    var_dump($query);
    $cadastro=$pdo->query($query);
    $cadastro->execute();

        echo "<div class='callout callout-success'>";
        echo "<h4>Folha de Pagamento cadastrada com sucesso!</h4>";
        echo "</div>";

  }

}else{
  echo "<div class='callout callout-success'>";
  echo "<h4>selecione um arquivo em XML ou CSV!</h4>";
  echo "</div>";
}

    ?>

<script language= "JavaScript">
     location.href="../index.php?p=folha"
</script>
