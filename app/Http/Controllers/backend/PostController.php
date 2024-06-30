<?php

namespace App\Http\Controllers\backend;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Post::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "image", "title",  "detail", "type", "status")
            ->get();
        return view("backend.post.index", compact("list"));
    }


    public function create()
    {
        $list_topic = Topic::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        $htmltopicid = "";
        foreach ($list_topic as $row) {
            $htmltopicid .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
        }
        return view('backend.post.create', compact("htmltopicid"));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $row = new Post();
    //     $row->title = $request->title;
    //     $row->description = $request->description;
    //     $row->detail = $request->detail;
    //     $row->type = $request->type;
    //     $row->topic_id = $request->topic_id;
    //     $row->status = $request->status;
    //     $row->slug = Str::of($request->title)->slug('-');
    //     $row->created_at = date('Y-m-d H:i:s');
    //     $row->created_by = Auth::id() ?? 1;
    //     //update file image
    //     if ($request->hasFile('image')) {
    //         $exten = $request->image->getClientOriginalExtension();
    //         if (in_array($exten, ["png", "jpg","jpeg", "gif", "webp"])) {
    //             $fileName = date('YmdHis') . '.' . $exten;
    //             $request->image->move(public_path('images/post/'), $fileName);
    //             $row->image = $fileName;
    //         }
    //     }

    //     $row->save();
    //     return redirect()->route('admin.post.index');
    // }
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->description = $request->description;
        $post->topic_id = $request->topic_id;
        $post->type = $request->type;
        if ($request->image) {
            $exten = $request->file("image")->extension();
            if (in_array($exten, ["png", "jpg", "jpeg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/post/'), $fileName);
                $post->image = $fileName;
            }
        }
        $post->status = $request->status;
        $post->slug = Str::of($request->name)->slug('-');
        $post->created_at = date('Y-m-d H:i:s');
        $post->created_by = Auth::id() ?? 1;

        $post->save();
        return redirect()->route('admin.post.index');
    }


    // chi tiet
    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('admin.post.index');
        }
        return view("backend.post.show", compact("post"));
    }

    //thung rac
    public function trash()
    {
        $list = Post::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "image", "title", "detail", "type", "slug", "status")
            ->get();

        return view("backend.post.trash", compact("list"));
    }

    // chinh sua
    public function edit(string $id)
    {
        $post = Post::find($id);
        if ($post == null) {
            return redirect()->route('admin.post.index');
        }
        $list = Post::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id",  "title",  "detail", "topic_id", "type", "status")
            ->get();
        $list_topic = Topic::where('status', '!=', 0)
            ->select("id", "name")
            ->get();
        $htmltopicid = "";
        foreach ($list_topic as $item) {
            if ($post->topic_id == $item->id) {
                $htmltopicid .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $htmltopicid .= "<option  value='" . $item->id . "'>" . $item->name . "</option>";
            }
        }
        return view("backend.post.edit", compact("post", "htmltopicid",));
    }

    //cap nhap
    public function update(Request $request, string $id)
    {
        $row = Post::find($id);
        if ($row == null) {
            return redirect()->route('admin.post.index');
        }
        $row->title = $request->title;
        $row->description = $request->description;
        $row->detail = $request->detail;
        $row->type = $request->type;
        $row->topic_id = $request->topic_id;
        $row->status = $request->status;
        $row->slug = Str::of($request->title)->slug('-');
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        //update file image
        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/post/'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->save();
        return redirect()->route('admin.post.index');
    }

    //Đổi trạng thái, status=1 thì đổi qua =2, ngược lại
    public function status(string $id)
    {
        $row = Post::find($id);
        if ($row == null) {
            return redirect()->route('admin.post.index');
        }

        $row->status = ($row->status == 2) ? 1 : 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.post.index');
    }

    //xóa , chuyển trạng thái về 0
    public function delete(string $id)
    {
        $row = Post::find($id);
        if ($row == null) {
            return redirect()->route('admin.post.index');
        }
        $row->status = 0;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.post.index');
    }

    //khôi phục , đổi status =2.
    public function restore(string $id)
    {
        $row = Post::find($id);
        if ($row == null) {
            return redirect()->route('admin.post.index');
        }
        $row->status = 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.post.trash');
    }

    //xóa khỏi databse
    public function destroy(string $id)
    {
        $row = Post::find($id);
        if ($row == null) {
            return redirect()->route('admin.post.index');
        }

        $row->delete();
        return redirect()->route('admin.post.trash');
    }
}
