<?php

namespace App\Http\Controllers\backend;

use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateStoreTopicRequest;

class TopicController extends Controller
{
    public function restore(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->status = 2;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1;

        $topic->save();
        return redirect()->route('admin.topic.trash');
    }
    public function delete(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->status = 0;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1;

        $topic->save();
        return redirect()->route('admin.topic.index');
    }
    public function status(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->status = ($topic->status == 1) ? 2 : 1;
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1;

        $topic->save();
        return redirect()->route('admin.topic.index');
    }
    public function trash()
    {
        $list = Topic::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "slug", "description", "sort_order", "status")
            ->get();

        return view("backend.topic.trash", compact("list"));
    }
    public function index()
    {
        $list = Topic::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "slug", "description", "sort_order", "status")
            ->get();
        $htmlsortorder = "";
        foreach ($list as $row) {
            $htmlsortorder .= "<option value='" . ($row->sort_order + 1) . "'>sau: " . $row->name . "</option>";
        }
        return view("backend.topic.index", compact("list", "htmlsortorder"));
    }


    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->description = $request->description;
        $topic->sort_order = $request->sort_order;
        $topic->status = $request->status;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->created_by = Auth::id() ?? 1;
        $topic->save();
        return redirect()->route('admin.topic.index');
    }


    public function show(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        return view("backend.topic.show", compact("topic"));
    }

    public function edit(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $list = Topic::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "slug", "description", "sort_order", "status")
            ->get();
        $htmlsortorder = "";
        foreach ($list as $row) {
            if ($topic->sort_order - 1 == $row->sort_order) {
                $htmlsortorder .= "<option selected value='" . ($row->sort_order + 1) . "'>sau: " . $row->name . "</option>";
            } else {
                $htmlsortorder .= "<option value='" . ($row->sort_order + 1) . "'>sau: " . $row->name . "</option>";
            }
        }
        return view("backend.topic.edit", compact("list", "htmlsortorder", "topic"));
    }

    public function update(UpdateStoreTopicRequest $request, string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->name = $request->name;
        $topic->description = $request->description;
        $topic->sort_order = $request->sort_order;
        $topic->status = $request->status;
        $topic->slug = Str::of($request->name)->slug('-');
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->updated_by = Auth::id() ?? 1;
        $topic->save();
        return redirect()->route('admin.topic.index');
    }

    public function destroy(string $id)
    {
        $topic = Topic::find($id);
        if ($topic == null) {
            return redirect()->route('admin.topic.index');
        }
        $topic->delete();
        return redirect()->route('admin.topic.trash');
    }
}
