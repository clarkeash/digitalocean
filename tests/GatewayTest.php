<?php

use Rackr\DigitalOcean\Gateway;

class GatewayTest extends PHPUnit_Framework_TestCase {

    /**
     * @var \Prophecy\Prophecy\ObjectProphecy
     */
    protected $guzzle;

    /**
     * @var Gateway
     */
    protected $gateway;

    public function setUp()
    {
        $this->guzzle = $this->prophesize('GuzzleHttp\Client');
        $this->gateway = new Gateway($this->guzzle->reveal(), ['token' => 'FAKE']);
    }

    /** @test */
    public function it_is_an_instance_of_gateway_interface()
    {
        $this->assertInstanceOf('Rackr\Cloud\GatewayInterface', $this->gateway);
    }

    protected function guzzle($data)
    {
        $guzzleStream = $this->prophesize('GuzzleHttp\Stream\StreamInterface');
        $guzzleStream->getContents()->willReturn($data);

        $guzzleResp = $this->prophesize('GuzzleHttp\Message\Response');
        $guzzleResp->getBody()->willReturn($guzzleStream);

        return $guzzleResp;
    }

    /** @test */
    public function it_gets_the_available_sizes()
    {
        $guzzleResp = $this->guzzle(['sizes' => [] ]);

        $this->guzzle->get('https://api.digitalocean.com/v2/sizes', ["headers" => ["Authorization" => "Bearer FAKE"]])
            ->willReturn($guzzleResp);

        $resp = $this->gateway->sizes();

        $this->assertInstanceOf('Rackr\Cloud\Response', $resp);
    }
}
 