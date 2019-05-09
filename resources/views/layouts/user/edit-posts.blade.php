@extends('layouts.user.user-master')
@section('title-page', 'User Edit Post')
@section('header', 'Edit Post')
@section('content')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
	<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <!-- <h4 class="title">Edit Post</h4> -->
                    </div>
                    <div class="content">
                        <form action="{{ action('PostsController@update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>title</label>
                                        <input rows="5" name="title" id="title" placeholder="Title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title', $post->post_title)}}">
                                        @if ($errors->has('title'))
                                            <div class="invalid-feedback" style="color: red">
                                                {{ $errors->first('title')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>image cover</label>
                                        <input type="file" name="image" accept="image/*" class="form-control-file" id="image" value="{{ old('image')}}" onchange="readURL(this);">
                                        <br>
                                        @if($post->post_cover == null)
                                            <img src="" id="profile-img-tag" width="300px" style="display: none"/>
                                        @endif
                                        @if($post->post_cover != null)
                                            <img src="{{ URL::to('/') }}/images/{{ $post->post_cover }}" id="profile-img-tag" width="300px"/>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>description</label>
                                        <input rows="5" name="description" class="form-control" value="{{ old('description', $post->description) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">category</label><br>
                                        <select class="form-control" id="category" name="category" value="{{ old('category', $post->category) }}">
                                            <option value="{{$post->category}}">{{$post->category}}</option>   
                                            
                                            @foreach($categories_name as $category)
                                                @if($post->category != $category)
                                                    <option value="{{ $category}}" >{{ $category}}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tags:</label>
                                        <br/>
                                        <input data-role="tagsinput" type="text" name="tags" id="input-tags" class="typeahead form-control" value="{{ old('tags', $post->post_tag)}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>detail</label>
                                        <textarea name="post_detail" rows="3" class="form-control" id="editor1" >{{ old('detail', $post->post_detail) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <h5>Upload Files</h5><hr>
                            <div class="row">
                                <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleFormControlFile1">Example file input</label>
                                        <input type="file" name="file[]" id="file" class="form-control-file form-group {{ $errors->has('file') ? ' is-invalid' : '' }}" multiple>
                                      </div>
                                </div>
                            </div>
                            @if ($errors->has('file.*'))
                                            <div class="invalid-feedback" style="color: red">
                                                {{ $errors->first('file.*')}}
                                            </div>
                                        @endif
                            <hr>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Edit Post</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor1' );
    </script>
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#profile-img-tag').attr('src', e.target.result);
                    $('#profile-img-tag').show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#profile-img").change(function(){
            readURL(this);
        });
    </script>

<script type="text/javascript">
	$('#input-tags').tagsInput();
</script>
@endsection
