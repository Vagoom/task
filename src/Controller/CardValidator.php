<?php


namespace App\Controller;


use App\Services\LuhnAlgorithm;

class CardValidator
{
    /**
     * @param Card $card
     * @return bool
     */
    public function validate($card)
    {
        return $this->isCardNumberValid($card->getCardNumber())
            && $this->isCardHolderValid($card->getCardHolder())
            && LuhnAlgorithm::check($card->getCardNumber())
        ;
    }

    /**
     * @param string $value
     * @return bool
     */
    private function isCardNumberValid($value)
    {
        return preg_match('/^[0-9]+$/', $value) === 1;
    }

    /**
     * @param string $value
     * @return bool
     */
    private function isCardHolderValid($value)
    {
        return preg_match('/^[A-Za-z]+ [A-Za-z]+$/', $value) === 1;
    }
}