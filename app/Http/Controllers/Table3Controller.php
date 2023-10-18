<?php

namespace App\Http\Controllers;

use App\Models\Table3;
use Illuminate\Http\Request;

class Table3Controller extends Controller
{
    public function index()
    {
        $table3Data = Table3::all();
        return response()->json($table3Data);
    }

    public function show($id)
    {
        $table3Data = Table3::find($id);
        return response()->json($table3Data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $table3Data = Table3::create($data);
        return response()->json($table3Data, 201);
    }

    public function update(Request $request, $id)
    {
        $table3Data = Table3::find($id);
        $table3Data->update($request->all());
        return response()->json($table3Data);
    }

    public function destroy($id)
    {
        $table3Data = Table3::find($id);
        $table3Data->delete();
        return response()->json(null, 204);
    }
}
