<?php

//  include_once('src/classes/KeywordProcessor.php');

//include_once('src/classes/KeywordProcessor.php');

class KeywordProcessorTest extends \PHPUnit_Framework_TestCase
{

  public function testKeywordProcess1() {
    $app = KeywordProcessor::checkKeywords("AAA AAA AAA");
    //KeywordProcessor::CheckKeyword("");
  }

}

