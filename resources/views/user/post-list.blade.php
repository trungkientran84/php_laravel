@extends('layouts.user-master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="row card-header">
                        <div class="col-sm-12 col-md-6"><h4>{{$title}}</h4></div>
                        <div class="col-sm-12 col-md-6">
                            <form action="{{Request::url()}}"
                                  class="form-inline md-form form-sm active-cyan active-cyan-2 mt-2">
                                <i class="voyager-search" aria-hidden="true"></i>
                                <input class="form-control form-control-sm ml-3 w-100" type="text" placeholder="Search"
                                       name="search"
                                       aria-label="Search" value="{{Request::input('search')}}">
                            </form>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                        <?php
                        $count = 0;
                        ?>

                        <!--Rendering each post-->
                            @foreach($posts as $post)
                                <?php if($count != 0 && $count % 3 == 0){ ?>
                                    </div>
                                    <div class="row">

                                <?php }
                                    $count++;
                                ?>
                            <div class="col-sm-4">
                                <section class="card mb-5">
                                    <img class="card-img-top" src="storage/{{$post->image}}" alt="{{$post->title}}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="well well-sm text-center">
                                                <div class="rating">
                                                    <span class="glyphicon glyphicon-star"></span>
                                                    <span class="glyphicon glyphicon-star"></span>
                                                    <span class="glyphicon glyphicon-star"></span>
                                                    <span class="glyphicon glyphicon-star"></span>
                                                    <span class="glyphicon glyphicon-star-empty"></span>
                                                </div>
                                                <div class="row statistic mt-5">
                                                    <div class="col-xs-4 text-center">
                                                        <span
                                                            class="glyphicon glyphicon-star"></span>{{$post->total_ratings}}
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <span
                                                            class="glyphicon glyphicon-edit"></span>{{$post->total_comments}}
                                                    </div>
                                                    <div class="col-xs-4 text-center">
                                                        <span
                                                            class="glyphicon glyphicon-eye-open"></span>{{$post->total_views}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            <div>
                                {{ $posts->links() }}
                            </div>

                            <div role="status" class="show-res" aria-live="polite">{{ trans_choice(
                                    'voyager::generic.showing_entries', $posts->total(), [
                                        'from' => $posts->firstItem(),
                                        'to' => $posts->lastItem(),
                                        'all' => $posts->total()
                                    ]) }}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
