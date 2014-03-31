<?php

class FileList extends FileListBase {
  
  function testA() {
  	echo "k";
  }

  function load($cmd) {
    $output = array();
    exec($cmd, $output);
    $this->files = $output;
  }
  
}