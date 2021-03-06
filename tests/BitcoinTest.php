<?php

namespace BitWasp\Bitcoin\Tests;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Math\Math;
use BitWasp\Bitcoin\Network\Network;
use BitWasp\Bitcoin\Network\NetworkFactory;
use Mdanter\Ecc\EccFactory;
use Mdanter\Ecc\Math\Gmp;

class BitcoinTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {

    }

    public function testGetMath()
    {
        $default = Bitcoin::getMath();
        $this->assertEquals(new Math(), Bitcoin::getMath());
    }

    public function testGetGenerator()
    {
        $default = EccFactory::getSecgCurves(Bitcoin::getMath())->generator256k1();
        $this->assertEquals($default, Bitcoin::getGenerator());
    }

    public function testGetNetwork()
    {
        $default = Bitcoin::getDefaultNetwork();
        $bitcoin = NetworkFactory::bitcoin();
        $viacoin = NetworkFactory::viacoin();

        $this->assertEquals($default, $bitcoin);
        $this->assertEquals($default, Bitcoin::getNetwork());
        Bitcoin::setNetwork($viacoin);
        $this->assertSame($viacoin, Bitcoin::getNetwork());

        Bitcoin::setNetwork(Bitcoin::getDefaultNetwork()); // (re)set back to default
    }
}
