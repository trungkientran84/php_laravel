<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NavMenus;
use App\Post;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function show()
    {
        $navmenus = NavMenus::all();
        return view('welcome', ['navmenus' => $navmenus]);
    }

    public function toPage($id)
    {
        $posts = Post::where('category_id', $id)->paginate(4);
        return view('layouts/pages/category', ['posts' => $posts]);
    }

    public function addPost()
    {
        $navmenus = NavMenus::all();
        return view('layouts.addPost', ['navmenus' => $navmenus]);
    }


    public function storePost(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'seo_title' =>'required',
            'body' => 'required'
        ]);

        //update the path for the image
        $path = $request->file('upfile')->store('public/posts/October2019');
        $pos = strpos($path,'/');
        $path = substr($path,$pos);
        //add the image path into the request
        $request->request->add(['image' => $path]);
        //create the post
        Post::create($request->all());
        $navmenus = NavMenus::all();
        $category_id = $request->category_id;
        $posts = Post::where('category_id', $category_id)
            ->orderBy('id', 'desc')
            ->paginate(4);
        return view('layouts/pages/category', ['navmenus' => $navmenus, 'posts' => $posts]);
    }

    public function editPost($id)
    {
        $navmenus = NavMenus::all();
        $post = POST::find($id);
        return view('layouts/editPost', ['navmenus' => $navmenus, 'post' => $post]);
    }

    public function updatePost(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            'seo_title' =>'required',
            'body' => 'required'
        ]);

        $post = POST::find($id);

        $path = $request->file('editfile')->store('public/posts/October2019');
        $pos = strpos($path,'/');
        $path = substr($path,$pos);
        //add the image path into the request
        $request->request->add(['image' => $path]);

        $post->update($request->all());
        $category_id = $post->category_id;
        $navmenus = NavMenus::all();
        $posts = Post::where('category_id', $category_id)
            ->orderBy('id', 'desc')
            ->paginate(4);
        return view('layouts/pages/category', ['navmenus' => $navmenus, 'posts' => $posts]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $category_id = $post->category_id;
        $post->delete();

        $navmenus = NavMenus::all();
        $posts = Post::where('category_id', $category_id)
            ->orderBy('id', 'desc')
            ->paginate(4);
        return view('layouts/pages/category', ['navmenus' => $navmenus, 'posts' => $posts]);
    }

    public function search(Request $request)
    {
        $searchString = $request->searchString;
        $navmenus = NavMenus::all();
        $posts = DB::table('posts')->where('title', 'LIKE', '%' . $searchString . '%')
            ->orwhere('body', 'LIKE', '%' . $searchString . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('layouts/pages/category', ['navmenus' => $navmenus, 'posts' => $posts]);
    }
}
