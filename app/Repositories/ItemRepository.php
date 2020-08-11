<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\Site;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ItemRepository
{
    /**
     * @param string $id
     * @return Item|null
     */
    public function findById(string $id) : ?Item
    {
        /** @var Item|null $item */
        $item = Item::query()
            ->with('site')
            ->find($id);

        return $item;
    }

    /**
     * @param Site $site
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getForSitePaginated(Site $site, int $paginateBy = 30, int $page = null) : LengthAwarePaginator
    {
        return $site->items()
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param Site $site
     * @return Collection
     */
    public function getForSite(Site $site) : Collection
    {
        return $site->items()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @param Site $site
     * @param string $name
     * @param string $code
     * @param int $initialPrice
     * @param int $minAcceptablePrice
     * @param int $minUnacceptablePrice
     * @param array|null $urls
     * @return Item
     */
    public function createForSite(
        Site $site,
        string $name,
        string $code,
        int $initialPrice,
        int $minAcceptablePrice,
        int $minUnacceptablePrice,
        array $urls = null
    ) : Item {

        /** @var Item $item */
        $item = $site->items()
            ->create([
                'name'                      => $name,
                'code'                      => $code,
                'initial_price'             => $initialPrice,
                'min_acceptable_price'      => $minAcceptablePrice,
                'min_unacceptable_price'    => $minUnacceptablePrice,
                'urls'                      => $urls
            ]);

        return $item;
    }

    /**
     * @param Item $item
     * @param string $name
     * @param string $code
     * @param int $initialPrice
     * @param int $minAcceptablePrice
     * @param int $minUnacceptablePrice
     * @param array|null $urls
     * @return Item
     */
    public function update(
        Item $item,
        string $name,
        string $code,
        int $initialPrice,
        int $minAcceptablePrice,
        int $minUnacceptablePrice,
        array $urls = null
    ) : Item {
        $item->update([
            'name' => $name,
            'code' => $code,
            'initial_price'             => $initialPrice,
            'min_acceptable_price'      => $minAcceptablePrice,
            'min_unacceptable_price'    => $minUnacceptablePrice,
            'urls' => $urls
        ]);

        return $item;
    }

    /**
     * @param Item $item
     * @throws \Exception
     */
    public function delete(Item $item) : void
    {
        $item->delete();
    }
}