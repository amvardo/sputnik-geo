<?php

/*
 * This file is part of the php-skeleton package.
 *
 * (c) Alex Malozemov <is.malozemov@ya.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Anklaav\Sputnik;

class Sputnik
{
    private $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function negate()
    {
        return new Sputnik(-1 * $this->amount);
    }
}