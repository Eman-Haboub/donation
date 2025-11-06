<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
      public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }
   public function send(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email',
        'subject' => 'required|string|max:150',
        'message' => 'required|string|max:1000',
    ]);

    Message::create([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
    ]);

    Mail::raw($request->message, function($mail) use ($request) {
        $mail->to('your-email@example.com')
             ->subject($request->subject)
             ->from($request->email, $request->name);
    });

    return back()->with('success', 'Your message has been sent successfully!');
}
public function show($id)
{
    $message = Message::findOrFail($id);
    return view('admin.messages.show', compact('message'));
}

public function destroy($id)
{
    $message = Message::findOrFail($id);
    $message->delete();

    return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
}

}
