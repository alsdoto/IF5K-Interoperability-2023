<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import model Post
use Illuminate\Http\Request;

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

    /**
    * Store a newly created resource in storage
    *
    * @param \Illuminate\Http\Request $request 
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $input = $request->all();
        $post = Post::create($input);

        return response()->json($post, 200);
    }
    
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return response()->json($post);
    }
    
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->delete();
        $message = ['message' => 'deleted successfully', 'post_id' => $id];

        return response()->json($post, 200);
    }

}
