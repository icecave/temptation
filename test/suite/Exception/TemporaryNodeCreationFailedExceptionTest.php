<?php
namespace Icecave\Temptation\Exception;

use PHPUnit_Framework_TestCase;

class TemporaryNodeCreationFailedExceptionTest extends PHPUnit_Framework_TestCase
{
    public function testException()
    {
        $exception = new TemporaryNodeCreationFailedException();

        $this->assertSame('Failed to create temporary node.', $exception->getMessage());
    }
}
