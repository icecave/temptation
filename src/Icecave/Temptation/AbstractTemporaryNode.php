<?php
namespace Icecave\Temptation;

use Icecave\Temptation\TypeCheck\TypeCheck;
use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractTemporaryNode
{
    /**
     * @param string $path The path to the temporary file or directory.
     * @param Filesystem $fileSystem The filesystem object used to manipulate the file system.
     */
    public function __construct($path, Filesystem $fileSystem)
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->path = $path;
        $this->fileSystem = $fileSystem;
    }

    public function __destruct()
    {
        if ($this->isReleased()) {
            return;
        }

        try {
            $this->fileSystem->remove($this->path);
        } catch (Exception $e) {
            // ignore exceptions in destructor ...
        }
    }

    /**
     * Fetch the path of the temporary file or directory.
     *
     * @return string The path of the temporary file or directory.
     * @throws Exception\ObjectReleasedException if the object has been released previously.
     */
    public function path()
    {
        $this->typeCheck->path(func_get_args());

        if ($this->isReleased()) {
            throw new Exception\ObjectReleasedException;
        }

        return $this->path;
    }

    /**
     * Release and delete the temporary file/directory immediately.
     */
    public function delete()
    {
        $this->typeCheck->delete(func_get_args());

        $this->fileSystem->remove($this->path);
        $this->release();
    }

    /**
     * Release the temporary file or directory from the control of the Temptation library.
     *
     * The file must be deleted manually by the user. Future calls to {@see AbstractTemporaryNode::path()} will fail.
     *
     * @return string The path to the file.
     */
    public function release()
    {
        $this->typeCheck->release(func_get_args());

        $this->fileSystem = null;

        return $this->path;
    }

    /**
     * Check if the temporary file or directory has been released.
     *
     * @return boolean True if the file or directory has been released from management; otherwise, false.
     */
    public function isReleased()
    {
        $this->typeCheck->isReleased(func_get_args());

        return null === $this->fileSystem;
    }

    /**
     * Get the filesystem object used to delete the temporary file or directory.
     *
     * @return Filesystem|null The filesystem object used to delete the temporary file or directory, or null if the object has been released.
     */
    public function fileSystem()
    {
        $this->typeCheck->fileSystem(func_get_args());

        return $this->fileSystem;
    }

    private $typeCheck;
    private $path;
    private $fileSystem;
}
