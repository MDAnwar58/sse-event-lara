<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMsg(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $message = new Message();
        $message->message = $request->message;
        $message->save();

        return response()->json('Send Message!');
    }
}
