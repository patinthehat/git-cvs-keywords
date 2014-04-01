<?php


class BasicTextProcessorTest extends \PHPUnit_Framework_TestCase
{

  function testLoadText() {
    $a = ApplicationData::getInstance();
    
    $tp = new TextProcessor();
    $tp->loadText("/proc/loadavg");
    $this->assertNotSame($tp->getData(), "aaa");
    // $a->reset();
  }


}
