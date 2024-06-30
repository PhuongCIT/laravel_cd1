<?php

namespace App\Http\Controllers\backend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $list = Order::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')

            ->get();
        return view("backend.order.index", compact("list"));
    }

    public function create()
    {
        $list = Order::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "delivery_name", "delivery_email", "delivery_phone")
            ->get();
        return view("backend.order.create", compact("list"));
    }

    public function store(Request $request)
    {
        //
    }

    // chi tiet
    public function show(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
        return view("backend.order.show", compact("order"));
    }

    public function delete(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
        $order->status = 0;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->updated_by = Auth::id() ?? 1;

        $order->save();
        return redirect()->route('admin.order.index');
    }

    public function status($id)
    {
        $order = Order::find($id);
        if ($order) {
            // Đảo ngược trạng thái từ 1 sang 2 và ngược lại
            $order->status = $order->status == 1 ? 2 : 1;
            $order->save();
        }

        return redirect()->route('admin.order.index');
    }
    public function trash()
    {
        $list = Order::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "delivery_name", "delivery_email", "delivery_phone")
            ->get();
        return view("backend.order.trash", compact("list"));
    }

    public function destroy(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return redirect()->route('admin.order.index');
        }
        $order->delete();
        return redirect()->route('admin.order.trash');
    }


    public function update(Request $request, string $id)
    {
        //
    }
}
