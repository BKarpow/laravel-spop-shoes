<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    function create(Request $request){
        $validatedData = $request->validate([
            'name' => 'require|max:100',
            'email' => 'required|email|max:200',
            'phone' => 'max:15',
            'subject' => 'max:50',
            'message' => 'required|max:1000',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->phone = $request->phone;
        $feedback->subject = $request->subject;
        $feedback->message = $request->message;
        $feedback->ip = $request->ip();
        $feedback->save();
        return redirect()->route('page.about')->with('status', 'Надiслано!!');
    }
}
