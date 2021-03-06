<?php
namespace Icecave\Temptation;

use Icecave\Isolator\Isolator;
use Phake;
use PHPUnit\Framework\TestCase;

class TemptationTest extends TestCase
{
    public function setUp()
    {
        $this->fileSystem = Phake::mock('Symfony\Component\Filesystem\Filesystem');
        $this->isolator = Phake::mock(Isolator::className());
        $this->temptation = new Temptation($this->fileSystem, $this->isolator);

        Phake::when($this->isolator)
            ->sys_get_temp_dir(Phake::anyParameters())
            ->thenReturn('/tmp');

        Phake::when($this->isolator)
            ->tempnam(Phake::anyParameters())
            ->thenReturn('/tmp/foo')
            ->thenReturn('/tmp/bar')
            ->thenReturn('/tmp/spam');

        Phake::when($this->isolator)
            ->mkdir(Phake::anyParameters())
            ->thenReturn(true);
    }

    public function testConstructorDefaults()
    {
        $temptation = new Temptation();

        $this->assertInstanceOf('Symfony\Component\Filesystem\Filesystem', $temptation->fileSystem());
    }

    public function testCreateDirectory()
    {
        $result = $this->temptation->createDirectory();

        Phake::inOrder(
            Phake::verify($this->isolator)->sys_get_temp_dir(),
            Phake::verify($this->isolator)->tempnam('/tmp', 'temptation-'),
            Phake::verify($this->isolator)->unlink('/tmp/foo'),
            Phake::verify($this->isolator)->mkdir('/tmp/foo', 0700)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\TemporaryDirectory', $result);
        $this->assertSame('/tmp/foo', $result->path());
        $this->assertSame($this->fileSystem, $result->fileSystem());
    }

    public function testCreateDirectoryFailure()
    {
        Phake::when($this->isolator)
            ->mkdir(Phake::anyParameters())
            ->thenReturn(false);

        $this->expectException(__NAMESPACE__ . '\Exception\TemporaryNodeCreationFailedException');

        try {
            $this->temptation->createDirectory();
        } catch (RuntimeException $e) {
            Phake::inOrder(
                Phake::verify($this->isolator)->sys_get_temp_dir(),
                Phake::verify($this->isolator)->tempnam('/tmp', 'temptation-'),
                Phake::verify($this->isolator)->unlink('/tmp/foo'),
                Phake::verify($this->isolator)->mkdir('/tmp/foo', 0700),
                Phake::verify($this->isolator)->unlink('/tmp/bar'),
                Phake::verify($this->isolator)->mkdir('/tmp/bar', 0700),
                Phake::verify($this->isolator)->unlink('/tmp/spam'),
                Phake::verify($this->isolator)->mkdir('/tmp/spam', 0700)
            );

            throw $e;
        }
    }

    public function testCreateFile()
    {
        $result = $this->temptation->createFile();

        Phake::inOrder(
            Phake::verify($this->isolator)->sys_get_temp_dir(),
            Phake::verify($this->isolator)->tempnam('/tmp', 'temptation-'),
            Phake::verify($this->isolator)->chmod('/tmp/foo', 0600)
        );

        $this->assertInstanceOf(__NAMESPACE__ . '\TemporaryFile', $result);
        $this->assertSame('/tmp/foo', $result->path());
        $this->assertSame($this->fileSystem, $result->fileSystem());
    }

    public function testFileSystem()
    {
        $this->assertSame($this->fileSystem, $this->temptation->fileSystem());
    }
}
