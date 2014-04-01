<?php

//class BaseTest { 
#  function sing() {  return false; }
#    return false;
#  }


class BaseTestTest  extends \PHPUnit_Framework_TestCase 
{

  function testOne() {
    $this->assertSame(1, 1);
  }


}
