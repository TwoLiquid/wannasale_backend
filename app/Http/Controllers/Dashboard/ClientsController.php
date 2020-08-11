<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Client\CreateRequest;
use App\Http\Requests\Dashboard\Client\MergeRequest;
use App\Models\Client;
use App\Models\Vendor;
use App\Repositories\ClientRepository;
use App\Services\ClientService;
use App\Services\ExcelService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientsController extends BaseController
{
    public function index(ClientRepository $clientRepo)
    {
        $vendor = $this->getVendor();
        $clients = $clientRepo->getByVendor($vendor);
        $paginatedClients = $clientRepo->getByVendorPaginated($vendor);

        $similar = $clientRepo->getSimilarIds($vendor, $clients);

        return view('dashboard.clients.index', [
            'clients' => $paginatedClients,
            'similar' => $similar
        ]);
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(CreateRequest $request, ClientRepository $clientRepo)
    {
        $vendor = $this->getVendor();

        $client = $clientRepo->create(
            $vendor,
            $request->input('name'),
            $request->input('email'),
            $request->input('phone')
        );

        if ($client === null) {
            return $this->error(
                'Не удалось добавить клиента.',
                route('dashboard.clients')
            );
        }

        return $this->success(
            'Пользователь успешно добавлен.',
            route('dashboard.clients')
        );
    }

    public function getSimilar($id, Request $request, ClientRepository $clientRepo) : JsonResponse
    {
        $vendor = $this->getVendor();
        $client = $clientRepo->findById($id);

        if ($client === null) {
            return $this->respondWithError('Клиент не найден.');
        }

        $similarClients = $clientRepo->getSimilar($vendor, $client);

        return $this->respondWithSuccess([
            'similar' => $similarClients
        ], 'Список похожих клиентов получен');
    }

    public function updateSimilar($id, MergeRequest $request, ClientRepository $clientRepo, ClientService $clientService)
    {
        $vendor = $this->getVendor();
        $client = $clientRepo->findById($id);
        $oldClients = $clientRepo->findByIds($vendor, $request->input('clients'));

        $clientService->mergeSimilar(
            $client,
            $oldClients,
            $request->input('name'),
            $request->input('phone')
        );

        return redirect()->route('dashboard.clients');
    }

    public function excel(ExcelService $service)
    {
        $vendor = $this->getVendor();

        return $service->exportVendorClients($vendor);
    }

    public function delete(string $id, ClientRepository $clientRepo)
    {
        $client = $clientRepo->findById($id);
        if ($client === null) {
            return $this->error(
                'Пользователь не найден.',
                route('dashboard.clients')
            );
        }

        $clientRepo->delete($client);

        return $this->warning(
            'Пользователь удалён.',
            route('dashboard.clients')
        );
    }
}
