<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Console;
use App\Models\Mod;
use App\Models\Repairer;

class DashboardController extends Controller
{
    public function index()
    {
        $mods = Mod::orderBy('quantity', 'asc')->limit(10)->get();
        $repairers = Repairer::withCount('consoles')
            ->orderBy('consoles_count', 'desc')
            ->limit(10)
            ->get();
        
        return view('admin.dashboard', compact('mods', 'repairers'));
    }
}
