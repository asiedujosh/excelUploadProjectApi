<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Customer;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use HttpResponses;
    //

    public function index(Request $request){
        $pageNo = $request->input('page');
        $perPage = $request->input('perPage');
        $data = Customer::paginate($perPage, ['*'], 'page', $pageNo);
            return $this->success([
                'data' => $data,
                'pagination' => [
                  'total' => $data->total(),
                  'current_page' => $data->currentPage(),
                  'last_page' => $data->lastPage()
                ]
               ]);
        }


    public function countData(){
            $countData = Customer::count();
            return $this->success([
              'data' => $countData
            ]);
        }


    public function uploadExcel(Request $request){
        // $request->validate([
        //     'import_file' => ['required', 'file']
        // ]);

        // Excel::import(new CustomerImport, $request->file('import_file'));

        // return response()->json([
        //     'message' => 'Data Imported Successfully',
        // ]);


        // Store the uploaded file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName);

       // Dispatch import job
       Excel::import(new CustomerImport(), 'uploads/' . $fileName);

       return $this->success([
        'data' => 'File Imported successfully'
        ]);
    }
}
