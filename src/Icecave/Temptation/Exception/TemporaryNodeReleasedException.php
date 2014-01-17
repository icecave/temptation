<?php
namespace Icecave\Temptation\Exception;

use Exception;

class TemporaryNodeReleasedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Temporary node has already been released.');
    }
}
