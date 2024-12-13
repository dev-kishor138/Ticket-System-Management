<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('backend.admin-dashboard');
    }
    public function userDashboard()
    {
        return view('backend.user-dashboard');
    }
}
