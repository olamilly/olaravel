@extends("layouts.app")
@section("content")
<html>
<head>
<style>
    #container{
        text-align:center;
    }
</style>
</head>
<body>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery.js"></script>
  <!-- Include all compiled plugins (below), or include individual files 
        as needed -->
  <script src="js/bootstrap.min.js"></script>
<div id="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h1>Edit {{ $name }}</h1>
    <form method="post" action="{{route('updateuser')}}">
    <input type=hidden name=id value="{{ $id }}">
{{ csrf_field() }}
<div class="form-group row my-2" >
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" name="name" class="form-control" Value="{{ $name }}">
    </div>
  </div>
  <div class="form-group row my-2">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" name="email" class="form-control" Value="{{ $email }}">
    </div>
  </div>
  @if(Auth::User()->role == "admin")
  <div class="form-group row my-2">
  <label class="col-sm-2 col-form-label">Role</label>
  <div class="col-sm-10">
  <select name="role" class="select form-control">
  
  <option value="user">User</option>
  <option value="admin">Admin</option>
</select></div>
  </div>
  @endif
  <div class="form-group text-center">
    <button type="submit" class="btn btn-primary align-self-center">Update</button>
</div>
</form>
</div>
<script>
  console.log(document.getElementById("dropdownMenuButton").value);
</script>
</body>
</html>
@endsection



