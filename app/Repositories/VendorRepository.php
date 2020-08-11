<?php

namespace App\Repositories;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VendorRepository
{
    /**
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $paginateBy = 30, int $page = null) : LengthAwarePaginator
    {
        return Vendor::query()
            ->orderBy('created_at', 'desc')
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param string $id
     * @return Vendor|null
     */
    public function findById(string $id) : ?Vendor
    {
        /** @var Vendor|null $vendor */
        $vendor = Vendor::query()
            ->with('users')
            ->find($id);

        return $vendor;
    }

    /**
     * @param string $name
     * @param string $slug
     * @param bool $active
     * @param int $site_max
     * @return Vendor
     */
    public function create(
        string $name,
        string $slug,
        bool $active = true,
        int $site_max
    ) : Vendor {
        return Vendor::create([
            'name'   => $name,
            'slug'   => $slug,
            'active' => $active,
            'site_max' => $site_max
        ]);
    }

    /**
     * @param Vendor $vendor
     * @param string $name
     * @param string $slug
     * @param bool $active
     * @param int $site_max
     * @return Vendor
     */
    public function update(
        Vendor $vendor,
        string $name,
        string $slug,
        bool $active = true,
        int $site_max
    ) : Vendor {
        $vendor->update([
            'name'   => $name,
            'slug'   => $slug,
            'active' => $active,
            'site_max' => $site_max
        ]);

        return $vendor;
    }

    /**
     * @param Vendor $vendor
     * @param string $name
     * @return Vendor
     */
    public function setName(
        Vendor $vendor,
        string $name
    ) : Vendor
    {
        $vendor->update([
            'name'   => $name,
        ]);

        return $vendor;
    }

    /**
     * @param Vendor $vendor
     * @throws \Exception
     */
    public function delete(Vendor $vendor) : void
    {
        $vendor->delete();
    }

    /**
     * @param Vendor $vendor
     * @param User $user
     */
    public function syncUsers(
        Vendor $vendor,
        User $user
    ) : void
    {
        $vendor->users()->detach($user->id);
        $vendor->users()->attach($user->id);
    }

    /**
     * @param string $slug
     * @return Vendor|null
     */
    public function findActiveBySlug(string $slug) : ?Vendor
    {
        return Vendor::query()
            ->where('active', true)
            ->where('slug', $slug)
            ->first();
    }

    /**
     * @param User $user
     * @return Vendor|null
     */
    public function findFirstActiveForUser(User $user) : ?Vendor
    {
        return $user->vendors()
            ->where('active', true)
            ->first();
    }

    /**
     * @param User $user
     * @return Collection|Vendor[]
     */
    public function getActiveForUser(User $user) : Collection
    {
        return $user->vendors()
            ->where('active', true)
            ->get();
    }

    /**
     * @param User $user
     * @param Vendor $vendor
     * @return bool
     */
    public function canBeAccessedByUser(Vendor $vendor, User $user) : bool
    {
        return DB::table('user_vendor')
            ->where('user_id', $user->getKey())
            ->where('vendor_id', $vendor->getKey())
            ->exists();
    }
}
