<?php

namespace Dreamr\OneSignalChannel;

class OneSignalMessage
{
    private $body;
    private $data = [];

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function data($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function body(string $body)
    {
        $this->body = $body;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getData()
    {
        return $this->data;
    }
}
