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
        $file = File::where('level_id', Auth::user()->level)->first();

        $url = isset($file->url) ? Storage::url($file->url) : false;

        //company
        $file = File::whereNull('level_id')->first();

        $urlCompany = isset($file->url) ? Storage::url($file->url) : false;
       
        return view('user.rule.index', compact('url', 'urlCompany'));
    }
}
