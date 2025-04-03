<?php

namespace App\Traits;

use Closure;

trait WithMemoized
{
    protected array $__memoized = [];

    protected function memoized(Closure $callback, string $key = null): mixed
    {
        if (!$key) {
            [$current, $caller] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

            $key = $caller['function'];
        }

        return $this->__memoized[$key] = isset($this->__memoized[$key])
            ? $this->__memoized[$key]
            : $callback();
    }
}
