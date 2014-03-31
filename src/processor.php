#!/usr/bin/php 
<?php

require_once('src/classes/ApplicationData.php');
$appData = ApplicationData::getInstance();
$appData->test1 = "test1";

require_once("src/classes/FileListBase.php");
require_once("src/classes/FileList.php");

require_once("src/classes/BasicTextProcessor.php");
require_once("src/classes/KeywordProcessor.php");

require_once("src/classes/TextProcessorBase.php");
require_once("src/classes/FileProcessor.php");


function __autoload($name) {
  if (file_exists("src/$name.php"))
    include_once("src/$name.php");
  if (file_exists("src/classes/$name.php"))
    include_once("src/classes/$name.php");  
}


$appData->gitdir = realpath( dirname ($argv[0]) ) . "/.git";

$appData->Date = exec('git --git-dir='.$appData->gitdir.' log --format="%aD" -1 HEAD'); //date('Y-M-d H:i T'); //this should be 


$fl = new FileList();
$fl->load("src/git-show-modified-files.sh");

$fp = new FileProcessor();

while($fl->count() > 0) {
  $appData->save = 0;
  $fn = $fl->popFile();
  $fp->reset();
  $fp->loadText( $fn );
  
  if (KeywordProcessor::checkKeywords( $fp->getData() )) {
    $appData->Id = "";
    $appData->Filename = $fn;
    $appData->Author = exec('git --git-dir='.$appData->gitdir.'  log -n 1 --format="%aN <%ae>" HEAD');
    $appData->CommitId = exec('git  --git-dir='.$appData->gitdir.' rev-parse --verify HEAD');
    $appData->Revision = substr($appData->CommitId,0,12);
  
    $o = array();
    exec('git  --git-dir='.$appData->gitdir.' tag  -l', $o);
    $appData->Tags = implode(", ",$o);;
    $appData->save = 1;
  }
  
  

  $fp->processText();
  $data = KeywordProcessor::processText($fp->getData());
  $fp->setData($data);
  if ($appData->save == 1) {
    
    //write processed text back to file / temp/test file
    $fp->saveText( $fn . ".tmp" );
    $appData->save = 0;
  }
//  echo $fn . PHP_EOL;
  if ($appData->haskeys) {
    
    
  }
  
}

//print_r( ApplicationData::getInstance() );
