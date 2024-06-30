<?php

namespace App\Http\Controllers\frontend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    // public $category_list = '';
    // public $brand_list = '';
    //product all
    public function index()
    {
        $category_list = Category::where('status', '=', 1)->orderBy('sort_order', 'asc')->get();
        $brand_list = Brand::where('status', '=', 1)->orderBy('sort_order', 'asc')->get();
        $product_all_list = Product::where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('frontend.product', compact('product_all_list', 'category_list', 'brand_list'));
    }
    //
    public function getlistcategoryid($rowid)
    {
        $listcatid = [];

        array_push($listcatid, $rowid);
        $list1 = Category::where([['status', '=', 1], ['parent_id', '=', $rowid]])->select("id", "name", "slug")->get();
        if (count($list1) > 0) {
            foreach ($list1 as $row1) {
                array_push($listcatid, $row1->id);
                $list2 = Category::where([['status', '=', 1], ['parent_id', '=', $row1->id]])->select("id", "name", "slug")->get();
                if (count($list2) > 0) {
                    foreach ($list2 as $row2) {
                        array_push($listcatid, $row2->id);
                    }
                }
            }
        }
        return $listcatid;
    }
    //product category
    public function category($slug)
    {

        $row_cat = Category::where('status', '=', 1)->select("name")->get();
        $row_brand = Brand::where('status', '=', 1)->select("name")->get();


        $category = Category::where([['status', '=', 1], ['slug', '=', $slug]])->select("id", "name", "slug")->first();
        $listcatid = [];
        $listbrandid = [];
        if ($category != null) {
            $listcatid = $this->getlistcategoryid($category->id);
        }

        $product_cat_list = Product::where('status', '=', 1)
            ->whereIn('category_id', $listcatid)
            ->orderBy('created_at', 'desc')->paginate(9);
        $product_brand_list = Product::where('status', '=', 1)
            ->whereIn('brand_id',  $listbrandid)
            ->orderBy('created_at', 'desc')->paginate(9);
        return view('frontend.product_category', compact('product_cat_list', 'category', 'row_cat', 'row_brand'));
    }

    public function product_detail($slug)
    {
        $product = Product::where([['status', '=', 1], ['slug', '=', $slug]])->first();
        $listcatid = $this->getlistcategoryid($product->category_id);
        //lấy sản phẩm liên quan trừ nó ra
        $product_cat_list = Product::where([['status', '=', 1], ['id', '!=', $product->id]])
            ->whereIn('category_id', $listcatid)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('frontend.product_detail', compact('product', 'product_cat_list'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where([['name', 'like', '%' . $keyword . '%',]])->paginate(10);
        return view('frontend.search', compact('products', 'keyword'));
    }

    //trang filter
    // public function filter()
    // {
    //     $category_list = Category::where('status', '=', 1)->orderBy('sort_order', 'asc')->get();
    //     $brand_list = Brand::where('status', '=', 1)->orderBy('sort_order', 'asc')->get();

    //     return view('frontend.filter', compact('category_list', 'brand_list'));
    // }

    public function product_filter(Request $request)
    {
        // Lấy danh sách các danh mục được chọn
        $selectedCategories = $request->input('categories', []);

        // Lấy danh sách các thương hiệu được chọn
        $selectedBrands = $request->input('brands', []);

        $query = Product::query();

        // Lọc sản phẩm theo danh mục nếu có danh mục được chọn
        if (!empty($selectedCategories)) {
            $query->whereIn('category_id', $selectedCategories);
        }

        // Lọc sản phẩm theo thương hiệu nếu có thương hiệu được chọn
        if (!empty($selectedBrands)) {
            $query->whereIn('brand_id', $selectedBrands);
        }

        // Lọc theo khoảng giá
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price)->orderBy('price', 'asc');
        }

        $products_filter = $query->paginate(10);

        return view('frontend.filter', compact('products_filter'));
    }
}
