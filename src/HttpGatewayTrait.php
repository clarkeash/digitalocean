<?php namespace Rackr\DigitalOcean;

trait HttpGatewayTrait
{
    /**
     * @param $section
     * @return string
     */
    protected function endpoint($section)
    {
        return $this->endpoint . $section;
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $options
     * @return Response
     */
    protected function send($method, $endpoint, $options = [])
    {
        $conf = [
            'headers' => [ 'Authorization' => 'Bearer ' . $this->config['token'] ],
        ];

        $guzzleResp =  $this->client->{$method}($this->endpoint($endpoint), array_merge($conf, $options));

        return Response::make($guzzleResp->getBody()->getContents());
    }

    /**
     * @param $endpoint
     * @param array $options
     * @return Response
     */
    protected function get($endpoint, $options = [])
    {
        return $this->send('get', $endpoint, $options);
    }
} 