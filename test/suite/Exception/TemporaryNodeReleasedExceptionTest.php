<?php
namespace Icecave\Temptation\Exception;

use PHPUnit_Framework_TestCase;

class TemporaryNodeReleasedExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $exception = new TemporaryNodeReleasedException;

        $this->assertSame('Temporary node has already been released.', $exception->getMessage());
    }
}
