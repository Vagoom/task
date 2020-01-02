<?php

namespace App\Services;

class LuhnAlgorithm
{
    /**
     * @param string $digits
     * @return bool
     */
    public static function check($digits)
    {
        $number = strrev(preg_replace('/[^\d]/', '', $digits));
        $sum = 0;
        for ($i = 0, $j = strlen($number); $i < $j; $i++) {
            if (($i % 2) == 0) {
                $val = $number[$i];
            } else {
                $val = $number[$i] * 2;
                if ($val > 9)  {
                    $val -= 9;
                }
            }
            $sum += $val;
        }
        return (($sum % 10) === 0);
    }
}