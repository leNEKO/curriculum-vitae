<?php

declare(strict_types=1);

namespace App\Cv;

class Experience
{
    public function __construct(
        public Periode $periode,
        public string $poste,
        public string $entreprise,
        public TacheCollection $tacheCollection,
        public StackCollection $stackCollection,
    ) {
    }
}
