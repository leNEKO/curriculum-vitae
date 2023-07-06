<?php

declare(strict_types=1);

namespace App\Cv;

class ExperienceCollection
{
    /**
     * @param Experience[] $experiences 
     */
    public function __construct(public array $experiences)
    {
    }
}
