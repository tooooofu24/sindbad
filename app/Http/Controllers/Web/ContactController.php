<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        Mail::to('admin@sindbad.sakura.ne.jp')->send(new ContactMail($request->content));
        return redirect()->route('contact.index');
    }
}
