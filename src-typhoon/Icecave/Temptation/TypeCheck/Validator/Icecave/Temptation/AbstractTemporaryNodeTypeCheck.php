<?php
namespace Icecave\Temptation\TypeCheck\Validator\Icecave\Temptation;

class AbstractTemporaryNodeTypeCheck extends \Icecave\Temptation\TypeCheck\AbstractValidator
{
    public function validateConstruct(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount < 2) {
            if ($argumentCount < 1) {
                throw new \Icecave\Temptation\TypeCheck\Exception\MissingArgumentException('path', 0, 'string');
            }
            throw new \Icecave\Temptation\TypeCheck\Exception\MissingArgumentException('fileSystem', 1, 'Symfony\\Component\\Filesystem\\Filesystem');
        } elseif ($argumentCount > 2) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(2, $arguments[2]);
        }
        $value = $arguments[0];
        if (!\is_string($value)) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentValueException(
                'path',
                0,
                $arguments[0],
                'string'
            );
        }
    }

    public function validateDestruct(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function path(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function delete(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function release(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function isReleased(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function fileSystem(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

}
