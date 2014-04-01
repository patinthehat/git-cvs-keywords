<?php


abstract class TextProcessorBase   {
  protected $data;
  protected $textData;
  
  abstract public function loadText($data);
  abstract public function processText();
  abstract public function saveText($data);
  
  function getData() {
    return $this->data;
  }
  
  function setData($data) {
  	$this->data = $data;
  }
  
  public function reset() {
  	$this->data = "";
  	$this->textData = "";
  }
  
  function process($textData) {
    $this->textData = $textData;
    $this->data = $this->loadText($textData);
    $this->processText($this->data);
    $this->data = $this->saveText($textData);
  }
  
  
  
  
}
