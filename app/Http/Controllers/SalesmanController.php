<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalesmanRequest;
use App\Http\Resources\SalesmanCollection;
use App\Http\Resources\SalesmanResource;
use App\Models\Salesman;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    public function index(Request $request, Salesman $salesman)
    {
        $sort = $request->input('sort');

        $builder = Salesman::query();
        if ($sort) {
            $orderByColumn = ltrim($sort, '-');
            $orderByDirection = $sort[0] === '-' ? 'DESC' : 'ASC';
            if (in_array($orderByColumn, $salesman->sortable)) {
                $builder->orderBy($orderByColumn, $orderByDirection);
            }
        }
        return new SalesmanCollection($builder->paginate($request->input('per_page')));
    }

    public function store(CreateSalesmanRequest $request)
    {
        $salesmen = Salesman::create($request->all());
        return new SalesmanResource($salesmen);
    }

    public function update(CreateSalesmanRequest $request, Salesman $salesman)
    {
        $salesman->update($request->all());
        return new SalesmanResource($salesman);
    }

    public function destroy(Salesman $salesman)
    {
        $salesman->delete();
        return response(null, 204);
    }

    public function show(Salesman $salesman)
    {
        return new SalesmanResource($salesman);
    }
}
