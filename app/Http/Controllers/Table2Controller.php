<?php

namespace App\Http\Controllers;

use App\Models\Table2;
use Illuminate\Http\Request;

class Table2Controller extends Controller
{
    public function index()
    {
        $table2Data = Table2::all();
        return response()->json($table2Data);
    }

    public function show($id)
    {
        $table2Data = Table2::find($id);
        return response()->json($table2Data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $table2Data = Table2::create($data);
        return response()->json($table2Data, 201);
    }

    public function update(Request $request, $id)
    {
        $table2Data = Table2::find($id);
        $table2Data->update($request->all());
        return response()->json($table2Data);
    }

    public function destroy($id)
    {
        $table2Data = Table2::find($id);
        $table2Data->delete();
        return response()->json(null, 204);
    }
}
