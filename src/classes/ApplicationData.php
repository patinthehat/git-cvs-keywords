<?php

class ApplicationData {

  public function getInstance() {
    static $inst = null;
    if ($inst === null)
      $inst = new static;
    return $inst;
  }
  
  private function __construct() {
      
  }
  
  protected $data = array();
  
  function __get($name) {
    if (isset($this->data[$name]))
      return $this->data[$name];

    return "";
  }
  
  function __set($name, $value) {
    $this->data[$name] = $value;
  
  }
  
  
}

$appData = ApplicationData::getInstance();
// $appData = ApplicationData::getInstance();
