<?php

declare(strict_types=1);

namespace EasyTest\Expect\Expectation;

use function get_class;
use function gettype;
use function is_array;
use function is_object;
use function is_resource;
use function is_string;
use function method_exists;

abstract class Expectation
{
    /**
     * Checks if the the expectation is met.
     */
    abstract public function matches(): bool;

    /**
     * The error message if the assertion fails
     */
    abstract public function error(): string;

    /**
     * @param mixed $value
     */
    protected static function valueToString($value): string
    {
        if ($value === null) {
            return 'null';
        }
        if ($value === true) {
            return 'true';
        }
        if ($value === false) {
            return 'false';
        }
        if (is_array($value)) {
            return 'array';
        }
        if (is_object($value)) {
            if (method_exists($value, '__toString')) {
                return get_class($value) . ': ' . self::valueToString($value->__toString());
            }

            return get_class($value);
        }
        if (is_resource($value)) {
            return 'resource';
        }
        if (is_string($value)) {
            return '"' . $value . '"';
        }

        return (string) $value;
    }

    /**
     * @param mixed $value
     */
    protected static function typeToString($value): string
    {
        return is_object($value) ? get_class($value) : gettype($value);
    }
}
