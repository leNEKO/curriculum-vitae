<?php

declare(strict_types=1);

namespace App\Cv;

class Periode
{
    public function __construct(
        public \DateTimeImmutable $start,
        public \DateTimeImmutable $end,
    ) {
    }

    public static function fromAtomStrings(
        string $start,
        string $end,
    ): self {
        return new self(
            \date_create_immutable($start),
            \date_create_immutable($end),
        );
    }

    public function __toString()
    {
        return \implode(
            ' - ',
            [
                $this->start->format('Y'),
                $this->end->format('Y'),
            ]
        );
    }
}
