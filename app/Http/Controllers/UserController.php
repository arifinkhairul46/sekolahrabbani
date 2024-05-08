<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);


            $user  = User::where('username', $request->username)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->regenerate();

                    Auth::login($user);

                    return redirect()->intended('home');
                }
            }

            return redirect("login")->withSuccess('Login details are not valid');
        } catch (\Exception $th) {
            // dd($th);
            return redirect("login")->withError($th->getMessage());
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            // 'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        // dd($check);

        return redirect("login")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        try {
            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                // 'id_role' => $data['role'],
            ]);
        } catch (\Exception $th) {
            dd($th);
        }
    }

    public function home()
    {
        if (Auth::check()) {
            return view('index');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
