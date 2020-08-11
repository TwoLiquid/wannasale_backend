<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\Vendor;
use App\Repositories\ClientRepository;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClientExport implements FromCollection
{
    protected $vendor;

    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    public function collection()
    {
        $clientRepo = app(ClientRepository::class);
        $vendorClients = $clientRepo->getByVendorWithFields($this->vendor, ['name', 'email', 'phone']);

        return $vendorClients;
    }
}