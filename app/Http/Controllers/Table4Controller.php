<?php

namespace App\Http\Controllers;

use App\Models\Table4;
use Illuminate\Http\Request;

class Table4Controller extends Controller
{
    public function index()
    {
        $table4Data = Table4::all();
        return response()->json($table4Data);
    }

    public function show($id)
    {
        $table4Data = Table4::find($id);
        return response()->json($table4Data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $table4Data = Table4::create($data);
        return response()->json($table4Data, 201);
    }

    public function update(Request $request, $id)
    {
        $table4Data = Table4::find($id);
        $table4Data->update($request->all());
        return response()->json($table4Data);
    }

    public function destroy($id)
    {
        $table4Data = Table4::find($id);
        $table4Data->delete();
        return response()->json(null, 204);
    }
}
