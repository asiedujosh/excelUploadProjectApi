<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'recordId',
        'domain',
        'subDomain',
        'category',
        'subCategory',
        'healthOutcome',
        'variable',
        'variableName',
        'variableDescription',
        'sex',
        'race',
        'ethnicity',
        'age',
        'geography',
        'dataUnit',
        'dataYear',
        'dataSourceName',
        'dataSource',
        'dataPortalName',
        'dataPortal',
        'dataFormat',
        'dataLocation',
        'accessedDate',
        'processed',
        'note'
    ];
}
