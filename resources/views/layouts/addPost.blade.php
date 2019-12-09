@extends('layouts.master')
@section('body')
    <div class="container">
        <h2 class="text-primary">Add New Post</h2>
        <form method="post" action="/posts" enctype="multipart/form-data">
            {{ csrf_field() }}
            <fieldset class="form-group">
                <legend>Post information</legend>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="custom-select" id="category" name="category_id">
                        <option>Choose</option>
                        @foreach($navmenus as $navmenu)
                            <option value="{{$navmenu->navtype}}">{{$navmenu->name}}</option>
                        @endforeach
                    </select>

                </div>
                @if($errors->has('category_id'))
                    <span> {{$errors->first('category_id')}}</span>
                @endif

                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="Title"
                           @if($errors->has('title'))
                           value="{{$errors->first('title')}}"
                        @endif>
                </div>

                <div class="form-group">
                    <label for="subtitle">Sub Title</label>
                    <input class="form-control" type="text" name="seo_title" id="subtitle" placeholder="Sub Title"
                           @if($errors->has('seo_title'))
                           value="{{$errors->first('seo_title')}}"
                        @endif>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control rounded-0" name="body" id="description" rows="5"
                              @if($errors->has('body'))
                              placeholder="{{$errors->first('body')}}"
                    @endif
                    ></textarea>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                        <input type="file" class="custom-file-input" name="upfile" id="upfile">
                        <label class="custom-file-label" for="upfile">Upload photo</label>

                    </div>
                </div>
            </fieldset>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div><!-- content container -->
@endsection
