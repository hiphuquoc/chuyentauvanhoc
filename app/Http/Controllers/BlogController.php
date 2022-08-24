<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

use PDF;

class BlogController extends Controller {

    public function buildTocContent(Request $request){
        $result         = null;
        if(!empty($request->get('data'))){
            $data       = $request->get('data');
            $result     = view('main.blog.tocContent', compact('data'));
        }
        echo $result;
    }

    public function searchBlog(Request $request){
        if(!empty($request->get('search_name'))){
            $list       = Blog::getList([
                'search_name' => $request->get('search_name')
            ]);
            /* Lấy danh sách category phân cấp theo tree */
            $category   = Category::getAllCategoryByTree();
        }
        return view('main.blog.list', compact('list'));
    }

    public function exportPdf(Request $request){
        if(!empty($request->get('blog_info_id'))){
            $infoBlog   = Blog::select('*')
                            ->where('id', $request->get('blog_info_id'))
                            ->with('pages')
                            ->first();
            if(!empty($infoBlog)){
                $pdf    = PDF::loadView('main.blog.pdf', ['item' => $infoBlog]);
                return $pdf->download($infoBlog->pages->seo_alias.'.pdf');
            }
        }
        
    }

}
