<?php
use App\NavMenus;
$navmenus = NavMenus::all();
?>
<header class="d-flex align-self-center" style="background-color: cornsilk">
    <div class="container">
        <img src="{{url('/')."/storage/images/sharesquare.png"}}">
    </div>
</header>
<nav class="navbar bg-dark navbar-dark navbar-expand-md mb-5">
    <div class="container">
        <button class="navbar-toggler" type="button"
                data-toggle="collapse" data-target="#myToggleNav"
                aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="myToggleNav">
            <div class="navbar-nav">
                <a href="{{url('/')}}" class="navbar-brand">Share Square</a>
                @foreach($navmenus as $navmenu)
                    <a class="nav-item nav-link " href="/pages/{{$navmenu->navtype}}">{{$navmenu->name}}</a>
                @endforeach
            </div><!--navbar nav-->
        </div><!--collapse-->
        <div class="d-none d-sm-inline-block">
            @if (Route::has('login'))
                @auth
                    <a class="align-self-center mr-2 " href="{{ url('/dashboard') }}">Dashboard</a>
                    <a class="align-self-center mr-2 " href="{{ url('/messages') }}">Messages</a>
                @else
                    <a class="align-self-center mr-2 " href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <span class="d-sm-inline-block align-self-center text-light mr-2"> | </span>
                        <a class="align-self-center mr-2" href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        @endif

        <!--            <button type="button" class="btn btn-secondary mr-2"-->
            <!--                    data-toggle="collapse" data-target="#searchButton"-->
            <!--                    aria-expanded="false" aria-label="Toggle Search" role="button"-->
            <!--                    aria-controls="collapsemySearchButton">-->
            <!--                <img src="storage/images/search_icon.jpg" width="15px">-->
            <!--            </button>-->
            <div id="searchButton" class="d-sm-inline-block">
                <form class="form-inline" method="get" action="/search">
                    {{ csrf_field() }}
                    <input class="form-control mr-2" type="text" name = "searchString" placeholder="Search">
                    <button class="btn btn-outline-light" type="submit">Go</button>
                </form>
            </div>
        </div>
    </div><!--container-->
</nav><!--navbar--->
