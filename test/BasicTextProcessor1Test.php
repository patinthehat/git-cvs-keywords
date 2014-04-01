<?php

//include_once('src/classes/KeywordProcessor.php');
//require_once("TextProcessorBase.php");
//require_once('FileProcessor.php');
//$a = new BasicTextProcessor();


class BasicTextProcessorTest1 extends \PHPUnit_Framework_TestCase
{
  public function testKeywordProcess1() {
    $app = KeywordProcessor::checkKeywords("AAA AAA AAA");
    $this->assertNotSame($app, fails);
  }

}

