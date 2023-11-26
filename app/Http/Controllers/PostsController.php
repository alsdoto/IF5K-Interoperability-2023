<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import model Post
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
       $posts = Post::OrderBy("id", "DESC")->paginate(2)->toArray();
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

    /**
    * Store a newly created resource in storage
    *
    * @param \Illuminate\Http\Request $request 
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $input = $request->all();

        $post = $Post::find($id);

        if(!$post) {
            abort(404);
        }

        $validationRules = [
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'status' => 'required|in:draft,published',
            'user_id' => 'required|exists:users,id',
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $post->fill($input);
        $post->save();

        return response()->json($post, 200);
    }

        
    public function show(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        if ($acceptHeader === 'application/json') {
            return response()->json($post, 200);
        } elseif ($acceptHeader === 'application/xml') {
            $xml = new \SimpleXMLElement('<post/>');
            $xml->addChild('title', $post->title);
            $xml->addChild('content', $post->content);
            $xml->addChild('status', $post->status);
            $xml->addChild('user_id', $post->user_id);
            return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
        } else {
            return response('Unsupported Media Type', 415);
        }
    }

    
    public function update(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');
        $contentTypeHeader = $request->header('Content-Type');

        if ($contentTypeHeader === 'application/json') {
            // Melakukan proses update data
            $post = Post::find($id);
            if (!$post) {
                return response()->json(['message' => 'Post not found'], 404);
            }

            $post->title = $request->title;
            $post->content = $request->content;
            $post->status = $request->status;
            $post->user_id = $request->user_id;
            $post->save();

            if ($acceptHeader === 'application/json') {
                return response()->json(['message' => 'Post updated successfully'], 200);
            } elseif ($acceptHeader === 'application/xml') {
                // Buat dan kembalikan data dalam format XML
                $xml = new \SimpleXMLElement('<post/>');
                $xml->addChild('title', $request->title);
                $xml->addChild('content', $request->content);
                $xml->addChild('status', $request->status);
                $xml->addChild('user_id', $request->user_id);
                return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
            } else {
                return response('Unsupported Media Type', 415);
            }
        } else {
            return response('Unsupported Media Type', 415);
        }
    }


    public function destroy(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        $post = Post::find($id);
        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        if ($acceptHeader === 'application/json') {
            $post->delete();
            return response()->json(['message' => 'Post deleted successfully'], 200);
        } elseif ($acceptHeader === 'application/xml') {
            $xml = new \SimpleXMLElement('<post/>');
            $xml->addChild('message', 'Post deleted successfully');
            return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
        } else {
            return response('Unsupported Media Type', 415);
        }
    }

}
