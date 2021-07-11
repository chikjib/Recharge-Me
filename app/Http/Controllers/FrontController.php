<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function aboutUs()
    {
        return view('pages.frontend.about-us');
    }

    public function blog()
    {
        $posts = Post::paginate(10);
        return view('pages.frontend.posts',['posts' => $posts]);
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug',$slug)->first();
        return view('pages.frontend.single-post',['post' => $post]);
    }
}
