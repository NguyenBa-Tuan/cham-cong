<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;

class RuleController extends Controller
{
    public function index()
    {
        $file = File::where('level', Auth::user()->level)->first();

        $url = $file->url ? Storage::url($file->url) : false;
       
        return view('user.rule.index', compact('url'));
    }
}
