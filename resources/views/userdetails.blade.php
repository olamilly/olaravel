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
            text-align:center;
            margin-bottom:1rem;
            width:100%;
            border-radius:3px;
            padding:1px;
        }
        section{
            display:flex;
            width:100%;
            flex-direction:column;
            align-items:center;
            justify-content:center;
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
    <h1>{{ $user->role }} {{ $user->name }}</h1>
    <p>{{ $user->email }}</p>
    <hr>
    <h2>{{ $user->name }} Items</h2>
    @foreach ($items as $data)
    <div id="table">
        <h2>{{ $data->username }}</h2>
        <section>
          <p>Item Id: {{ $data->id }}</p>
          <article>{{ $data->content }}</article>
          <p>Created at: {{$data->created_at}}</p>
          @if($data->completed == 1)
          <p>Completed: yes</p>
          @endif
          @if($data->completed == 0)
          <p>Completed: no</p>
          @endif
        </section>
    </div>
    @endforeach
</div>
</body>
</html>
@endsection



