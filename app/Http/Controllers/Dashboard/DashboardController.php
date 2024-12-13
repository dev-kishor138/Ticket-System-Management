<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $purchases = Purchase::latest()->get();
        return view('backend.admin-dashboard', compact('purchases'));
    }
    public function userDashboard()
    {
        return view('backend.user-dashboard');
    }
}
