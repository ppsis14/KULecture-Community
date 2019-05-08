@extends('layouts.admin.admin-master')
@section('title-page', 'Dashboard')
@section('header')
    <i class="pe-7s-graph"></i>&nbsp;&nbsp;Dashboard
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <div class="header">
                        <h4 class="title">User</h4>
                        <p class="category">Number of users except admins  </p>
                    </div>
                    <div class="content">
                        <!-- <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div> -->
                        <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$users}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Users</h3>
                        <div class="footer">
                            <!-- <div class="legend">
                                <i class="fa fa-circle text-info"></i> Open
                                <i class="fa fa-circle text-danger"></i> Bounce
                                <i class="fa fa-circle text-warning"></i> Unsubscribe
                            </div> -->
                            <hr>
                            <!-- <div class="stats">
                                <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Post</h4>
                        <p class="category">Number of posts</p>
                    </div>
                    <div class="content">
                        <h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$posts}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Posts </h3> 
                        <div class="footer">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Login stats ({{ date('d-m-Y')}})</h4>
                        <p class="category">Peroid time that user login</p>
                    </div>
                    <div class="content">
                        <div id="panel-body" class="ct-chart">
                            {!! $loginChart->container() !!}
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
                        {!! $loginChart->script() !!}
                        
                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-check"></i> Data information certified
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Post stats</h4>
                        <p class="category">All category</p>
                    </div>
                    <div class="content">
                        <div id="panel-body" class="ct-chart">
                            {!! $postChart->container() !!}
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

                        {!! $postChart->script() !!}

                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-check"></i> Data information certified
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();
            $('#dashboard').addClass('active');

        });
    </script>
@endsection
