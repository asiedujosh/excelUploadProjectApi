<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    //
    public function exportCustomers(Request $request)
    {
        $format = $request->query('format', 'csv'); // Default to 'csv' if no format is provided

        if ($format === 'excel') {
            return Excel::download(new CustomersExport, 'customers.xlsx');
        } else {
            return Excel::download(new CustomersExport, 'customers.csv', \Maatwebsite\Excel\Excel::CSV);
        }
    }
}
