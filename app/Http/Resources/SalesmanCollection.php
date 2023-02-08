<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;

class SalesmanCollection extends ResourceCollection
{
    public function paginationInformation($request, $paginated, $default)
    {
        return Arr::only($default, 'links');
    }
}
