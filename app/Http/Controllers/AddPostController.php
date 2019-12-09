<?php

namespace App\Http\Controllers;

use App\PostAtrributes;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Posts;
use App\PostImages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Collection;

class AddPostController extends Controller
{

    public function addPost(){
            return view('posts.addPost');
        }
    public function addAttributes(Request $request){
            $attributes = DB::table('attributes')->where('attribute_group', '=', $request->post_category)->get();
            $id = $request->post_id;
        for ($i=0; $i<$attributes->count(); $i++){
            $temp = $attributes[$i]->attribute_name;
            if($request->$temp != ""){
              //return $request->$temp;
                $postattribute = new PostAtrributes;
                $postattribute->post_id = $id;
                $postattribute->attribute_id = $attributes[$i]->attribute_id;
                $postattribute->value = $request->$temp;
                $postattribute->Save();
            }
        }
        if($request->hasfile('images')) {
            foreach ($request->images as $photo) {
                $extension = $photo->getClientOriginalExtension();
                $filename = rand(1,time()). '.'.$extension;
                $photo->move('photos/',$filename);
                $postimage = new PostImages;
                $postimage->post_id = $id;
                //$filename = $photo->store('public\photos');
                $postimage->image = $filename;
                $postimage->Save();
            }
        }
               return "Post Created Successfully";
    }
    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'post_category' => 'required',
        ]);

        $post = Posts::create($request->all());

        if($post->post_category == 1)
            return view('posts.addRealEstate')->with('post', $post);
        else if($post->post_category==2)
            return view('posts.addCars')->with('post', $post);
        else if($post->post_category==3)
            return view('posts.addJobs')->with('post', $post);
        else
            return redirect('addPost');
    }
    public function editPost($id){
        $postattributes = DB::table('postattributes')->where('post_id', '=', $id)->get();
        $category = DB::table('posts')->where('post_id', '=', $id)->pluck('post_category');
        $title = DB::table('posts')->where('post_id', '=', $id)->pluck('title');
        $attributes = DB::table('attributes')->where('attribute_group', '=', $category)->get();
        $postData = array();
        $attributes_names = array();
        $attributes_data = array();
        for ($i=0; $i<$postattributes->count(); $i++){
            $attribute_name = DB::table('attributes')->where('attribute_id', '=', $postattributes[$i]->attribute_id)->pluck('attribute_name');
                array_push($attributes_names,$attribute_name[0]);
        }
        for ($i=0; $i<$postattributes->count(); $i++){
                array_push($attributes_data,$postattributes[$i]->value);
        }
        for ($i=0; $i<$postattributes->count(); $i++) {
            $postData = array_combine($attributes_names,$attributes_data);
        }
        $postData["post_id"] = $id;
        $postData["post_category"] = $category[0];
        $postData["title"] = $title[0];
        //return $postData;
        if($category[0]==1)
            return view('posts.editRealEstate')->with('postData', $postData);
        else if($category[0]==2)
            return view('posts.editCars')->with('postData', $postData);
        else if($category[0]==3)
            return view('posts.editJobs')->with('postData', $postData);

    }
    public function editAttributes(Request $request)
    {
        //return $request;
        $attributes = DB::table('attributes')->where('attribute_group', '=', $request->post_category)->get();
        $id = $request->post_id;
        DB::table('postattributes')->where('post_id', '=', $request->post_id)->delete();
        for ($i=0; $i<$attributes->count(); $i++){
            $temp = $attributes[$i]->attribute_name;
            if($request->$temp != ""){
                //return $request->$temp;
                $postattribute = new PostAtrributes;
                $postattribute->post_id = $id;
                $postattribute->attribute_id = $attributes[$i]->attribute_id;
                $postattribute->value = $request->$temp;
                $postattribute->Save();
            }
        }
        if($request->hasfile('images')) {
            DB::table('postimages')->where('post_id', '=', $request->post_id)->delete();
            foreach ($request->images as $photo) {
                $extension = $photo->getClientOriginalExtension();
                $filename = time().'.'.$extension;
                $photo->move('photos/',$filename);
                $postimage = new PostImages;
                $postimage->post_id = $id;
                //$filename = $photo->store('photos');
                $postimage->image = $filename;
                $postimage->Save();
            }
        }
        return "Post Edited Successfully";
    }
    public function deletePost($id){
        DB::table('postattributes')->where('post_id', '=', $id)->delete();
        DB::table('postimages')->where('post_id', '=', $id)->delete();
        DB::table('posts')->where('post_id', '=', $id)->delete();
        return "Post Deleted Successfully";
    }
    public function displayPost($id){
        $postattributes = DB::table('postattributes')->where('post_id', '=', $id)->get();
        $category = DB::table('posts')->where('post_id', '=', $id)->pluck('post_category');
        $title = DB::table('posts')->where('post_id', '=', $id)->pluck('title');
        $attributes = DB::table('attributes')->where('attribute_group', '=', $category)->get();
        $postData = array();
        $attributes_names = array();
        $attributes_data = array();
        $images = DB::table('postimages')->where('post_id', '=', $id)->pluck('image');
        for ($i=0; $i<$postattributes->count(); $i++){
            $attribute_name = DB::table('attributes')->where('attribute_id', '=', $postattributes[$i]->attribute_id)->pluck('attribute_name');
            array_push($attributes_names,$attribute_name[0]);
        }
        for ($i=0; $i<$postattributes->count(); $i++){
            array_push($attributes_data,$postattributes[$i]->value);
        }
        for ($i=0; $i<$postattributes->count(); $i++) {
            $postData = array_combine($attributes_names,$attributes_data);
        }
        $postData["post_id"] = $id;
        $postData["post_category"] = $category[0];
        $postData["title"] = $title[0];
        $postData["images"] = $images;
        //return $postData;
        return view('posts.displayPost')->with('postData', $postData);
    }
    public function help(){
        return view('posts.helpPage');
    }
    public function promotePost($id){
        return view('posts.promotePost')->with('post_id',$id);
    }
    public function checkout(Request $request){
        $data = array();
        $total = 0.00;
        if (Arr::exists($request,'Top_Ad')){
            $data['Top_Ad'] = $request->select_topAd;
            $total = $total + $request->select_topAd;
        }
        if (Arr::exists($request,'HomePage_Gallery')){
            $data['HomePage_Gallery'] = $request->select_gallery;
            $total = $total + $request->select_gallery;
        }
        if (Arr::exists($request,'Bump_Ad')){
            $data['Bump_Ad'] = $request->select_bumpAd;
            $total = $total + $request->select_bumpAd;
        }
        $data['post_id'] = $request->post_id;
        $data['total'] = $total;
        //return $data;
        return view('posts.checkout')->with('data',$data);
    }
}
