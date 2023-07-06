<?php

namespace App\Cv;

use Cocur\Slugify\Slugify;

class CompetenceService
{
    /** @var Competence[] */
    private array $data;

    public function __construct(
        private \Iterator $iterator,
        private Slugify $slugify,
    ) {
    }

    /** @return Competence[] */
    public function getData()
    {
        return $this->data ??= \iterator_to_array(
            $this->load()
        );
    }

    private function load(): \Generator
    {
        foreach ($this->iterator as $row) {
            yield $this->slugify->slugify($row['Techno']) => new Competence(
                $row['Type'],
                $row['Techno'],
                (int) $row['Level'],
                $row['Icon'] ?: null,
                $row['URL'] ?: null,
                (bool) \trim($row['Display']),
            );
        }
    }

    public function getByName(string $name): Competence
    {
        return ($this->getData()[$name]
            ?? new Competence(
                'UNKNOWN',
                $name,
                -1,
                'fa-solid fa-question',
                '',
                false
            )
        );
    }

    /** @return \Generator<Competence> */
    public function getByType(string $type): \Generator
    {
        foreach ($this->getData() as $competence) {
            if (
                $competence->type === $type
                && $competence->display
            ) {
                yield $competence;
            }
        };
    }

    /** @return array<array<Competence>> */
    public function getGroupedByLevel(string $type)
    {
        $grouped = [];
        foreach ($this->getByType($type) as $competence) {
            $grouped[$competence->level][] = $competence;
        }

        krsort($grouped);

        return $grouped;
    }
}
