<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import model Post

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::OrderBy("id", "DESC")->paginate(10); // Mengambil semua data dari tabel "posts"
        
        $outPut = [
            "message" => "posts",
            "result" => $posts
        ];
        
        return response()->json($posts, 200);
    }
}
