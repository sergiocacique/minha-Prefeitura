<?php
include ("../../conexao.php");
include('../func/funcoes.php');
$pdo=conectar();
?>
<div class="panel panel-default">
    <div class="panel-body">
        <form id="formulario_clientes" name="formulario_clientes" class="validate" action="diaria_adicionar.php" method="post">

            <div class=" col-sm-12 col-md-3">
                <label>Mês</label>
                    <select class="form-control" id="mes" name="mes">
                        <?php
                        for ($i = 1; $i <= 12; $i++){
                            ?>
                            <option value="<?=$i?>"><?=retorna_mes_extenso($i)?></option>
                        <?php }?>
                    </select>
            </div>

            <div class=" col-sm-12 col-md-3">
                <label>Ano</label>
                    <select class="form-control" id="ano" name="ano">
                        <?php
                        for($ano=date('Y');$ano > date('Y')-10;$ano--){
                            ?>
                            <option value="<?=$ano?>" ><?=$ano?></option>
                        <?php }?>
                    </select>

            </div>

            <div class=" col-sm-12 col-md-6">
                <div class="fancy-form">
                    <label>Destino</label>
                    <input id="Destino" name="Destino" class="form-control" type="text" placeholder="Digite o Destino Completo">
                </div>
            </div>

            <div class=" col-sm-12 col-md-6">
                <div class="fancy-form">
                    <label>Nome Completo</label>
                    <input id="Nome" name="Nome" class="form-control" type="text"  placeholder="Digite o Nome Completo">
                </div>
            </div>

            <div class=" col-sm-12 col-md-6">
                <div class="fancy-form">
                    <label>Cargo</label>
                    <input id="Cargo" name="Cargo" class="form-control"  type="text" placeholder="Digite o Destino Completo">
                </div>
            </div>

            

            <div class=" col-sm-12 col-md-6">
                <label>Secretaria</label>
                    <select class="form-control" id="secretaria" name="secretaria">
                        <?php
                        $sqlGlossario = mysql_query("SELECT * FROM estrutura WHERE CdPrefeitura = '".$_SESSION['CdPrefeitura']."' ORDER BY Nome ASC");
                        $Glossario = mysql_num_rows($sqlGlossario);

                        for ($y = 0; $y < $Glossario; $y++){
                            $verGlossario = mysql_fetch_array($sqlGlossario);

                            ?>
                            <option value="<?php echo $verGlossario['Nome']; ?>"><?php echo $verGlossario['Nome']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
            </div>



            <div class=" col-sm-12 col-md-6">
                <div class="fancy-form">
                    <label>Periodo</label>
                    <input id="Periodo" name="Periodo" class="form-control"  type="text" placeholder="Digite o Destino Completo">
                </div>
            </div>



            <div class="box-branco">

                <div class=" col-sm-12 col-md-2">
                    <div class="fancy-form">
                        <label>Dias</label>
                        <input class="form-control" id="dias" name="dias" placeholder="Dias">
                    </div>
                </div>

                <div class=" col-sm-12 col-md-5">
                    <div class="fancy-form">
                        <label>Valor da Diária (R$)</label>
                        <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$"  class="form-control" id="valor_diaria" name="valor_diaria" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), soma1()">              </div>
                </div>

                <div class=" col-sm-12 col-md-5">
                    <div class="fancy-form">
                        <label>Valor Bruto (R$)</label>
                        <input data-mask="money" class="form-control" id="valor_bruto" name="valor_bruto" placeholder="0,00">
                    </div>
                </div>

                <div class=" col-sm-12 col-md-4">
                    <div class="fancy-form">
                        <label>Valor INSS (R$)</label>
                        <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" class="form-control" id="inss" name="inss" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), subtrai1()">
                    </div>
                </div>

                <div class=" col-sm-12 col-md-4">
                    <div class="fancy-form">
                        <label>Valor IRRF (R$)</label>
                        <input type="tel" pattern="([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$" data-mask="money" class="form-control" id="irrf" name="irrf" placeholder="0,00" onkeyup="maskIt(this,event,'###.###.###,##',true), subtrai1()">
                    </div>
                </div>

                <div class=" col-sm-12 col-md-4">
                    <div class="fancy-form">
                        <label>Valor Liquido (R$)</label>
                        <input data-mask="money" class="form-control" id="valor_liquido" name="valor_liquido" placeholder="0,00" >
                    </div>
                </div>


            </div>



            <div class=" col-sm-12 col-md-12">
                <button type="reset" class="btn btn-3d btn-danger margin-bottom-30 font-branco">CANCELAR</button>
                <button type="submit" class="btn btn-3d btn-primary margin-bottom-30 font-branco">GRAVAR</button>
            </div>

        </form>
    </div>
</div>
