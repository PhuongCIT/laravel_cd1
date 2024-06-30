<?php

namespace App\View\Components;

use Closure;
use App\Models\Post;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class LastPost extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $post_new = Post::where([['status', '=', 1], ['type', '=', 'post']])
            ->orderBy('created_at', 'DESC')->select('slug', 'id', 'title', 'image', 'description')
            ->limit(8)
            ->get();
        // $post = Post::where([['status', '=', 1], ['type', '=', 'post']])
        //     ->orderBy('created_at', 'DESC')
        //     ->limit(8)
        //     ->get();
        return view('components.last-post', compact('post_new'));
    }
}
