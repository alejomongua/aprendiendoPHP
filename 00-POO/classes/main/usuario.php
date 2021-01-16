<?php

// El código se puede separar en namespaces
namespace Main;

class Usuario {
  public $username;
  public $email;
  private $loggedIn;

  public function __construct($username, $email) {
    $this->username = $username;
    $this->email = $email;
    $this->loggedIn = false;
  }

  public function login()
  {
    $this->loggedIn = true;
  }

  public function logout()
  {
    $this->loggedIn = false;
  }

  public function isLoggedIn()
  {
    if ($this->loggedIn) {
      echo $this->username . ' is logged in';
      return;
    }

    echo $this->username . ' is not logged in';
  }

  public function classInfo()
  {
    echo 'Class name: ' . __CLASS__;
    echo '<br />';
    echo 'Method name: ' . __METHOD__;
    echo '<br />';
    echo 'File name: ' . __FILE__;
    echo '<br />';
    echo 'Dir name: ' . __DIR__;
    echo '<br />';
    echo 'Trait name: ' . __TRAIT__;
    echo '<br />';
    echo 'Namepace name: ' . __NAMESPACE__;
  }
}

