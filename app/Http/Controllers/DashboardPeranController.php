<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardPeranController extends Controller
{
    public function index()
    {
        $totalPeran = Role::count();
        // $totalPengguna = User::count();

        return view('dashboard-peran', compact(
            'totalPeran',
            // 'totalPengguna',
        ));
    }
}
