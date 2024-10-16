<?php

namespace App\Http\Controllers;

use App\Models\FormSafe;
use \Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        return view('adm.dashboard', [
            'types' => '',
            'types_count' => '',
            'ufs' => '',
            'ufs_count' => ''
        ]);
    }
}
