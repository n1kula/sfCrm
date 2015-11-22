<?php

namespace AppBundle\Tests\Utils;

use AppBundle\Utils\Pesel;

/**
 * Class PeselTest
 */
class PeselTest extends \PHPUnit_Framework_TestCase
{
    public function testCheck()
    {
        $pesel = new Pesel();
        
        $this->assertTrue($pesel->check(16011208935));
        
        $this->assertFalse($pesel->check(1601125));
    }
}
