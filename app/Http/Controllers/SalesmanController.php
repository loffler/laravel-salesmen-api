<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalesmanRequest;
use App\Http\Resources\SalesmanResource;
use App\Models\Salesman;
use Illuminate\Http\Request;

class SalesmanController extends Controller
{
    public function index()
    {
//        $salesmen = Salesman::orderBy('id','desc')->paginate(5);
//        return view('salesmen.index', compact('salesmen'));
        $salesmen = Salesman::all();
        return SalesmanResource::collection($salesmen);
    }

    public function create()
    {
        return view('salesmen.create');
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
}
