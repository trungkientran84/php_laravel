@extends('layouts.user-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-8">
                        <h4> Dashboard</h4>
                    </div>
                    <div class="col-md-4">
                        <form action="{{route('user.dashboard')}}">
                            <!--Render the combobox of history year. When user select the item, submit the target year to dashboard route-->
                            <select class="form-control" style="margin-top: 2px" name="year" onchange="this.form.submit()">
                                @foreach($historyYear as $hyear)
                                    @if($year == $hyear->year)
                                        <option selected value="{{$hyear->year}}">{{$hyear->year}}</option>
                                    @else
                                        <option value="{{$hyear->year}}">{{$hyear->year}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                        <script>
                            function yearChange() {

                            }
                        </script>
                    </div>

                </div>

                <div class="card-body">
                    <!--Show the status if any-->
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!--Generate the statistic-->
                    <div class="clearfix container-fluid row">
                        <div class="col-xs-12 col-sm-6 col-md-4"><div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('http://127.0.0.1:8000/admin/voyager-assets?path=images%2Fwidget-backgrounds%2F01.jpg');">
                                <div class="dimmer"></div>
                                <div class="panel-content">
                                    <i class="voyager-group"></i>        <h4>{{$totalViews}} views</h4>
                                </div>
                            </div>
                        </div><div class="col-xs-12 col-sm-6 col-md-4"><div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('http://127.0.0.1:8000/admin/voyager-assets?path=images%2Fwidget-backgrounds%2F02.jpg');">
                                <div class="dimmer"></div>
                                <div class="panel-content">
                                    <i class="voyager-news"></i> <h4>{{$totalPosts}} Posts</h4>
                                </div>
                            </div>
                        </div><div class="col-xs-12 col-sm-6 col-md-4"><div class="panel widget center bgimage" style="margin-bottom:0;overflow:hidden;background-image:url('http://127.0.0.1:8000/admin/voyager-assets?path=images%2Fwidget-backgrounds%2F03.jpg');">
                                <div class="dimmer"></div>
                                <div class="panel-content">
                                    <i class="voyager-star"></i> <h4>{{$totalRatings}} Ratings</h4>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Monthly post chart-->
                    <div class="clearfix container-fluid row">
                        {!! $monthly_post->container() !!}
                        {!! $monthly_post->script() !!}
                    </div>
                    <!--Monthly statistic-->
                    <div class="clearfix container-fluid row">
                        {!! $monthly_interactive_chart->container() !!}
                        {!! $monthly_interactive_chart->script() !!}
                    </div>
                    <!--Rating statistic-->
                    <div class="clearfix container-fluid row">
                        {!! $rating_chart->container() !!}
                        {!! $rating_chart->script() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
