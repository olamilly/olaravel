@extends("layouts.app")
@section("content")
<html>
<head>
    <style>
        #container{
            text-align:center;
            min-height:650px;
        }
       
        .modal-header{
            text-align:center;
            justify-content:center;
        }
        
    </style>
    <script>$(document).ready(function() {
    $(".myBtn").click(function() {
        $("#exampleModal").modal("show");
    });
});
</script>
</head>
<body>
<div id="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (Auth::user()->role == "admin")
      <h1>Admin</h1>
    @endif
    @if (Auth::user()->role == "user")
      <h1>User</h1>
    @endif
    <h1>Welcome {{ Auth::user()->name }}</h1>
    <p>{{  Auth::user()->email }}</p>
    
    <div id="btn-group">
        <a href="{{route('edituser', ['id'=>Auth::user()->id])}}"><button class="btn btn-primary ">Edit</button></a>
        <button class="btn btn-danger  myBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
    </div>
    
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-center" id="exampleModalLabel">Are you sure?</h5>
      </div>
      <div class="modal-body">
        Your profile will be permanently deleted from the database and cannot be recovered.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ route('deleteuser', ['id'=>Auth::user()->id]) }}"><button type="button" class="btn btn-danger">Confirm Delete</button></a>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>
@endsection



