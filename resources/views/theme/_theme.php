<!doctype html>
<html lang="pt-br">

<head>
    <title>Lotris RH</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="<?php echo asset('/img/logotransp.ico'); ?>" />
    <link rel="stylesheet" href="<?php echo asset('master.min.css'); ?>" />
</head>

<body>
    <div class="container">
        <div class="ajax_load">
            <div class="ajax_load_box">
                <div class="ajax_load_box_circle"></div>
                <div class="ajax_load_box_title">
                    <img src="<?php echo asset('/img/logotransG.png'); ?>" style=" width: 90px; height: 38px; align-items: center" />
                </div>
            </div>
        </div>
        <header>
            <div class="logotheme">
                <img src="<?php echo asset('/img/logotransG.png'); ?>" alt="alt" />
                <span>Gestão em RH</span>
            </div>
            <div class="painelhome">
                <span id="titlepag"></span>
            </div>
            <div>
                <span class="txt-small-1 cor-br horadigital"></span>
            </div>
            <div class="header-menu">
                <img id="btn_open_menu" src="<?= asset("/img/engrenagen.svg"); ?>  alt=" Menu Configuração" title="Menu Configuração">
            </div>
           
            <!-- MENU LATERAL  -->
            <div class="menu_conteiner" id="menu_conteiner"></div>
            <nav class="menu" id="menu">
                <h1 class="label txt-small-4 cor-am-cl mg-add-1">Menus e Ferramentas</h1>
                <ul>
                    <li><a href="#" class="img-cadastro-menu">Casdatros</a>
                        <ul id="cadastros">
                            <li><a href="<?php echo site('root') . 'controller/index'; ?>">Dashboard</a></li>
                            <li><a href="<?php echo site('root') . 'candidatos/index'; ?>">Candidatos</a></li>
                            <li><a href="<?php echo site('root') . 'empresasParceiras/index'; ?>">Empresas Parceiras</a></li>
                            <li><a href="<?php echo site('root') . 'vagas/index'; ?>">Vagas</a></li>
                            <li><a href="<?php echo site('root') . 'encaminhamentos/index'; ?>">Encaminhamentos</a></li>
                            <li><a href="<?php echo site('root') . 'encaminhamentos/cartaEmail'; ?>">Enviar E-mail</a></li>
                            <li><a href="<?php echo site('root') . 'usuarios/index'; ?>">Usuarios</a></li>
                            <li><a href="<?php echo site('root') . 'empresa/index'; ?>">Empresa</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="img-relatorio-menu">Relatórios</a>
                        <ul id="relatorios">
                            <li><a href="<?php echo site('root') . 'candidatos/relatorioCandidatos'; ?>">Candidatos</a></li>
                            <li><a href="<?php echo site('root') . 'vagas/relatorioVagas'; ?>">Vagas</a></li>
                            <li><a href="<?php echo site('root') . 'empresasParceiras/relatorioEmpresasPar'; ?>">Empresas Parceiras</a></li>
                            <li><a href="<?php echo site('root') . 'encaminhamentos/relatorioEncaminhar'; ?>">Encaminhamentos</a></li>
                        </ul>
                    </li>
                    <!-- <li><a href="<?= site("root") . "vendas/pdv" ?>" class="img-pdv-menu">Pdv</a></li> -->
                    <li><a href="#" class="img-pdv-menu">Administrativo</a>
                        <ul id="Administrativo">
                            <li><a href="<?php echo site('root') . 'controller/backupBdMysql'; ?>">Backup BD</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= site('root') . 'sair/index'; ?>" class="img-sair-menu">Sair</a></li>
                </ul>
            </nav>

            <!--  FIM MENU LATERAL   -->

        </header>

        <main>
            <?php

            use \App\Core\View;

            View::renderViewNoTemplate($nome, $dadosModel);
            ?>
        </main>

        <footer>
            <p><span>Nome do Usuário: <?php echo isset($_SESSION['login']) ? $_SESSION['login']['NOME']
                                            : ''; ?></span></p>
            <p><span> Lotris - RH &copy; <?php echo dataAtual(5); ?> </span></p>
        </footer>

        <script src="<?php echo asset('master.min.js'); ?>"></script>

    </div>
</body>

</html>