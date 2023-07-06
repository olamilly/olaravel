@extends("layouts.app")
@section("content")
<html>
<head>
    <style>
        h1{
            text-align:center;
        }
        form{
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        form>div{
            margin:5px;
            display:flex;
            flex-direction:column;
            width:40%;
        }
        input{
            padding:.5rem;
            border-radius:5px;
        }
        button{
            margin:5px;
        }
    </style>
</head>
<body>
<div id="container">
    <a href="{{ url('/') }}"><box-icon name='arrow-back'></box-icon></a>
    <h1>Form</h1>
    <form method="post" action="{{route('successful')}}">
        {{ csrf_field() }}
        <div>
        <label for="name">Name</label>
        <input name="name"/></div>
        <div>
        <label for="content">Content</label>
        <input name="content"/></div>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
@endsection