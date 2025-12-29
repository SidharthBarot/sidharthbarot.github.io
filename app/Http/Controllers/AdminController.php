<?php
namespace App\Http\Controllers; 
use App\Mail\UsersListMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Controllers;

class AdminController extends Controller
{
    public function sendUsersPDF()
    {
        $users = User::all(); // get all users

        Mail::to(auth()->user()->email)
            ->send(new UsersListMail($users));

        return redirect()->back()
            ->with('success', 'Users list PDF sent to your email.');
    }
}
