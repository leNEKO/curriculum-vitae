<?php

namespace App\Cv;

class CompetenceService
{
    /** @var Competence[] */
    private array $data;

    public function __construct(
        private \Iterator $iterator
    ) {}

    /** @return Competence[] */
    public function getData() {
        return $this->data ??= \iterator_to_array(
            $this->load()
        );
    }
    private function load(): \Generator
    {
        foreach($this->iterator as $row) {
            yield new Competence(
                $row['Type'],
                $row['Techno'],
                (int) $row['Level'],
                $row['Icon'],
                $row['URL'],
                (bool) \trim($row['Display']),
            );
        }
    }

    /** @return \Generator<Competence> */
    public function getByType(string $type): \Generator {
        foreach($this->getData() as $competence) {
            if ($competence->type === $type
                && $competence->display
            ) {
                yield $competence;
            }
        };
    }

    /** @return array<array<Competence>> */
    public function getGroupedByLevel(string $type) {
        $grouped = [];
        foreach($this->getByType($type) as $competence) {
            $grouped[$competence->level][] = $competence;
        }

        krsort($grouped);

        return $grouped;
    }
}