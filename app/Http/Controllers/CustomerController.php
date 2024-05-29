<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Customer;
use App\Models\recordsModel;
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


    public function getRecordsRequest(Request $request){
        $pageNo = 1;
        $perPage = 5;
        $recordId = $request->id;

        $data = Customer::where('recordId', $recordId)->paginate($perPage, ['*'], 'page', $pageNo);
        return $this->success([
            'data' => $data,
            'pagination' => [
              'total' => $data->total(),
              'current_page' => $data->currentPage(),
              'last_page' => $data->lastPage()
            ]
           ]);
    }


    public function getRecordsExport(Request $request){
        $recordId = $request->id;
        return Excel::download(new CustomersExport($recordId), 'customers.csv');
    }

    
    public function getRecords(Request $request){
        $pageNo = $request->input('page');
        $perPage = $request->input('perPage');
        $data = recordsModel::paginate($perPage,['*'], 'page', $pageNo);
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
    
            DB::beginTransaction();
    
            try {
                $record = new recordsModel;
                $record->recordId = trim($request->recordId);
                $record->recordName = trim($request->recordName);
                $record->recordDescription = trim($request->description);
                $record->author = trim($request->author);
    
                // Store the uploaded file
                $file = $request->file('fileUpload');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName);
                // Save the record to the database
                $record->save();
    
                // Prepare additional dynamic data
                $recordId = [
                    'recordId' => $request->input('recordId'), // Example of dynamic data
                ];
    
                // Dispatch import job
                Excel::import(new CustomerImport($recordId), $filePath);
    
                // Commit the transaction
                DB::commit();
    
                return $this->success([
                    'data' => 'File Imported successfully'
                ]);
            } catch (\Exception $e) {
                // Rollback the transaction if any operation fails
                DB::rollBack();
    
                // Delete the uploaded file to clean up
                if (Storage::disk('public')->exists('uploads/' . $fileName)) {
                    Storage::disk('public')->delete('uploads/' . $fileName);
                }
    
                // Return an error response
                return response()->json(['error' => 'File import failed: ' . $e->getMessage()], 500);
            }
        }


    public function deleteRecords($id){
            $res = Customer::where('recordId', $id)->delete();
            if($res){
              $res2 = recordsModel::where('recordId', $id)->delete(); 
              if($res2){
                return $this->success([
                    'message' => "Exams deleted Successfully"
                ]);
              }
            }
        }
}
