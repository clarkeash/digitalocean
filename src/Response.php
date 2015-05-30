<?php namespace Rackr\DigitalOcean;

class Response
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param null $data
     */
    public function __construct($data = null)
    {
        if(!is_null($data))
        {
            $this->setData($data);
        }
    }

    /**
     * Static constructor.
     *
     * @param null $data
     * @return static
     */
    public static function make($data = null)
    {
        return new static($data);
    }

    /**
     * @param array|string $data
     * @return $this
     */
    public function setData($data)
    {
        if(!is_array($data) && !is_string($data)) throw new \InvalidArgumentException('Expected an array or string got a: ' . gettype($data));

        if(is_string($data))
        {
            $data = json_decode($data, true);
            if(json_last_error() !== JSON_ERROR_NONE) throw new \InvalidArgumentException;
        }

        $this->data = $data;
        return $this;
    }

    /**
     * @param $key
     * @return static
     */
    public function only($key)
    {
        if(! array_key_exists($key, $this->data)) throw new \InvalidArgumentException;
        return new static($this->data[$key]);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->data);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
} 