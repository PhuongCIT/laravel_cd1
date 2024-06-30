<?php

namespace App\Http\Controllers\frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }
    public function addcontact(Request $request)
    {
        $user = Auth::user();
        $contact = new Contact();
        $contact->user_id = $user->id;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->title = $request->title;
        $contact->content = $request->content;
        $contact->replay_id = Auth::id();
        $contact->status = 2;
        $contact->created_at = date('Y-m-d H:i:s');

        $contact->save();
        return view('frontend.contact')->with('alert', 'tạo liên hệ thành công');
    }
}
