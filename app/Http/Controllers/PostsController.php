<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $this->authorize('view', Post::class);

        if (Auth::user()->role === 'admin') {
            $posts = Post::OrderBy("id", "DESC")->paginate(5)->toArray();
        } else {
            $posts = Post::Where(['user_id' => Auth::user()->id])->OrderBy("id", "DESC")->paginate(2)->toArray();
        }


        $response = [
            "total_count" => $posts["total"],
            "limit" => $posts["per_page"],
            "pagination" => [
                "next_page" => $posts["next_page_url"],
                "current_page" => $posts["current_page"]
            ],
            "data" => $posts["data"],
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $input = $request->all();
        $validationRules = [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'status' => 'required|in:draft, published'
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $input['user_id'] = auth()->id();
        $post = Post::create($input);

        return response()->json($post, 200);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('viewDetail', $post);

        if (!$post) {
            abort(404);
        }
        return response()->json($post, 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $post = Post::find($id);
        $this->authorize('update', $post);

        if (!$post) {
            abort(404);
        }

        $validationRules = [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'status' => 'required|in:draft, published',
            'user_id' => 'required|exists:users,id'
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);

        if (!$post) {
            abort(404);
        }

        $post->delete();
        $message = [
            "message" => "Deleted SUccessfully",
            'post_id' => $id
        ];

        return response()->json($message, 200);
    }
}