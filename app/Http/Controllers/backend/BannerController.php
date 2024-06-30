<?php

namespace App\Http\Controllers\backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Banner::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "image", "position", "status")
            ->get();
        $htmlparentid = "";
        foreach ($list as $row) {
            $htmlparentid .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
        }
        return view("backend.banner.index", compact("list", "htmlparentid"));
    }
    //thùng rác
    public function trash()
    {
        $list = Banner::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "image", "position", "status")
            ->get();
        return view("backend.banner.trash", compact("list"));
    }


    public function store(StoreBannerRequest $request)
    {
        $row = new banner();
        $row->name = $request->name;
        $row->link = $request->link;
        $row->description = $request->description;
        $row->position = $request->position;

        if ($request->image) {
            $fileName = date('YmDHis') . '.' . $request->image->extension();
            $request->image->move(public_path('images/banner/'), $fileName);
            $row->image = $fileName;
        }


        $row->status = $request->status;
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = Auth::id() ?? 1;

        $row->save();
        return redirect()->route('admin.banner.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('admin.banner.index');
        }
        return view("backend.banner.show", compact("banner"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        if ($banner == null) {
            return redirect()->route('admin.banner.index');
        }
        $list = Banner::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "image", "position", "status")
            ->get();
        $htmlparentid = "";
        foreach ($list as $item)
            if ($banner->position == $item->position) {
                $htmlparentid .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }

        return view("backend.banner.edit", compact("list", "htmlparentid", "banner"));
    }

    public function update(UpdateBannerRequest $request, string $id)
    {
        $row = Banner::find($id);
        if ($row == null) {
            return redirect()->route('admin.banner.index');
        }
        $row->name = $request->name;
        $row->link = $request->link;
        $row->description = $request->description;
        $row->position = $request->position;

        if ($request->image) {
            $exten = $request->file("image")->extension();
            if (in_array($exten, ["png", "jpg", "jpeg", "gif", "webp"])) {
                $fileName = $row->slug . "." . $exten;
                $request->image->move(public_path('images/banner'), $fileName);
                $row->image = $fileName;
            }
        }

        $row->status = $request->status;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id() ?? 1;

        $row->save();
        return redirect()->route('admin.banner.index');
    }

    //xử lý xóa khỏi database
    public function destroy(string $id)
    {
        $row = Banner::find($id);
        if ($row == null) {
            return redirect()->route('admin.banner.index');
        }
        $row->delete();

        return redirect()->route('admin.banner.trash');
    }

    //xử lý trạng thái
    public function status(string $id)
    {
        $row = Banner::find($id);
        if ($row == null) {
            return redirect()->route('admin.banner.index');
        }
        $row->status = ($row->status == 1) ? 2 : 1;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();

        return redirect()->route('admin.banner.index');
    }

    // xử lý xóa
    public function delete(string $id)
    {
        $row = Banner::find($id);
        if ($row == null) {
            return redirect()->route('admin.banner.index');
        }
        $row->status = 0;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();

        return redirect()->route('admin.banner.index');
    }

    //khôi phục
    public function restore(string $id)
    {
        $row = Banner::find($id);
        if ($row == null) {
            return redirect()->route('admin.banner.index');
        }
        $row->status = 2;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();

        return redirect()->route('admin.banner.trash');
    }
}
