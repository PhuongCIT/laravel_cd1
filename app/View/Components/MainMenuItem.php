<?php

namespace App\View\Components;

use Closure;
use App\Models\Menu;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class MainMenuItem extends Component
{
    public $row_menu = null;
    public function __construct($rowmenu)
    {
        $this->row_menu = $rowmenu;
    }


    public function render(): View|Closure|string
    {
        $menu = $this->row_menu;

        $args_mainmenu_sub = [
            ['status', '=', 1],
            ['position', '=', 'mainmenu'],
            ['parent_id', '=', $menu->id]
        ];
        $list_menu_sub = Menu::where($args_mainmenu_sub)
            ->orderBy('sort_order', 'DESC')
            ->get();
        return view('components.main-menu-item', compact('menu', 'list_menu_sub'));
    }
}
