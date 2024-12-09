<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Forum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:accounts',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required|in:user,professional',
            'terms' => 'accepted',
        ]);

        $account = Account::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($account);

        return redirect()->route('home')->with('success', 'Registration successful!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('');
        }

        return redirect()->back()->withErrors(['login_error' => 'Wrong Credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('');
    }

    public function profile(){
        $id = Auth::id();
        $user = Auth::user();
        $articles = Article::where('account_id', '=', $id)->with(['categories', 'pictures'])->get();
        $forums = Forum::where('account_id', '=', $id)->with(['comments', 'categories', 'pictures'])->get();
        $comments = Comment::where('account_id', '=', $id)->with(['forum', 'account'])->get();
        return view('profile', compact('user', 'articles', 'forums', 'comments'));
    }
}
