@extends('layouts.user.user-master')
@section('title-page', 'User Create Post')
@section('header', 'Create New Post')
@section('content')

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
	<script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>

    <style>
    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        display: inline-block;
        padding: 4px 6px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 22px;
        cursor: text;
        height: 40px;
    }
    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: text-bottom;
        border-radius: .25em;
    }
    </style>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <!-- <h4 class="title">Create New Post</h4> -->
                    </div>
                    <div class="content">
                        <form action="{{ action('PostsController@store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                            <h5>Information</h5><hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>title</label>
                                        <input rows="5" name="title" id="title" placeholder="Title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title')}}">
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
                                        <input type="file" name="image" accept="image/*" class="form-control-file" onchange="readURL(this);">
                                        <br><img src="" id="profile-img-tag" width="300px" style="display: none"/>
                                        @if ($errors->has('image'))
                                            <div class="invalid-feedback" style="color: red">
                                                {{ $errors->first('image')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>description</label>
                                        <input rows="5" name="description" class="form-control" value="{{ old('description')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">category</label><br>
                                        <select class="form-control" id="category" name="category" value="{{ old('category')}}">
                                            @foreach($categorys as $category)
                                                <option value="{{ $category}}" >{{ $category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tags:</label>
                                        <br/>
                                        <input data-role="tagsinput" type="text" name="tags" id="input-tags" class="typeahead form-control" value="{{ old('tags')}}">
                                    </div>	
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>detail</label>
                                        <textarea name="post_detail" rows="3" class="form-control" id="editor1" placeholder="Here can be your description" >{{ old('post_detail')}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <h5>Upload Files</h5><hr>
                            <div class="row">
                                <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleFormControlFile1">Example file input</label>
                                        <input type="file" name="file[]" id="file" class="form-control-file" multiple>
                                      </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-info btn-fill pull-right upload-image">Create Post</button>
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
    <!-- <script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script> -->
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
