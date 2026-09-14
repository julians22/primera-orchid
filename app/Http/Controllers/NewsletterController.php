<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        return back()->with('success', 'Terima kasih telah berlangganan!');
    }
}