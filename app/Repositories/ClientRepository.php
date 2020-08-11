<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Request;
use App\Models\Site;
use App\Models\Vendor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository
{
    /**
     * @param Vendor $vendor
     * @param int $paginateBy
     * @param int|null $page
     * @return LengthAwarePaginator|Collection|Client[]
     */
    public function getByVendorPaginated(Vendor $vendor, int $paginateBy = 30, int $page = null) : LengthAwarePaginator
    {
        return $vendor->clients()
            ->paginate($paginateBy, ['*'], 'page', $page);
    }

    /**
     * @param Vendor $vendor
     * @return Collection
     */
    public function getByVendor(Vendor $vendor) : Collection
    {
        return $vendor->clients()
                      ->orderBy('created_at', 'desc')
                      ->get();
    }

    /**
     * @param Vendor $vendor
     * @param array $fields
     * @return Collection
     */
    public function getByVendorWithFields(Vendor $vendor, array $fields = []) : Collection
    {
        return $vendor->clients()
            ->orderBy('created_at', 'desc')
            ->get($fields);
    }

    /**
     * @param string $id
     * @return Client|null
     */
    public function findById(string $id) : ?Client
    {
        /** @var Client|null $client */
        $client = Client::query()->find($id);

        return $client;
    }

    /**
     * @param Vendor $vendor
     * @param array $ids
     * @return Collection|null
     */
    public function findByIds(Vendor $vendor, array $ids) : ?Collection
    {
        $clients = $vendor->clients()->whereIn('id', $ids)->get();

        return $clients;
    }

    /**
     * @param Vendor $vendor
     * @param Collection $clients
     * @return array
     */
    public function getSimilarIds(
        Vendor $vendor,
        Collection $clients
    ) : array
    {
        $ids = [];

        foreach ($clients as $client) {
            $result = $this->similarClientsExist($vendor, $client);

            if ($result) {
                $ids[] = $client->id;
            }
        }

        return $ids;
    }

    /**
     * @param Vendor $vendor
     * @param Client $client
     * @return bool
     */
    public function similarClientsExist(Vendor $vendor, Client $client) : bool
    {
        $result = $vendor->clients()->where('id', '<>', $client->id)
            ->where('email', '=', $client->email)
            ->exists();

        return $result;
    }

    /**
     * @param Vendor $vendor
     * @param Client $client
     * @return Collection
     */
    public function getSimilar(Vendor $vendor, Client $client) : Collection
    {
        $similarClients = Client::query()->where('id', '<>', $client->id)
            ->where('vendor_id', '=', $vendor->id)
            ->where('email', '=', $client->email)
            ->get();

        return $similarClients;
    }

    /**
     * @param Vendor $vendor
     * @param string $name
     * @param string $email
     * @param null|string $phone
     * @return Client|null
     */
    public function getByInfo(
        Vendor $vendor,
        string $name,
        string $email,
        ?string $phone
    ) : ?Client
    {
        $result = $vendor->clients()->where('name', '=', $name)
            ->where('email', '=', $email)
            ->where('phone', '=', $phone)
            ->first();

        return $result;
    }

    /**
     * @param Vendor $vendor
     * @param string $name
     * @param string $email
     * @param string $phone
     * @return Client
     */
    public function create(
        Vendor $vendor,
        string $name,
        string $email,
        ?string $phone
    ) : Client {
        return Client::create([
            'vendor_id' => $vendor->id,
            'name'      => $name,
            'email'     => $email,
            'phone'     => $phone
        ]);
    }

    /**
     * @param Client $client
     * @param string $name
     * @param string $email
     * @param string $phone
     * @return Client
     */
    public function update(
        Client $client,
        string $name,
        string $email,
        string $phone
    ) : Client {
        $client->update([
            'name'  => $name,
            'email' => $email,
            'phone' => $phone
        ]);

        return $client;
    }

    /**
     * @param Client $client
     * @param null|string $name
     * @param null|string $phone
     * @return Client
     */
    public function updateIfExist(
        Client $client,
        ?string $name,
        ?string $phone
    ) : Client
    {
        if ($name !== null) {
            $client->name = $name;
        }

        if ($phone !== null) {
            $client->phone = $phone;
        }

        $client->save();

        return $client;
    }

    /**
     * @param Client $client
     * @throws \Exception
     */
    public function delete(Client $client) : void
    {
        $client->delete();
    }
}
