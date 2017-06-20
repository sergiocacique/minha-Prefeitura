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


$Ano = addslashes(trim($_POST['ano']));
$Titulo = addslashes(trim($_POST['Titulo']));
$DtAtualizacao = date('Y-m-d H:i:s');
$Pasta = "prestacao";

if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
  $Acao = addslashes(trim($_POST['acao']));
}else{
  $Acao = 'Arquivo';
}

$DtAtualizacao = date('Y-m-d H:i:s');

$DtCadastro1 = date('Y-m');
$Protocolo = "U".$verTempo->CdUsuario."P".date('Y').date('m').date('d');

$Atual=$pdo->prepare("SELECT * FROM prestacao_conta WHERE Pasta = 'prestacao' AND CdUsuario = '".$verTempo->CdUsuario."' AND DATE_FORMAT(DtCadastro, '%Y-%m') = '".$DtCadastro1."' ");
$Atual->execute();
$lAtual=$Atual->fetch(PDO::FETCH_OBJ);
$tAtual = $Atual->rowCount();

if ($tAtual == 0){
    $Protocolo = $Protocolo;
}else{
    $Protocolo = $lAtual->Protocolo;
}

$dir = '../../dinamico/municipio/'.$vAdmin->Pasta.'/'.$Ano.'/prestacao_conta/';

if (is_dir($dir)) {
} else {
    mkdir($dir, 0777, true); // Cria uma nova pasta dentro do diretório atual
}


// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 10240 * 10240 * 10; // 2Mb

// Array com as extensões permitidas
$_UP['extensoes'] = array('pdf');

// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = true;

$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do SERVIDOR';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
    echo "<script>";
    echo "$('#loading2').css('visibility','hidden');";
    echo "</script>";
    echo "<div class='callout callout-warning'>";
    echo "<h4>Arquivo Muito Grande</h4>";
    echo "<p>" . die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]) . "</p>";
    echo "</div>";
    echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
    echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
    echo "<i class='fa fa-arrow-left'></i> Voltar";
    echo "</a>";
    echo "</div>";

    exit; // Para a execução do script
}


// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$arquivos = explode('.', $_FILES['arquivo']['name']);

$extensao = strtolower($arquivos[count($arquivos) - 1]);

if (array_search($extensao, $_UP['extensoes']) === false) {
    echo "<div class='callout callout-warning'>";
    echo "<h4>Arquivo Errado</h4>";
    echo "<p>Por favor, envie arquivos com a seguinte extensão: pdf</p>";
    echo "</div>";
    echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
    echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
    echo "<i class='fa fa-arrow-left'></i> Voltar";
    echo "</a>";
    echo "</div>";
    echo "<script>";
    echo "$('#loading2').css('visibility','hidden');";
    echo "</script>";
    exit;
}

// Faz a verificação do tamanho do arquivo
if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
    echo "<div class='callout callout-warning'>";
    echo "<h4>Arquivo muito grande</h4>";
    echo "<p>O arquivo enviado é muito grande, envie arquivos de até 2Mb.</p>";
    echo "</div>";
    echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
    echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
    echo "<i class='fa fa-arrow-left'></i> Voltar";
    echo "</a>";
    echo "</div>";
    echo "<script>";
    echo "$('#loading2').css('visibility','hidden');";
    echo "</script>";
    exit;
}


// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta

// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
    $nome_final = md5(time()) . '.'.$extensao;
} else {
    // Mantém o nome original do arquivo
    $nome_final = $_FILES['arquivo']['name'];
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $nome_final)) {
    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
    echo "<div class='callout callout-success'>";
    echo "<h4>Prestação de Conta cadastrada com sucesso!</h4>";
    echo "</div>";

    $buscasegura=$pdo->prepare("INSERT INTO prestacao_conta(CdPrefeitura,CdUsuario,Nome,Ano,Arquivo,Acao,DtCadastro,Pasta,Protocolo)VALUES(:CdPrefeitura,:CdUsuario,:Nome,:Ano,:Arquivo,:Acao,:DtCadastro,:Pasta,:Protocolo)");
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);
    $buscasegura->bindValue(":Nome",$Titulo);
    $buscasegura->bindValue(":Ano",$Ano);
    $buscasegura->bindValue(":Protocolo",$Protocolo);
    $buscasegura->bindValue(":Arquivo",$nome_final);
    $buscasegura->bindValue(":Acao",$Acao);
    $buscasegura->bindValue(":Pasta",$Pasta);
    $buscasegura->bindValue(":DtCadastro",$DtAtualizacao);
    $buscasegura->execute();

    //auditoria($_POST,$_SESSION['Usuario'].' Adicionou RREO/RGF : '.$Nome.'');
    ?>
<?php

} else {
    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
    echo "<div class='callout callout-danger'>";
    echo "<h4>NEGADO</h4>";
    echo "<p>Não foi possível enviar o arquivo, tente novamente</p>";
    echo "</div>";
    echo " <div class='col-xs-5 col-sm-5 col-md-5'>";
    echo "<a href='noticia_cadastro.php' title='Enviar Arquivo' id='add-datatables1' class='btn upl_btn datatables1-actions' role='button'>";
    echo "<i class='fa fa-arrow-left'></i> Voltar";
    echo "</a>";
    echo "</div>";
    echo "<script>";
    echo "$('#loading2').css('visibility','hidden');";
    echo "</script>";
}

?>
<script language= "JavaScript">
    location.href="../index.php?p=prestacao_conta"
</script>
