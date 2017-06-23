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
    <!-- <li class="">
      <a href="?p=minha_tarefa" class="detailed">
        <span class="title">Minhas tarefas</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-inbox"></i></span>
    </li> -->
    <!-- <li class="">
      <a href="?p=financa" class="detailed">
        <span class="title">Finanças</span>
        <span class="details">Despesas & Receitas</span>
      </a>
      <span class="icon-thumbnail">FI</span>
    </li> -->
    <!-- <li class="">
      <a href="?p=prestacao_conta" class="detailed">
        <span class="title">Gestão</span>
        <span class="details">Prestação de Contas</span>
      </a>
      <span class="icon-thumbnail ">GE</span>
    </li> -->
    <!-- <li class="">
      <a href="?p=esic" class="detailed">
        <span class="title">e-SIC</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-comments-o"></i></span>
    </li> -->

    <li class="">
      <a href="javascript:;">
        <span class="title">Transparência</span>
        <span class=" arrow"></span>
      </a>
      <span class="icon-thumbnail"><i class="fa fa-diamond"></i>
              </span>
      <ul class="sub-menu">
        <li class="">
          <a href="?p=receitas">Receitas</a>
          <span class="icon-thumbnail">RE</span>
        </li>
        <li class="">
          <a href="?p=despesas">Despesas</a>
          <span class="icon-thumbnail">DE</span>
        </li>
        <li class="">
          <a href="?p=empresas">Empresas</a>
          <span class="icon-thumbnail">EM</span>
        </li>
        <li class="">
          <a href="?p=convenios">Convênios</a>
          <span class="icon-thumbnail">CO</span>
        </li>
        <li class="">
          <a href="?p=projetos_sociais">Projetos Sociais</a>
          <span class="icon-thumbnail">PS</span>
        </li>
        <li class="">
          <a href="?p=obras">Obras</a>
          <span class="icon-thumbnail">OB</span>
        </li>
        <li class="">
          <a href="?p=fundeb">Fundeb</a>
          <span class="icon-thumbnail">FB</span>
        </li>
        <li class="">
          <a href="?p=rreo">RREO</a>
          <span class="icon-thumbnail">RR</span>
        </li>
        <li class="">
          <a href="?p=relatorio_gestao">RGF - Relatório de Gestão Fiscal</a>
          <span class="icon-thumbnail">RG</span>
        </li>
        <li class="">
          <a href="?p=prestacao_conta">Prestação de Conta</a>
          <span class="icon-thumbnail">PC</span>
        </li>
        <li class="">
          <a href="?p=frota">Frota</a>
          <span class="icon-thumbnail">FR</span>
        </li>
        <li class="">
          <a href="?p=folha">Folha de Pagamento</a>
          <span class="icon-thumbnail">FO</span>
        </li>
        <li class="">
          <a href="?p=passagens">Passagens</a>
          <span class="icon-thumbnail">PA</span>
        </li>
        <li class="">
          <a href="?p=diaria">Diárias</a>
          <span class="icon-thumbnail">DI</span>
        </li>
        <li class="">
          <a href="?p=ajuda_custo">Ajuda de Custo</a>
          <span class="icon-thumbnail">AC</span>
        </li>
        <li class="">
          <a href="?p=cpl">Contratos e Licitações</a>
          <span class="icon-thumbnail">CL</span>
        </li>
      </ul>
    </li>
    <!-- <li class="">
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
    </li> -->
    <!-- <li class="">
      <a href="?p=diario_oficial" class="detailed">
        <span class="title">Diário Oficial</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-book"></i></span>
    </li> -->
    <!-- <li class="">
      <a href="?p=publicacao_oficial" class="detailed">
        <span class="title">Publicações</span>
        <span class="details">Publicação Oficiais</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-file-text-o"></i></span>
    </li> -->
    <!-- <li class="">
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
    </li> -->
    <!-- <li class="">
      <a href="?p=configuracoes" class="detailed">
        <span class="title">Configuração</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-cogs"></i></span>
    </li> -->
    <!-- <li class="">
      <a href="?p=usuarios" class="detailed">
        <span class="title">Usuário</span>
      </a>
      <span class="icon-thumbnail "><i class="fa fa-users"></i></span>
    </li> -->
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
