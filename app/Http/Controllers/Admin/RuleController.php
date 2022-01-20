<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserLevel;
use App\Http\Controllers\Controller;
use App\Models\File;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuleController extends Controller
{
    public function index()
    {
        $levels = UserLevel::toSelectArray();

        $listFile = File::all();

        return view('admin.rule.index', compact('levels', 'listFile'));
    }

    public function store(Request $request)
    {
        try {
            //remove old file pdf
            $oldPdf = File::where('level', $request->level)->first();
            if ($oldPdf) {
                File::where('level', $request->level)->delete();
                $this->removeFile($oldPdf->url);
            }

            //add new
            $url = 'rule/' . $request->level;
            // $path = Storage::put($url, $request->file);
            $path = $request->file('file')->store('public/'.$url);

            File::create([
                'name' => $request->file->getClientOriginalName(),
                'url' => $path,
                'level' => $request->level,
            ]);

            return redirect()->back()->with('success', 'Thêm file thành công');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function removeFile($path)
    {
        Storage::delete($path); // Xóa 1 file
    }

    public function downloadFile(File $file)
    {
        try {
            return Storage::download($file->url, $file->name);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
