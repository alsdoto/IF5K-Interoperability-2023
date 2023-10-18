<?php

namespace App\Http\Controllers;

use App\Models\Table5; // Mengubah ini menjadi Table5
use Illuminate\Http\Request;

class Table5Controller extends Controller // Mengubah ini menjadi Table5Controller
{
    public function index()
    {
        $table5Data = Table5::all();
        return response()->json($table5Data);
    }

    public function show($id)
    {
        $table5Data = Table5::find($id);
        return response()->json($table5Data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $table5Data = Table5::create($data);
        return response()->json($table5Data, 201);
    }

    public function update(Request $request, $id)
    {
        $table5Data = Table5::find($id);
        $table5Data->update($request->all());
        return response()->json($table5Data);
    }

    public function destroy($id)
    {
        $table5Data = Table5::find($id);
        $table5Data->delete();
        return response()->json(null, 204);
    }
}
