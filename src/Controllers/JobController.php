<?php
namespace Jobboard\Controllers;
/**
 *
 */
class JobController extends AbstractController
{
  // protected $companies;
  // public function __construct(){
  //   $json = file_get_contents(__DIR__ . '/../../companies.json');
  //   $this->companies = json_decode($json, true);
  // }

  public function search(){
    $json = file_get_contents(__DIR__ . '/../../companies.json');
    $companies = json_decode($json, true);


    $skills = array_values($this->request->getParams()->getAll());
    //var_dump($skills);
    $validCompanies = [];
    foreach($companies as $company){

      $isQualified = $this->checkQualification($company, $skills);
      if($isQualified){
        $validCompanies[]=  $company["name"];
      }
    }
    
    $params = ['companies' => $validCompanies];
    return $this->render('results.twig', $params);
  }


  public function checkQualification($company, $skills){
    $hasAll = $this->hasAll($company, $skills);
    $hasAtleastOneOf = $this->hasAtleastOneOf($company, $skills);
    if($hasAll == true && $hasAtleastOneOf == true){
      return true;
    }
    else{
      return false;
    }
  }

  public function hasAll($company, $skills){
    if(count($company['requiresAll']) == 0){
      return true;
    }

    return !array_diff($company['requiresAll'], $skills);

  }

  public function hasAtleastOneOf($company, $skills){
    if(count($company['requiresOneOf']) == 0){
      return true;
    }

    if (count(array_intersect($company['requiresOneOf'], $skills)) === 0) {
      return false;
    } else {
      return true;
    }
  }
}
