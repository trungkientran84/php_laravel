<?php
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<header>

</header>
<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="https://mdbootstrap.com/docs/jquery/" target="_blank">
            <strong class="blue-text">Share Square</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link waves-effect" href="#">Display Post
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ URL::to('editPost', ['id' => $postData["post_id"]])}}" target="_blank">Edit Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ URL::to('deletePost', ['id' => $postData["post_id"]])}}"
                       target="_blank">Delete Post</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ URL::to('addPost') }}" target="_blank">Create New</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ URL::to('promotePost', ['id' => $postData["post_id"]])}}"
                       target="_blank">Promote Post</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<!-- Navbar -->
<main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">
        <p class="h4 mb-4 text-left">{{ $postData["title"] }}</p>
        <!--Grid row-->
        <div class="row wow fadeIn">
            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Carousel Wrapper-->
                <div id="carousel-example-1z" class="carousel slide carousel-fade carousel-fade" data-ride="carousel">
                    <!--Indicators-->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                        @for($i=1;$i<$postData["images"]->count();$i++)
                            {
                        <li data-target="#carousel-example-1z" data-slide-to="{{ $i }}"></li>
                            }
                        @endfor
                    </ol>
                    <!--/.Indicators-->
                    <!--Slides-->
                    <div class="carousel-inner z-depth-1-half" role="listbox">
                        <!--First slide-->
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('photos/'.$postData["images"][0]) }}" alt="First slide">
                        </div>
                        <!--/First slide-->
                        <!--Second slide-->
                        @for($i=1;$i<$postData["images"]->count();$i++)
                            {
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset('photos/'.$postData["images"][$i]) }}">
                            </div>
                            }
                        @endfor
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <!--/.Controls-->
                </div>
                <!--/.Carousel Wrapper-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Content-->
                <div class="p-4">

                    <p class="lead font-weight-bold">Description</p>

                    <p>{{ $postData["Description"] }}</p>

                    <form class="d-flex justify-content-left">
                        <button class="btn btn-primary btn-md my-0 p" type="submit">Contact Owner
                            <i class="fa fa-address-card ml-1"></i>
                        </button>

                    </form>

                </div>
                <!--Content-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <!--Grid row-->
        <div class="row d-flex justify-content-center wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 text-center">

                <h4 class="my-4 h4">Additional information</h4>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            @foreach($postData as $key => $value)
                @if($key != 'post_id' and $key != 'post_category' and $key != 'title' and $key!='images')
                    <div class="col-lg-4 col-md-12 mb-4">

                        <p>{{$key}} : {{$value}}</p>

                    </div>
                    @endif
            @endforeach
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </div>

</main>
<footer>

</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
