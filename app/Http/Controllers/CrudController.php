<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrudRequest;
use App\Models\Crud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud = Crud::get();
        return view('crud.index', ['crud' => $crud]);
        // return response()->json($crud, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CrudRequest $request)
    {
        try {
            DB::beginTransaction();
            $request = $request->validated();
            Crud::create($request);
            DB::commit();
            return redirect()->route('crud.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return route('404');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Crud $crud)
    {
        return view('crud.detail', compact('crud'));
        // return view('crud.detail', ['crud' => $crud]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Crud $crud)
    {
        return view('crud.edit', compact('crud'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Crud $crud)
    {
        $request = $request->toArray();
        $crud->update($request);
        return redirect()->route('crud.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Crud $crud)
    {
        $crud->delete();
        return redirect()->route('crud.index');
    }
}
