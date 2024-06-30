<?php

namespace App\View\Components;

use Closure;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductCategoryHome extends Component
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
        $args_caterory = [
            ['status', '=', 1],
            ['parent_id', '=', 0],
        ];
        $category_list = Category::where($args_caterory)->orderBy('sort_order', 'asc')->get();
        return view('components.product-category-home', compact('category_list'));
    }
}
