<?php
namespace Icecave\Temptation;

use Icecave\Isolator\Isolator;
use Icecave\Temptation\Exception\TemporaryNodeCreationFailedException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Creates temporary files and directories.
 */
class Temptation
{
    /**
     * @param Filesystem|null $fileSystem The filesystem object used to manipulate the file system.
     * @param Isolator|null   $isolator
     */
    public function __construct(Filesystem $fileSystem = null, Isolator $isolator = null)
    {
        if (null === $fileSystem) {
            $fileSystem = new Filesystem();
        }

        $this->fileSystem = $fileSystem;
        $this->isolator = Isolator::get($isolator);
    }

    /**
     * Create a temporary directory.
     *
     * The temporary directory will automatically be deleted once there are no more references to the returned object.
     *
     * @param integer $mode The mode/permissions of the created directory.
     *
     * @return TemporaryDirectory An object that controls the lifetime of the temporary directory.
     */
    public function createDirectory($mode = 0700)
    {
        $attempts = 3;

        while ($attempts--) {
            $path = $this->generatePath();
            $this->isolator->unlink($path);

            if (@$this->isolator->mkdir($path, $mode)) {
                return new TemporaryDirectory($path, $this->fileSystem);
            }
        }

        throw new TemporaryNodeCreationFailedException('Unable to create temporary directory.');
    }

    /**
     * Create a temporary file.
     *
     * The temporary file will automatically be deleted once there are no more references to the returned object.
     *
     * @param integer $mode The mode/permissions of the created file.
     *
     * @return TemporaryFile An object that controls the lifetime of the temporary file.
     */
    public function createFile($mode = 0600)
    {
        $path = $this->generatePath();
        $this->isolator->chmod($path, $mode);

        return new TemporaryFile($path, $this->fileSystem);
    }

    /**
     * The filesystem object used to manipulate the file system.
     *
     * @return Filesystem The filesystem object used to manipulate the file system.
     */
    public function fileSystem()
    {
        return $this->fileSystem;
    }

    /**
     * Generate a file at a unique temporary path.
     *
     * @return string The path to the temporary file.
     */
    protected function generatePath()
    {
        $path = $this->isolator->tempnam(
            $this->isolator->sys_get_temp_dir(),
            'temptation-'
        );

        return $path;
    }

    private $fileSystem;
    private $isolator;
}
