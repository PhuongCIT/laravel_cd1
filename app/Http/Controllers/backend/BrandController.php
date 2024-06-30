<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Brand::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "slug", "status")
            ->get();

        $htmlsortorder = "";
        foreach ($list as $item) {
            $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
        }
        return view("backend.brand.index", compact("list", "htmlsortorder"));
    }

    // THEM THƯƠNG HIỆU
    public function store(StoreBrandRequest $request)
    {
        $row = new Brand();
        $row->name = $request->name;
        $row->slug = Str::of($row->name)->slug('-');
        $row->description = $request->description;
        $row->sort_order = $request->sort_order;
        $row->status = $request->status;
        $row->created_at = date('Y-m-d h:i:s');
        $row->created_by = Auth::id() ?? 1;
        //upload file
        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/brand/'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->save();
        return redirect()->route('admin.brand.index')->with('message', ['type' => 'success', 'msg' => 'Thêm thành công']);
    }

    // chi tiet
    public function show(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return redirect()->route('admin.brand.index');
        }
        return view("backend.brand.show", compact("brand"));
    }

    //thung rac
    public function trash()
    {
        $list = Brand::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "image", "name", "slug", "status")
            ->get();

        return view("backend.brand.trash", compact("list"));
    }

    // chinh sua
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            return redirect()->route('admin.brand.index');
        }
        $list = Brand::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "image", "name", "slug", "status")
            ->get();

        $htmlsortorder = "";
        foreach ($list as $item) {
            if ($brand->sort_order - 1 == $item->sort_order) {
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            } else {
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }
        }
        return view("backend.brand.edit", compact("brand", "htmlsortorder"));
    }

    //cap nhap
    public function update(Request $request, string $id)
    {
        $row = Brand::find($id);
        if ($row == null) {
            return redirect()->route('admin.brand.index');
        }
        $row->name = $request->name;
        $row->description = $request->description;
        $row->sort_order = $request->sort_order;
        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/brand/'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->status = $request->status;
        $row->slug = Str::of($request->name)->slug('-');
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;

        $row->save();
        return redirect()->route('admin.brand.index');
    }

    //Đổi trạng thái, status=1 thì đổi qua =2, ngược lại
    public function status(Request $request, string $id)
    {
        $row = Brand::find($id);
        if ($row == null) {
            return redirect()->route('admin.brand.index');
        }

        $row->status = ($row->status == 2) ? 1 : 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.brand.index');
    }

    //xóa , chuyển trạng thái về 0
    public function delete(Request $request, string $id)
    {
        $row = Brand::find($id);
        if ($row == null) {
            return redirect()->route('admin.brand.index');
        }
        $row->status = 0;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.brand.index');
    }

    //khôi phục , đổi status =2.
    public function restore(string $id)
    {
        $row = Brand::find($id);
        if ($row == null) {
            return redirect()->route('admin.brand.index');
        }
        $row->status = 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.brand.trash');
    }

    //xóa khỏi databse
    public function destroy(string $id)
    {
        $row = Brand::find($id);
        if ($row == null) {
            return redirect()->route('admin.brand.index');
        }

        $row->delete();
        return redirect()->route('admin.brand.trash');
    }
}
