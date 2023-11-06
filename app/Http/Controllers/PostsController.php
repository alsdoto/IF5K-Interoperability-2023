<?php

namespace App\Http\Controllers;

use App\Models\Post; // Import model Post
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $posts = Post::OrderBy("id", "DESC")->paginate(10);

            if ($acceptHeader === 'application/json') {
                //response json
                return response()->json($posts->items('data'), 200);
            } else {
                //create xml posts element
                $xml = new \SimpleXMLElement('<post/>');
                foreach ($posts->items('data') as $item) {
                    //create xml post element
                    $xmlItem = $xml->addChild('post');
                    
                    //mengubah setiap field post menjadi bentuk xml
                    $xmlItem->addChild('id', $item->id);
                    $xmlItem->addChild('title', $item->title);
                    $xmlItem->addChild('status', $item->status);
                    $xmlItem->addChild('content', $item->content);
                    $xmlItem->addChild('user_id', $item->user_id);
                    $xmlItem->addChild('created_at', $item->created_at);
                    $xmlItem->addChild('update_at', $item->update_at);
                }
                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    /**
    * Store a newly created resource in storage
    *
    * @param \Illuminate\Http\Request $request 
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json') {
            // Lakukan proses penyimpanan data
            $post = new Post;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->status = $request->status;
            $post->user_id = $request->user_id;
            $post->save();

            return response()->json(['message' => 'Post created successfully'], 201);
        } elseif ($acceptHeader === 'application/xml') {
            // Buat dan kembalikan data dalam format XML
            $xml = new \SimpleXMLElement('<post/>');
            $xml->addChild('title', $request->title);
            $xml->addChild('content', $request->content);
            $xml->addChild('status', $request->status);
            $xml->addChild('user_id', $request->user_id);
            return response($xml->asXML(), 201)->header('Content-Type', 'application/xml');
        } else {
            return response('Unsupported Media Type', 415);
        }
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
