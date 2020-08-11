<?php

namespace App\Services;

use App\Exports\ClientExport;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

class ExcelService {

    public function exportVendorClients(
        Vendor $vendor
    )
    {
        return Excel::download(new ClientExport($vendor), 'clients.xls');
    }
}