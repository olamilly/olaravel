@extends("layouts.app")
@section("content")
<html>
<head>
<style>
  
    #container{
        height:100%;
        margin-left:10px;
    }
    h1{
        text-align:center;
    }
    .row{
        margin:15px;
    }
</style>
</head>
<body>
<div id="container">
<a href="{{route('home')}}"><box-icon name='arrow-back'></box-icon></a>
<h1>{{$editData->name}}</h1>
<form method="post" action="{{route('updated',['id'=>$editData->id])}}">
{{ csrf_field() }}
<div class="form-group row" >
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" Value="{{ $editData->name }}">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Content</label>
    <div class="col-sm-10">
      <input type="text" name="content" class="form-control" Value="{{ $editData->content }}">
    </div>
  </div>
  <div class="form-group text-center">
    <button type="submit" class="btn btn-primary align-self-center">Update</button>
</div>
</form>
</div>
</body>
</html>
@endsection