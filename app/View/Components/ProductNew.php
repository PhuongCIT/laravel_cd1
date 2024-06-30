<?php

namespace App\View\Components;

use Closure;
use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ProductNew extends Component
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

        $product_new = Product::where('status', '=', 1)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('components.product-new', compact('product_new'));
    }
}
