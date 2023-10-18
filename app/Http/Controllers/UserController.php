<?php
// 3
namespace App\Http\Controllers;

class UserController extends Controller
{
    public function getUserById($userId)
    {
        // Di sini, Anda dapat menambahkan logika untuk mencari pengguna berdasarkan $userId
        // Contoh data pengguna:
        $user = [
            "id" => 1,
            "name" => "Sumatrana",
            "email" => "sumatrana@gmail.com",
            "address" => "Padang",
            "gender" => "Laki-laki"
        ];

        return response()->json($user);
    }
}
