@extends("layouts.app")
@section("content")
<html>
<head>
<style>
    #container{
        text-align:center;
    }
    .dataBox{
        color: white;
        min-width: 200px;
        border-radius:7px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        margin:35px;
        padding:10px;
    }
    #data{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #users{
        background-color:green;
    }
    #todo{
        background-color:red;
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
    <h1>Welcome Admin, {{ Auth::user()->name }}</h1>
    <div id=data>
    <a href="{{route('userlist')}}"><div class=dataBox id=users>
            <h3>Users</h3>
            <p>{{ $userNumber }}</p>
        </div></a>
    <a href="{{route('itemlist')}}"><div class=dataBox id=todo>
            <h3>Todo Items</h3>
            <p>{{ $todoNumber }}</p>
        </div></a>
    </div>
</div>
</body>
</html>
@endsection



