<?php

declare(strict_types=1);

namespace App\Cv;

class StackCollection
{
    /**
     * @param Competence[] $competences
     */
    public function __construct(public array $competences)
    {
    }
}
