<?php

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Jobboard\Core\Router;
    use Jobboard\Core\Request;
    use Jobboard\Core\Config;
    use Jobboard\Utils\DependencyInjector;

    require_once __DIR__ . '/vendor/autoload.php';

    $config = new Config();

    // $dbConfig = $config->get('db');
    // $db = new PDO(
    //     'mysql:host=localhost;port=3307;dbname=jobboard',
    //     $dbConfig['user'],
    //     $dbConfig['password']
    // );

    $loader = new Twig_Loader_Filesystem(__DIR__ . '/views');
    $view = new Twig_Environment($loader);

    $log = new Logger('jobboard');
    $logFile = $config->get('log');
    $log->pushHandler(new StreamHandler($logFile, Logger::DEBUG));

    $di = new DependencyInjector();
    //$di->set('PDO', $db);
    $di->set('Utils\Config', $config);
    $di->set('Twig_Environment', $view);
    $di->set('Logger', $log);

    $router = new Router($di);
    $response = $router->route(new Request());
    echo $response;
