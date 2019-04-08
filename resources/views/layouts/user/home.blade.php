@extends('layouts.user.user-master')
@section('title-page', 'User Home')
@section('header', 'Home')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-user">
                    <div class="image">
                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                    </div>
                    <br>
                    <div class="content">
                        <div class="author">
                             <a href="#">
                            <img class="avatar border-gray" src="/img/faces/face-3.jpg" alt="..."/>
                                <br>
                              <h4 class="title">Mike Andrew<br />
                                 <small>michael24</small>
                              </h4>
                            </a>
                        </div>
                        <p class="description text-center"> "Lamborghini Mercy <br>
                                            Your chick she so thirsty <br>
                                            I'm in that two seat Lambo"
                        </p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button href="#" class="btn btn-simple"><i class="fas fa-envelope"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-black" style="padding: 30px;" align="center" >
                  <div class="card-header"><h2 class="card-title">Posts</h2></div>
                  <div class="card-body">
                    <p class="card-text"><h3>3</h3></p>
                  </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-black" style="padding: 30px;" align="center" >
                  <div class="card-header"><h2 class="card-title">Download</h2></div>
                  <div class="card-body">
                    <p class="card-text"><h3>22</h3></p>
                  </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-black" style="padding: 30px;" align="center" >
                  <div class="card-header"><h2 class="card-title">Purchase</h2></div>
                  <div class="card-body">
                    <p class="card-text"><h3>0</h3></p>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
