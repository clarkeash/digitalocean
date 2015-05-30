<?php

use Rackr\DigitalOcean\Gateway;

class GatewayTest extends PHPUnit_Framework_TestCase {

    protected $guzzle;
    protected $gateway;

    public function setUp()
    {
        $this->guzzle = Mockery::mock('GuzzleHttp\Client');
        $this->gateway = new Gateway($this->guzzle, []);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    /** @test */
    public function it_is_an_instance_of_gateway_interface()
    {
        $this->assertInstanceOf('Rackr\Cloud\GatewayInterface', $this->gateway);
    }

}
 