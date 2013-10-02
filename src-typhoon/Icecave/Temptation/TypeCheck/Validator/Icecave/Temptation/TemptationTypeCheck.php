<?php
namespace Icecave\Temptation\TypeCheck\Validator\Icecave\Temptation;

class TemptationTypeCheck extends \Icecave\Temptation\TypeCheck\AbstractValidator
{
    public function validateConstruct(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount > 2) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(2, $arguments[2]);
        }
    }

    public function createDirectory(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount > 1) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        if ($argumentCount > 0) {
            $value = $arguments[0];
            if (!\is_int($value)) {
                throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentValueException(
                    'mode',
                    0,
                    $arguments[0],
                    'integer'
                );
            }
        }
    }

    public function createFile(array $arguments)
    {
        $argumentCount = \count($arguments);
        if ($argumentCount > 1) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(1, $arguments[1]);
        }
        if ($argumentCount > 0) {
            $value = $arguments[0];
            if (!\is_int($value)) {
                throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentValueException(
                    'mode',
                    0,
                    $arguments[0],
                    'integer'
                );
            }
        }
    }

    public function fileSystem(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

    public function generatePath(array $arguments)
    {
        if (\count($arguments) > 0) {
            throw new \Icecave\Temptation\TypeCheck\Exception\UnexpectedArgumentException(0, $arguments[0]);
        }
    }

}
