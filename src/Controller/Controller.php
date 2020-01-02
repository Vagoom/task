<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;

class Controller
{
    /** @var CardValidator */
    private $cardValidator;

    /**
     * Controller constructor.
     * @param CardValidator $cardValidator
     */
    public function __construct(CardValidator $cardValidator)
    {
        $this->cardValidator = $cardValidator;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws BadRequestException
     */
    public function validateCard(Request $request)
    {
        if ($request->getMethod() === Request::METHOD_POST) {

            return (new Response)
                ->setHeaders(['Content-type: application/json'])
                ->setBody(json_encode(['status' =>
                    $this->cardValidator->validate(
                        Card::fromRequest($request)
                    ) ? 'ok' : 'error'
                ]))
            ;
        } else {
            throw new BadRequestException('Method Not Supported');
        }
    }
}