<?php
namespace Icecave\Temptation;

use Exception;
use Phake;
use PHPUnit_Framework_TestCase;

class AbstractTemporaryNodeTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->path = '/tmp/foo';
        $this->fileSystem = Phake::mock('Symfony\Component\Filesystem\Filesystem');
        $this->node = new TemporaryFile($this->path, $this->fileSystem);
    }

    public function testPath()
    {
        $this->assertSame($this->path, $this->node->path());
    }

    public function testPathWhenReleased()
    {
        $this->node->release();

        $this->setExpectedException(__NAMESPACE__ . '\Exception\TemporaryNodeReleasedException');
        $this->node->path();
    }

    public function testFileSystem()
    {
        $this->assertSame($this->fileSystem, $this->node->fileSystem());
    }

    public function testDelete()
    {
        $this->node->delete();
        Phake::verify($this->fileSystem)->remove($this->path);
        $this->assertTrue($this->node->isReleased());
    }

    public function testDeleteWhenReleased()
    {
        $this->node->release();

        $this->setExpectedException(__NAMESPACE__ . '\Exception\TemporaryNodeReleasedException');
        try {
            $this->node->delete();
        } catch (Exception $e) {
            Phake::verifyNoInteraction($this->fileSystem);
            throw $e;
        }
    }

    public function testRelease()
    {
        $this->assertSame($this->path, $this->node->release());
        $this->assertTrue($this->node->isReleased());
    }

    public function testIsReleased()
    {
        $this->assertFalse($this->node->isReleased());
        $this->node->release();
        $this->assertTrue($this->node->isReleased());
    }

    public function testDestructor()
    {
        $this->node->__destruct();

        Phake::verify($this->fileSystem)->remove($this->path);
    }

    public function testDestructorWhenReleased()
    {
        $this->node->release();
        $this->node->__destruct();

        Phake::verifyNoInteraction($this->fileSystem);
    }
}
