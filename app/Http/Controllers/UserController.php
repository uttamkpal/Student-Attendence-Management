<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(): Response
    {
        $user = User::with('roles')->latest()->get();
        return Inertia::render('Admin/Users/Index',[
            'users' => $user
        ]);
    }

    public function dashboard(): RedirectResponse
    {
        $user = User::find(Auth::id());
        $role = $user->getRoleNames()->toArray()[0];
       
        if( $role == 'admin'){
            $url = 'admin';
        }
        elseif( $role == 'professor'){
            $url = 'professor';
        }
        elseif( $role == 'staff'){
            $url = 'staff';
        }
        elseif( $role == 'student'){
            $url = 'student';
        }else{
            return redirect('login');
        }
        return redirect($url);

    }
}
