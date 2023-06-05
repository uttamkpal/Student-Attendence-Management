<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    public function index() :Response {
        $user = Auth::user();
        return Inertia::render('Professor/Index',[
            'users' => $user
        ]);
    }
}
