<?php

abstract class FileListBase implements Countable {
  protected $files = array();
  
  function pushFile($filename) {
    $this->files[] = $filename;
  }
  
  function popFile() {
     //$ret = $this->files[0];
     $ret = array_shift($this->files);
     return $ret;
  }
  
  function getCount() {
    return count($this->files);
  }
    
  function getFiles() { 
    return $this->files;
  }
  
  abstract function testA();
  
  
  function count() {
    return $this->getCount();
  }
}