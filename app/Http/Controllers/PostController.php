<?php

namespace App\Http\Controllers;

use App\FollowPage;
use App\FollowPerson;
use App\Page;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function person_attach_post(Request $request){
        $validator = Validator::make($request->all(), [
            'post_content' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = [
            'person_id' => Auth::user()->id,
            'content' => $request->post_content
        ];
        //dd($data);
        $post = Post::create($data);
        if($post){
            return response()->json(['message' => 'Post Create Successfully']);
        }else{
            return response()->json(['message' => 'Post Create Failed']);
        }

    }

    public function page_attach_post(int $page_id, Request $request){
        if($page_id) {
            $validator = Validator::make($request->all(), [
                'post_content' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $page_found = Page::where('id', $page_id)->first();
            if(!empty($page_found)) {
                $data = [
                    'page_id' => $page_id,
                    'content' => $request->post_content
                ];
                //dd($data);
                $post = Post::create($data);
                if ($post) {
                    return response()->json(['message' => 'Post Create Successfully']);
                } else {
                    return response()->json(['message' => 'Post Create Failed']);
                }
            }else{
                return response()->json(['message' => 'Page ID Not Found']);
            }
        }

    }

    public function feed(Request $request){
       $user_id = Auth::user()->id;
       $result = array();
       $followPersonPost = FollowPerson::with('user:id,name','post:id,person_id,page_id,content')->where('follower_id', $user_id)->get();
       $followPagePost = FollowPage::with('page:id,name','post:id,person_id,page_id,content')->where('follower_id', $user_id)->get();
       $contents = array_merge($followPersonPost->toArray(), $followPagePost->toArray());
       if( !empty($contents)) {
           //dd($contents);
           foreach ($contents as $content) {
               if (!empty($content['post'])) {
                   foreach ($content['post'] as $post) {
                       $result[$post['id']]['follow_person'] = isset($content['user'])  && !empty($content['user']) ? $content['user']['name'] : '';
                       $result[$post['id']]['follow_page'] = isset($content['page']) && !empty($content['page']) ? $content['page']['name'] : '';
                       $result[$post['id']]['post_content'] = $post['content'];

                   }
               }

           }
       }
       return $result;
    }
}
