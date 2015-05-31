<?php

class TestCase extends PHPUnit_Framework_TestCase
{
    protected function guzzleResp($data)
    {
        $guzzleStream = $this->prophesize('GuzzleHttp\Stream\StreamInterface');
        $guzzleStream->getContents()->willReturn($data);

        $guzzleResp = $this->prophesize('GuzzleHttp\Message\Response');
        $guzzleResp->getBody()->willReturn($guzzleStream);

        return $guzzleResp;
    }
} 