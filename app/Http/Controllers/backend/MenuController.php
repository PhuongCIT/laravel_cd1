<?php

namespace App\Http\Controllers\backend;

use App\Models\Menu;
use App\Models\Post;
use App\Models\Brand;
use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMenuRequest;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('status', '!=', '0')->orderBy('created_at', 'DESC')->select('id', 'name')->get();
        $brands = Brand::where('status', '!=', '0')->orderBy('created_at', 'DESC')->select('id', 'name')->get();
        $topics = Topic::where('status', '!=', '0')->orderBy('created_at', 'DESC')->select('id', 'name')->get();
        $pages = Post::where([['status', '!=', '0'], ['type', '=', 'page']])->orderBy('created_at', 'DESC')->select('id', 'title')->get();
        $posts = Post::where([['status', '!=', '0'], ['type', '=', 'post']])->orderBy('created_at', 'DESC')->select('id', 'title')->get();
        $list = Menu::where('status', '!=', '0')
            ->orderBy('created_at', 'DESC')
            ->select('id', 'link', 'name', 'position', 'parent_id', 'status')
            ->get();

        return view('backend.menu.index', compact('list', 'categories', 'brands', 'topics', 'pages', 'posts'));
    }

    public function store(Request $request)
    {
        //danh muc
        if (isset($request->createCategory)) {
            $listid = $request->categoryid;
            if ($listid) {
                foreach ($listid as $id) {
                    $category = Category::find($id);

                    if ($category != null) {
                        $menu = new Menu();
                        $menu->name = $category->name;
                        $menu->link = 'danh-muc/' . $category->slug;
                        $menu->sort_order = 0;

                        $menu->type = 'category';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = now();
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = $request->status;
                        $menu->save();
                    }
                }
                return redirect()->route('admin.menu.index')->with('success', 'Thêm Menu thành công.');
            } else {
                echo "khoong co";
            }
        }
        //thuong hieu
        if (isset($request->createBrand)) {
            $listid = $request->brandid;
            if ($listid) {
                foreach ($listid as $id) {
                    $brand = brand::find($id);
                    if ($brand != null) {
                        $menu = new Menu();
                        $menu->name = $brand->name;
                        $menu->link = 'thuong-hieu/' . $brand->slug;
                        $menu->sort_order = 0;

                        $menu->type = 'brand';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = now();
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = $request->status;
                        $menu->save();
                    }
                }
                return redirect()->route('admin.menu.index')->with('success', 'Thêm Menu thành công.');
            } else {
                echo "khoong co";
            }
        }
        //chu de
        if (isset($request->createTopic)) {
            $listid = $request->topicid;
            if ($listid) {
                foreach ($listid as $id) {
                    $topic = topic::find($id);
                    if ($topic != null) {
                        $menu = new Menu();
                        $menu->name = $topic->name;
                        $menu->link = 'chu-de/' . $topic->slug;
                        $menu->sort_order = 0;

                        $menu->type = 'topic';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = now();
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = $request->status;
                        $menu->save();
                    }
                }

                return redirect()->route('admin.menu.index')->with('success', 'Thêm Menu thành công.');
            } else {
                echo "khoong co";
            }
        }
        //trang don
        if (isset($request->createPage)) {
            $listid = $request->pageid;
            if ($listid) {
                foreach ($listid as $id) {
                    $page = Post::where([["id", "=", $id], ['type', '=', 'page']])->first();
                    if ($page != null) {
                        $menu = new Menu();
                        $menu->name = $page->title;
                        $menu->link = 'trang-don/' . $page->slug;
                        $menu->sort_order = 0;

                        $menu->type = 'page';
                        $menu->position = $request->position;
                        $menu->table_id = $id;
                        $menu->created_at = now();
                        $menu->created_by = Auth::id() ?? 1;
                        $menu->status = $request->status;
                        $menu->save();
                    }
                }
                return redirect()->route('admin.menu.index')->with('success', 'Thêm Menu thành công.');
            } else {
                echo "khoong co";
            }
        }
        //tuy lien ket
        if (isset($request->createCustom)) {
            if (isset($request->name, $request->link)) {
                $menu = new Menu();
                $menu->name = $request->name;
                $menu->link = $request->link;
                $menu->sort_order = 0;

                $menu->type = 'custome';
                $menu->position = $request->position;
                $menu->created_at = now();
                $menu->created_by = Auth::id() ?? 1;
                $menu->status = $request->status;
                $menu->save();
            }
        }
        return redirect()->route('admin.menu.index')->with('success', 'Menu đã được thêm thành công.');
    }

    public function restore(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('admin.menu.index');
        }
        $menu->status = 2;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = Auth::id() ?? 1;

        $menu->save();
        return redirect()->route('admin.menu.trash');
    }

    public function delete(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('admin.menu.index');
        }
        $menu->status = 0;
        $menu->updated_at = date('Y-m-d H:i:s');
        $menu->updated_by = Auth::id() ?? 1;

        $menu->save();
        return redirect()->route('admin.menu.index');
    }
    public function status($id)
    {
        $menu = Menu::find($id);
        if ($menu) {
            // Đảo ngược trạng thái từ 1 sang 2 và ngược lại
            $menu->status = ($menu->status == 1) ? 2 : 1;
            $menu->save();
        }

        return redirect()->route('admin.menu.index');
    }

    public function trash()
    {
        $list = Menu::where('status', '=', '0')
            ->orderBy('created_at', 'DESC')
            ->select('id', 'link', 'name', 'position', 'status')
            ->get();
        return view('backend.menu.trash', compact('list'));
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('admin.menu.index');
        }
        return view("backend.menu.show", compact("menu"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('admin.menu.index');
        }
        $categories = Category::all();
        $brands = Brand::all();
        $topics = Topic::all();
        $pages = Post::where('type', 'page')->get();
        $posts = Post::where('type', 'post')->get();
        $list = Menu::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select('id', 'link', 'name', 'position', 'status')
            ->get();
        $menu_parent = Menu::where([['status', '!=', 0], ['parent_id', '=', 0]])
            ->orderBy('created_at', 'DESC')
            ->select('id', 'name')
            ->get();

        return view('backend.menu.edit', compact('menu', 'list', 'categories', 'brands', 'topics', 'pages', 'posts', 'menu_parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return redirect()->route('admin.menu.index');
        }
        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->position = $request->position;
        $menu->parent_id = $request->parent_id;
        $menu->status = $request->status;
        $menu->updated_by = Auth::id() ?? 1;
        $menu->updated_at = now();
        $menu->save();
        return redirect()->route('admin.menu.index')->with('success', 'Menu đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        if ($menu == null) {
            return redirect()->route('admin.menu.index');
        }
        $menu->delete();
        return redirect()->route('admin.menu.trash');
    }
}
