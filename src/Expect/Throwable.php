<?php

declare(strict_types=1);

namespace EasyTest\Expect;

/**
 * Represent a thrown exception/error. Used in ToThrow.
 */
final class Throwable
{
    /** @var string|null */
    public $class;
    /** @var string|null */
    public $message;
    /** @var int|null */
    public $code;
    /** @var Throwable|null */
    public $previous;

    public function __construct(?string $class = null, ?string $message = null, ?int $code = null, ?Throwable $previous = null)
    {
        $this->class    = $class;
        $this->message  = $message;
        $this->code     = $code;
        $this->previous = $previous;
    }
}
