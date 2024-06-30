<?php

namespace App\Http\Controllers\backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Product::where('product.status', '!=', 0)
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->orderBy('product.created_at', 'DESC')
            ->select("product.id", "product.name", "product.image", "price", "qty", "pricesale", "product.status", "category.name as categoryname", "brand.name as brandname")
            ->get();
        return view("backend.product.index", compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->get();

        $brands = Brand::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        $htmlcategoryid = "";
        $htmlbrandid = "";
        foreach ($categories as $row) {
            $htmlcategoryid .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
        }
        foreach ($brands as $row) {
            $htmlbrandid .= "<option value='" . $row->id . "'>" . $row->name . "</option>";
        }
        return view('backend.product.create', compact("htmlcategoryid", "htmlbrandid"));
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('admin.product.index');
        }

        $categories = Category::where('status', '!=', 0)->orderBy('name')->get();
        $brands = Brand::where('status', '!=', 0)->orderBy('name')->get();
        return view("backend.product.edit", compact("product", "categories", "brands"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $row = new Product();
        $row->name = $request->name;
        $row->description = $request->description;
        $row->detail = $request->detail;
        $row->price = $request->price;
        $row->qty = $request->qty;
        $row->pricesale = $request->pricesale;
        $row->category_id = $request->category_id;
        $row->brand_id = $request->brand_id;

        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/product/'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->status = $request->status;
        $row->slug = Str::of($request->name)->slug('-');
        $row->created_at =  date('d-m-Y H:i:s');
        $row->created_by = Auth::id() ?? 1;

        $row->save();
        return redirect()->route('admin.product.index')->with('message', ['type' => 'success', 'msg' => 'Thêm thành công']);;
    }

    // chi tiet
    public function show(string $id)
    {
        $product = Product::find($id);
        if ($product == null) {
            return redirect()->route('admin.product.index');
        }
        return view("backend.product.show", compact("product"));
    }

    //thung rac
    public function trash()
    {
        $list = Product::where('product.status', '=', 0)
            ->join('category', 'product.category_id', '=', 'category.id')
            ->join('brand', 'product.brand_id', '=', 'brand.id')
            ->orderBy('product.created_at', 'desc')
            ->select("product.id", "product.name", "product.image", "category.name as categoryname", "brand.name as brandname")
            ->get();
        return view("backend.product.trash", compact("list"));
    }

    public function update(Request $request, string $id)
    {
        $row = Product::find($id);
        if ($row == null) {
            return redirect()->route('admin.product.index');
        }

        $row->name = $request->name;
        $row->description = $request->description;
        $row->detail = $request->detail;
        $row->price = $request->price;
        $row->qty = $request->qty;
        $row->pricesale = $request->pricesale;
        $row->category_id = $request->category_id;
        $row->brand_id = $request->brand_id;
        $row->status = $request->status;
        $row->slug = Str::of($request->name)->slug('-');
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;

        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/product/'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->save();
        return redirect()->route('admin.product.index')->with('message', ['type' => 'success', 'msg' => 'Thêm thành công']);;
    }

    //Đổi trạng thái, status=1 thì đổi qua =2, ngược lại
    public function status(string $id)
    {
        $row = Product::find($id);
        if ($row == null) {
            return redirect()->route('admin.product.index');
        }

        $row->status = ($row->status == 2) ? 1 : 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.product.index');
    }

    //xóa , chuyển trạng thái về 0
    public function delete(string $id)
    {
        $row = Product::find($id);
        if ($row == null) {
            return redirect()->route('admin.product.index');
        }
        $row->status = 0;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.product.index');
    }

    //khôi phục , đổi status =2.
    public function restore(string $id)
    {
        $row = Product::find($id);
        if ($row == null) {
            return redirect()->route('admin.product.index');
        }
        $row->status = 2;
        $row->updated_at =  date('d-m-Y H:i:s');
        $row->updated_by = Auth::id() ?? 1;
        $row->save();
        return redirect()->route('admin.product.trash');
    }

    //xóa khỏi databse
    public function destroy(string $id)
    {
        $row = Product::find($id);
        if ($row == null) {
            return redirect()->route('admin.product.index');
        }
        $row->delete();
        return redirect()->route('admin.product.trash');
    }
}
