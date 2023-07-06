@extends("layouts.app")
@section("content")
<html>
<head>
    <style>
        #container{
            text-align:center;
            min-height:650px;
        }
        #table{
            display:flex;
            flex-direction:column;
            background-color:grey;
            width:30%;
            border:2px solid black;
            border-radius:6px;
            margin-bottom:10px;
        }
        article{
            background-color:lightgrey;
            text-align:left;
            width:100%;
        }
        section{
            display:flex;
            width:100%;
        }
        .modal-header{
            text-align:center;
            justify-content:center;
        }
        #btn-group{
          display:flex;
          align-items:center;
          justify-content: center;
        }
        #btn-group>button{
          margin:5px;
        }
        #links{
          width:100%;
          display:flex;
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
    <h1>Welcome {{ Auth::user()->name }}</h1>
    <p>My first Laravel Project...first step to great things</p>
    @foreach ($items as $data)
    <div id="table">
        <h4>{{ $data->name }}</h4>
        <section>
          <article>{{ $data->content }}</article></section>
          <div id="btn-group">
            <button class="btn btn-danger btn-sm myBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
            <a href="{{route('edit',['id'=> $data->id])}}"><button class="btn btn-primary btn-sm">Edit</button></a>
          </div>
    
    </div>
    

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-center" id="exampleModalLabel">Are you sure?</h5>
      </div>
      <div class="modal-body">
        Data will be permanently deleted from the database and cannot be recovered.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="{{ url('/delete/' . $data->id ) }}"><button type="button" class="btn btn-danger">Confirm Delete</button></a>
      </div>
    </div>
  </div>
</div>
@endforeach
<div id="links">
  {{ $items->links('vendor.pagination.bootstrap-5') }}
</div>
</div>
</body>
</html>
@endsection



