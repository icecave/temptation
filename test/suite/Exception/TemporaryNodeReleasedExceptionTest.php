<?php
namespace Icecave\Temptation\Exception;

use PHPUnit\Framework\TestCase;

class TemporaryNodeReleasedExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new TemporaryNodeReleasedException();

        $this->assertSame('Temporary node has already been released.', $exception->getMessage());
    }
}
