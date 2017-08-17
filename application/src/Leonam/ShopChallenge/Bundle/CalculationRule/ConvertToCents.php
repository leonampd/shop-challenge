<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\CalculationRule;


trait ConvertToCents
{
    public function convertToCents($value) {
        return $value * 100;
    }
}