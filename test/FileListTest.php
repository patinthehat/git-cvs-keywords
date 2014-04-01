<?php

//require_once('autoload.php');
//require_once('src/classes/ApplicationData.php');
//require_once('src/cllasses/FileListBase.p.php');
//require_once('src/classes/classes/FileList.php');

/**
  * @covers FileListBase
 */
class FileListTest extends PHPUnit_Framework_TestCase
{
  
  function testPushFileAndCheckCount() {
    $fl = new \FileList();    
    $fl->pushFile("processor.php");
    $this->assertSame(1, $fl->getCount());
    $this->assertSame( $fl->popFile(), "processor.php" );  
  }
  
  function testCounting() {
    $fl = new \FileList();
    $this->assertSame(0, count($fl) );
    $this->assertSame(0, count($fl->getFiles()));
  }
  
}
