<?php

namespace App\Http\Controllers\backend;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreContactquest;
use App\Http\Requests\UpdateContactRequest;


class contactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function restore(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        $contact->status = 2;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = Auth::id() ?? 1;

        $contact->save();
        return redirect()->route('admin.contact.trash');
    }

    public function delete(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        $contact->status = 0;
        $contact->updated_at = date('Y-m-d H:i:s');
        $contact->updated_by = Auth::id() ?? 1;

        $contact->save();
        return redirect()->route('admin.contact.index');
    }

    public function status($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            // Đảo ngược trạng thái từ 1 sang 2 và ngược lại
            $contact->status = $contact->status == 1 ? 2 : 1;
            $contact->save();
        }

        return redirect()->route('admin.contact.index');
    }
    public function index()
    {
        $list = Contact::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "email", "phone", "title", "content", "replay_id", "status")
            ->get();
        return view("backend.contact.index", compact("list"));
    }

    public function trash()
    {
        $list = Contact::where('status', '=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "email", "phone", "title", "content", "replay_id", "status")
            ->get();
        return view("backend.contact.trash", compact("list"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list = Contact::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "email", "phone", "title", "content", "replay_id", "status")
            ->get();
        $htmlreplayid = "";
        foreach ($list as $row) {
            $htmlreplayid .= "<option value='" . ($row->replay_id + 1) . "'>sau: " . $row->name . "</option>";
        }
        return view("backend.contact.create", compact("list", "htmlreplayid"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactquest $request)
    {
        $row = new Contact();
        $row->name = $request->name;
        $row->phone = $request->phone;
        $row->email = $request->email;
        $row->title = $request->title;
        $row->content = $request->content;
        $row->replay_id = $request->replay_id;
        $row->status = $request->status;
        $row->created_at = date('Y-m-d H:i:s');
        $row->user_id = Auth::id() ?? 1;

        $row->save();
        return redirect()->route('admin.contact.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        return view("backend.contact.show", compact("contact"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        $list = Contact::where('status', '!=', 0)
            ->orderBy('created_at', 'DESC')
            ->select("id", "name", "email", "phone", "title", "content", "replay_id", "status")
            ->get();
        $htmlreplayid = "";
        foreach ($list as $row) {
            if ($contact->replay_id - 1 == $row->replay_id) {
                $htmlreplayid .= "<option selected value='" . ($row->replay_id + 1) . "'>sau: " . $row->name . "</option>";
            } else {
                $htmlreplayid .= "<option value='" . ($row->replay_id + 1) . "'>sau: " . $row->name . "</option>";
            }
        }
        return view("backend.contact.edit", compact("list", "htmlreplayid", "contact"));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, string $id)
    {
        $row = Contact::find($id);
        if ($row == null) {
            return redirect()->route('admin.contact.index');
        }
        $row->name = $request->name;
        $row->phone = $request->phone;
        $row->email = $request->email;
        $row->title = $request->title;
        $row->content = $request->content;
        $row->replay_id = $request->replay_id;

        $row->status = $request->status;
        $row->updated_at = date('Y-m-d H:i:s');
        $row->updated_by = Auth::id() ?? 1;

        $row->save();
        return redirect()->route('admin.contact.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if ($contact == null) {
            return redirect()->route('admin.contact.index');
        }
        $contact->delete();
        return redirect()->route('admin.contact.trash');
    }
}
