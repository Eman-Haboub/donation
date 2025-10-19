<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
   public function send(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email',
        'subject' => 'required|string|max:150',
        'message' => 'required|string|max:1000',
    ]);

    // تخزين الرسالة في قاعدة البيانات
    Message::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    // (اختياري) إرسال إيميل
    Mail::raw($request->message, function($mail) use ($request) {
        $mail->to('your-email@example.com')
             ->subject($request->subject)
             ->from($request->email, $request->name);
    });

    return back()->with('success', 'Your message has been sent successfully!');
}
}
