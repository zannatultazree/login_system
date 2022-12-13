<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Auth\SessionGuard;

class AuthController extends Controller
{
    public function index(){

        return view('main');

    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // $credentials = array('email' => $request->email, 'password' => $request->password);
        // dd($credentials);

// dd($credentials);
        //  $credentials = [
        //     'email' => $request['email'],
        //     'password' => $request['password'],
        //  ];

        // return $credentials;
        //dd(bcrypt("123456"));
        //  dd(Auth::attempt([
        //      "name" => "Test",
        //      "password" => "123456"
        // ]));

        // dd(Auth::attempt(['email' => $request['email'], 'password' =>$request['password']]));
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials))
        {
            // dd('here');
            // $request->session()->regenerate();
            return redirect()->intended('dashboard')
            ->withSuccess('Signed in');
        }

         return redirect('login')->withSuccess('success','Enter valid login information');

    }

    public function registration()
    {
        return view('registration');
    }

    public function validate_registration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('login')->with('success', 'Registration done, now you can login');
    }

    function dashboard()
    {
        if(Auth::check())
        {
            return view('dashboard');
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    public function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect('login');
    }
}
