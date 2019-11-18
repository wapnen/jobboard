<?php
namespace Jobboard\Controllers;

/**
 *
 */
class HomeController extends AbstractController
{

  public function home(){
    return $this->render('home.twig', []);
  }
}
