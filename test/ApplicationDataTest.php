<?php




class ApplicationDataTest extends \PHPUnit_Framework_TestCase
{

  function testCoReset() {
    $a = ApplicationData::getInstance();
    $this->assertSame($a->var1, "");
   // $a->reset();
  }
  
  
}
