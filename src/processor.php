#!/usr/bin/php 
<?php

  require_once('/home/trick/Development/github/git-cvs-keywords/autoload.php');

/*
require_once('src/gck.utils.php');

require_once('src/classes/ApplicationData.php');

require_once("src/classes/FileListBase.php");
require_once("src/classes/FileList.php");

//require_once("src/classes/BasicTextProcessor.php");
require_once("src/classes/KeywordProcessor.php");

require_once("src/classes/TextProcessorBase.php");
require_once('src/classes/FileProcessor.php');
*/
/*
function __autoload($name) {
  if (file_exists("src/$name.php"))
    include_once("src/$name.php");
  if (file_exists("src/classes/$name.php"))
    include_once("src/classes/$name.php");  
}
*/

$FROM_HOOK=getenv('FROM_HOOK');
if ($FROM_HOOK=="") { $FROM_HOOK=false; } else { }

if ($FROM_HOOK) 
  echo "[debug] processor running, triggered from git hook $FROM_HOOK.\n";

$appData->gitdir=realpath( dirname ($argv[0]) );
while(1==1) {
  if (is_dir($appData->gitdir."/.git")) {
    $appData->gitdir=$appData->gitdir . "/.git";
    break;
  } else {
    $appData->gitdir = realpath(dirname($appData->gitdir));
  }
  if ($appData->gitdir=="" || strlen($appData->gitdir)<2) break;
}

//$appData->gitdir = realpath( dirname ($argv[0]) ) . "/.git";

$appData->Date = exec('git --git-dir='.$appData->gitdir.' log --format="%aD" -1 HEAD'); //date('Y-M-d H:i T'); //this should be 


$fl = new FileList();
$fl->loadScript("src/git-show-modified-files.sh");


foreach($argv as $argf) {
  $fl->pushFile($argf);
}

$fp = new FileProcessor();

print_r($fl);

while($fl->count() > 0) {
  $appData->save = 0;
  $fn = $fl->popFile();
  echo "fn = $fn \n";
  $fp->reset();
  $fp->loadText( $fn );
  
  $inst = KeywordProcessor::getInstance();
  if ($inst::checkKeywords( $fp->getData() )) { } ;
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
  
//}


putenv('FROM_HOOK=');
//print_r( ApplicationData::getInstance() );
