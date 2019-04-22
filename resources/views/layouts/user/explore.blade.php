@extends('layouts.user.user-master')
@section('title-page', 'Posts Explorer')
@section('header')
    <i class="pe-7s-global"></i>&nbsp;&nbsp;Posts Explorer
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row" id="normal-search">
            <form action="{{ action('ExplorePostsController@search') }}" role="search" method="get">
            <div class="col-md-10">
                <div class="form-group"> 
                    <input class="form-control" type="text" name="title" placeholder="Search..." aria-label="Search" value="{{ old('title')}}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <button type="submit" class="btn" name="button" id="btn-search"><i class="fas fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            </form>

            <div class="col-md-3">
                <div class="form-group">
                    <button type="button" class="btn" name="button" id="btn-advance"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Advance Search</button>
                </div>
            </div>
        </div>

        <div >
            @if(isset($query))
            <p>The search result for <b>{{ $query }}</b> are :</p>
            @endif
        </div>
        <div class="row" id="advance-search">
            <div class="col-sm-12">
                <div class="card" style="padding: 20px;">
                    <h4 class="card-title">Advance Search</h4>
                    <div class="card-body">
                        <form action="{{ action('ExplorePostsController@advance') }}" role="search" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Post Title</label>
                                        <input type="text" class="form-control" name="post_title">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <!-- <input type="text" class="form-control" placeholder="Last Name" value="Andrew"> -->
                                        <br><select name="post_tag">
                                          <option value="free">FREE</option>
                                          <option value="sale">FOR SALE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
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
                            </div> -->
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
        @if(isset($details))
          @foreach($details as $post)
            <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">{{$post->post_title}}</a></h4>
                  <p class="card-text">{{$post->post_detail}}</p>
                  <p class="card-text"><small class="text-muted">Tag by : <a>{{$post->post_tag}}</a></small></p>
                  <p class="card-text"><small class="text-muted">Post by : <a>Thikamporn Simud</a></small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small><span><a class="close" href="#"><i class="fas fa-download fa-fw"></i></a></span></p>
                </div>
              </div>
            </div>
            @endforeach
        @endif
          
            <div class="col-md-4">
                @if(isset($message))
                <p>{{ $message }}</p>
			          @endif
            </div>
            <!-- <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Text Book : Calculus 1</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Post by : <a>Thikamporn Simud</a></small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small><span><a class="close" href="#"><i class="fas fa-donate fa-fw"></i></a></span></p>
                </div>
              </div>
            </div> -->
            <!-- <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Text Book : Calculus 2</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Post by : <a>Thikamporn Simud</a></small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small><span><a class="close" href="#"><i class="fas fa-donate fa-fw"></i></a></span></p>
                </div>
              </div>
            </div> -->
            <!-- <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Lecture note : Calculus 1</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Post by : <a>Thikamporn Simud</a></small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small><span><a class="close" href="#"><i class="fas fa-download fa-fw"></i></a></span></p>
                </div>
              </div>
            </div> -->
            <!-- <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Lecture note : Calculus 1</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Post by : <a>Thikamporn Simud</a></small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small><span><a class="close" href="#"><i class="fas fa-download fa-fw"></i></a></span></p>
                </div>
              </div>
            </div> -->
            <!-- <div class="col-sm-6">
              <div class="card" style="padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><a href="#">Lecture note : Calculus 1</a></h4>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Post by : <a>Thikamporn Simud</a></small></p>
                  <hr>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small><span><a class="close" href="#"><i class="fas fa-download fa-fw"></i></a></span></p>
                </div>
              </div>
            </div> -->
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#explorer').addClass('active');

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
