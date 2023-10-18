<?php

namespace App\Http\Controllers;

use App\Models\Table1;
use Illuminate\Http\Request;

class Table1Controller extends Controller
{
    public function index()
    {
        $table1Data = Table1::all();
        return response()->json($table1Data);
    }

    public function show($id)
    {
        $table1Data = Table1::find($id);
        return response()->json($table1Data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $table1Data = Table1::create($data);
        return response()->json($table1Data, 201);
    }

    public function update(Request $request, $id)
    {
        $table1Data = Table1::find($id);
        $table1Data->update($request->all());
        return response()->json($table1Data);
    }

    public function destroy($id)
    {
        $table1Data = Table1::find($id);
        $table1Data->delete();
        return response()->json(null, 204);
    }
}
