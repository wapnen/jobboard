<?php

    namespace Jobboard\Controllers;

    use Jobboard\Core\Config;
    use Jobboard\Core\Request;
    use Jobboard\Utils\DependencyInjector;
    use Monolog\Logger;
    use Twig_Environment;
    use Twig_Loader_Filesystem;
    use Monolog\Handler\StreamHandler;

    abstract class AbstractController {
        protected $request;
        protected $di;
        protected $db;
        protected $config;
        protected $view;
        protected $log;

        public function __construct(DependencyInjector $di, Request $request) {
            $this->di = $di;
            $this->request = $request;

            //$this->db = $di->get('PDO');
            $this->log = $di->get('Logger');
            $this->view = $di->get('Twig_Environment');
            $this->config = $di->get('Utils\Config');
            

        }


        protected function render(string $template, array $params): string {
            return $this->view->loadTemplate($template)->render($params);
        }
    }
