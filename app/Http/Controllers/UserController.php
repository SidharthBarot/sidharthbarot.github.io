<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\returnCallback;

use Illuminate\Support\Facades\Mail;
use App\Mail\LoginSuccessMail;
use App\Notifications\LoginSuccessNotification;


class UserController extends Controller
{
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role'=>$request->role
        ]);


        return redirect('/login')->with('success','Registered Successfully');
    }

    public function login(Request $request){

         $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

       $users=User::where('email',$request->email)->first();
       

       if($users && Hash::check($request->password, $users->password))
       {
            Session::put('user_id',$users->id);
             Mail::to($users->email)->send(new LoginSuccessMail($users));
             $users->notify(new LoginSuccessNotification());

            return redirect('/admin_show');
            
            
       }
       
       return back()->with('Login Failed ');
    }

   public function show(Request $request)
{
    $loggedInUser = User::find(Session::get('user_id'));

   
    $search = $request->search;

    $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");  
        })
        ->paginate(3);


    return view('admin_show', compact('users', 'loggedInUser'));
}

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('edit', compact('user'));
}
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    return redirect('/admin_show')->with('success', 'User Updated');
}
public function delete($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect('/admin_show')->with('success', 'User Deleted');
}


    public function logout()
{
    Session::forget('user_id');
    return redirect('/login');
}

}

