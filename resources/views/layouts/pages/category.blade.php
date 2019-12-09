@extends('layouts/master')
@section('body')
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-sm-4 border-top border-right border-left border-bottom border-success">
                    <h3 class="card-title">{{$post->title}}</h3>
                    <div class="card mb-3">
                        <img class="card-img-top" src="{{url('/')."/storage/".$post->image}}" alt="{{$post->slug}}">
                    </div>
                </div>
                <div class="col-sm-8 border-top border-right border-bottom border-success">
                    <div class="row">
                        <div class="col border-bottom border-success">
                            <div class="card-body ">
                                <h5 class="card-subtitle ">{{$post->seo_title}}</h5>
                                <p class="card-text text-truncate text-md-left">{{$post->excerpt}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-8">
                            <h3></h3>
                            <p class="card-text">{{$post->body}}</p>
                        </div>
                        <div class="col-4 border-left border-secondary">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item">
                                    <form class="form-inline" method="get"
                                          action="{{url('/posts/'.$post->id.'/edit')}}">
                                        {{ csrf_field() }}
                                        <input class="btn btn-primary" type="submit" value="Update Post">
                                    </form>
                                </a>
                                <a class="list-group-item">
                                    <form class="form-inline" method="post" action="{{ url('/posts/'.$post->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input class="btn btn-primary" type="submit" value="Delete"/>
                                    </form>
                                </a>
                                <a class="list-group-item">
                                    <form class="form-inline">
                                        <button class="btn btn-primary">Show Reviews</button>
                                    </form>
                                </a>
                                <a class="list-group-item">
                                    <form class="form-inline">
                                        <button class="btn btn-primary">Add Reviews</button>
                                    </form>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- card -->
            @endforeach

        </div>
        {{ $posts->links() }}
    </div>
@endsection
