<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $user = User::with('roles')->latest()->get();
        return response()->json($user);
    }
    public function ViewIndex(): Response
    {
        $user = User::with('roles')->latest()->get();
        return Inertia::render('Admin/Users/Index',[
            'users' => $user
        ]);
    }

    public function update(User $user, Request $request): JsonResponse 
    {
        if($user->id == Auth::user()->id){
            return response()->json(['error' => "You cannot Update your roles"], 400);
        }
        if($request->name){
            $user->update([
                'name' => $request->name
            ]);
            $user->syncRoles([$request->role]);
            return response()->json(['success' => "User Role Updated successfully"], 200);
        } else{
            return response()->json(['error' => "User Name is Empty."], 400);
        }
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return response()->json(['success' => "User Deleted successfully"], 200);
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
