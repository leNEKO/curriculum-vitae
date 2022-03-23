<?php declare(strict_types=1);

namespace App\Cv;

class Competence
{
    public function __construct(
        public string $type,
        public string $techno,
        public int $level,
        public string $icons,
        public string $url,
        public bool $display,
    ) {}
}