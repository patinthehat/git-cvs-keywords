<?php

require_once('src/classes/ApplicationData.php');
$appData = ApplicationData::getInstance();

class TextProcessor extends TextProcessorBase  {

  public function loadText($data) {
    $this->data = file_get_contents($data);
  }
  
  public function processText() {
    $this->data = str_replace('###REPLACEME###', '--REPLACED--', $this->data);
  }
  
  public function saveText($data) {
    if (!file_exists($this->fileData . ".tmp")) {
      echo "Writing ".$this->fileData.".tmp ...\n";
      file_put_contents($this->fileData . ".tmp", $this->data);
    }
    $text = $this->data;
    //echo "\n--- " .$this->fileData . " ---\n";
    //echo "$text";
  }

}