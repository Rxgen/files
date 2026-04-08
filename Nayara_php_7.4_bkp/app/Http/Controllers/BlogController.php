<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\BlogPost;
use Response;
use Cookie;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    protected function getBlogPage($slug)
    {
        return $page = Page::whereSlug($slug)->where('status', 1)->get();
    }
    public function blogDetails(Request $request, $slug)
    {
        $page = $this->getBlogPage($slug);
        $post = BlogPost::where('slug', $request->slug)->where('status', '1')->first();
        if(!$post){
             return response()->view('exceptions.error_404');
        }
        $blogSchemaCode=$post->blog_schema;
        $blogrelatedposts=BlogPost::where('status', 1)->latest()->take(3)->get();
        return view('pages.detail')->with(compact(['post','page','blogrelatedposts','blogSchemaCode']));
    }
    public function ajaxlike(Request $request)
    {
        if (Cookie::get('post_'.$request->postid) !== null) {
            //return response()->json(['like'=>$likecount]);
            return response()->json(['like' => 'You have already liked this blog']);
        } else {
            // return response()->json(['like'=>'Cookies is already set']);
            Cookie::queue('post_'.$request->postid,$request->postid , 10);
            $user = BlogPost::find($request->postid);
            $user->increment('likes');
            $likecount = BlogPost::where("id", "=", $request->postid)->where("status", "=", '1')->value('likes');
            return response()->json(['like' => $likecount]);
        }
    }
}
