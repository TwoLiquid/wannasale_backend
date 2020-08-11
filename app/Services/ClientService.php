<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Request;
use App\Repositories\ClientRepository;
use App\Repositories\RequestRepository;
use Illuminate\Database\Eloquent\Collection;

class ClientService
{
    /**
     * @param Client $client
     * @param Collection $oldClients
     * @param null|string $name
     * @param null|string $phone
     * @throws \Exception
     */
    public function mergeSimilar(
        Client $client,
        Collection $oldClients,
        ?string $name,
        ?string $phone
    ) : void
    {
        $clientRepo = app(ClientRepository::class);
        $requestRepo = app(RequestRepository::class);

        foreach ($oldClients as $oldClient) {
            $requestRepo->replaceClient(
                $client,
                $oldClient
            );

            $clientRepo->delete($oldClient);
        }

        $clientRepo->updateIfExist(
            $client,
            $name,
            $phone
        );
    }
}