<?php

    namespace Jobboard\Controllers;

    use Jobboard\Controllers\AbstractController;

    class ErrorController extends AbstractController {
        public function notFound(): string {
            $properties = ['errorMessage' => 'Page Not Found'];
            return $this->render('error.twig', $properties);
        }
    }
