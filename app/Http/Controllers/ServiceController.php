<?php
//  1
namespace App\Http\Controllers;

class ServiceController extends Controller
{
    public function getServiceStatus()
    {
        return response()->json([
            'service_name' => 'PHP Service App',
            'status' => 'Running'
        ]);
    }
}
