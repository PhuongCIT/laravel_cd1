<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateStoreUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $list = User::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select('id', 'image', 'name', 'username', 'phone', 'email', 'roles', "status")
            ->get();
        return view('backend.user.index', compact('list'));
    }

    public function create()
    {
        $list = User::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select('id', 'image', 'name', 'username', 'phone', 'email', 'roles')
            ->get();
        return view('backend.user.create', compact('list'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->roles = $request->roles;
        $user->status = $request->status;
        $user->created_at = date('Y-m-d H:i:s');
        $user->created_by = Auth::id() ?? 1;
        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/user/'), $fileName);
                $user->image = $fileName;
            }
        }

        $user->save();
        return redirect()->route('admin.user.index');
    }

    public function status($id)
    {
        $user = User::find($id);
        if ($user) {
            // Đảo ngược trạng thái từ 1 sang 2 và ngược lại
            $user->status = $user->status == 1 ? 2 : 1;
            $user->save();
        }

        return redirect()->route('admin.user.index');
    }

    public function show(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        return view("backend.user.show", compact("user"));
    }

    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $list = User::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select('id', 'name', 'roles')
            ->get();

        return view('backend.user.edit', compact('list', 'user'));
    }
    // cập nhật
    public function update(UpdateStoreUserRequest $request, string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->roles = $request->roles;
        $user->status = $request->status;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1;
        //update file image
        if ($request->hasFile('image')) {
            $exten = $request->image->getClientOriginalExtension();
            if (in_array($exten, ["png", "jpg", "gif", "webp"])) {
                $fileName = date('YmdHis') . '.' . $exten;
                $request->image->move(public_path('images/user/'), $fileName);
                $user->image = $fileName;
            }
        }

        $user->save();
        return redirect()->route('admin.user.index');
    }
    // xóa ,chuyển trạng thái sang 0
    public function delete(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $user->status = 0;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1;

        $user->save();
        return redirect()->route('admin.user.index');
    }
    // khôi phục, chuyển trạng thái bằng 2    
    public function restore(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $user->status = 2;
        $user->updated_at = date('Y-m-d H:i:s');
        $user->updated_by = Auth::id() ?? 1;

        $user->save();
        return redirect()->route('admin.user.trash');
    }
    //hiện thị trong thùng rác những user có stutus = 0.
    public function trash()
    {
        $list = User::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select('id', 'image', 'name', 'username', 'phone', 'email', 'user.roles')
            ->get();
        return view('backend.user.trash', compact('list'));
    }
    // xóa khỏi database
    public function destroy(string $id)
    {
        $user = User::find($id);
        if ($user == null) {
            return redirect()->route('admin.user.index');
        }
        $user->delete();
        return redirect()->route('admin.user.trash');
    }
}
