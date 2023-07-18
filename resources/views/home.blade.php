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
            padding:2px;
        }
        article{
            background-color:lightgrey;
            text-align:left;
            width:100%;
            border-radius:3px;
            padding:1px;
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
        #itemid{
          display:none;
        }
    </style>
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
        <h4>{{ $data->username }}</h4>
        <section>
          <article>{{ $data->content }}</article>
        </section>
        @if( $data->user_id == Auth::User()->id)
          <div id="btn-group">
            <p id=itemid>{{$data->id}}</p>
            <button class="btn btn-danger btn-sm myBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
            <a href="{{route('edit',['id'=> $data->id])}}"><button class="btn btn-primary btn-sm">Edit</button></a>
          </div>
        @endif
    </div>
    

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-center" id="exampleModalLabel">Are you sure?</h5>
      </div>
      
      <form method="post" action="{{route('delete')}}">
                    {{ csrf_field() }}
                    <div class="modal-body">
                    Data will be permanently deleted from the database and cannot be recovered.
                    </div>
                    <div class="modal-footer">
                        <input type=hidden id=delitemid name=item_id />
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </div>
                    </form>
      
      
    </div>
  </div>
</div>
@endforeach
<div id="links">
  {{ $items->links('vendor.pagination.bootstrap-5') }}
</div>
</div>
<script>
   
    var boxList = document.querySelectorAll(".myBtn");
      boxList.forEach(box => {
        box.addEventListener('click', function b(){boxOperation(this)});
      });
    function boxOperation(e){
        var val= e.closest('#btn-group').children[0].innerText;
        document.getElementById("delitemid").value=val;  
    }
</script>
</body>
</html>
@endsection



