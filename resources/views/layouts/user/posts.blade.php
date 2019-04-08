@extends('layouts.user.user-master')
@section('title-page', 'User Posts')
@section('header', 'Posts')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <form class="form-inline">
                  <input class="form-control" type="text" placeholder="Search" aria-label="Search">&nbsp;&nbsp;
                  <span><i class="fas fa-search" aria-hidden="true"></i></span>
                </form>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-info" href="{{ action('PostsController@create') }}"><i class="fas fa-plus fa-fw"></i>&nbsp;&nbsp;Create New Post</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title">Lecture note : Calculus 1</h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <br>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-download fa-fw"></i>&nbsp;&nbsp;10</span></p>
                  <p><a href="{{ action('PostsController@update') }}"><i class="fas fa-edit fa-fw"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-trash-alt fa-fw"></i></a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title">Text Book : Calculus 2</h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <br>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-download fa-fw"></i>&nbsp;&nbsp;2</span></p>
                  <p><a href="{{ action('PostsController@update') }}"><i class="fas fa-edit fa-fw"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-trash-alt fa-fw"></i></a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title">Lecture note : Calculus 3</h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <br>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>&nbsp;&nbsp;&nbsp;&nbsp;<span><i class="fas fa-download fa-fw"></i>&nbsp;&nbsp;10</span></p>
                  <p><a href="{{ action('PostsController@update') }}"><i class="fas fa-edit fa-fw"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fas fa-trash-alt fa-fw"></i></a></p>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection
