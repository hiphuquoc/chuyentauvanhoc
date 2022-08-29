<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCacheController extends Controller {

    public static function clearCacheAllPage(){
        $data = glob(Storage::path(config('admin.cache.folderSave')).'*');
        foreach($data as $item) @unlink($item);
        return redirect()->route('admin.blog.list');
    }

    

}
