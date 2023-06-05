<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(EmailRequest $request)
    {
        
        $fromUser = Auth::user();

        try {
            $validatedData = $request->validate([
                'title' => 'required|string|min:3|max:20',
                'subject' => 'required|string|min:3|max:30',
                'body' => 'required|string',
            ]);

            $sendMailData = [
                'title' => $validatedData['title'],
                'subject' => $validatedData['subject'],
                'body' => $validatedData['body'],
            ];

            try {
                Mail::to('fablab.blog.sm@gmail.com')->send(new SendMail($sendMailData, $fromUser));
                $emailSent = true;
            } catch (\Exception $e) {
                $emailSent = false;
                return redirect()->route('contact')->with('emailSent', $emailSent);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            $emailSent = false;
            $errors = $e->validator->errors()->all(); // récupère les erreurs de validation
            return view('other.contact', [
                'emailSent' => $emailSent,
                'errors' => $errors, // on transmet les erreurs à la vue
            ]);
        }

        return redirect()->route('contact')->with('emailSent', $emailSent);
    }
}
