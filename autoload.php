<?php

require_once('src/gck.utils.php');

require_once('src/classes/ApplicationData.php');
//if (!$appData) {
if (!isset($appData)) {
  $appData = ApplicationData::getInstance();
  $appData->test1 = "test1";
}

require_once("src/classes/FileListBase.php");
require_once("src/classes/FileList.php");

require_once("src/classes/BasicTextProcessor.php");
require_once("src/classes/KeywordProcessor.php");

require_once("src/classes/TextProcessorBase.php");
require_once('src/classes/FileProcessor.php');


function __autoload($name) {
  //if (file_exists("src/$name.php"))
 //   include_once("src/$name.php");
  if (file_exists("src/classes/$name.php"))
    require_once("src/classes/$name.php");  
}

