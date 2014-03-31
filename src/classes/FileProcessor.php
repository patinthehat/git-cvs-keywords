<?php
/**
 * $Author$
 * 
 *  $Id$
$ @@IGNOREKE YWORDS. disables matching
 * $Id$
 * @@EIGNORE  
 *
 * 
 * $Id: src/classes/FileProcessor.php test v1.2 $
 * $Id: src/classes/NotChanged.php test v2.1 $
 * 
 * 
 * 
 * $Author$
 * $Tags$
 * $Tags: replace $
 * $Date$
 * 
 * ###REPLACEME###
 * 
 */




class FileProcessor extends TextProcessorBase {
  
    public function loadText($data) {
      $data = realpath($data);
      
      $this->fileData = $data;
      $this->data = file_get_contents($data);
    }
  
    public function processText() {
      $this->data = str_replace('###REP"."LACEME###', '--REPLACED--', $this->data);
    }
  
    public function saveText($data) {
      global $appData;
      //if (!file_exists($this->fileData . ".tmp")) 
      if (1==1) {
        echo "Writing ".$this->fileData.".tmp ...\n";
        file_put_contents($this->fileData . ".tmp", $this->data);
      }
      
      //$text = $this->data;
      //$text = $this->data;
      //echo "\n--- " .$this->fileData . " ---\n";
      //echo "$text";
    }
  
  }