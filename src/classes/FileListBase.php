<?php

abstract class FileListBase implements Countable {
  protected $files = array();
  
  function pushFile($filename) {
    $this->files[] = $filename;
  }
  
  public function popFile() {
     //$ret = $this->files[0];
     $ret = array_shift($this->files);
     return $ret;
  }
  
  public function getCount() {
    return count($this->files);
  }
    
  public function getFiles() { 
    return $this->files;
  }
  
  public abstract function testA();
  
  
  public function count() {
    return $this->getCount();
  }
}