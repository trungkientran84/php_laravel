@extends('layouts.master')
@section('body')
    <div class="container">
        <h2 class="text-primary">Edit Post</h2>
        <form method="post" action="{{url('/posts',$post->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <fieldset class="form-group">
                <legend>Post information</legend>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="custom-select" id="category" name="category_id">
                        <option>Choose</option>
                        @foreach($navmenus as $navmenu)
                            @if($post->category_id ==$navmenu->navtype)
                                <option value="{{$navmenu->navtype}}" selected>{{$navmenu->name}}</option>
                            @else
                                <option value="{{$navmenu->navtype}}">{{$navmenu->name}}</option>
                            @endif

                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title"
                           @if($errors->has('title'))
                           value="{{$errors->first('title')}}"
                           @else
                           value="{{ old('title', $post->title ) }}"
                        @endif>
                </div>

                <div class="form-group">
                    <label for="subtitle">Sub Title</label>
                    <input class="form-control" type="text" name="seo_title" id="subtitle"
                           @if($errors->has('seo_title'))
                           value="{{$errors->first('seo_title')}}"
                           @else
                           value="{{ old('title', $post->seo_title ) }}"
                        @endif>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control rounded-0 " name="body" id="description"
                              rows="5">
                        @if($errors->has('body'))
                            {{$errors->first('body')}}
                        @else
                            {{ old('title', $post->body ) }}
                        @endif</textarea>
                </div>


                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="petphoto"
                               value="{{ old('title', $post->image ) }}">
                        <label class="custom-file-label" for="petphoto">Upload photo</label>
                    </div>
                </div>


            </fieldset>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div><!-- content container -->
@endsection
