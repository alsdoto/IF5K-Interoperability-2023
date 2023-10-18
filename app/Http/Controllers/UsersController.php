<?php
// 2
namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function getUsers()
    {
        $users = [
            [
                "id" => 1,
                "name" => "Sumatrana",
                "email" => "sumatrana@gmail.com",
                "address" => "Padang",
                "gender" => "Laki-laki"
            ],
            [
                "id" => 2,
                "name" => "Jawarianto",
                "email" => "jawarianto@gmail.com",
                "address" => "Cimahi",
                "gender" => "Laki-laki"
            ],
            [
                "id" => 3,
                "name" => "Kalimantanio",
                "email" => "kalimantanio@gmail.com",
                "address" => "Samarinda",
                "gender" => "Laki-laki"
            ],
            [
                "id" => 4,
                "name" => "Sulawesiani",
                "email" => "sulawesiani@gmail.com",
                "address" => "Makasar",
                "gender" => "Perempuan"
            ],
            [
                "id" => 5,
                "name" => "Papuani",
                "email" => "papuani@gmail.com",
                "address" => "Jayapura",
                "gender" => "Perempuan"
            ]
        ];

        return response()->json($users);
    }
}
