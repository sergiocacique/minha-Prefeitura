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

$CdCPL = $_POST['CdCPL'];
$Tipo = $_POST['Tipo'];

$DtCadastro = date('Y-m-d H:i:s');

$dir = '../../dinamico/municipio/'.$vAdmin->Pasta.'/anexo/';

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
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
if ($_FILES['arquivo']['error'] != 0) {
    die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
    exit; // Para a execução do script
}


// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

// Faz a verificação da extensão do arquivo
$arquivos = explode('.', $_FILES['arquivo']['name']);

$extensao = strtolower($arquivos[count($arquivos) - 1]);


if (array_search($extensao, $_UP['extensoes']) === false) {
    echo "<div class='callout callout-danger'>";
    echo "<h4>ERROR:</h4>";
    echo "<p>Por favor, envie arquivos com a seguinte extensão: pdf</p>";
    echo "</div>";
    exit;
}

// Faz a verificação do tamanho do arquivo
if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
    echo "<div class='callout callout-danger'>";
    echo "<h4>ERROR:</h4>";
    echo "<p>O arquivo enviado é muito grande, envie arquivos de até 2Mb.</p>";
    echo "</div>";
    exit;
}


// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta

// Primeiro verifica se deve trocar o nome do arquivo
if ($_UP['renomeia'] == true) {
    // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
    $nome_final = md5(time()).'.'.$extensao.'';
} else {
    // Mantém o nome original do arquivo
    $nome_final = $_FILES['arquivo']['name'];
}

// Depois verifica se é possível mover o arquivo para a pasta escolhida
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $nome_final)) {
    // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
    echo "<div class='callout callout-warning'>";
    echo "<h4>cadastrado com sucesso</h4>";
    echo "<p><a href=' . $dir . $nome_final . '>Clique aqui para acessar o arquivo</a></p>";
    echo "</div>";



    $query = "INSERT INTO arquivos(";

    $query = $query . " Codigo,";
    $query = $query . " CdPrefeitura,";
    $query = $query . " Pagina,";
    $query = $query . " Arquivo,";
    $query = $query . " Tipo, ";
    $query = $query . " DtCadastro, ";
    $query = $query . " Acao, ";
    $query = $query . " CdUsuario ";

    $query = $query . " )VALUES(";

    $query = $query . " :Codigo,";
    $query = $query . " :CdPrefeitura,";
    $query = $query . " :Pagina,";
    $query = $query . " :Arquivo,";
    $query = $query . " :Tipo, ";
    $query = $query . " :DtCadastro, ";
    $query = $query . " :Acao, ";
    $query = $query . " :CdUsuario ";

    $query = $query . " )";

    $buscasegura=$pdo->prepare($query);
    $buscasegura->bindValue(":Codigo",$CdCPL);
    $buscasegura->bindValue(":CdPrefeitura",$vAdmin->CdPrefeitura);
\    $buscasegura->bindValue(":Pagina",'CPL');
    $buscasegura->bindValue(":Arquivo",$nome_final);
    $buscasegura->bindValue(":Tipo",$Tipo);
    $buscasegura->bindValue(":DtCadastro",$DtCadastro);
    $buscasegura->bindValue(":Acao",'Publicado');
    $buscasegura->bindValue(":CdUsuario",$verTempo->CdUsuario);



    $buscasegura->execute();


?>
<script language= "JavaScript">
     location.href="../index.php?p=cplEditar&id=<?php echo $CdCPL;?>&t=anexo"
</script>
<?php

} else {
    // Não foi possível fazer o upload, provavelmente a pasta está incorreta
    echo "<div class='callout callout-danger'>";
    echo "<h4>ERROR:</h4>";
    echo "<p>Não foi possível enviar o arquivo, tente novamente<br>". $dir . $nome_final ."</p>";
    echo "</div>";
}
    ?>
