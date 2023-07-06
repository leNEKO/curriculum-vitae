<?php

declare(strict_types=1);

namespace App\Cv;

trait SingletonTrait
{
    private static $instance;

    public static function getInstance(...$args): self
    {
        return static::$instance ??= new static(...$args);
    }
}
