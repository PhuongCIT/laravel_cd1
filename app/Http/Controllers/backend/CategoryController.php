<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Category::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "image", "name", "slug", "status")
            ->get();
        $htmlparentid = "";
        $htmlsortorder = "";
        foreach ($list as $item) {
            $htmlparentid .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
        }


        return view("backend.category.index", compact("list", "htmlparentid", "htmlsortorder"));
    }

    //them danh muc
    public function store(StoreCategoryRequest $request)
    {
        $row = new Category();
        $row->name = $request->name;
        $row->description = $request->description;
        $row->parent_id = $request->parent_id;
        $row->sort_order = $request->sort_order;
        //update file image
        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/category/'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->status = $request->status;
        $row->slug = Str::of($request->name)->slug('-');
        $row->created_at =  date('d-m-Y H:i:s');
        $row->created_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.category.index');
    }


    // chi tiet
    public function show(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('admin.category.index');
        }
        return view("backend.category.show", compact("category"));
    }

    //thung rac
    public function trash()
    {
        $list = Category::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "image", "name", "slug", "status")
            ->get();

        return view("backend.category.trash", compact("list"));
    }

    // chinh sua
    public function edit(string $id)
    {
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('admin.category.index');
        }
        $list = Category::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "image", "name", "slug", "status")
            ->get();
        $htmlparentid = "";
        $htmlsortorder = "";
        foreach ($list as $item) {
            if ($category->parent_id == $item->id) {
                $htmlparentid .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            } else {
                $htmlparentid .= "<option  value='" . $item->id . "'>" . $item->name . "</option>";
            }
            if ($category->sort_order - 1 == $item->sort_order) {
                $htmlsortorder .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            } else {
                $htmlsortorder .= "<option value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }
        }
        return view("backend.category.edit", compact("category", "htmlparentid", "htmlsortorder"));
    }

    //cap nhap
    public function update(Request $request, string $id)
    {
        $row = Category::find($id);
        if ($row == null) {
            return redirect()->route('admin.category.index');
        }
        $row->name = $request->name;
        $row->description = $request->description;
        $row->parent_id = $request->parent_id;
        $row->sort_order = $request->sort_order;
        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/category/'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->status = $request->status;
        $row->slug = Str::of($request->name)->slug('-');
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;

        $row->save();
        return redirect()->route('admin.category.index');
    }

    //Đổi trạng thái, status=1 thì đổi qua =2, ngược lại
    public function status(string $id)
    {
        $row = Category::find($id);
        if ($row == null) {
            return redirect()->route('admin.category.index');
        }

        $row->status = ($row->status == 2) ? 1 : 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.category.index');
    }

    //xóa , chuyển trạng thái về 0
    public function delete(string $id)
    {
        $row = Category::find($id);
        if ($row == null) {
            return redirect()->route('admin.category.index');
        }
        $row->status = 0;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.category.index');
    }

    //khôi phục , đổi status =2.
    public function restore(string $id)
    {
        $row = Category::find($id);
        if ($row == null) {
            return redirect()->route('admin.category.index');
        }
        $row->status = 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.category.trash');
    }

    //xóa khỏi databse
    public function destroy(string $id)
    {
        $row = Category::find($id);
        if ($row == null) {
            return redirect()->route('admin.category.index');
        }

        $row->delete();
        return redirect()->route('admin.category.trash');
    }
}
