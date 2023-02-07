<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact_registration(Request $request){
        $data = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Mail::to('info@boolprojects.com')->send(new NewContact($data));
    }
}
