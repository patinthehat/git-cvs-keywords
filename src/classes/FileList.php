<?php

class FileList extends FileListBase {
  
  function testA() { echo ""; }

  public function loadScript($cmd) {
    if (!$cmd || $cmd == "")
      return  false;
    
    $output = array();
    exec($cmd, $output);
    $this->files = $output;
    return isset($this->files);
  }


  function loadArray(array $a) {
    $ret =  array_merge($this->files, $a);
    return $ret;  
  }

}
