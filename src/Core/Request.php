<?php

namespace App\Core;

class Request
{
    public const METHOD_POST = 'POST';

    /** @var string */
    private $method;

    /** @var string */
    private $uri;

    /** @var array */
    private $jsonBody = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];

        if ($this->method === self::METHOD_POST) {
            $this->jsonBody = json_decode(file_get_contents('php://input'), true);
        }
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getJsonBody(): array
    {
        return $this->jsonBody;
    }
}