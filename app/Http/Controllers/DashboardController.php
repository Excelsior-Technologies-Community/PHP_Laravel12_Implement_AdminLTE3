<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic statistics
        $totalUsers = User::count();
        $todayUsers = User::whereDate('created_at', today())->count();
        
        // Advanced statistics
        $weekUsers = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $monthUsers = User::whereMonth('created_at', Carbon::now()->month)->count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $last7DaysUsers = User::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        
        // Chart data for last 7 days
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartData[$date->format('M d')] = User::whereDate('created_at', $date)->count();
        }
        
        return view('home', compact(
            'totalUsers', 
            'todayUsers',
            'weekUsers',
            'monthUsers', 
            'verifiedUsers',
            'last7DaysUsers',
            'chartData'
        ));
    }
}