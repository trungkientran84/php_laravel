@extends('layouts.user-master')
@section('css')
    <link href="{{asset('css/messages.css')}}"  rel="stylesheet" />
@endsection
@section('content')
    <h2>Create Message</h2>
    @if($errors->any())
        @foreach($errors ->all() as $err)
            <li>{{$err}}</li>
        @endforeach
    @endif
    <div class="container">

    <form method="post" action="/messages">

        {{csrf_field()}}
        <div class="card">
            <input type="hidden" name="created_user_id" value="{{ app('VoyagerAuth')->user()->id }}">
            <h5 class="card-header">To:

                <input type="text" name="recipient_id" value="{{old('recipient_id')}}"/></h5>
            <div class="card-body">
                <textarea name="content" id="" cols="30" rows="10">{{old('content')}}</textarea>
            </div>
            <div class="card-footer text-muted">
                <input type="submit"  class="btn btn-primary" value="Send Message">
            </div>
        </div>

    </form>
@endsection
