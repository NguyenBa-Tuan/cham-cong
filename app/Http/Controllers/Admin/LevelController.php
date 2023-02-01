<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LevelController extends Controller
{
    public function index()
    {
        $levels = Level::orderBy('id', 'DESC')->get();

        return view('admin.level.index', compact('levels'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $level = Level::create(['name' => $request->level]);
            DB::commit();
            return redirect()->back()->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Thêm thất bại!');
        }
    }

    public function edit(Level $level)
    {
        $levels = Level::orderBy('id', 'DESC')->get();

        return view('admin.level.index', compact('levels', 'level'));
    }

    public function update(Level $level, Request $request)
    {
        DB::beginTransaction();

        try {
            $level->name = $request->level;
            $level->save();

            DB::commit();

            return redirect()->back()->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Cập nhật thất bại!');
        }
    }
}
