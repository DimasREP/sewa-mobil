<?php

namespace App\Http\Controllers\Admin;
use App\Models\Message;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $message = Message::latest()->get();

        return view('admin.messages.index', compact('message'));
    }

    public function destroy(Message $message)

    {
        $message->delete();

        return redirect()->back()->with([
                'message' => 'Data berhasil dihapus',
                'alert-type' => 'danger'
        ]);
    }
}
