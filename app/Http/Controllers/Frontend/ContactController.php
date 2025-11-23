<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:500',
            'message' => 'required|string|min:10|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
             'subject' => $request->subject,
            'message' => $request->message,
            'reviewed' => false,
        ]);

        return redirect()->route('contact.index')
            ->with('success', 'تم إرسال رسالتك بنجاح! سنرد عليك في أقرب وقت ممكن.');
    }
}