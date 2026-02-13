<?php

namespace Golampi\Exceptions;

use Exception;
use Golampi\Runtime\Value;

/**
 * Excepción para manejar la sentencia break
 */
class BreakException extends Exception
{
    public function __construct()
    {
        parent::__construct("break");
    }
}

/**
 * Excepción para manejar la sentencia continue
 */
class ContinueException extends Exception
{
    public function __construct()
    {
        parent::__construct("continue");
    }
}

/**
 * Excepción para manejar la sentencia return
 */
class ReturnException extends Exception
{
    private Value $returnValue;

    public function __construct(Value $returnValue)
    {
        parent::__construct("return");
        $this->returnValue = $returnValue;
    }

    public function getReturnValue(): Value
    {
        return $this->returnValue;
    }
}