<?php

namespace App\View\Components;

use Closure;
use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FlashSale extends Component
{

    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $args = [
            ['status', '=', 1],
            ['pricesale', '!=', 0]
        ];
        $product_sale = Product::where($args)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('components.flash-sale', compact('product_sale'));
    }
}
