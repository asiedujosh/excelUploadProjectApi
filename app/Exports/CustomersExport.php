<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{

    protected $recordId;

    public function __construct($recordId)
    {
        $this->recordId = $recordId;
    }
    /**
    * @return \Illuminate\Support\Collection
    */

    public function query()
    {
        return Customer::query()->where('recordId', $this->recordId)
            ->select([
                "recordId",
                "domain",
                "subDomain",
                "category",
                "subCategory",
                "healthOutcome",
                "variable",
                "variableName",
                "variableDescription",
                "sex",
                "race",
                "ethnicity",
                "age",
                "geography",
                "dataUnit",
                "dataYear",
                "dataSourceName",
                "dataSource",
                "dataPortalName",
                "dataPortal",
                "dataFormat",
                "dataLocation",
                "accessedDate",
                "processed",
                "note"
            ]);
    }
    
    public function collection()
    {
            return Customer::all([
                "recordId",
                "domain",
                "subDomain",
                "category",
                "subCategory",
                "healthOutcome",
                "variable",
                "variableName",
                "variableDescription",
                "sex",
                "race",
                "ethnicity",
                "age",
                "geography",
                "dataUnit",
                "dataYear",
                "dataSourceName",
                "dataSource",
                "dataPortalName",
                "dataPortal",
                "dataFormat",
                "dataLocation",
                "accessedDate",
                "processed",
                "note"
            ]);
        
    }

    public function headings(): array
    {
        return [
            'Record ID',
            'Domain',
            'SubDomain',
            'Category',
            'SubCategory',
            'Health Outcome',
            'Variable',
            'Variable Name',
            'Variable Description',
            'Sex',
            'Race',
            'Ethnicity',
            'Age',
            'Geography',
            'Data Unit',
            'Data Year',
            'Data Source Name',
            'Data Source',
            'Data Portal Name',
            'Data Portal',
            'Data Format',
            'Data Location',
            'Accessed Date',
            'Processed',
            'Note'
        ];
    }
}
