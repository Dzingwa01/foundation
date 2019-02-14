<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $user = Auth::user()->load('roles');

        if($user->roles[0]->name=='app-admin'){
            return view('admin.admin-home',compact('users'));
        }else if($user->roles[0]->name=='agent'){
            return view('agent.agent-home');
        }
        else if($user->roles[0]->name=='premium-accounting-clerk'){
            return view('premium-accounting-clerk.premium-accounting-clerk-home');
        }else if($user->roles[0]->name=='data-capturer'){
            return view('data-capturer.data-capturer-home');
        }
        else if($user->roles[0]->name=='claims-clerk'){
            return view('claims-clerk.claims-clerk-home');
        }
        else if($user->roles[0]->name=='supervisor'){
            return view('supervisor.supervisor-home');
        }
        else if($user->roles[0]->name=='undertaker'){
            return view('undertaker.undertaker-home');
        }
        else if($user->roles[0]->name=='funeral-services-manager'){
            return view('funeral-services-manager.funeral-services-manager-home');
        }
    }
}
