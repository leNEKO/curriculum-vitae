<?php declare(strict_types=1);

namespace App\Cv;

use Box\Spout\Common\Type;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Reader\CSV\Sheet;
use Box\Spout\Reader\CSV\SheetIterator;
use GuzzleHttp\Client;

class SheetReader
{
    public function __construct(
        private string $endpoint,
        private bool $reload
    ) {}

    public function read(): \Generator
    {
        $body = (new Client())->get($this->endpoint)->getBody();
        $stream = \tmpfile();

        while($line = $body->read(2048)) {
            \fwrite($stream, $line);
        }
        \fseek($stream, 0);

        $reader = ReaderFactory::createFromType(Type::CSV);
        $reader->open(\stream_get_meta_data($stream)['uri']);

        /** @var SheetIterator<Sheet> */
        $sheetIterator = $reader->getSheetIterator();
        $sheet = $sheetIterator->current();
        $rowIterator = $sheet->getRowIterator();

        $header = false;
        foreach($rowIterator as $row) {
            if ($header) {
                yield \array_combine(
                    $header,
                    $row->toArray(),
                );
            } else {
                $header = $row->toArray();
            }
        }

        \fclose($stream);
    }

    public function toArray(): array
    {
        return \iterator_to_array(
            $this->read()
        );
    }
}