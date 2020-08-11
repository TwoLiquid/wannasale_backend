<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\Site;
use App\Repositories\ItemRepository;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ItemsImport implements ToCollection
{
    protected $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function collection(Collection $rows)
    {
        $itemRepo = app(ItemRepository::class);

        foreach ($rows as $row)
        {
            if (!isset($row[0]) || !is_string($row[0])) {
                continue;
            }

            if (!isset($row[1]) || !is_string($row[1])) {
                continue;
            }

            if (!isset($row[2]) || !is_int($row[2])) {
                continue;
            }

            if (!isset($row[5]) || !is_string($row[5])) {
                continue;
            }

            $itemRepo->createForSite(
                $this->site->id,
                $row[0],
                $row[1],
                $row[2],
                isset($row[3]) && is_int($row[3]) ? $row[3] : null,
                isset($row[4]) && is_int($row[4]) ? $row[4] : null,
                $row[5]
            );
        }
    }
}