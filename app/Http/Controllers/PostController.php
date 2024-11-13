<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('likes')->get();
        return view('post.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            // 'content' => $request->content,
        ]);

        return redirect()->back();
    }

    public function like($id)
    {
        $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
        
        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'post_id' => $id,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->back();
    }
}

