<?php
namespace Icecave\Temptation\Exception;

use Exception;

class TemporaryNodeCreationFailedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Failed to create temporary node.');
    }
}
