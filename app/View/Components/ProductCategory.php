<?php

namespace App\View\Components;

use Closure;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductCategory extends Component
{
    /**
     * Create a new component instance.
     */
    public $cat_row = null;
    public function __construct($catrow)
    {
        $this->cat_row = $catrow;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        // $category_list = Category::where($args_caterory)->orderBy('sort_order', 'asc')->get();
        $cat = $this->cat_row;

        $listcatid = [];
        array_push($listcatid, $cat->id);
        $listcat1 = Category::where([['parent_id', '=', $cat->id], ['status', '=', 1]])->select('id')->get();
        if (count($listcat1) > 1) {
            foreach ($listcat1 as $cat1) {
                array_push($listcatid, $cat1->id);
                $listcat2 = Category::where([['parent_id', '=', $cat1->id], ['status', '=', 1]])->select('id')->get();
                if (count($listcat2) > 1) {
                    foreach ($listcat2 as $cat2) {
                        array_push($listcatid, $cat2->id);
                        $listcat3 = Category::where([['parent_id', '=', $cat2->id], ['status', '=', 1]])->select('id')->get();
                        if (count($listcat3) > 1) {
                            foreach ($listcat3 as $cat3) {
                                array_push($listcatid, $cat3->id);
                            }
                        }
                    }
                }
            }
        }

        $product_cat_list = Product::where('status', '=', 1)
            ->whereIn('category_id', $listcatid)
            ->orderBy('created_at', 'desc')
            ->limit(4)->get();
        return view('components.product-category', compact('product_cat_list'));
    }
}
