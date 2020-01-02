<?php

namespace App\Core;

use App\Controller\BadRequestException;
use App\Controller\CardValidator;
use App\Controller\Controller;

class Application
{
    private $classContainer = [];

    /** @var array */
    private $routes = [
        '/validate' => ['webApi', 'validateCard']
    ];

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $cardValidator = new CardValidator();
        $this->classContainer['webApi'] = new Controller($cardValidator);
    }

    /**
     * @param Request $request
     * @return void
     * @throws BadRequestException
     */
    public function run(Request $request)
    {
        /** @var Response $response */
        $response = null;
        if (array_key_exists($request->getUri(), $this->routes)) {
            $response = call_user_func([
                $this->classContainer[$this->routes[$request->getUri()][0]],
                $this->routes[$request->getUri()][1],
            ], $request);
        }

        if ($response === null) {
            throw new BadRequestException('Undefined method call');
        }
        foreach ($response->getHeaders() as $h) {
            header($h);
        }
        die($response->getBody());
    }
}