<?php

namespace App\Repositories;

use App\Models\Rate;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RateRepository
{
    /**
     * @return Collection
     */
    public function getAll() : Collection
    {
        return Rate::query()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findById(string $id) : ?Rate
    {
        /** @var Rate|null $item */
        $item = Rate::query()
            ->find($id);

        return $item;
    }

    /**
     * @return Rate|null
     */
    public function getDefault() : ?Rate
    {
        /** @var Rate|null $item */
        $item = Rate::query()->where('default', '=', 1)
            ->first();

        return $item;
    }

    /**
     * @param Rate $rate
     * @throws \Exception
     */
    public function delete(Rate $rate) : void
    {
        $rate->delete();
    }
}
