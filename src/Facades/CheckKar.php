<?php

namespace PrimeKit\CheckKar\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \PrimeKit\CheckKar\CheckKar
 */
class CheckKar extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PrimeKit\CheckKar\CheckKar::class;
    }
}
