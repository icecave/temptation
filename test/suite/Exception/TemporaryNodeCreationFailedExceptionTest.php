<?php
namespace Icecave\Temptation\Exception;

use PHPUnit\Framework\TestCase;

class TemporaryNodeCreationFailedExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new TemporaryNodeCreationFailedException();

        $this->assertSame('Failed to create temporary node.', $exception->getMessage());
    }
}
