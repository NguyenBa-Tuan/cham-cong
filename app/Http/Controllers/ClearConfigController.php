<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ClearConfigController extends Controller
{
    public function index()
    {
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
    }
}
