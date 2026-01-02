<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $todayUsers = User::whereDate('created_at', today())->count();

        return view('home', compact('totalUsers', 'todayUsers'));
    }
}
