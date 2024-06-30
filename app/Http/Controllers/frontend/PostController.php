<?php

namespace App\Http\Controllers\frontend;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $topic_list = Topic::where('status', '=', 1)->orderBy('sort_order', 'asc')->get();

        $post_list = Post::where([['status', '=', 1], ['type', '=', 'post']])
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('frontend.post', compact('post_list', 'topic_list'));
    }
    // bài viết theo chủ đề
    public function topic($slug)
    {
        $topic = Topic::where([['status', '=', 1], ['slug', '=', $slug]])->select("id", "name", "slug")->first();
        $post_list = Post::where([['status', '=', 1], ['type', '=', 'post'], ['topic_id', '=', $topic->id]])
            ->orderBy('created_at', 'desc')
            ->paginate(8);


        return view('frontend.post_topic', compact('post_list', 'topic'));
    }

    public function detail($slug)
    {

        $post = Post::where([['status', '=', 1], ['slug', '=', $slug]])->first();

        //lấy bài viết liên quan trừ nó ra
        $list_post = Post::where([['status', '=', 1], ['topic_id', '=', $post->topic_id], ['id', '!=', $post->id], ['type', '=', 'post']])
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('frontend.post_detail', compact('post', 'list_post'));
    }
}
