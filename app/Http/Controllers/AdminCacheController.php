<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCacheController extends Controller {

    public static function clearCacheAllPage(){
        $disk   = Storage::disk(config('admin.cache.disk', 'local'));
        $folder = rtrim(config('admin.cache.folderSave'), '/');
        $files  = $disk->files($folder);
        foreach ($files as $file) {
            $disk->delete($file);
        }
        return redirect()->route('admin.blog.list');
    }

    

}
