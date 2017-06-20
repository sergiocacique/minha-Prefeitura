
<div class="col-md-12">


                <?php
                $tarefas1 = array('receitas','despesas','ajuda_custo','convenios', 'diarias', 'obras', 'passagens', 'prestacao_conta', 'projetos_sociais', 'rreo', 'servidor', 'cpl', 'frotas_abastecimento');
                $somatarefas1 = 0;

                $UsuarioLog1 = "";

                if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){
                    $UsuarioLog1 = " Acao IN('Aguardando','Pendente','Arquivo','Correcao','Cadastrando')";
                }else{
                    $UsuarioLog1 = "CdUsuario = '".$verTempo->UsuarioID."' AND Acao IN('Pendente','Arquivo','Correcao','Cadastrando')";
                }



                foreach ($tarefas1 as $indice1 => $valor1) {


                    if ($valor1 == "frotas_abastecimento") {
                        $sqlCPL11 = "SELECT Acao, count(Acao) as Total  FROM $valor1 WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND $UsuarioLog1 GROUP BY Protocolo";
                    } elseif ($valor1 == "servidor") {
                        $sqlCPL11 = "SELECT Acao, count(Acao) as Total FROM $valor1 WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND $UsuarioLog1 GROUP BY Protocolo";
                    } elseif ($valor1 == "cpl") {
                        $sqlCPL11 = "SELECT Acao, count(Acao) as Total  FROM $valor1 WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND $UsuarioLog1 GROUP BY Protocolo";

                    } else {
                        $sqlCPL11 = "SELECT Acao, count(Acao) as Total FROM $valor1 WHERE CdPrefeitura = '".$vAdmin->CdPrefeitura."' AND  $UsuarioLog1";
                    }


                    $Ano=$pdo->prepare($sqlCPL11);
                    $Ano->execute();

                    $lAno=$Ano->fetchAll(PDO::FETCH_OBJ);
                    $tAno = $Ano->rowCount();

                    $somaTotalCPL1 = 0;
                    $somaCPL1 = 0;
                    $somatarefas1 = 0;

                    foreach ($lAno as $vAno) {
                      $somaCPL1 = $vAno->Total;
                      $somaTotalCPL1 += $somaCPL1;
                    }


                    $somatarefas1 += $somaTotalCPL1;



                    if ($valor1 == "obras") {
                        $icone1 = "fa-warning";
                        $nome1 = "Obras";
                        $link1 = "?p=minha_tarefa&t=obras";

                    } elseif ($valor1 == "passagens") {
                        $icone1 = "fa-suitcase";
                        $nome1 = "Passagens";
                        $link1 = "?p=minha_tarefa&t=passagens";

                    } elseif ($valor1 == "diarias") {
                        $icone1 = "fa-hotel";
                        $nome1 = "Diárias";
                        $link1 = "?p=minha_tarefa&t=diarias";

                    } elseif ($valor1 == "ajuda_custo") {
                        $icone1 = "fa-ambulance";
                        $nome1 = "Ajuda de Custo";
                        $link1 = "?p=minha_tarefa&t=ajuda_custo";

                    } elseif ($valor1 == "cpl") {
                        $icone1 = "fa-folder-open-o";
                        $nome1 = "Contratos e Licitações";
                        $link1 = "?p=minha_tarefa&t=cpl";

                    } elseif ($valor1 == "convenios") {
                        $icone1 = "fa-code-fork";
                        $nome1 = "Convênios";
                        $link1 = "?p=minha_tarefa&t=convenios";

                    } elseif ($valor1 == "servidor") {
                        $icone1 = "fa-usd";
                        $nome1 = "Folha de Pagamento";
                        $link1 = "?p=minha_tarefa&t=folha";

                    }  elseif ($valor1 == "prestacao_conta") {
                        $icone1 = "fa-area-chart";
                        $nome1 = "Prestação de Contas";
                        $link1 = "?p=minha_tarefa&t=prestacao_conta";

                    } elseif ($valor1 == "projetos_sociais") {
                        $icone1 = "fa-child";
                        $nome1 = "Projetos Sociais";
                        $link1 = "?p=minha_tarefa&t=projetos_sociais";

                    } elseif ($valor1 == "frotas_abastecimento") {
                        $icone1 = "fa-car";
                        $nome1 = "Abastecimentos";
                        $link1 = "";

                    } elseif ($valor1 == "despesas") {
                        $icone1 = "fa-minus";
                        $nome1 = "Despesas";
                        $link1 = "?p=minha_tarefa&t=despesas";

                    } elseif ($valor1 == "receitas") {
                        $icone1 = "fa-plus";
                        $nome1 = "Receitas";
                        $link1 = "?p=minha_tarefa&t=receitas";

                    } elseif ($valor1 == "rreo") {
                        $icone1 = "fa-line-chart";
                        $nome1 = "rreo";
                        $link1 = "?p=minha_tarefa&t=rreo";

                    }



                    if ($somatarefas1 != 0) {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="<?php echo $link1 ?>" class="link-interno" data-ativo="1">
                                    <h2><?php echo $nome1 ?></h2>
                                </a>

                                <div class="info">
                                    <div class="info-descricao-texto"><?php echo $nome1 ?>
                                        <strong><?php echo $somatarefas1; ?></strong> pendente(s)
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                }?>

            </div>
