<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
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
        return response()->json(['users' => $user]);
    }
    public function ViewIndex(): Response
    {
        $user = User::with('roles')->latest()->get();
        return Inertia::render('Admin/Users/Index',[
            'users' => $user
        ]);
    }
    public function ViewCreate(): Response
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        // return response()->json($request->all(), 400);
        $validated = $request->validated();
        if($request->role == 'student'){
            if($request->roll_no != '' || $request->registration_no != ''){
                $user = User::create($validated);
                $user->roll_no = $request->roll_no;
                $user->registration_no = $request->registration_no;
                $user->save();
            } else {
                return response()->json("A Student Must Have Roll and Registration Number", 400);
            }
        }else{
            $user = User::create($validated);
        }
        $user->assignRole($request->role);

        return response()->json("A". $request->role. " Successfully Created", 200);
    }
    public function update(User $user, Request $request): JsonResponse 
    {
        if($user->id == Auth::user()->id){
            return response()->json("You cannot Update your roles", 400);
        }
        if($request->name){
            $user->update([
                'name' => $request->name
            ]);
            $user->syncRoles([$request->role]);
            return response()->json(['success' => "User Role Updated successfully"], 200);
        } else{
            return response()->json("User Name is Empty.", 400);
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
