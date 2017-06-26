<!-- BEGIN SIDEBAR MENU -->
<div class="sidebar-menu">
  <ul class="menu-items">
    <li class="m-t-30">
      <a href="?p=meus_dados" class="detailed">
        <span class="title">Meus dados</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-address-card"></i></span>
    </li>
    <?php if($vAdmin->Acao == "Publicado"){?>
    <li class="">
      <a href="?p=minha_tarefa" class="detailed">
        <span class="title">Minhas Tarefas</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-inbox"></i></span>
    </li>
    <?php if ($verTempo->gerenciador == 'sim'){?>
    <li class="">
      <a href="javascript:;">
        <span class="title">Gerenciador </span>
        <span class=" arrow"></span>
      </a>
      <span class="icon-thumbnail"><i class="fa fa-industry"></i>
              </span>
      <ul class="sub-menu">
        <li class="">
          <a href="?p=home">Empresas</a>
          <span class="icon-thumbnail">EM</span>
        </li>
        <li class="">
          <a href="?p=o_municipio">Contratos</a>
          <span class="icon-thumbnail">CO</span>
        </li>
        <li class="">
          <a href="?p=servicos">Serviços</a>
          <span class="icon-thumbnail">LE</span>
        </li>
        <li class="">
          <a href="?p=noticias">Notícias</a>
          <span class="icon-thumbnail">PF</span>
        </li>
        <li class="">
          <a href="?p=fotos">Fotos</a>
          <span class="icon-thumbnail">GL</span>
        </li>
        <li class="">
          <a href="?p=videos">Vídeos</a>
          <span class="icon-thumbnail">LK</span>
        </li>
      </ul>
    </li>
    <?php }?>
    <?php if ($verTempo->esic == 'sim'){?>
    <li class="">
      <a href="?p=esic" class="detailed">
        <span class="title">e-SIC</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-comments-o"></i></span>
    </li>
    <?php }?>
  <?php if ($verTempo->transparencia == 'sim'){?>
    <li class="">
      <a href="javascript:;">
        <span class="title">Transparência</span>
        <span class=" arrow"></span>
      </a>
      <span class="icon-thumbnail"><i class="fa fa-diamond"></i>
              </span>
      <ul class="sub-menu">
        <?php if ($vPemissao->financeiro == 'sim'){?>
        <li class="">
          <a href="?p=receitas">Receitas</a>
          <span class="icon-thumbnail">RE</span>
        </li>
        <li class="">
          <a href="?p=despesas">Despesas</a>
          <span class="icon-thumbnail">DE</span>
        </li>
        <?php }?>
        <!-- <?php if ($vPemissao->cpl == 'sim'){?>
        <li class="">
          <a href="?p=empresas">Empresas</a>
          <span class="icon-thumbnail">EM</span>
        </li>
        <?php }?> -->
        <?php if ($vPemissao->convenio == 'sim'){?>
        <li class="">
          <a href="?p=convenios">Convênios</a>
          <span class="icon-thumbnail">CO</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->sociais == 'sim'){?>
        <li class="">
          <a href="?p=projetos_sociais">Projetos Sociais</a>
          <span class="icon-thumbnail">PS</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->obras == 'sim'){?>
        <li class="">
          <a href="?p=obras">Obras</a>
          <span class="icon-thumbnail">OB</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->fundeb == 'sim'){?>
        <li class="">
          <a href="?p=fundeb">Fundeb</a>
          <span class="icon-thumbnail">FB</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->rreo == 'sim'){?>
        <li class="">
          <a href="?p=rreo">RREO</a>
          <span class="icon-thumbnail">RR</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->prestacao_conta == 'sim'){?>
        <li class="">
          <a href="?p=relatorio_gestao">RGF - Relatório de Gestão Fiscal</a>
          <span class="icon-thumbnail">RG</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->prestacao_conta == 'sim'){?>
        <li class="">
          <a href="?p=prestacao_conta">Prestação de Conta</a>
          <span class="icon-thumbnail">PC</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->frotas == 'sim'){?>
        <li class="">
          <a href="?p=frota">Frota</a>
          <span class="icon-thumbnail">FR</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->folha == 'sim'){?>
        <li class="">
          <a href="?p=folha">Folha de Pagamento</a>
          <span class="icon-thumbnail">FO</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->passagens == 'sim'){?>
        <li class="">
          <a href="?p=passagens">Passagens</a>
          <span class="icon-thumbnail">PA</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->diarias == 'sim'){?>
        <li class="">
          <a href="?p=diaria">Diárias</a>
          <span class="icon-thumbnail">DI</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->ajuda_custo == 'sim'){?>
        <li class="">
          <a href="?p=ajuda_custo">Ajuda de Custo</a>
          <span class="icon-thumbnail">AC</span>
        </li>
        <?php }?>
        <?php if ($vPemissao->cpl == 'sim'){?>
        <li class="">
          <a href="?p=cpl">Contratos e Licitações</a>
          <span class="icon-thumbnail">CL</span>
        </li>
        <?php }?>
      </ul>
    </li>
    <?php }?>
    <?php if ($verTempo->rh == 'sim'){?>
    <li class="">
      <a href="javascript:;">
        <span class="title">RH</span>
        <span class=" arrow"></span>
      </a>
      <span class="icon-thumbnail"><i class="fa fa-shield"></i>
              </span>
      <ul class="sub-menu">
        <li class="">
          <a href="?p=servidor">Servidores</a>
          <span class="icon-thumbnail">SE</span>
        </li>
        <li class="">
          <a href="?p=contra_cheque">Contra-Cheque</a>
          <span class="icon-thumbnail">CC</span>
        </li>
        <li class="">
          <a href="?p=cedula_c">Cédula-C</a>
          <span class="icon-thumbnail">CE</span>
        </li>
        <li class="">
          <a href="?p=tabela_codigo">Tabela de Códigos</a>
          <span class="icon-thumbnail">TC</span>
        </li>
      </ul>
    </li>
    <?php }?>
    <?php if ($verTempo->diario_oficial == 'sim'){?>
    <li class="">
      <a href="?p=diario_oficial" class="detailed">
        <span class="title">Diário Oficial</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-book"></i></span>
    </li>
    <?php }?>
    <?php if ($verTempo->publicacoes == 'sim'){?>
    <li class="">
      <a href="javascript:;">
        <span class="title">Publicações</span>
        <span class=" arrow"></span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-file-text-o"></i></span>
      <ul class="sub-menu">
        <?php
        $PubOf=$pdo->prepare("SELECT * FROM publicacoes_oficiais_categoria  ORDER BY Nome ASC");
        $PubOf->execute();

        $lPubOf=$PubOf->fetchAll(PDO::FETCH_OBJ);
        $tPubOf = $PubOf->rowCount();
        foreach ($lPubOf as $vPubOf) {
        ?>
        <li class="">
          <a href="?p=publicacoes&c=<?php echo $vPubOf->CdCategoria;?>"><?php echo $vPubOf->Nome;?></a>
          <span class="icon-thumbnail"><?php echo $vPubOf->Abreviacao;?></span>
        </li>
        <?php }?>

      </ul>
    </li>
    <?php }?>
    <?php if ($verTempo->portal == 'sim'){?>
    <li class="">
      <a href="javascript:;">
        <span class="title">Portal </span>
        <span class=" arrow"></span>
      </a>
      <span class="icon-thumbnail"><i class="fa fa-institution"></i>
              </span>
      <ul class="sub-menu">
        <li class="">
          <a href="?p=home">Home</a>
          <span class="icon-thumbnail">SP</span>
        </li>
        <li class="">
          <a href="?p=o_municipio">O Municipio</a>
          <span class="icon-thumbnail">EO</span>
        </li>
        <li class="">
          <a href="?p=servicos">Serviços</a>
          <span class="icon-thumbnail">LE</span>
        </li>
        <li class="">
          <a href="?p=noticias">Notícias</a>
          <span class="icon-thumbnail">PF</span>
        </li>
        <li class="">
          <a href="?p=fotos">Fotos</a>
          <span class="icon-thumbnail">GL</span>
        </li>
        <li class="">
          <a href="?p=videos">Vídeos</a>
          <span class="icon-thumbnail">LK</span>
        </li>
      </ul>
    </li>
    <?php }?>
    <?php if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){?>
    <li class="">
      <a href="?p=configuracoes" class="detailed">
        <span class="title">Configuração</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-cogs"></i></span>
    </li>
    <?php }?>
    <?php if ($verTempo->Perfil == '1' OR $verTempo->Perfil == '2'){?>
    <li class="">
      <a href="?p=usuarios" class="detailed">
        <span class="title">Usuário</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-users"></i></span>
    </li>
    <?php }?>
    <?php }?>
    <li class="">
      <a href="sair.php" class="detailed">
        <span class="title">Sair</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-close"></i></span>
    </li>
  </ul>
  <div class="clearfix"></div>
</div>
<!-- END SIDEBAR MENU -->
