<?php


namespace App\Controller;


use App\Core\Request;

class Card
{
    /** @var string */
    private $cardNumber = '';

    /** @var string */
    private $cardHolder = '';

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     * @return Card
     */
    public function setCardNumber(string $cardNumber): Card
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getCardHolder(): string
    {
        return $this->cardHolder;
    }

    /**
     * @param string $cardHolder
     * @return Card
     */
    public function setCardHolder(string $cardHolder): Card
    {
        $this->cardHolder = $cardHolder;
        return $this;
    }

    /**
     * @param Request $request
     * @return Card
     */
    public static function fromRequest(Request $request)
    {
        return (new self)
            ->setCardHolder($request->getJsonBody()['cardholder'])
            ->setCardNumber($request->getJsonBody()['cardnumber'])
        ;
    }
}