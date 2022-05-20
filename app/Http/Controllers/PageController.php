<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Page;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    public function store(PageRequest $request){
        $page = Page::create(['name' => $request->page_name]);
        if($page){
            return response()->json(['message' => 'Page Create Successfully']);
        }else{
            return response()->json(['message' => 'Page Create Failed']);  
        }
    }
}
