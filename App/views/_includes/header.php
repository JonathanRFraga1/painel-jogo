<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jonathan Rossetto de Fraga">
    <meta name="description" content="Painel de controle para o jogo da forca">
    <meta namm="keywords" content="Painel, controle, painel do jogo">
    <meta http-equiv="content-language" content="pt-br">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="<?= $this->robots?>">
    <title><?= $this->title?></title>
    <link rel="stylesheet" href="<?= HOME_URI?>/App/views/_includes/fontAwesome/css/all.min.css">
    <link rel="stylesheet" href="<?= HOME_URI?>/App/views/_includes/css/styles.css">
    <script src="<?= HOME_URI?>/App/views/_includes/js/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <button id="bt-main-menu" aria-label="clique para exibir o menu do sistema">
            <i class="fas fa-bars"></i>
        </button>

        <h2>Jogo da Forca</h2>
    </header>

    <nav role="navigation" id="main-menu">
        <ul>
            <li>
                <a href="<?= HOME_URI?>">
                    <i class="fas fa-home"></i>
                    Home
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/jogadores">
                    <i class="fas fa-gamepad"></i>
                    Jogadores
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/palavras">
                    <i class="fas fa-file-contract"></i>
                    Palavras
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/categorias">
                    <i class="fas fa-list"></i>
                    Categorias
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/usuarios">
                    <i class="fas fa-users"></i>
                    Usuários
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/configuracoes">
                    <i class="fas fa-sliders-h"></i>
                    Configurações
                </a>
            </li>
            <li>
                <a href="<?= HOME_URI?>/login/sair">
                    <i class="fas fa-sign-out-alt"></i>
                    Sair
                </a>
            </li>
        </ul>
    </nav>

    <div class="notification" id="notification-alert">
        <p class="title" id="title-notification" role="alert">Testando</p>
        <p id="message-notification" role="alert">Notification</p>
    </div>
