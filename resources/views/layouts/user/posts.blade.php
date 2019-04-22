@extends('layouts.user.user-master')
@section('title-page', 'User Posts')
@section('header')
    <i class="pe-7s-news-paper"></i>&nbsp;&nbsp;Posts
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row" id="normal-search">
            <div class="col-md-10">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Search..." aria-label="Search">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button type="button" class="btn" name="button" id="btn-advance"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Advance Search</button>
                </div>
            </div>
        </div>
        <div class="row" id="advance-search">
            <div class="col-sm-12">
                <div class="card" style="padding: 20px;">
                    <h4 class="card-title">Advance Search</h4>
                    <div class="card-body">
                        <form class="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name" value="Mike">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Facebook</label>
                                        <input type="facebook" class="form-control" placeholder="Facebook">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Search</button>
                            <button type="button" class="btn btn-success btn-fill pull-left" id="btn-normal">Normal Search</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Lecture note : Calculus 1</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <br>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-download fa-fw"></i>&nbsp;&nbsp;10</span></p>
                  <hr>
                  <p><a href="{{ action('PostsController@update') }}"><i class="fas fa-edit fa-fw"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-trash-alt fa-fw"></i></a>
                      <!-- &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-eye"></i></a> -->
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-eye-slash"></i></a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Text Book : Calculus 2</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <br>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-download fa-fw"></i>&nbsp;&nbsp;2</span></p>
                  <hr>
                  <p><a href="{{ action('PostsController@update') }}"><i class="fas fa-edit fa-fw"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-trash-alt fa-fw"></i></a>
                      <!-- &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-eye"></i></a> -->
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-eye-slash"></i></a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Lecture note : Calculus 3</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <br>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-download fa-fw"></i>&nbsp;&nbsp;10</span></p>
                  <hr>
                  <p><a href="{{ action('PostsController@update') }}"><i class="fas fa-edit fa-fw"></i></a>
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-trash-alt fa-fw"></i></a>
                      <!-- &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-eye"></i></a> -->
                      &nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-eye-slash"></i></a>
                  </p>
                </div>
              </div>
            </div>
        </div>
    </div>
    <a href="{{ action('PostsController@create') }}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
    <div class="label-container">
        <div class="label-text">Create new post</div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#posts').addClass('active');

            $('#advance-search').hide();

            $('#btn-advance').click(function () {
                $('#advance-search').show();
                $('#normal-search').hide();
            });

            $('#btn-normal').click(function () {
                $('#advance-search').hide();
                $('#normal-search').show();
            });
        });
    </script>
@endsection