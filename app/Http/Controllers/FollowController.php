<?php

namespace App\Http\Controllers;

use App\FollowPage;
use App\FollowPerson;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function follow_person(int $person_id){
        $follower_id = Auth::user()->id;
        if($follower_id){
            $person_found = User::where('id', $person_id)->first();
            if(!empty($person_found)) {
                $data = [
                    'person_id' => $person_id,
                    'follower_id' => $follower_id
                ];
                $follow = FollowPerson::create($data);
                if ($follow) {
                    return response()->json(['message' => 'Follow Person Successfully']);
                } else {
                    return response()->json(['message' => 'Follow Person Failed']);
                }
            }else{
                return response()->json(['message' => 'Person ID Not Found']);
            }
        }else{
            return response()->json(['message' => 'Follower ID Not Found']);
        }
    }

    public function follow_page(int $page_id){
        $follower_id = Auth::user()->id;
        if($follower_id){
            $page_found = Page::where('id', $page_id)->first();
            if(!empty($page_found)) {
                $data = [
                    'page_id' => $page_id,
                    'follower_id' => $follower_id
                ];
                $follow = FollowPage::create($data);
                if ($follow) {
                    return response()->json(['message' => 'Follow Page Successfully']);
                } else {
                    return response()->json(['message' => 'Follow Page Failed']);
                }
            }else{
                return response()->json(['message' => 'Page ID Not Found']);
            }
        }else{
            return response()->json(['message' => 'Follower ID Not Found']);
        }
    }

}
