<?php

require_once 'vendor/autoload.php';

require_once './config.php';

// Verifica se recebeu algum parametro
if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);

    $file = './App/controllers/' . $url[0] . '-controller.php';

    // Verifica se a controller existe
    if (file_exists($file)) {
        // Caso exista, carrega o arquivo;
        require_once $file;

        $controller_name = "App\\Controllers\\" . $url[0] . 'Controller';

        // Cria um objeto da controller
        $controller = new $controller_name();

        // Verifica se está chamando um método em específico
        if (isset($url[1]) && $url[1] != '' && $url[1] != 'null') {
            $function = $url[1];

            // Verifica se o método existe
            if (method_exists($controller, $function)) {
                // Caso o método exista, chama ele
                $controller->$function();
            } else {
                // Caso o contrário exibe a página de erro
                require_once './404.php';
            }
        } else {
            // Caso não esteja chamando um função carrega o index
            $controller->index();
        }
    } else {
        // Caso não exista a controller carrega a página de erro
        require_once './404.php';
    }
} else {
    // Caso não tenha recebido carrega a home
    require_once './App/controllers/home-controller.php';
}
